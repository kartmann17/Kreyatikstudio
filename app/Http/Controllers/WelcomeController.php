<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\GlobalSettings;
use App\Services\SEOService;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index()
    {
        $settings = GlobalSettings::getInstance();

        // Récupérer les 2 derniers articles publiés avec cache de 15 minutes
        $latestArticles = \Cache::remember('homepage.articles', 900, function () {
            return Article::where('is_published', true)
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->limit(2)
                ->get();
        });

        // Utiliser le SEOService pour générer les données SEO dynamiquement depuis la BDD
        $SEOData = $this->seoService->generatePageSEO('home');

        return view('welcome', [
            'SEOData' => $SEOData,
            'latestArticles' => $latestArticles
        ]);
    }
}