<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use App\Services\SEOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NosOffresController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index()
    {
        // Utiliser le SEOService pour générer les données SEO dynamiquement
        $SEOData = $this->seoService->generatePageSEO('offres', [
            'title' => 'Nos Offres - Services Web | Kréyatik Studio',
            'description' => 'Découvrez nos offres de création de sites web : site vitrine, e-commerce, application web sur mesure. Tarifs transparents et qualité professionnelle.',
            'canonical_url' => route('nos-offres'),
        ]);

        // Récupération des plans tarifaires actifs, triés par ordre
        $pricingPlans = PricingPlan::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('nosoffres.index', compact('SEOData', 'pricingPlans'));
    }
} 