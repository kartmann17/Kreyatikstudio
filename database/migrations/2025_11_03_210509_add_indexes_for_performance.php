<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ajoute des index pour améliorer les performances des requêtes fréquentes
     */
    public function up(): void
    {
        // Index pour la table tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->index('status', 'idx_tickets_status');
            $table->index('priority', 'idx_tickets_priority');
            $table->index(['client_id', 'status'], 'idx_tickets_client_status');
        });

        // Index pour la table tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->index('status', 'idx_tasks_status');
            $table->index('priority', 'idx_tasks_priority');
            $table->index(['project_id', 'status'], 'idx_tasks_project_status');
        });

        // Index pour la table articles
        Schema::table('articles', function (Blueprint $table) {
            $table->index('is_published', 'idx_articles_published');
            $table->index('published_at', 'idx_articles_published_at');
            $table->index(['is_published', 'published_at'], 'idx_articles_published_date');
        });

        // Index pour la table projects
        Schema::table('projects', function (Blueprint $table) {
            $table->index('status', 'idx_projects_status');
            $table->index(['client_id', 'status'], 'idx_projects_client_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer les index de tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('idx_tickets_status');
            $table->dropIndex('idx_tickets_priority');
            $table->dropIndex('idx_tickets_client_status');
        });

        // Supprimer les index de tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('idx_tasks_status');
            $table->dropIndex('idx_tasks_priority');
            $table->dropIndex('idx_tasks_project_status');
        });

        // Supprimer les index d'articles
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('idx_articles_published');
            $table->dropIndex('idx_articles_published_at');
            $table->dropIndex('idx_articles_published_date');
        });

        // Supprimer les index de projects
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex('idx_projects_status');
            $table->dropIndex('idx_projects_client_status');
        });
    }
};
