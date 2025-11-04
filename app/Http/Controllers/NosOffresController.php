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
        // Utiliser le SEOService pour générer les données SEO dynamiquement depuis la BDD
        $SEOData = $this->seoService->generatePageSEO('offres');

        // Récupération des plans tarifaires avec cache de 1 heure
        $pricingPlans = Cache::remember('pricing.plans', 3600, function () {
            return PricingPlan::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        return view('nosoffres.index', compact('SEOData', 'pricingPlans'));
    }
} 