<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Services\SEOService;
use Illuminate\Http\Request;

class PortfolioPublicController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index()
    {
        $portfolioItems = PortfolioItem::visible()->ordered()->get();

        // Utiliser le SEOService pour générer les données SEO dynamiquement
        $SEOData = $this->seoService->generatePageSEO('portfolio', [
            'title' => 'Portfolio - Nos Réalisations Web | Kréyatik Studio',
            'description' => 'Découvrez notre portfolio de réalisations web professionnelles. Des projets web sur mesure créés avec passion et expertise.',
            'canonical_url' => route('portfolio'),
        ]);

        return view('portfolio.index', [
            'portfolioItems' => $portfolioItems,
            'SEOData' => $SEOData
        ]);
    }
}