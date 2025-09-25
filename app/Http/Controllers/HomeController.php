<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $settings = \App\Models\GlobalSettings::getInstance();
        
        $seo = new SEOData(
            title: 'Accueil | Kréyatik Studio',
            description: $settings->default_description ?: 'Votre site web clé en main, pensé pour convertir. Agence digitale à Rochefort, spécialisée SEO & design impactant.',
            author: 'Kréyatik Studio',
            robots: 'index, follow',
            image: asset('images/logo.png'),
        );

        return view('welcome', [
            'SEOData' => $seo,
        ]);
    }
}
