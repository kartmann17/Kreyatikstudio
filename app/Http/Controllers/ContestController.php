<?php

namespace App\Http\Controllers;

use App\Models\ContestSubmission;
use App\Services\SEOService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContestController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index()
    {
        // Vérifier si le concours est actif (dates depuis config)
        if (!config('contest.enabled')) {
            abort(404, config('contest.messages.not_started'));
        }

        $startDate = Carbon::parse(config('contest.start_date'));
        $endDate = Carbon::parse(config('contest.end_date'))->endOfDay();
        $now = Carbon::now();

        $contestActive = $now->between($startDate, $endDate);

        if (!$contestActive) {
            abort(404, $now->lt($startDate)
                ? config('contest.messages.not_started')
                : config('contest.messages.ended'));
        }

        $SEOData = $this->seoService->generatePageSEO('concours', [
            'title' => 'Concours - Gagnez un Site Web Gratuit | Kréyatik Studio',
            'description' => 'Participez à notre concours et tentez de remporter un site web professionnel gratuit. Inscription gratuite et simple.',
            'canonical_url' => route('concours'),
        ]);

        return view('concours', [
            'SEOData' => $SEOData,
            'utm_source' => request('utm_source'),
            'utm_medium' => request('utm_medium'),
            'utm_campaign' => request('utm_campaign'),
        ]);
    }

    public function store(Request $request)
    {
        // Vérifier si le concours est actif (dates depuis config)
        if (!config('contest.enabled')) {
            return back()->with('error', config('contest.messages.not_started'));
        }

        $startDate = Carbon::parse(config('contest.start_date'));
        $endDate = Carbon::parse(config('contest.end_date'))->endOfDay();
        $now = Carbon::now();

        if (!$now->between($startDate, $endDate)) {
            return back()->with('error', config('contest.messages.ended'));
        }

        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'statut' => 'required|in:Indépendant,Auto-entrepreneur,TPE/PME,Association',
            'activite' => 'required|string|max:255',
            'besoins' => 'required|array|min:1',
            'besoins.*' => 'string',
            'budget' => 'required|in:< 500€,500–1 000€,1 000–2 000€,> 2 000€',
            'deadline' => 'required|in:ASAP,1–2 mois,3+ mois',
            'message' => 'nullable|string',
            'consent_rgpd' => 'required|accepted',
            'opt_in_marketing' => 'nullable|boolean',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
        ], [
            'nom_prenom.required' => 'Le nom et prénom sont obligatoires.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'activite.required' => 'L\'activité est obligatoire.',
            'besoins.required' => 'Veuillez sélectionner au moins un besoin.',
            'budget.required' => 'Le budget est obligatoire.',
            'deadline.required' => 'La deadline est obligatoire.',
            'consent_rgpd.required' => 'Vous devez accepter le traitement de vos données.',
            'consent_rgpd.accepted' => 'Vous devez accepter le traitement de vos données.',
        ]);

        // Convertir le tableau besoins en chaîne
        $validated['besoins'] = implode(', ', $validated['besoins']);
        $validated['opt_in_marketing'] = $request->has('opt_in_marketing');

        ContestSubmission::create($validated);

        return back()->with('success', 'Votre participation au concours a été enregistrée avec succès !');
    }

    public function results()
    {
        // La page résultat est visible selon config
        $resultsStartDate = Carbon::parse(config('contest.results_date'));
        $resultsEndDate = $resultsStartDate->copy()->addDays(10)->endOfDay();
        $now = Carbon::now();

        if ($now->lt($resultsStartDate)) {
            abort(404, config('contest.messages.results_not_yet'));
        }

        if (!config('contest.enabled')) {
            abort(404);
        }

        // Statistiques du concours
        $totalParticipants = ContestSubmission::count();
        $daysTotal = 31; // 13 octobre au 13 novembre = 31 jours

        $SEOData = $this->seoService->generatePageSEO('concours-resultat', [
            'title' => 'Résultats du Concours | Kréyatik Studio',
            'description' => 'Découvrez les résultats de notre concours. Qui a remporté un site web gratuit ?',
            'canonical_url' => route('concours.resultat'),
        ]);

        return view('concours-resultat', [
            'SEOData' => $SEOData,
            'totalParticipants' => $totalParticipants,
            'daysTotal' => $daysTotal,
        ]);
    }
}
