<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate {--force : Forcer la régénération même si le fichier existe}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère le fichier sitemap.xml avec tous les articles publiés';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Génération du sitemap en cours...');

        try {
            // Récupérer tous les articles publiés
            $articles = Article::where('is_published', true)
                ->where('published_at', '<=', now())
                ->get();
            
            $this->info("Nombre d'articles publiés trouvés : {$articles->count()}");
            
            // Générer le contenu du sitemap manuellement
            $content = $this->generateSitemapContent($articles);
            
            // Écrire le fichier sitemap.xml
            $sitemapPath = public_path('sitemap.xml');
            
            // Vérifier si le fichier existe déjà
            if (File::exists($sitemapPath) && !$this->option('force')) {
                if (!$this->confirm('Le fichier sitemap.xml existe déjà. Voulez-vous le remplacer ?')) {
                    $this->info('Opération annulée.');
                    return 0;
                }
            }
            
            File::put($sitemapPath, $content);
            
            $this->info('✅ Sitemap généré avec succès !');
            $this->info("📁 Fichier créé : {$sitemapPath}");
            $this->info("📊 Nombre d'articles inclus : {$articles->count()}");
            
            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de la génération du sitemap : ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Génère le contenu XML du sitemap
     */
    private function generateSitemapContent($articles): string
    {
        $baseUrl = url('/');
        $now = now()->toAtomString();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Pages statiques
        $staticPages = [
            ['url' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => '/NosOffres', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/Portfolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/blog', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/Contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/ConditionTarifaire', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/a-propos', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/methode-travail', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/temoignages-clients', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/plandusite', 'priority' => '0.4', 'changefreq' => 'monthly'],
            ['url' => '/MentionLegal', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/CGV', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/confidentialite', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];
        
        foreach ($staticPages as $page) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>{$baseUrl}{$page['url']}</loc>\n";
            $xml .= "        <lastmod>{$now}</lastmod>\n";
            $xml .= "        <changefreq>{$page['changefreq']}</changefreq>\n";
            $xml .= "        <priority>{$page['priority']}</priority>\n";
            $xml .= "    </url>\n";
        }
        
        // Articles du blog
        foreach ($articles as $article) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>{$baseUrl}/blog/{$article->slug}</loc>\n";
            $xml .= "        <lastmod>{$article->updated_at->toAtomString()}</lastmod>\n";
            $xml .= "        <changefreq>monthly</changefreq>\n";
            $xml .= "        <priority>0.7</priority>\n";
            $xml .= "    </url>\n";
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }
} 