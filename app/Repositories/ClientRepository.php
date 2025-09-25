<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository
{
    /**
     * Get paginated clients with optimized relations.
     */
    public function getPaginatedClients(int $perPage = 15): LengthAwarePaginator
    {
        return Client::query()
            ->withCount(['projects', 'users', 'tickets'])
            ->withSum('projects', 'budget')
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Find client with all related data.
     */
    public function findWithDetails(int $clientId): ?Client
    {
        return Client::query()
            ->with([
                'projects' => fn ($query) => $query->latest()->limit(10),
                'projects.user:id,name',
                'users:id,name,email,client_id',
                'tickets' => fn ($query) => $query->latest()->limit(5),
            ])
            ->withCount(['projects', 'users', 'tickets'])
            ->withSum('projects', 'budget')
            ->find($clientId);
    }

    /**
     * Search clients by name or email.
     */
    public function search(string $search): Collection
    {
        return Client::query()
            ->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('company', 'like', "%{$search}%");
            })
            ->withCount('projects')
            ->orderBy('name')
            ->limit(20)
            ->get();
    }

    /**
     * Get clients with active projects.
     */
    public function getClientsWithActiveProjects(): Collection
    {
        return Client::query()
            ->whereHas('projects', fn (Builder $query) => 
                $query->where('status', 'in_progress')
            )
            ->withCount([
                'projects',
                'projects as active_projects_count' => fn (Builder $query) => 
                    $query->where('status', 'in_progress')
            ])
            ->orderBy('name')
            ->get();
    }

    /**
     * Get client statistics for dashboard.
     */
    public function getClientStats(): array
    {
        $totalClients = Client::count();
        
        $clientsWithProjects = Client::query()
            ->has('projects')
            ->count();
            
        $topClients = Client::query()
            ->withCount('projects')
            ->withSum('projects', 'budget')
            ->having('projects_count', '>', 0)
            ->orderByDesc('projects_count')
            ->limit(10)
            ->get();

        $recentClients = Client::query()
            ->latest()
            ->limit(5)
            ->get(['id', 'name', 'email', 'created_at']);

        return [
            'total_clients' => $totalClients,
            'clients_with_projects' => $clientsWithProjects,
            'clients_without_projects' => $totalClients - $clientsWithProjects,
            'top_clients' => $topClients,
            'recent_clients' => $recentClients,
        ];
    }

    /**
     * Create client with validation.
     */
    public function create(array $data): Client
    {
        return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'company' => $data['company'] ?? null,
            'address' => $data['address'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update client with validation.
     */
    public function update(Client $client, array $data): bool
    {
        return $client->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'company' => $data['company'] ?? null,
            'address' => $data['address'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }
}