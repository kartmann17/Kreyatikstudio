<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vide tous les caches Laravel (config, cache, route, view)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Vidage de tous les caches...');

        try {
            // Vider le cache de configuration
            $this->call('config:clear');
            $this->info('✅ Cache de configuration vidé');

            // Vider le cache général
            $this->call('cache:clear');
            $this->info('✅ Cache général vidé');

            // Vider le cache des routes
            $this->call('route:clear');
            $this->info('✅ Cache des routes vidé');

            // Vider le cache des vues
            $this->call('view:clear');
            $this->info('✅ Cache des vues vidé');

            // Optimiser l'application
            $this->call('optimize:clear');
            $this->info('✅ Optimisation vidée');

            $this->info('🎉 Tous les caches ont été vidés avec succès !');
            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors du vidage des caches: ' . $e->getMessage());
            return 1;
        }
    }
} 