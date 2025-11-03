<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\SEOService;

class BlogController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index()
    {
        $articles = Article::where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        // SEO Data pour la page d'index du blog
        $SEOData = $this->seoService->generateBlogIndexSEO();

        return view('blog.index', compact('articles', 'SEOData'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published || $article->published_at > now()) {
            abort(404);
        }

        // Récupérer les articles similaires avec cache de 30 minutes
        $similarArticles = \Cache::remember("article.{$article->id}.similar", 1800, function () use ($article) {
            return Article::where('is_published', true)
                ->where('id', '!=', $article->id)
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        // Calculer le temps de lecture estimé (environ 200 mots par minute)
        $wordCount = str_word_count(strip_tags($article->content));
        $readingTime = max(1, round($wordCount / 200));

        // Récupérer les métadonnées de l'auteur
        $author = $article->user;

        // Générer les données SEO dynamiques pour l'article
        $SEOData = $this->seoService->generateArticleSEO($article);

        // Générer les données structurées pour l'article
        $structuredData = $this->seoService->generateArticleStructuredData($article);

        // Générer les breadcrumbs
        $breadcrumbs = $this->seoService->generateBreadcrumbs([
            ['name' => 'Accueil', 'url' => route('welcome')],
            ['name' => 'Blog', 'url' => route('blog')],
            ['name' => $article->title, 'url' => route('blog.show', $article->slug)]
        ]);

        return view('blog.show', compact('article', 'similarArticles', 'readingTime', 'author', 'SEOData', 'structuredData', 'breadcrumbs'));
    }
}
