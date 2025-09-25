<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $title;
    public $description;
    public $SEOData;

    public function __construct($title = null, $description = null, $seoData = null)
    {
        $this->title = $title ?: config('app.name') . ' - Création de sites web professionnels';
        $this->description = $description ?: 'Kreyatik Studio - Développeur web spécialisé';

        // Créer un objet SEOData basique si des paramètres sont fournis
        if ($title || $description || $seoData) {
            $this->SEOData = (object) [
                'title' => $this->title,
                'description' => $this->description,
                'author' => 'Kreyatik Studio',
                'robots' => 'index, follow',
                'canonical_url' => url()->current(),
                'type' => 'article',
                'image' => asset('images/default-og.jpg')
            ];
        }
    }

    public function render()
    {
        return view('components.header', [
            'SEOData' => $this->SEOData
        ]);
    }
}