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
        return view('MentionLegal.index', ['SEOData' => $SEOData]);
    }

    public function planDuSite()
    {
        $SEOData = $this->seoService->generatePageSEO('plan-du-site');
        return view('plandusite.index', ['SEOData' => $SEOData]);
    }

    public function cgv()
    {
        $SEOData = $this->seoService->generatePageSEO('cgv');
        return view('CGV.index', ['SEOData' => $SEOData]);
    }

    public function confidentialite()
    {
        $SEOData = $this->seoService->generatePageSEO('politique-confidentialite');
        return view('confidentialite.index', ['SEOData' => $SEOData]);
    }

    public function conditionsTarifaires()
    {
        $SEOData = $this->seoService->generatePageSEO('conditions-tarifaires');

        // Récupérer les plans tarifaires actifs
        $pricingPlans = PricingPlan::active()
            ->ordered()
            ->get();

        return view('conditions.tarifaire', [
            'SEOData' => $SEOData,
            'pricingPlans' => $pricingPlans
        ]);
    }

    public function contact()
    {
        $SEOData = $this->seoService->generatePageSEO('contact');
        return view('contact.index', ['SEOData' => $SEOData]);
    }

    public function aPropos()
    {
        $SEOData = $this->seoService->generatePageSEO('a-propos');
        return view('a-propos.index', ['SEOData' => $SEOData]);
    }

    public function methodeTravail()
    {
        $SEOData = $this->seoService->generatePageSEO('methode-travail');
        return view('methode-travail.index', ['SEOData' => $SEOData]);
    }

    public function temoignagesClients()
    {
        $SEOData = $this->seoService->generatePageSEO('temoignages-clients');
        return view('temoignages-clients.index', ['SEOData' => $SEOData]);
    }
}