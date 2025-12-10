<?php

namespace App\Http\Controllers;

use App\Services\SEOService;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function mentionsLegales()
    {
        $SEOData = $this->seoService->generatePageSEO('mentions-legales');
        return inertia('Legal/MentionsLegales', ['seo' => $SEOData]);
    }

    public function cgv()
    {
        $SEOData = $this->seoService->generatePageSEO('cgv');
        return inertia('Legal/CGV', ['seo' => $SEOData]);
    }

    public function confidentialite()
    {
        $SEOData = $this->seoService->generatePageSEO('politique-confidentialite');
        return inertia('Legal/Confidentialite', ['seo' => $SEOData]);
    }

    public function conditionsTarifaires()
    {
        $SEOData = $this->seoService->generatePageSEO('conditions-tarifaires');

        // Récupérer les plans tarifaires actifs
        $pricingPlans = PricingPlan::active()
            ->ordered()
            ->get();

        return inertia('Legal/ConditionsTarifaires', [
            'seo' => $SEOData,
            'pricingPlans' => $pricingPlans
        ]);
    }

    public function contact()
    {
        $SEOData = $this->seoService->generatePageSEO('contact');
        return inertia('Contact', ['seo' => $SEOData]);
    }

    public function aPropos()
    {
        $SEOData = $this->seoService->generatePageSEO('a-propos');
        return inertia('APropos', ['seo' => $SEOData]);
    }

    public function methodeTravail()
    {
        $SEOData = $this->seoService->generatePageSEO('methode-travail');
        return inertia('MethodeTravail', ['seo' => $SEOData]);
    }

    public function temoignagesClients()
    {
        $SEOData = $this->seoService->generatePageSEO('temoignages-clients');
        return inertia('TemoignagesClients', ['seo' => $SEOData]);
    }

    public function planDuSite()
    {
        $SEOData = $this->seoService->generatePageSEO('plan-du-site');
        return inertia('PlanDuSite', ['seo' => $SEOData]);
    }
}