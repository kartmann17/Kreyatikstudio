<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        Log::info('Observer: Article créé - ' . $article->title);
        $this->updateSitemap();
        Log::info('Sitemap mis à jour après création d\'article: ' . $article->title);
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        Log::info('Observer: Article modifié - ' . $article->title);
        $this->updateSitemap();
        Log::info('Sitemap mis à jour après modification d\'article: ' . $article->title);
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        Log::info('Observer: Article supprimé - ' . $article->title);
        $this->updateSitemap();
        Log::info('Sitemap mis à jour après suppression d\'article: ' . $article->title);
    }

    /**
     * Met à jour le fichier sitemap.xml statique
     */
    private function updateSitemap(): void
    {
        try {
            Log::info('Début de la mise à jour du sitemap');

            // Récupérer tous les articles publiés
            $articles = Article::where('is_published', true)
                ->where('published_at', '<=', now())
                ->get();
            Log::info('Articles publiés trouvés: ' . $articles->count());

            // Générer le contenu du sitemap manuellement
            $content = $this->generateSitemapContent($articles);
            Log::info('Contenu du sitemap généré, taille: ' . strlen($content) . ' caractères');

            // Écrire le fichier sitemap.xml
            $sitemapPath = public_path('sitemap.xml');
            Log::info('Chemin du sitemap: ' . $sitemapPath);

            $result = File::put($sitemapPath, $content);
            Log::info('Fichier écrit: ' . ($result ? 'SUCCÈS' : 'ÉCHEC'));

            Log::info('Sitemap mis à jour avec succès. Nombre d\'articles: ' . $articles->count());
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du sitemap: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
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
            ['url' => '/nos-offres', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/portfolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/blog', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/conditions-tarifaires', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/plan-du-site', 'priority' => '0.4', 'changefreq' => 'monthly'],
            ['url' => '/mentions-legales', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/cgv', 'priority' => '0.3', 'changefreq' => 'yearly'],
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
            // Priorité plus élevée pour articles avec mots-clés locaux
            $priority = '0.7';
            $localKeywords = ['rochefort', 'la rochelle', 'charente-maritime', 'site web rochefort', 'agence web'];

            foreach ($localKeywords as $keyword) {
                if (stripos($article->title . ' ' . $article->meta_keywords, $keyword) !== false) {
                    $priority = '0.8';
                    break;
                }
            }

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$baseUrl}/blog/{$article->slug}</loc>\n";
            $xml .= "        <lastmod>{$article->updated_at->toAtomString()}</lastmod>\n";
            $xml .= "        <changefreq>monthly</changefreq>\n";
            $xml .= "        <priority>{$priority}</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}