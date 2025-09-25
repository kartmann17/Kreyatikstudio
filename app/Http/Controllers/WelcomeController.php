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

        // Récupérer les 2 derniers articles publiés pour la page d'accueil
        $latestArticles = Article::where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(2)
            ->get();

        // Utiliser le SEOService pour générer les données SEO dynamiquement
        $SEOData = $this->seoService->generatePageSEO('home', [
            'title' => 'Accueil - Création de sites web professionnels | Kréyatik Studio',
            'description' => $settings->default_description ?: 'Votre site web clé en main, pensé pour convertir. Agence digitale à Rochefort, spécialisée SEO & design impactant.',
            'canonical_url' => url('/'),
        ]);

        return view('welcome', [
            'SEOData' => $SEOData,
            'latestArticles' => $latestArticles
        ]);
    }
}