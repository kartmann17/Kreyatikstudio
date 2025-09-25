<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, HasSEO;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'name',
        'description',
        'status',
        'client_id',
        'user_id',
        'start_date',
        'end_date',
        'budget',
        'price',
        'progress',
        'total_time_spent',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'budget' => 'float',
            'price' => 'float',
            'progress' => 'integer',
            'total_time_spent' => 'integer',
        ];
    }

    /**
     * Get the tasks associated with this project.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the time logs associated with this project.
     */
    public function timeLogs(): HasMany
    {
        return $this->hasMany(TimeLog::class);
    }

    /**
     * Get the user (responsible) for this project.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the client associated with this project.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Calculate the total duration spent on this project.
     */
    public function getTotalDuration(): int
    {
        return $this->timeLogs()->sum('duration');
    }

    /**
     * Get the formatted total duration.
     */
    public function getFormattedTotalDurationAttribute(): string
    {
        $totalMinutes = $this->getTotalDuration();
        $minutes = $totalMinutes % 60;
        $hours = floor($totalMinutes / 60);
        
        if ($hours > 0) {
            return $hours . 'h ' . str_pad($minutes, 2, '0', STR_PAD_LEFT) . 'm';
        }
        
        return $minutes . 'm';
    }

    /**
     * Calculate the overall project progress based on tasks.
     */
    public function getCalculatedProgressAttribute(): int
    {
        $tasks = $this->tasks;
        
        if ($tasks->isEmpty()) {
            return $this->attributes['progress'] ?? 0;
        }
        
        $totalProgress = $tasks->sum('progress');
        return round($totalProgress / $tasks->count());
    }
    
    /**
     * Retourne la progression manuelle du projet (stockée en base)
     */
    public function getManualProgressAttribute()
    {
        return $this->attributes['progress'] ?? 0;
    }
    
    /**
     * Formatte le temps total passé au format heures:minutes
     */
    public function getFormattedTotalTimeAttribute()
    {
        $hours = floor($this->total_time_spent / 3600);
        $minutes = floor(($this->total_time_spent % 3600) / 60);
        
        return sprintf('%02d:%02d', $hours, $minutes);
    }

    /**
     * Génère les métadonnées SEO pour ce projet
     */
    public function getDynamicSEOData(): SEOData
    {
        // Construire une description plus détaillée
        $description = $this->description;
        if (!$description) {
            $description = "Projet {$this->name} " . 
                ($this->client ? "pour {$this->client->name}. " : ". ") .
                "Statut: {$this->status}";
        }

        // Construire un titre enrichi
        $title = "{$this->name}";
        if ($this->client) {
            $title .= " | {$this->client->name}";
        }

        return new SEOData(
            title: $title,
            description: $description,
            author: $this->user ? $this->user->name : null,
            image: null, // Si vous avez des images de projet, vous pouvez les ajouter ici
            url: route('admin.projects.show', $this->id),
            enableTitleSuffix: true,
        );
    }
}
