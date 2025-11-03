<x-header :seoData="$SEOData ?? null" />

<main class="site-content" role="main">

    <section class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-[#0099CC] to-[#00A86B] pt-16 sm:pt-20 md:pt-24">

        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cdefs%3E%3Cpattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"%3E%3Cpath d="M 10 0 L 0 0 0 10" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.1"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width="100" height="100" fill="url(%23grid)"/%3E%3C/svg%3E')] opacity-20"></div>
        </div>


        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-element absolute top-20 left-10 w-32 h-32 bg-white/20 rounded-full opacity-30 animate-float"></div>
            <div class="floating-element absolute top-40 right-20 w-24 h-24 bg-white/20 rounded-full opacity-30 animate-float-delayed"></div>
            <div class="floating-element absolute bottom-32 left-1/4 w-20 h-20 bg-white/20 rounded-full opacity-30 animate-float-slow"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-6xl mx-auto text-center">
                <div class="mb-8">
                    <span class="inline-block px-6 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full text-white text-sm font-medium mb-6">
                        Portfolio Créatif
                    </span>
                </div>

                <h1 class="text-4xl sm:text-6xl md:text-8xl font-black mb-8 leading-none">
                    <span class="block text-white">NOS</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500] animate-gradient">RÉALISATIONS</span>
                    <span class="block text-white text-2xl sm:text-4xl md:text-6xl mt-4">DIGITALES</span>
                </h1>

                <p class="text-lg sm:text-xl md:text-2xl text-blue-100 mb-12 max-w-4xl mx-auto leading-relaxed px-4">
                    Découvrez notre collection de projets web innovants, où créativité et technologie se rencontrent pour créer des expériences digitales exceptionnelles.
                </p>

                <div class="flex flex-wrap justify-center gap-4 sm:gap-8 text-white/90 px-4">
                    <div class="stat-item text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#FFD700] mb-2">{{ count($portfolioItems) }}</div>
                        <div class="text-xs sm:text-sm">Créations uniques</div>
                    </div>
                    <div class="stat-item text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#FFD700] mb-2">100%</div>
                        <div class="text-xs sm:text-sm">Satisfaction Client</div>
                    </div>
                    <div class="stat-item text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#FFD700] mb-2">24/7</div>
                        <div class="text-xs sm:text-sm">Support Disponible</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>


    <section class="portfolio-section py-16 sm:py-24 md:py-32 bg-gradient-to-br from-[#0099CC] to-[#00A86B]" aria-label="Galerie de nos réalisations">
        <div class="container mx-auto px-4">
            @if(count($portfolioItems) > 0)
            <div class="mb-12 sm:mb-16 md:mb-20 text-center">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 sm:mb-6 px-4">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500]">Projets</span>
                    <span class="text-white">Phares</span>
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed px-4">
                    Chaque projet raconte une histoire unique d'innovation et d'excellence technique.
                    Découvrez comment nous transformons les idées en expériences digitales mémorables.
                </p>
            </div>

            <div class="portfolio-grid grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 md:gap-16" role="list">
                @foreach($portfolioItems->sortByDesc('created_at') as $index => $item)
                <article class="portfolio-card group relative h-full"
                         role="listitem"
                         itemscope
                         itemtype="https://schema.org/CreativeWork">


                    <div class="relative bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden transform transition-all duration-700 hover:scale-105 hover:rotate-1 border border-white/20 h-full flex flex-col">

                        <div class="portfolio-media relative overflow-hidden flex-shrink-0" style="aspect-ratio: 16/10;">
                            @if($item->isImage())
                            <img src="{{ asset($item->path) }}"
                                 alt="Aperçu du projet {{ $item->title }} - {{ $item->description }}"
                                 class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                 loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
                                 itemprop="image">
                            @else
                            <video autoplay muted loop playsinline
                                   poster="{{ asset($item->path) }}"
                                   class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                   aria-label="Présentation vidéo du projet {{ $item->title }}">
                                <source src="{{ asset($item->path) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture vidéo.
                            </video>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>


                            <div class="absolute top-4 sm:top-6 left-4 sm:left-6">
                                <span class="bg-gradient-to-r from-[#FFD700] to-[#FFA500] text-black px-3 sm:px-4 py-1 sm:py-2 rounded-full text-xs sm:text-sm font-bold shadow-2xl">
                                    #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/20 to-[#FFA500]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="portfolio-content p-4 sm:p-6 md:p-8 text-white flex-1 flex flex-col">
                            <header class="mb-4 sm:mb-6 flex-1">
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-2 sm:mb-3 group-hover:text-[#FFD700] transition-colors duration-300" itemprop="name">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-white leading-relaxed text-sm sm:text-base md:text-lg" itemprop="description">
                                    {{ $item->description }}
                                </p>
                            </header>

                            @if($item->technology)
                            <div class="portfolio-technologies mb-4 sm:mb-6">
                                <h4 class="text-xs sm:text-sm font-semibold text-[#FFD700] mb-2 sm:mb-4 flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Technologies Utilisées
                                </h4>
                                <div class="flex flex-wrap gap-2 sm:gap-3">
                                    @foreach(explode(',', $item->technology) as $tech)
                                    <span class="bg-white/20 text-white px-2 sm:px-4 py-1 sm:py-2 rounded-full text-xs sm:text-sm font-medium border border-white/30 hover:border-[#FFD700] hover:bg-[#FFD700]/20 transition-all duration-300">
                                        {{ trim($tech) }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="flex justify-between items-center pt-4 sm:pt-6 border-t border-white/20 mt-auto">
                                <div class="flex items-center gap-2 sm:gap-4 text-xs sm:text-sm text-white">
                                    <span class="flex items-center gap-1 sm:gap-2">
                                        <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-green-400 rounded-full animate-pulse"></div>
                                        Projet Livré
                                    </span>
                                    <span class="flex items-center gap-1 sm:gap-2">
                                        <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-blue-400 rounded-full animate-pulse"></div>
                                        Client Satisfait
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @else

            <div class="portfolio-empty text-center py-16 sm:py-24 md:py-32" role="alert">
                <div class="max-w-md mx-auto px-4">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 mx-auto mb-6 sm:mb-8 bg-gradient-to-br from-[#FFD700] to-[#FFA500] rounded-full flex items-center justify-center animate-pulse">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4 sm:mb-6">Portfolio en Construction</h3>
                    <p class="text-base sm:text-lg md:text-xl text-blue-100 mb-8 sm:mb-12 leading-relaxed">
                        Nous travaillons actuellement sur de nouveaux projets passionnants.
                        Revenez bientôt pour découvrir nos dernières réalisations !
                    </p>
                    <div class="flex justify-center space-x-2 sm:space-x-4">
                        <div class="w-3 h-3 sm:w-4 sm:h-4 bg-[#FFD700] rounded-full animate-bounce"></div>
                        <div class="w-3 h-3 sm:w-4 sm:h-4 bg-[#FFA500] rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-3 h-3 sm:w-4 sm:h-4 bg-white rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>


    <section class="expertise-section py-16 sm:py-24 md:py-32 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <!-- Background pattern subtil pour la profondeur -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%236b7280" fill-opacity="0.04"%3E%3Ccircle cx="30" cy="30" r="1.5"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-6xl mx-auto text-center mb-12 sm:mb-16 md:mb-20">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-gray-900 mb-6 sm:mb-8 px-4">
                    Notre <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-emerald-600">Expertise</span> Technique
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl text-gray-700 max-w-4xl mx-auto leading-relaxed px-4 font-medium">
                    Nous maîtrisons les technologies les plus avancées pour créer des solutions web performantes et innovantes.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="expertise-card group text-center p-8 sm:p-10 rounded-3xl bg-white hover:bg-gray-50 transition-all duration-500 transform hover:-translate-y-4 border border-gray-200 hover:border-blue-300 shadow-lg hover:shadow-2xl hover:shadow-blue-500/20">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 sm:mb-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-500 shadow-lg">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 group-hover:text-blue-600 transition-colors duration-300">Frontend Moderne</h3>
                    <p class="text-gray-600 leading-relaxed text-base sm:text-lg font-medium">Interfaces réactives et animations fluides avec les dernières technologies web.</p>
                </div>

                <div class="expertise-card group text-center p-8 sm:p-10 rounded-3xl bg-white hover:bg-gray-50 transition-all duration-500 transform hover:-translate-y-4 border border-gray-200 hover:border-emerald-300 shadow-lg hover:shadow-2xl hover:shadow-emerald-500/20">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 sm:mb-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-500 shadow-lg">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 group-hover:text-emerald-600 transition-colors duration-300">Backend Robuste</h3>
                    <p class="text-gray-600 leading-relaxed text-base sm:text-lg font-medium">Architectures scalables et APIs performantes pour vos applications.</p>
                </div>

                <div class="expertise-card group text-center p-8 sm:p-10 rounded-3xl bg-white hover:bg-gray-50 transition-all duration-500 transform hover:-translate-y-4 border border-gray-200 hover:border-purple-300 shadow-lg hover:shadow-2xl hover:shadow-purple-500/20">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 sm:mb-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-500 shadow-lg">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 group-hover:text-purple-600 transition-colors duration-300">Design UX/UI</h3>
                    <p class="text-gray-600 leading-relaxed text-base sm:text-lg font-medium">Expériences utilisateur intuitives et designs visuels impactants.</p>
                </div>

                <div class="expertise-card group text-center p-8 sm:p-10 rounded-3xl bg-white hover:bg-gray-50 transition-all duration-500 transform hover:-translate-y-4 border border-gray-200 hover:border-orange-300 shadow-lg hover:shadow-2xl hover:shadow-orange-500/20">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 sm:mb-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-500 shadow-lg">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 group-hover:text-orange-600 transition-colors duration-300">Performance</h3>
                    <p class="text-gray-600 leading-relaxed text-base sm:text-lg font-medium">Optimisation pour des temps de chargement ultra-rapides.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA  -->
    <section class="cta-section relative py-16 sm:py-24 md:py-32 bg-gradient-to-br from-white to-gray-50 overflow-hidden border-t border-gray-200">
        <!-- Pattern subtil pour la texture -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%236b7280" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="1.5"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-8 sm:mb-10 px-4 leading-tight">
                    <span class="text-gray-900">Prêt à Créer</span><br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-emerald-600">Votre Projet d'Exception</span> ?
                </h2>
                <p class="text-xl sm:text-2xl md:text-3xl text-gray-700 mb-12 sm:mb-16 leading-relaxed max-w-4xl mx-auto px-4 font-medium">
                    Transformez vos idées en réalité digitale avec notre expertise.
                    Chaque projet est une opportunité de créer quelque chose d'extraordinaire.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 justify-center px-4">
                    <a href="{{ route('contact') }}"
                       class="group inline-flex items-center justify-center px-8 sm:px-10 md:px-12 py-4 sm:py-5 md:py-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-bold text-lg sm:text-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-blue-500/25 transform hover:-translate-y-2">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 mr-3 sm:mr-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Discutons de Votre Projet
                    </a>
                    <a href="{{ route('nos-offres') }}"
                       class="group inline-flex items-center justify-center px-8 sm:px-10 md:px-12 py-4 sm:py-5 md:py-6 border-2 border-gray-300 text-gray-700 rounded-2xl font-bold text-lg sm:text-xl hover:border-gray-400 hover:bg-gray-50 transition-all duration-300 transform hover:-translate-y-2 shadow-md hover:shadow-lg">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 mr-3 sm:mr-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Voir Nos Offres
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
<x-footer />