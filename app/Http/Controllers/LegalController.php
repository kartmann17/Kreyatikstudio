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
        $SEOData = $this->seoService->generatePageSEO('mentions', [
            'title' => 'Mentions Légales | Kréyatik Studio',
            'description' => 'Consultez les mentions légales de Kréyatik Studio. Informations légales et conditions d\'utilisation de notre site.',
            'canonical_url' => route('mentionslegales'),
        ]);

        return view('MentionLegal.index', ['SEOData' => $SEOData]);
    }

    public function planDuSite()
    {
        $SEOData = $this->seoService->generatePageSEO('plan-site', [
            'title' => 'Plan du Site | Kréyatik Studio',
            'description' => 'Découvrez la structure complète de notre site web. Navigation facile et accès rapide à toutes nos pages.',
            'canonical_url' => url('/plandusite'),
        ]);

        return view('plandusite.index', ['SEOData' => $SEOData]);
    }

    public function cgv()
    {
        $SEOData = $this->seoService->generatePageSEO('cgv', [
            'title' => 'Conditions Générales de Vente | Kréyatik Studio',
            'description' => 'Consultez nos conditions générales de vente. Informations sur nos services, tarifs et modalités de paiement.',
            'canonical_url' => route('cgv'),
        ]);

        return view('CGV.index', ['SEOData' => $SEOData]);
    }

    public function confidentialite()
    {
        $SEOData = $this->seoService->generatePageSEO('confidentialite', [
            'title' => 'Politique de Confidentialité | Kréyatik Studio',
            'description' => 'Découvrez notre politique de confidentialité. Comment nous protégeons vos données personnelles.',
            'canonical_url' => route('confidentialite'),
        ]);

        return view('confidentialite.index', ['SEOData' => $SEOData]);
    }

    public function conditionsTarifaires()
    {
        $SEOData = $this->seoService->generatePageSEO('conditions', [
            'title' => 'Conditions Tarifaires | Kréyatik Studio',
            'description' => 'Découvrez nos conditions tarifaires et nos offres adaptées à vos besoins. Transparence et qualité de service garanties.',
            'canonical_url' => route('conditions-tarifaires'),
        ]);

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
        $SEOData = $this->seoService->generatePageSEO('contact', [
            'title' => 'Contact - Devis Gratuit | Kréyatik Studio',
            'description' => 'Contactez-nous pour discuter de votre projet. Notre équipe est à votre écoute pour vous accompagner dans la réalisation de vos objectifs digitaux.',
            'canonical_url' => route('contact'),
        ]);

        return view('contact.index', ['SEOData' => $SEOData]);
    }

    public function aPropos()
    {
        $SEOData = $this->seoService->generatePageSEO('a-propos', [
            'title' => 'À Propos | Expertise Web & Digital - Kréyatik Studio',
            'description' => 'Découvrez l\'expertise et le parcours de Kréyatik Studio. Plus de 5 ans d\'expérience dans le développement web, le design et la stratégie digitale.',
            'canonical_url' => route('a-propos'),
        ]);

        return view('a-propos.index', ['SEOData' => $SEOData]);
    }

    public function methodeTravail()
    {
        $SEOData = $this->seoService->generatePageSEO('methode-travail', [
            'title' => 'Notre Méthode de Travail | Processus de Création Web - Kréyatik Studio',
            'description' => 'Découvrez notre processus de création web en 5 étapes : audit, conception, développement, tests et déploiement. Méthode éprouvée et transparente.',
            'canonical_url' => route('methode-travail'),
        ]);

        return view('methode-travail.index', ['SEOData' => $SEOData]);
    }

    public function temoignagesClients()
    {
        $SEOData = $this->seoService->generatePageSEO('temoignages-clients', [
            'title' => 'Témoignages Clients | Avis et Retours d\'Expérience - Kréyatik Studio',
            'description' => 'Découvrez les témoignages de nos clients satisfaits. Projets web réussis, accompagnement personnalisé et expertise reconnue.',
            'canonical_url' => route('temoignages-clients'),
        ]);

        return view('temoignages-clients.index', ['SEOData' => $SEOData]);
    }
}