<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'client_id',
        'preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'password' => 'hashed',
            'preferences' => 'json',
        ];
    }

    /**
     * Get the client associated with this user (for client accounts).
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Vérifie si l'utilisateur est un administrateur
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un membre du staff
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * Vérifie si l'utilisateur est un client
     */
    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    /**
     * Récupère les projets dont l'utilisateur est responsable
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Récupère les tâches assignées à l'utilisateur
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Récupère les entrées de temps de l'utilisateur
     */
    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    /**
     * Récupère les tickets créés par l'utilisateur
     */
    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    /**
     * Récupère les tickets assignés à l'utilisateur
     */
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    /**
     * Retourne l'URL de l'image de profil
     */
    public function getAvatarUrl(): string
    {
        // Utiliser une URL d'avatar générique de UI Avatars
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Retourne la description du rôle
     */
    public function getRoleDescription()
    {
        return ucfirst($this->role);
    }

    /**
     * Retourne l'URL de profil
     */
    public function getProfileUrl()
    {
        // URL vers la page de profil selon le rôle
        if ($this->isAdmin()) {
            return route('admin.profile.index');
        } elseif ($this->isClient()) {
            return route('client.profile.index');
        }

        return route('admin.profile.index');
    }
}
