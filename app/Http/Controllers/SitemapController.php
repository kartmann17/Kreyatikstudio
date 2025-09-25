<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PortfolioItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class SitemapController extends Controller
{
    public function index()
    {
        // Pages statiques principales
        $staticPages = [
            [
                'url' => route('welcome'),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'url' => route('contact'),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => route('nos-offres'),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('portfolio'),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'url' => route('blog'),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'daily',
                'priority' => '0.8'
            ]
        ];

        // Articles de blog publiés
        $articles = Article::where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'url' => route('blog.show', $article->slug),
                    'lastmod' => $article->updated_at->toDateString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7'
                ];
            });

        // Portfolio items visibles
        $portfolioItems = PortfolioItem::visible()
            ->get()
            ->map(function ($item) {
                return [
                    'url' => route('portfolio') . '#project-' . $item->id,
                    'lastmod' => $item->updated_at->toDateString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6'
                ];
            });

        // Combine toutes les URLs
        $urls = collect($staticPages)
            ->merge($articles)
            ->merge($portfolioItems);

        $content = View::make('sitemap', compact('urls'));
        
        return Response::make($content, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600'
        ]);
    }
}
