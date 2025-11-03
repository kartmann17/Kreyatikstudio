<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seo      = $SEOData ?? null;
        $title    = $seo->title ?? (config('app.name') . ' Développeur Web Freelance Rochefort | Laravel, E-commerce & Applications');
        $desc     = $seo->description ?? 'Développeur web freelance à Rochefort : création de sites internet, e-commerce & applications Laravel sur-mesure. Expert SEO, solutions digitales performantes. Devis gratuit.';
        $robots   = $seo->robots ?? 'index, follow';
        $type     = $seo->type ?? 'website';
        $canonical= $seo->canonical_url ?? url()->current();


        $rawImage = $seo->image ?? null;
        $ogImage  = $rawImage
            ? (Str::startsWith($rawImage, ['http://','https://']) ? $rawImage : secure_url(ltrim($rawImage,'/')))
            : secure_asset('images/STUDIOcolibri.png');
    @endphp

    <title>{{ $title }}{{ isset($SEOData) ? ' | ' . config('app.name') : '' }}</title>
    <meta name="description" content="{{ $desc }}">
    <meta name="robots" content="{{ $robots }}">
    <link rel="canonical" href="{{ $canonical }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $type }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <!-- SEO Local Rochefort -->
    <meta name="geo.region" content="FR-17">
    <meta name="geo.placename" content="Rochefort">
    <meta name="geo.position" content="45.9377;-0.9609">
    <meta name="ICBM" content="45.9377,-0.9609">
    <meta name="keywords" content="développeur web freelance rochefort, création site internet rochefort, développeur laravel rochefort, freelance web charente-maritime, développeur application rochefort, site e-commerce rochefort, développeur php rochefort, kreyatik studio, lionel blanchet">

    <!-- Fonts et CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Macondo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('favicon/favicon-16x16.png') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('meta')

    <style>

        body.admin-page .navbar,
        body.client-page .navbar,
        .admin-layout .navbar,
        .admin-layout .mobile-nav {
            display: none !important;
        }


        .site-wrapper .navbar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1000 !important;
            background: rgba(0, 0, 0, 0.9) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;
            animation: none !important;
        }

        .site-wrapper .navbar-container {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            padding: 0.875rem 1rem !important;
            color: white !important;
            min-height: 60px !important;
            box-sizing: border-box !important;
        }


        .site-wrapper .navbar {
            padding: 0 !important;
        }

        /* Calculate exact navbar heights */
        .site-wrapper {

            padding-top: 48px !important;
        }

        /* Ensure no extra spacing */
        .site-wrapper > .site-content,
        .site-wrapper .main-page {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Navbar scroll effect */
        .site-wrapper .navbar.scrolled {
            background: rgba(0, 0, 0, 0.95) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3) !important;
        }

        /* Desktop navbar adjustments */
        @media (min-width: 1024px) {
            .site-wrapper .navbar-container {
                padding: 1rem 1rem !important;
                height: 64px !important;
                box-sizing: border-box !important;
            }

            .site-wrapper {
                /* Desktop: 1rem * 2 + content = 64px exact */
                padding-top: 64px !important;
            }

            /* Ensure desktop content starts immediately after navbar */
            .site-wrapper > .site-content,
            .site-wrapper .main-page,
            .site-wrapper .main-page > *:first-child,
            .site-wrapper .hero-section {
                margin-top: 0 !important;
                padding-top: 0 !important;
            }
        }

        /* Mobile elements */
        .site-wrapper .mobile-logo,
        .site-wrapper .mobile-menu-toggle {
            display: none;
            cursor: pointer;
            z-index: 50;
        }

        /* Desktop navigation */
        .site-wrapper .desktop-nav {
            display: none;
            gap: 1.5rem;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            list-style: none;
            padding: 0;
        }

        /* Mobile - show mobile elements, hide desktop nav */
        @media (max-width: 1023px) {
            .site-wrapper .navbar-container {
                justify-content: space-between !important;
            }

            .site-wrapper .mobile-logo,
            .site-wrapper .mobile-menu-toggle {
                display: block !important;
            }

            .site-wrapper .desktop-nav {
                display: none !important;
            }
        }

        /* Desktop - show centered desktop nav, hide mobile elements */
        @media (min-width: 1024px) {
            .site-wrapper .navbar-container {
                justify-content: center !important;
            }

            .site-wrapper .mobile-logo,
            .site-wrapper .mobile-menu-toggle {
                display: none !important;
            }

            .site-wrapper .desktop-nav {
                display: flex !important;
                gap: 2rem !important;
                align-items: center !important;
                justify-content: center !important;
                margin: 0 auto !important;
            }
        }

        /* Ensure public mobile nav is properly scoped */
        .site-wrapper .mobile-nav {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .site-wrapper .mobile-nav.active {
            transform: translateY(0);
        }

        .site-wrapper .mobile-nav.hidden {
            transform: translateY(-100%);
        }

        /* Only show mobile nav on small screens */
        @media (min-width: 1024px) {
            .site-wrapper .mobile-nav {
                display: none !important;
            }
        }

        /* Contest link blinking animation */
        @keyframes blink-glow {
            0%, 100% {
                opacity: 1;
                text-shadow: 0 0 10px rgba(255, 215, 0, 0.8),
                             0 0 20px rgba(255, 215, 0, 0.5),
                             0 0 30px rgba(255, 215, 0, 0.3);
            }
            50% {
                opacity: 0.7;
                text-shadow: 0 0 5px rgba(255, 215, 0, 0.4),
                             0 0 10px rgba(255, 215, 0, 0.2);
            }
        }

        .contest-link {
            animation: blink-glow 2s ease-in-out infinite;
            font-weight: 600 !important;
            color: #FFD700 !important;
        }

        .contest-link:hover {
            animation: none;
            color: #FFA500 !important;
            text-shadow: 0 0 15px rgba(255, 215, 0, 1);
        }

        /* Results link blinking animation (gold) */
        @keyframes blink-gold {
            0%, 100% {
                opacity: 1;
                text-shadow: 0 0 10px rgba(251, 191, 36, 0.8),
                             0 0 20px rgba(251, 191, 36, 0.5),
                             0 0 30px rgba(251, 191, 36, 0.3);
            }
            50% {
                opacity: 0.7;
                text-shadow: 0 0 5px rgba(251, 191, 36, 0.4),
                             0 0 10px rgba(251, 191, 36, 0.2);
            }
        }

        .results-link {
            animation: blink-gold 2s ease-in-out infinite;
            font-weight: 600 !important;
            color: #fbbf24 !important;
        }

        .results-link:hover {
            animation: none;
            color: #f59e0b !important;
            text-shadow: 0 0 15px rgba(251, 191, 36, 1);
        }
    </style>

    <!-- Google Analytics - Loaded conditionally based on consent -->
    <script type="text/javascript">
    window.loadGoogleAnalytics = function() {
        if (!window.gtag) {
            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id=G-5WGQCL5M8S';
            document.head.appendChild(script);

            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-5WGQCL5M8S');
            window.gtag = gtag;
        }
    };

    // Load GA if analytics consent was previously given (new system)
    const consent = localStorage.getItem('kreyatik_cookie_consent');
    if (consent) {
        const consentData = JSON.parse(consent);
        if (consentData.analytics) {
            window.loadGoogleAnalytics();
        }
    }
    </script>
</head>

<body class="h-full">
    <div class="site-wrapper">
        <nav class="navbar">
            <div class="navbar-container">
                <!-- Mobile Logo (only visible on mobile) -->
                <a href="/" class="mobile-logo">
                    <img src="{{ asset('images/Studiosansfond.png') }}" alt="Logo Kréyatik" width="100" height="50" class="object-contain">
                </a>

                <!-- Mobile Menu Toggle (only visible on mobile) -->
                <div id="menuToggle" class="mobile-menu-toggle">
                    <i class="fas fa-bars text-white text-xl"></i>
                </div>

                <!-- Desktop Navigation (only visible on desktop) -->
                <ul class="desktop-nav navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/NosOffres">Nos Offres</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Portfolio">Portfolio</a></li>
                    @php
                        $now = \Carbon\Carbon::now();
                        $contestEnabled = config('contest.enabled', false);
                        $contestStart = \Carbon\Carbon::parse(config('contest.start_date'));
                        $contestEnd = \Carbon\Carbon::parse(config('contest.end_date'))->endOfDay();
                        $contestActive = $contestEnabled && $now->between($contestStart, $contestEnd);
                        $resultsStartDate = \Carbon\Carbon::parse(config('contest.results_date'));
                        $resultsEndDate = \Carbon\Carbon::parse(config('contest.end_date'))->addDays(10)->endOfDay();
                        $resultsActive = $contestEnabled && $now->between($resultsStartDate, $resultsEndDate);
                    @endphp
                    @if($contestActive)
                        <li class="nav-item"><a class="nav-link contest-link" href="/concours">🎉 Concours</a></li>
                    @elseif($resultsActive)
                        <li class="nav-item"><a class="nav-link results-link" href="/concours/resultat">🏆 Résultat</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="/Contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Inscription</a></li>
                </ul>
            </div>
        </nav>

        <!-- Mobile Navigation Menu -->
        <div class="mobile-nav fixed inset-0 bg-black/95 z-40 lg:hidden hidden" id="mobileMenu">
            <div class="flex flex-col items-center justify-center h-full space-y-8 text-white">
                <a href="/" class="nav-link mobile-nav-link">Accueil</a>
                <a href="/NosOffres" class="nav-link mobile-nav-link">Nos Offres</a>
                <a href="/Portfolio" class="nav-link mobile-nav-link">Portfolio</a>
                @if($contestActive ?? false)
                    <a href="/concours" class="nav-link mobile-nav-link contest-link">🎉 Concours</a>
                @elseif($resultsActive ?? false)
                    <a href="/concours/resultat" class="nav-link mobile-nav-link results-link">🏆 Résultat</a>
                @endif
                <a href="/Contact" class="nav-link mobile-nav-link">Contact</a>
                <a href="/login" class="nav-link mobile-nav-link">Connexion</a>
                <a href="/register" class="nav-link mobile-nav-link">Inscription</a>
            </div>
        </div>

        <div class="site-content">{!! $slot ?? '' !!}</div>

        <!-- Modern Cookie Consent -->
        <x-cookie-consent />
    </div>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        if (document.getElementById('menuToggle')) {
            document.getElementById('menuToggle').addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobileMenu');
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>