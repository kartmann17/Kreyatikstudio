<?php

namespace App\View\Components;

use Illuminate\View\Component;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Header extends Component
{
    public $SEOData;

    public function __construct($seoData = null)
    {
        // Utiliser directement le SEOData passé en paramètre
        // Si aucun SEOData n'est fourni, créer un objet basique avec valeurs par défaut
        if ($seoData instanceof SEOData) {
            $this->SEOData = $seoData;
        } else {
            // Fallback avec valeurs par défaut
            $this->SEOData = new SEOData(
                title: config('app.name') . ' - Création de sites web professionnels',
                description: 'Kreyatik Studio - Développeur web spécialisé',
                author: 'Kreyatik Studio',
                robots: 'index, follow',
                canonical_url: url()->current(),
                type: 'website',
                image: asset('images/default-og.jpg')
            );
        }
    }

    public function render()
    {
        return view('components.header', [
            'SEOData' => $this->SEOData
        ]);
    }
}