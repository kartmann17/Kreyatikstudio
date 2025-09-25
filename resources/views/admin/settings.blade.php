@extends('admin.layout')

@section('title', 'Paramètres')

@section('page_title', 'Paramètres du site')

@section('content_body')
<!-- Header avec navigation -->
<div class="mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
        <div class="flex items-center space-x-4">
            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl shadow-lg">
                <i class="fas fa-cog text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Paramètres du site</h1>
                <p class="text-gray-600">Configurez les paramètres SEO et les informations de votre site</p>
            </div>
        </div>
    </div>
</div>

<!-- Paramètres SEO généraux -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-search text-blue-600"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-900">Paramètres SEO généraux</h2>
        </div>
        <p class="text-sm text-gray-600 mt-2">Configuration globale pour l'optimisation des moteurs de recherche</p>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.settings.seo') }}" id="seoForm" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Colonne de gauche -->
                <div class="space-y-6">
                    <!-- Nom du site -->
                    <div class="space-y-2">
                        <label for="site_name" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-globe mr-2 text-blue-500"></i>
                            Nom du site
                        </label>
                        <input type="text" 
                               id="site_name" 
                               name="site_name" 
                               value="{{ $settings->site_name }}" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <p class="text-xs text-gray-500">💡 Nom principal de votre site web affiché dans les titres de pages</p>
                    </div>

                    <!-- Description par défaut -->
                    <div class="space-y-2">
                        <label for="default_description" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-file-alt mr-2 text-green-500"></i>
                            Description par défaut
                        </label>
                        <textarea id="default_description" 
                                  name="default_description" 
                                  rows="4" 
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ $settings->default_description }}</textarea>
                        <p class="text-xs text-gray-500">📄 Cette description sera utilisée si aucune description spécifique n'est définie pour une page</p>
                    </div>

                    <!-- Mots-clés par défaut -->
                    <div class="space-y-2">
                        <label for="default_keywords" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-tags mr-2 text-yellow-500"></i>
                            Mots-clés par défaut
                        </label>
                        <input type="text" 
                               id="default_keywords" 
                               name="default_keywords" 
                               value="{{ $settings->default_keywords }}" 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                               placeholder="mot-clé1, mot-clé2, mot-clé3">
                        <p class="text-xs text-gray-500">🏷️ Séparés par des virgules (ex: développement, web, design)</p>
                    </div>
                </div>

                <!-- Colonne de droite -->
                <div class="space-y-6">
                    <!-- Image par défaut -->
                    <div class="space-y-2">
                        <label for="default_image" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-image mr-2 text-purple-500"></i>
                            Image par défaut pour les partages
                        </label>
                        <div class="relative">
                            <input type="file" 
                                   id="default_image" 
                                   name="default_image" 
                                   accept="image/*"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <p class="text-xs text-gray-500">🖼️ Image utilisée lors du partage sur les réseaux sociaux (recommandé: 1200x630px)</p>
                        
                        @if($settings->default_image)
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-700 mb-2">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $settings->default_image) }}" 
                                 alt="Image SEO par défaut" 
                                 class="h-24 w-auto rounded-lg shadow-sm border border-gray-200">
                        </div>
                        @endif
                    </div>

                    <!-- Langue par défaut -->
                    <div class="space-y-2">
                        <label for="locale" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-language mr-2 text-indigo-500"></i>
                            Langue par défaut
                        </label>
                        <select id="locale" 
                                name="locale" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="fr_FR" {{ $settings->locale == 'fr_FR' ? 'selected' : '' }}>🇫🇷 Français</option>
                            <option value="en_US" {{ $settings->locale == 'en_US' ? 'selected' : '' }}>🇺🇸 English (US)</option>
                            <option value="en_GB" {{ $settings->locale == 'en_GB' ? 'selected' : '' }}>🇬🇧 English (UK)</option>
                        </select>
                        <p class="text-xs text-gray-500">🌐 Langue principale utilisée pour les métadonnées et l'interface</p>
                    </div>
                </div>
            </div>

            <!-- Réseaux sociaux -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 border-b border-gray-200 pb-3">
                    <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-pink-600"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900">Réseaux sociaux</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Facebook -->
                    <div class="space-y-2">
                        <label for="social_facebook" class="block text-sm font-medium text-gray-700">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            Facebook
                        </label>
                        <input type="url" 
                               id="social_facebook"
                               name="social_facebook" 
                               placeholder="https://facebook.com/votre-page" 
                               value="{{ $settings->social_facebook }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                    
                    <!-- Twitter -->
                    <div class="space-y-2">
                        <label for="social_twitter" class="block text-sm font-medium text-gray-700">
                            <i class="fab fa-twitter text-sky-500 mr-2"></i>
                            Twitter
                        </label>
                        <input type="url" 
                               id="social_twitter"
                               name="social_twitter" 
                               placeholder="https://twitter.com/votre-compte" 
                               value="{{ $settings->social_twitter }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                    
                    <!-- Instagram -->
                    <div class="space-y-2">
                        <label for="social_instagram" class="block text-sm font-medium text-gray-700">
                            <i class="fab fa-instagram text-pink-500 mr-2"></i>
                            Instagram
                        </label>
                        <input type="url" 
                               id="social_instagram"
                               name="social_instagram" 
                               placeholder="https://instagram.com/votre-compte" 
                               value="{{ $settings->social_instagram }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                    
                    <!-- LinkedIn -->
                    <div class="space-y-2">
                        <label for="social_linkedin" class="block text-sm font-medium text-gray-700">
                            <i class="fab fa-linkedin text-blue-700 mr-2"></i>
                            LinkedIn
                        </label>
                        <input type="url" 
                               id="social_linkedin"
                               name="social_linkedin" 
                               placeholder="https://linkedin.com/company/votre-entreprise" 
                               value="{{ $settings->social_linkedin }}"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-2"></i>
                    <span>Les modifications seront appliquées immédiatement</span>
                </div>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-lg transform transition-all duration-200 hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer les paramètres SEO
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SEO par page -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-file-alt text-green-600"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">SEO par page</h2>
                <p class="text-sm text-gray-600 mt-1">Gérez le référencement spécifique pour chaque page principale du site</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <!-- Navigation par onglets moderne -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" id="pagesTabs" role="tablist">
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button active" 
                            data-tab="home" 
                            onclick="switchTab('home')"
                            style="border-color: #3B82F6; color: #3B82F6;">
                        <i class="fas fa-home mr-2"></i>
                        Accueil
                    </button>
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button" 
                            data-tab="offres" 
                            onclick="switchTab('offres')"
                            style="border-color: transparent; color: #6B7280;">
                        <i class="fas fa-tags mr-2"></i>
                        Nos Offres
                    </button>
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button" 
                            data-tab="contact" 
                            onclick="switchTab('contact')"
                            style="border-color: transparent; color: #6B7280;">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact
                    </button>
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button" 
                            data-tab="portfolio" 
                            onclick="switchTab('portfolio')"
                            style="border-color: transparent; color: #6B7280;">
                        <i class="fas fa-images mr-2"></i>
                        Portfolio
                    </button>
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button" 
                            data-tab="blog" 
                            onclick="switchTab('blog')"
                            style="border-color: transparent; color: #6B7280;">
                        <i class="fas fa-blog mr-2"></i>
                        Blog
                    </button>
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button" 
                            data-tab="client" 
                            onclick="switchTab('client')"
                            style="border-color: transparent; color: #6B7280;">
                        <i class="fas fa-user-circle mr-2"></i>
                        Espace Client
                    </button>
                    <button class="py-2 px-1 border-b-2 font-medium text-sm tab-button" 
                            data-tab="legal" 
                            onclick="switchTab('legal')"
                            style="border-color: transparent; color: #6B7280;">
                        <i class="fas fa-gavel mr-2"></i>
                        Pages légales
                    </button>
                </nav>
            </div>
        </div>

        <!-- Contenu des onglets -->
        <div id="pagesTabsContent" class="mt-6">
            <!-- Onglet Accueil -->
            <div class="tab-content active" id="home-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'home']) }}" class="pageSettingsForm space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Titre -->
                            <div class="space-y-2">
                                <label for="home_title" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-500"></i>
                                    Titre de la page d'accueil
                                </label>
                                <input type="text" 
                                       id="home_title" 
                                       name="title" 
                                       value="{{ $pagesSeo['home']->title ?? config('seo.pages.home.title', 'Accueil | ' . config('app.name')) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                       placeholder="Accueil | Mon Site">
                                <p class="text-xs text-gray-500">📄 Ce titre apparaîtra dans l'onglet du navigateur et les résultats de recherche</p>
                            </div>

                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="home_description" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>
                                    Description de la page d'accueil
                                </label>
                                <textarea id="home_description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                                          placeholder="Découvrez nos services et notre expertise...">{{ $pagesSeo['home']->description ?? config('seo.pages.home.description', '') }}</textarea>
                                <p class="text-xs text-gray-500">🔍 Cette description apparaîtra dans les résultats de recherche Google</p>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Onglet Contact -->
            <div class="tab-content hidden" id="contact-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'contact']) }}" class="pageSettingsForm space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="contact_title" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-500"></i>
                                    Titre de la page contact
                                </label>
                                <input type="text" 
                                       id="contact_title" 
                                       name="title" 
                                       value="{{ $pagesSeo['contact']->title ?? config('seo.pages.contact.title', 'Contactez-nous | ' . config('app.name')) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            </div>

                            <div class="space-y-2">
                                <label for="contact_description" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>
                                    Description de la page contact
                                </label>
                                <textarea id="contact_description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ $pagesSeo['contact']->description ?? config('seo.pages.contact.description', '') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Onglet Nos Offres -->
            <div class="tab-content hidden" id="offres-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'offres']) }}" class="pageSettingsForm space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="offres_title" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-500"></i>
                                    Titre de la page nos offres
                                </label>
                                <input type="text" 
                                       id="offres_title" 
                                       name="title" 
                                       value="{{ $pagesSeo['offres']->title ?? config('seo.pages.offres.title', 'Nos Offres | ' . config('app.name')) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            </div>

                            <div class="space-y-2">
                                <label for="offres_description" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>
                                    Description de la page nos offres
                                </label>
                                <textarea id="offres_description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ $pagesSeo['offres']->description ?? config('seo.pages.offres.description', '') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Onglet Portfolio -->
            <div class="tab-content hidden" id="portfolio-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'portfolio']) }}" class="pageSettingsForm space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="portfolio_title" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-500"></i>
                                    Titre de la page portfolio
                                </label>
                                <input type="text" 
                                       id="portfolio_title" 
                                       name="title" 
                                       value="{{ $pagesSeo['portfolio']->title ?? config('seo.pages.portfolio.title', 'Portfolio | ' . config('app.name')) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            </div>

                            <div class="space-y-2">
                                <label for="portfolio_description" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>
                                    Description de la page portfolio
                                </label>
                                <textarea id="portfolio_description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ $pagesSeo['portfolio']->description ?? config('seo.pages.portfolio.description', '') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Onglet Blog -->
            <div class="tab-content hidden" id="blog-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'blog']) }}" class="pageSettingsForm space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="blog_title" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-500"></i>
                                    Titre de la page blog
                                </label>
                                <input type="text" 
                                       id="blog_title" 
                                       name="title" 
                                       value="{{ $pagesSeo['blog']->title ?? config('seo.pages.blog.title', 'Blog - Actualités & Conseils | ' . config('app.name')) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                <p class="text-xs text-gray-500">📝 Titre optimisé pour les moteurs de recherche</p>
                            </div>

                            <div class="space-y-2">
                                <label for="blog_description" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>
                                    Description de la page blog
                                </label>
                                <textarea id="blog_description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ $pagesSeo['blog']->description ?? config('seo.pages.blog.description', 'Découvrez nos derniers articles sur le développement web, le design UX/UI, le SEO et les tendances digitales.') }}</textarea>
                                <p class="text-xs text-gray-500">📖 Description qui apparaîtra dans les résultats Google</p>
                            </div>

                            <div class="space-y-2">
                                <label for="blog_keywords" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-tags mr-2 text-yellow-500"></i>
                                    Mots-clés spécifiques au blog
                                </label>
                                <input type="text" 
                                       id="blog_keywords" 
                                       name="keywords" 
                                       value="{{ $pagesSeo['blog']->keywords ?? 'blog, articles, développement web, conseils digital, actualités tech' }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                       placeholder="blog, articles, conseils, actualités">
                                <p class="text-xs text-gray-500">🏷️ Mots-clés pour optimiser le référencement du blog</p>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Onglet Espace Client -->
            <div class="tab-content hidden" id="client-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'client']) }}" class="pageSettingsForm space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="client_title" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-500"></i>
                                    Titre de l'espace client
                                </label>
                                <input type="text" 
                                       id="client_title" 
                                       name="title" 
                                       value="{{ $pagesSeo['client']->title ?? config('seo.pages.client.title', 'Espace Client | ' . config('app.name')) }}"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            </div>

                            <div class="space-y-2">
                                <label for="client_description" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-green-500"></i>
                                    Description de l'espace client
                                </label>
                                <textarea id="client_description" 
                                          name="description" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ $pagesSeo['client']->description ?? config('seo.pages.client.description', '') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Onglet Pages légales -->
            <div class="tab-content hidden" id="legal-content">
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                            <i class="fas fa-gavel text-purple-600 mr-2"></i>
                            Gestion SEO des pages légales
                        </h3>
                        <p class="text-sm text-gray-600">Configurez le référencement de vos pages légales (CGV, Mentions légales, Confidentialité, etc.)</p>
                    </div>

                    <!-- Sous-onglets pour pages légales -->
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2 border-b border-gray-200 pb-2">
                            <button class="px-4 py-2 text-sm bg-purple-100 text-purple-700 rounded-lg legal-tab active" 
                                    onclick="switchLegalTab('cgv')" data-legal-tab="cgv">
                                CGV
                            </button>
                            <button class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg legal-tab" 
                                    onclick="switchLegalTab('mentions')" data-legal-tab="mentions">
                                Mentions légales
                            </button>
                            <button class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg legal-tab" 
                                    onclick="switchLegalTab('confidentialite')" data-legal-tab="confidentialite">
                                Confidentialité
                            </button>
                            <button class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg legal-tab" 
                                    onclick="switchLegalTab('conditions')" data-legal-tab="conditions">
                                Conditions tarifaires
                            </button>
                        </div>
                    </div>

                    <!-- Contenu CGV -->
                    <div class="legal-tab-content" id="cgv-content">
                        <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'cgv']) }}" class="pageSettingsForm space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre CGV</label>
                                    <input type="text" name="title" 
                                           value="{{ $pagesSeo['cgv']->title ?? 'Conditions Générales de Vente | ' . config('app.name') }}"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description CGV</label>
                                    <textarea name="description" rows="3" 
                                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">{{ $pagesSeo['cgv']->description ?? 'Consultez nos conditions générales de vente pour connaître les modalités de nos prestations.' }}</textarea>
                                </div>
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-sm rounded-lg hover:bg-purple-700">
                                    <i class="fas fa-save mr-1"></i> Sauvegarder CGV
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contenu Mentions légales -->
                    <div class="legal-tab-content hidden" id="mentions-content">
                        <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'mentions']) }}" class="pageSettingsForm space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre Mentions légales</label>
                                    <input type="text" name="title" 
                                           value="{{ $pagesSeo['mentions']->title ?? 'Mentions Légales | ' . config('app.name') }}"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description Mentions légales</label>
                                    <textarea name="description" rows="3" 
                                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">{{ $pagesSeo['mentions']->description ?? 'Mentions légales de notre site web, informations sur l\'éditeur et l\'hébergeur.' }}</textarea>
                                </div>
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-sm rounded-lg hover:bg-purple-700">
                                    <i class="fas fa-save mr-1"></i> Sauvegarder Mentions
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contenu Confidentialité -->
                    <div class="legal-tab-content hidden" id="confidentialite-content">
                        <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'confidentialite']) }}" class="pageSettingsForm space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre Confidentialité</label>
                                    <input type="text" name="title" 
                                           value="{{ $pagesSeo['confidentialite']->title ?? 'Politique de Confidentialité | ' . config('app.name') }}"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description Confidentialité</label>
                                    <textarea name="description" rows="3" 
                                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">{{ $pagesSeo['confidentialite']->description ?? 'Notre politique de confidentialité explique comment nous collectons et utilisons vos données personnelles.' }}</textarea>
                                </div>
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-sm rounded-lg hover:bg-purple-700">
                                    <i class="fas fa-save mr-1"></i> Sauvegarder Confidentialité
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contenu Conditions tarifaires -->
                    <div class="legal-tab-content hidden" id="conditions-content">
                        <form method="POST" action="{{ route('admin.settings.seo.page', ['page' => 'conditions']) }}" class="pageSettingsForm space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre Conditions tarifaires</label>
                                    <input type="text" name="title" 
                                           value="{{ $pagesSeo['conditions']->title ?? 'Conditions Tarifaires | ' . config('app.name') }}"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description Conditions tarifaires</label>
                                    <textarea name="description" rows="3" 
                                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 text-sm">{{ $pagesSeo['conditions']->description ?? 'Découvrez nos tarifs et conditions de facturation pour nos services web.' }}</textarea>
                                </div>
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-sm rounded-lg hover:bg-purple-700">
                                    <i class="fas fa-save mr-1"></i> Sauvegarder Conditions
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section de prévisualisation SEO -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-search text-green-600"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Prévisualisation SEO</h2>
                <p class="text-sm text-gray-600 mt-1">Aperçu de votre site dans les résultats de recherche Google</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <!-- Sélecteur de page pour prévisualisation -->
        <div class="mb-6">
            <label for="preview-page" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-eye mr-2 text-blue-500"></i>
                Choisir une page à prévisualiser
            </label>
            <select id="preview-page" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="updateSEOPreview()">
                <option value="home">Page d'accueil</option>
                <option value="blog">Blog</option>
                <option value="portfolio">Portfolio</option>
                <option value="contact">Contact</option>
                <option value="offres">Nos Offres</option>
                <option value="client">Espace Client</option>
            </select>
        </div>

        <!-- Aperçu Google Search Results -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-700 mb-4 flex items-center">
                <i class="fab fa-google mr-2 text-blue-600"></i>
                Aperçu dans les résultats Google
            </h3>
            
            <div class="bg-white rounded-lg p-4 border border-gray-200" id="google-preview">
                <div class="mb-2">
                    <span class="text-xs text-green-600">{{ url('/') }} › </span>
                    <span class="text-xs text-gray-500" id="preview-breadcrumb">accueil</span>
                </div>
                <h4 class="text-lg text-blue-600 hover:underline cursor-pointer mb-1" id="preview-title">
                    Kreyatik Studio - Création de sites web professionnels
                </h4>
                <p class="text-sm text-gray-600 leading-relaxed" id="preview-description">
                    Découvrez nos services de création de sites web modernes et performants. Développement sur mesure, design responsive et optimisation SEO.
                </p>
                <div class="flex items-center text-xs text-gray-500 mt-2">
                    <i class="far fa-clock mr-1"></i>
                    <span>Mis à jour aujourd'hui</span>
                </div>
            </div>
        </div>

        <!-- Aperçu réseaux sociaux -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Aperçu Facebook -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                    <i class="fab fa-facebook-square text-blue-600 mr-2"></i>
                    Aperçu Facebook
                </h4>
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-image text-white text-2xl"></i>
                    </div>
                    <div class="p-3">
                        <p class="text-xs text-gray-500 uppercase mb-1">{{ parse_url(url('/'), PHP_URL_HOST) }}</p>
                        <h5 class="font-medium text-sm mb-1" id="fb-preview-title">Kreyatik Studio</h5>
                        <p class="text-xs text-gray-600" id="fb-preview-description">Description de la page...</p>
                    </div>
                </div>
            </div>

            <!-- Aperçu Twitter -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                    <i class="fab fa-twitter-square text-sky-500 mr-2"></i>
                    Aperçu Twitter
                </h4>
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-sky-400 to-blue-500 flex items-center justify-center">
                        <i class="fas fa-image text-white text-2xl"></i>
                    </div>
                    <div class="p-3">
                        <h5 class="font-medium text-sm mb-1" id="twitter-preview-title">Kreyatik Studio</h5>
                        <p class="text-xs text-gray-600 mb-2" id="twitter-preview-description">Description de la page...</p>
                        <p class="text-xs text-gray-500" id="twitter-preview-url">{{ url('/') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informations sur l'application -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-info-circle text-indigo-600"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-900">À propos de l'application</h2>
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Version -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-code-branch text-blue-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-900">Version</h3>
                </div>
                <p class="text-2xl font-bold text-blue-600">1.0.0</p>
                <p class="text-sm text-gray-600 mt-1">Version actuelle du système</p>
            </div>
            
            <!-- Développeur -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-green-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-900">Développé par</h3>
                </div>
                <p class="text-lg font-semibold text-green-600">Kréyatik Studio</p>
                <p class="text-sm text-gray-600 mt-1">Votre équipe de développement</p>
            </div>
            
            <!-- Statut -->
            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-purple-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-900">Statut</h3>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-green-600">Opérationnel</span>
                </div>
                <p class="text-sm text-gray-600 mt-1">Tous les services fonctionnent</p>
            </div>
        </div>
        
        <!-- Description -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-medium text-gray-900 mb-2 flex items-center">
                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                Description de l'application
            </h3>
            <p class="text-gray-700 leading-relaxed">
                Cette application de gestion de projets est conçue pour vous aider à organiser efficacement votre travail, 
                suivre le temps passé sur vos tâches et gérer vos clients. Elle intègre des fonctionnalités avancées de SEO 
                pour optimiser votre présence en ligne.
            </p>
        </div>
        
        <!-- Liens rapides -->
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200">
                <i class="fas fa-book mr-2"></i>
                Documentation
            </a>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition-colors duration-200">
                <i class="fas fa-life-ring mr-2"></i>
                Support
            </a>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-lg transition-colors duration-200">
                <i class="fas fa-bug mr-2"></i>
                Signaler un bug
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Styles personnalisés pour les onglets */
.tab-button {
    transition: all 0.2s ease;
    cursor: pointer;
}

.tab-button:hover {
    color: #3B82F6 !important;
    border-color: #93C5FD !important;
}

.tab-content {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Animation pour les cartes */
.bg-gradient-to-br {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.bg-gradient-to-br:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
</style>
@endpush

@section('custom_js')
<script>
// Variables globales
let currentTab = 'home';

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des messages flash
    @if(session('success'))
    Swal.fire({
        title: 'Succès !',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        showConfirmButton: true,
        timer: 3000
    });
    @endif

    @if(session('error'))
    Swal.fire({
        title: 'Erreur !',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
    @endif

    // Gestion du fichier image
    const fileInput = document.getElementById('default_image');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
            
            // Créer un indicateur visuel
            let indicator = document.getElementById('file-indicator');
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.id = 'file-indicator';
                indicator.className = 'mt-2 p-2 bg-blue-50 rounded-lg text-sm text-blue-700';
                fileInput.parentNode.insertBefore(indicator, fileInput.nextSibling);
            }
            
            indicator.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-file-image"></i>
                    <span>${fileName}</span>
                </div>
            `;
        });
    }
    
    // Animation d'entrée pour les éléments
    animateElements();
});

// Fonction pour changer d'onglet
function switchTab(tabName) {
    // Cacher tous les contenus
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.classList.remove('active');
    });
    
    // Afficher le contenu sélectionné
    const targetContent = document.getElementById(tabName + '-content');
    if (targetContent) {
        targetContent.classList.remove('hidden');
        targetContent.classList.add('active');
    }
    
    // Mettre à jour l'apparence des boutons d'onglets
    document.querySelectorAll('.tab-button').forEach(button => {
        button.style.borderColor = 'transparent';
        button.style.color = '#6B7280';
        button.classList.remove('active');
    });
    
    // Activer le bouton sélectionné
    const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
    if (activeButton) {
        activeButton.style.borderColor = '#3B82F6';
        activeButton.style.color = '#3B82F6';
        activeButton.classList.add('active');
    }
    
    currentTab = tabName;
}

// Animation des éléments au chargement
function animateElements() {
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 150);
    });
}

// Validation des formulaires
document.querySelectorAll('.pageSettingsForm').forEach(form => {
    form.addEventListener('submit', function(e) {
        const title = this.querySelector('input[name="title"]');
        const description = this.querySelector('textarea[name="description"]');
        
        let hasError = false;
        
        // Validation du titre
        if (title && title.value.trim().length < 10) {
            title.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
            hasError = true;
        } else if (title) {
            title.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
        }
        
        // Validation de la description
        if (description && description.value.trim().length < 30) {
            description.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
            hasError = true;
        } else if (description) {
            description.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
        }
        
        if (hasError) {
            e.preventDefault();
            Swal.fire({
                title: 'Attention !',
                text: 'Le titre doit contenir au moins 10 caractères et la description au moins 30 caractères.',
                icon: 'warning',
                confirmButtonText: 'Compris'
            });
        }
    });
});

// Compteur de caractères pour les champs de texte
document.querySelectorAll('input[type="text"], textarea').forEach(field => {
    field.addEventListener('input', function() {
        const length = this.value.length;
        const minLength = this.tagName === 'TEXTAREA' ? 30 : 10;
        
        // Changement de couleur selon la longueur
        if (length < minLength) {
            this.style.borderColor = '#F87171';
        } else {
            this.style.borderColor = '#10B981';
        }
    });
});

// Fonction pour les sous-onglets des pages légales
function switchLegalTab(tabName) {
    // Cacher tous les contenus des onglets légaux
    document.querySelectorAll('.legal-tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Afficher le contenu sélectionné
    const targetContent = document.getElementById(tabName + '-content');
    if (targetContent) {
        targetContent.classList.remove('hidden');
    }
    
    // Mettre à jour l'apparence des boutons des sous-onglets
    document.querySelectorAll('.legal-tab').forEach(button => {
        button.className = 'px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg legal-tab';
    });
    
    // Activer le bouton sélectionné
    const activeButton = document.querySelector(`[data-legal-tab="${tabName}"]`);
    if (activeButton) {
        activeButton.className = 'px-4 py-2 text-sm bg-purple-100 text-purple-700 rounded-lg legal-tab active';
    }
}

// Ajout de mots-clés aux autres pages existantes
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter des champs de mots-clés aux pages existantes si nécessaire
    const existingForms = document.querySelectorAll('form[action*="seo.page"]');
    
    existingForms.forEach(form => {
        // Vérifier si le formulaire n'a pas déjà de champ keywords
        if (!form.querySelector('input[name="keywords"]') && form.id !== 'seoForm') {
            const descriptionField = form.querySelector('textarea[name="description"]');
            if (descriptionField && descriptionField.closest('.space-y-2')) {
                const keywordsDiv = document.createElement('div');
                keywordsDiv.className = 'space-y-2';
                keywordsDiv.innerHTML = `
                    <label for="keywords" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-tags mr-2 text-yellow-500"></i>
                        Mots-clés spécifiques
                    </label>
                    <input type="text" 
                           name="keywords" 
                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           placeholder="mot-clé1, mot-clé2, mot-clé3">
                    <p class="text-xs text-gray-500">🏷️ Mots-clés spécifiques à cette page (optionnel)</p>
                `;
                
                // Insérer après le champ description
                descriptionField.closest('.space-y-2').parentNode.insertBefore(keywordsDiv, descriptionField.closest('.space-y-2').nextSibling);
            }
        }
    });
});

// Fonction pour mettre à jour la prévisualisation SEO
function updateSEOPreview() {
    const selectedPage = document.getElementById('preview-page').value;
    
    // Données SEO par page (simulées - dans un vrai système, cela viendrait du serveur)
    const seoData = {
        home: {
            title: 'Kreyatik Studio - Création de sites web professionnels',
            description: 'Découvrez nos services de création de sites web modernes et performants. Développement sur mesure, design responsive et optimisation SEO.',
            breadcrumb: 'accueil'
        },
        blog: {
            title: 'Blog - Actualités Web & Conseils Digital | Kreyatik Studio',
            description: 'Découvrez nos derniers articles sur le développement web, le design UX/UI, le SEO et les tendances digitales. Conseils d\'experts pour votre présence en ligne.',
            breadcrumb: 'blog'
        },
        portfolio: {
            title: 'Portfolio - Nos Réalisations Web | Kreyatik Studio',
            description: 'Explorez notre portfolio de sites web créés pour nos clients. Découvrez nos réalisations en développement web, design et référencement.',
            breadcrumb: 'portfolio'
        },
        contact: {
            title: 'Contact - Devis Gratuit | Kreyatik Studio',
            description: 'Contactez-nous pour votre projet web. Devis gratuit et personnalisé pour la création de votre site internet professionnel.',
            breadcrumb: 'contact'
        },
        offres: {
            title: 'Nos Offres - Services Web | Kreyatik Studio',
            description: 'Découvrez nos offres de création de sites web : site vitrine, e-commerce, application web sur mesure. Tarifs transparents et qualité professionnelle.',
            breadcrumb: 'nos-offres'
        },
        client: {
            title: 'Espace Client - Suivi de Projet | Kreyatik Studio',
            description: 'Accédez à votre espace client pour suivre l\'avancement de votre projet web, consulter vos factures et échanger avec notre équipe.',
            breadcrumb: 'espace-client'
        }
    };
    
    const data = seoData[selectedPage] || seoData.home;
    
    // Mettre à jour l'aperçu Google
    document.getElementById('preview-title').textContent = data.title;
    document.getElementById('preview-description').textContent = data.description;
    document.getElementById('preview-breadcrumb').textContent = data.breadcrumb;
    
    // Mettre à jour les aperçus des réseaux sociaux
    document.getElementById('fb-preview-title').textContent = data.title;
    document.getElementById('fb-preview-description').textContent = data.description.substring(0, 100) + '...';
    
    document.getElementById('twitter-preview-title').textContent = data.title;
    document.getElementById('twitter-preview-description').textContent = data.description.substring(0, 100) + '...';
    
    // Animation de mise à jour
    const preview = document.getElementById('google-preview');
    preview.style.opacity = '0.7';
    setTimeout(() => {
        preview.style.opacity = '1';
    }, 200);
}

// Initialiser la prévisualisation au chargement
document.addEventListener('DOMContentLoaded', function() {
    updateSEOPreview();
});
</script>
@endsection