<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(isset($SEOData))
        <title>{{ $SEOData->title }} | {{ config('app.name') }}</title>
        <meta name="description" content="{{ $SEOData->description }}">
        <meta name="author" content="{{ $SEOData->author }}">
        <meta name="robots" content="{{ $SEOData->robots }}">
        <link rel="canonical" href="{{ $SEOData->canonical_url }}" />
    @else
        <title>{{ config('app.name') }} - Développeur Web Freelance Rochefort | Laravel, SaaS, CRM</title>
        <meta name="description" content="Développeur web freelance à Rochefort spécialisé Laravel, SaaS et CRM sur-mesure. Création de sites internet professionnels en Charente-Maritime. Devis gratuit sous 24h.">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}" />
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ isset($SEOData) ? $SEOData->type : 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ isset($SEOData) ? $SEOData->title : config('app.name') . ' - Développeur Web Freelance Rochefort' }}">
    <meta property="og:description" content="{{ isset($SEOData) ? $SEOData->description : 'Développeur web freelance à Rochefort spécialisé Laravel, SaaS et CRM sur-mesure en Charente-Maritime' }}">
    <meta property="og:image" content="{{ isset($SEOData) ? $SEOData->image : asset('images/default-og.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="{{ isset($SEOData) ? $SEOData->title : config('app.name') }}">
    <meta property="twitter:description" content="{{ isset($SEOData) ? $SEOData->description : 'Développeur web freelance Rochefort - Laravel, SaaS, CRM sur-mesure' }}">

    <!-- SEO Local Rochefort -->
    <meta name="geo.region" content="FR-17">
    <meta name="geo.placename" content="Rochefort">
    <meta name="geo.position" content="45.9377;-0.9609">
    <meta name="ICBM" content="45.9377,-0.9609">
    <meta name="author" content="Kréyatik Studio - Développeur web freelance Rochefort">
    <meta name="keywords" content="développeur web Rochefort, création site internet Charente-Maritime, développeur Laravel Rochefort, freelance web Rochefort, SaaS Rochefort, CRM sur mesure">

    <!-- Fonts et CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Macondo&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hide public navigation on admin/client pages */
        body.admin-page .navbar,
        body.client-page .navbar,
        .admin-layout .navbar,
        .admin-layout .mobile-nav {
            display: none !important;
        }

        /* Override existing navbar styles and make it responsive */
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

        /* Override default.css navbar padding */
        .site-wrapper .navbar {
            padding: 0 !important;
        }

        /* Calculate exact navbar heights */
        .site-wrapper {
            /* Mobile: 0.875rem * 2 + min 32px content = ~46px, round to 48px */
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