<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'company', 
        'address', 
        'notes'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Get the projects associated with this client.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the users associated with this client.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the tickets associated with this client.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Assign this client to a project (optimized version).
     */
    public function assignToProject(int $projectId): bool
    {
        return Project::where('id', $projectId)
            ->update(['client_id' => $this->id]) > 0;
    }

    /**
     * Get active projects for this client.
     */
    public function activeProjects(): HasMany
    {
        return $this->projects()->where('status', 'in_progress');
    }

    /**
     * Get the total budget for all projects.
     */
    public function getTotalBudgetAttribute(): float
    {
        return $this->projects()->sum('budget') ?? 0;
    }

    /**
     * Get the total completed projects count.
     */
    public function getCompletedProjectsCountAttribute(): int
    {
        return $this->projects()->where('status', 'completed')->count();
    }
}
