<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProjectService
{
    /**
     * Get optimized projects list with eager loading.
     */
    public function getProjectsWithStats(?int $clientId = null): LengthAwarePaginator
    {
        return Project::query()
            ->with(['client:id,name', 'user:id,name'])
            ->withCount(['tasks', 'timeLogs'])
            ->withSum('timeLogs', 'duration')
            ->when($clientId, fn (Builder $query) => $query->where('client_id', $clientId))
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    /**
     * Get project dashboard statistics.
     */
    public function getDashboardStats(): array
    {
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', 'in_progress')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        
        // Projets récents avec eager loading
        $recentProjects = Project::query()
            ->with(['client:id,name', 'user:id,name'])
            ->latest()
            ->limit(5)
            ->get();

        // Statistiques par client (optimisé)
        $clientStats = Client::query()
            ->withCount([
                'projects',
                'projects as active_projects_count' => fn (Builder $query) => 
                    $query->where('status', 'in_progress')
            ])
            ->having('projects_count', '>', 0)
            ->orderByDesc('projects_count')
            ->limit(10)
            ->get();

        return [
            'total_projects' => $totalProjects,
            'active_projects' => $activeProjects,
            'completed_projects' => $completedProjects,
            'completion_rate' => $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100, 1) : 0,
            'recent_projects' => $recentProjects,
            'client_stats' => $clientStats,
        ];
    }

    /**
     * Get project details with all related data.
     */
    public function getProjectWithDetails(int $projectId): ?Project
    {
        return Project::query()
            ->with([
                'client:id,name,email',
                'user:id,name,email',
                'tasks' => fn ($query) => $query->orderBy('created_at'),
                'timeLogs' => fn ($query) => $query->latest()->limit(10),
                'timeLogs.user:id,name'
            ])
            ->withCount(['tasks', 'timeLogs'])
            ->withSum('timeLogs', 'duration')
            ->find($projectId);
    }

    /**
     * Search projects with optimized query.
     */
    public function searchProjects(string $search, ?int $clientId = null): Collection
    {
        return Project::query()
            ->with(['client:id,name', 'user:id,name'])
            ->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($clientId, fn (Builder $query) => $query->where('client_id', $clientId))
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();
    }

    /**
     * Get projects by status with performance optimization.
     */
    public function getProjectsByStatus(string $status): Collection
    {
        return Project::query()
            ->with(['client:id,name', 'user:id,name'])
            ->where('status', $status)
            ->withCount('tasks')
            ->orderByDesc('updated_at')
            ->get();
    }

    /**
     * Calculate project metrics for analytics.
     */
    public function getProjectMetrics(): array
    {
        // Utilisation de requêtes groupées pour optimiser les performances
        $statusCounts = Project::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $monthlyStats = Project::query()
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $averageProjectDuration = Project::query()
            ->whereNotNull('end_date')
            ->whereNotNull('start_date')
            ->selectRaw('AVG(DATEDIFF(end_date, start_date)) as avg_duration')
            ->value('avg_duration');

        return [
            'status_counts' => $statusCounts,
            'monthly_stats' => $monthlyStats,
            'average_duration' => round($averageProjectDuration ?? 0, 1),
        ];
    }
}