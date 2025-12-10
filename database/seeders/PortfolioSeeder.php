<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioItem;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Supprimer les items existants
        PortfolioItem::truncate();

        $files = [
            'homepagein_1747059906.png' => [
                'title' => 'Homepage In - Site Web Moderne',
                'description' => 'Site web moderne et responsive avec interface utilisateur intuitive',
                'technology' => 'Laravel, TailwindCSS, MySQL'
            ],
            'homepageloukart_1747060414.png' => [
                'title' => 'Loukart - E-commerce',
                'description' => 'Plateforme e-commerce complète avec paiement en ligne sécurisé',
                'technology' => 'Laravel, Vue.js, Stripe, PayPal'
            ],
            'enregistrement-de-lecran-2025-05-12-a-163638_1747061025.mp4' => [
                'title' => 'Démo Application Web',
                'description' => 'Démonstration vidéo d\'une application web custom',
                'technology' => 'Laravel, React, MySQL'
            ],
            'capture-decran-2025-05-12-a-164618_1747061550.png' => [
                'title' => 'Application Web Custom',
                'description' => 'Application web sur mesure avec tableau de bord complet',
                'technology' => 'Laravel, React, PostgreSQL'
            ],
            'enregistrement-de-lecran-2025-05-12-a-172647_1747063895.mp4' => [
                'title' => 'Présentation Projet Client',
                'description' => 'Vidéo de présentation d\'un projet réalisé pour un client',
                'technology' => 'Laravel, Inertia.js, TailwindCSS'
            ],
            'capture-decran-2025-07-22-a-014307_1753141851.png' => [
                'title' => 'Dashboard Analytique',
                'description' => 'Tableau de bord analytique avec graphiques en temps réel',
                'technology' => 'Laravel, Chart.js, PostgreSQL'
            ],
            'capture-decran-2025-08-28-a-095821_1757625692.png' => [
                'title' => 'Site E-commerce Avancé',
                'description' => 'Plateforme e-commerce avec gestion avancée des stocks',
                'technology' => 'Laravel, Vue.js, Stripe'
            ],
            'capture-decran-2025-09-21-a-163042_1758465282.png' => [
                'title' => 'Application Mobile-First',
                'description' => 'Application web optimisée mobile avec PWA',
                'technology' => 'Laravel, Alpine.js, TailwindCSS'
            ],
            'capture-decran-2025-11-25-a-003006_1764027239.png' => [
                'title' => 'Plateforme SaaS',
                'description' => 'Solution SaaS multi-tenant avec abonnements',
                'technology' => 'Laravel, Livewire, Stripe'
            ],
            'kreyatik-studio-developpeur-web-la-rochell-rochefort-royan-wwwkreyatikstudiofr_1764115456.png' => [
                'title' => 'Kreyatik Studio - Site Vitrine',
                'description' => 'Site vitrine professionnel pour développeur web freelance',
                'technology' => 'Laravel, Inertia.js, React, TailwindCSS'
            ],
            'capture-decran-2025-12-06-a-144557_1765028781.png' => [
                'title' => 'Application Gestion de Projet',
                'description' => 'Application de gestion de projets avec suivi temps réel',
                'technology' => 'Laravel, React, WebSocket'
            ]
        ];

        $order = 1;
        foreach ($files as $filename => $data) {
            // Déterminer le type (image ou vidéo)
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $type = in_array($extension, ['mp4', 'webm', 'avi', 'mov']) ? 'video' : 'image';

            PortfolioItem::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'technology' => $data['technology'],
                'type' => $type,
                'path' => 'images/portfolio/' . $filename,
                'url' => null,
                'order' => $order++,
                'is_visible' => true
            ]);
        }

        $this->command->info('✅ ' . PortfolioItem::count() . ' portfolio items créés avec succès');
    }
}
