<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Kréyatik Studio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fixed Layout Styles */
        body, html {
            height: 100vh;
            overflow: hidden;
        }

        .admin-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Fixed Sidebar Styles */
        #sidebar {
            width: 256px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 30;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #e5e7eb;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        #sidebar.show {
            transform: translateX(0);
        }

        /* Desktop sidebar always visible */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0) !important;
                position: fixed !important;
            }

            .main-content {
                margin-left: 256px !important;
            }
        }

        /* Sidebar navigation scroll */
        .sidebar-nav {
            height: calc(100vh - 120px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Content scroll area */
        .content-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .content-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .content-scroll::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .content-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .content-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Mobile responsiveness */
        @media (max-width: 1023px) {
            .mobile-header {
                padding-left: 4rem !important;
            }

            .mobile-buttons {
                position: fixed;
                top: 1rem;
                right: 1rem;
                z-index: 40;
                display: flex;
                gap: 0.5rem;
            }

            .mobile-menu-btn {
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 40;
                background: white;
                padding: 0.5rem;
                border-radius: 0.375rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                transition: all 0.2s ease;
            }

            .mobile-menu-btn:hover {
                background: #f9fafb;
            }
        }

        /* Tablet specific styles */
        @media (min-width: 768px) and (max-width: 1023px) {
            .content-scroll {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        /* Animation classes */
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 20;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
    </style>

    @yield('head')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white shadow-lg border-r border-gray-200">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-6 bg-gradient-to-r from-blue-600 to-blue-700">
                    <img src="{{ asset('images/Studiosansfond.png') }}" alt="Kréyatik Studio" class="h-10 w-auto">
                    <span class="ml-2 text-white font-bold text-lg">Admin</span>
                </div>

                <!-- User Info -->
                <div class="flex items-center px-6 py-4 border-b border-gray-200">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Utilisateur' }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role ?? 'user') }}</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="sidebar-nav px-4 py-4">
                    <div class="space-y-1">
                        <!-- Dashboard Principal -->
                        <div class="mb-6">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border-r-4 border-blue-700' : '' }}">
                                <i class="fas fa-tachometer-alt mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : '' }}"></i>
                                <span class="font-semibold">Tableau de bord</span>
                            </a>
                        </div>

                        <!-- GESTION DE PROJETS -->
                        <div class="mb-4">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gestion de projets</h3>
                            <div class="space-y-1">
                                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.projects.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-project-diagram mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.projects.*') ? 'text-blue-600' : '' }}"></i>
                                    Projets
                                </a>

                                <a href="{{ route('admin.tasks.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.tasks.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-tasks mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.tasks.*') ? 'text-blue-600' : '' }}"></i>
                                    Tâches
                                </a>

                                <a href="{{ route('admin.timer.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.timer.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-clock mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.timer.*') ? 'text-blue-600' : '' }}"></i>
                                    Chronomètre
                                </a>
                            </div>
                        </div>

                        <!-- GESTION CLIENTÈLE -->
                        <div class="mb-4">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gestion clientèle</h3>
                            <div class="space-y-1">
                                <a href="{{ route('admin.clients.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.clients.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-users mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.clients.*') ? 'text-blue-600' : '' }}"></i>
                                    Clients
                                </a>

                                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.contact-messages.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-envelope mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.contact-messages.*') ? 'text-blue-600' : '' }}"></i>
                                    Messages
                                    <span id="messages-notification-badge" class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 hidden"></span>
                                </a>

                                <a href="{{ route('admin.tickets.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.tickets.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-ticket-alt mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.tickets.*') ? 'text-blue-600' : '' }}"></i>
                                    Tickets Support
                                    <span id="tickets-notification-badge" class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 hidden"></span>
                                </a>
                            </div>
                        </div>

                        <!-- CONTENU & MÉDIAS -->
                        <div class="mb-4">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Contenu & médias</h3>
                            <div class="space-y-1">
                                <a href="{{ route('admin.articles.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.articles.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-newspaper mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.articles.*') ? 'text-blue-600' : '' }}"></i>
                                    Articles Blog
                                </a>

                                <a href="{{ route('admin.portfolio.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.portfolio.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-images mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.portfolio.*') ? 'text-blue-600' : '' }}"></i>
                                    Portfolio
                                </a>
                            </div>
                        </div>

                        <!-- FINANCES -->
                        <div class="mb-4">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Finances</h3>
                            <div class="space-y-1">
                                <a href="{{ route('admin.expenses.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.expenses.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-receipt mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.expenses.*') ? 'text-blue-600' : '' }}"></i>
                                    Dépenses
                                </a>

                                <a href="{{ route('admin.pricing-plans.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.pricing-plans.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-tags mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.pricing-plans.*') ? 'text-blue-600' : '' }}"></i>
                                    Plans Tarifaires
                                </a>
                            </div>
                        </div>

                        <!-- ANALYTIQUES -->
                        <div class="mb-4">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Analytiques</h3>
                            <div class="space-y-1">
                                <a href="{{ route('admin.stats.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.stats.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-chart-bar mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.stats.*') ? 'text-blue-600' : '' }}"></i>
                                    Statistiques
                                </a>

                                <a href="{{ route('admin.projects.timer') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.projects.timer') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-stopwatch mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.projects.timer') ? 'text-blue-600' : '' }}"></i>
                                    Temps Projets
                                </a>
                            </div>
                        </div>

                        <!-- CONFIGURATION -->
                        <div class="mb-4">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Configuration</h3>
                            <div class="space-y-1">
                                @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-user-cog mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.users.*') ? 'text-blue-600' : '' }}"></i>
                                    Utilisateurs
                                </a>
                                @endif

                                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.settings.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-cog mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.settings.*') ? 'text-blue-600' : '' }}"></i>
                                    Paramètres Site
                                </a>

                                <a href="{{ route('admin.profile.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.profile.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                                    <i class="fas fa-user-circle mr-3 text-gray-500 group-hover:text-gray-700 {{ request()->routeIs('admin.profile.*') ? 'text-blue-600' : '' }}"></i>
                                    Mon Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Logout Button -->
                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 group">
                            <i class="fas fa-sign-out-alt mr-3 text-red-500 group-hover:text-red-600"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Mobile menu button -->
            <button id="sidebar-toggle" class="mobile-menu-btn lg:hidden">
                <i class="fas fa-bars text-gray-600"></i>
            </button>

            <!-- Quick access buttons for mobile -->
            <div class="mobile-buttons lg:hidden">
                <a href="{{ route('admin.contact-messages.index') }}" class="p-2 bg-white rounded-md shadow-lg hover:bg-gray-50 transition-colors relative">
                    <i class="fas fa-envelope text-gray-600"></i>
                    <span id="mobile-messages-badge" class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center hidden"></span>
                </a>
                <a href="{{ route('admin.tickets.index') }}" class="p-2 bg-white rounded-md shadow-lg hover:bg-gray-50 transition-colors relative">
                    <i class="fas fa-ticket-alt text-gray-600"></i>
                    <span id="mobile-tickets-badge" class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center hidden"></span>
                </a>
                <a href="{{ route('admin.projects.index') }}" class="p-2 bg-white rounded-md shadow-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-project-diagram text-gray-600"></i>
                </a>
            </div>

            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4 mobile-header">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">@yield('page_title', 'Dashboard')</h1>
                    </div>

                    <!-- Top Bar Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Retour au site -->
                        <a href="{{ url('/') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Retourner au site web">
                            <i class="fas fa-globe mr-2"></i>
                            <span class="hidden md:inline">Retour au site</span>
                        </a>
                        
                        <!-- Notifications -->
                        <div class="relative">
                            <button id="notifications-btn" class="p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg transition-colors duration-200">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- Notifications Dropdown -->
                            <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-2 z-50 border border-gray-200">
                                <div class="px-4 py-2 text-sm font-semibold text-gray-700 border-b border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <span>Notifications</span>
                                        <span class="bg-red-100 text-red-800 text-xs rounded-full px-2 py-1">3 nouvelles</span>
                                    </div>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="{{ route('admin.contact-messages.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-envelope text-blue-600 text-xs"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="font-medium">Nouveau message</p>
                                                <p class="text-gray-500 text-xs">Il y a 5 minutes</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.projects.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-project-diagram text-green-600 text-xs"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="font-medium">Projet mis à jour</p>
                                                <p class="text-gray-500 text-xs">Il y a 1 heure</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.tickets.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-ticket-alt text-yellow-600 text-xs"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="font-medium">Nouveau ticket</p>
                                                <p class="text-gray-500 text-xs">Il y a 2 heures</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-t border-gray-200 p-2">
                                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-center text-sm text-blue-600 hover:text-blue-800 py-1">
                                        Voir toutes les notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Menu -->
                        <div class="relative">
                            <button id="profile-menu-btn" class="flex items-center p-2 text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg transition-colors duration-200">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="hidden md:block">{{ Auth::user()->name ?? 'Utilisateur' }}</span>
                                <i class="fas fa-chevron-down ml-2 transition-transform duration-200" id="profile-chevron"></i>
                            </button>
                            
                            <!-- Profile Dropdown -->
                            <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                <div class="px-4 py-2 text-xs text-gray-500 border-b border-gray-200">
                                    Connecté en tant que
                                </div>
                                <a href="{{ route('admin.profile.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                                    Mon Profil
                                </a>
                                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-cog mr-3 text-gray-400"></i>
                                    Paramètres
                                </a>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt mr-3 text-red-500"></i>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="content-scroll bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times cursor-pointer"></i>
                            </span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times cursor-pointer"></i>
                            </span>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="mb-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('warning') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times cursor-pointer"></i>
                            </span>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content_body')
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="sidebar-overlay lg:hidden"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }

            function closeSidebar() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Auto-show sidebar on desktop, auto-hide on mobile
            function handleResize() {
                if (window.innerWidth >= 1024) {
                    // Desktop: ensure sidebar is shown
                    sidebar.classList.add('show');
                    overlay.classList.remove('show');
                } else {
                    // Mobile: hide sidebar and overlay by default
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            }

            // Initialize on load
            handleResize();

            // Handle window resize
            window.addEventListener('resize', handleResize);

            // Close sidebar on mobile when clicking a link
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Top bar dropdowns functionality
            initTopBarDropdowns();

            // Initialize tooltips for mobile
            initTooltips();

            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
            // Check unread messages and update counters
            updateSidebarCounters();
            setInterval(updateSidebarCounters, 5 * 60 * 1000);
            @endif
        });

        // Initialize top bar dropdowns
        function initTopBarDropdowns() {
            const notificationsBtn = document.getElementById('notifications-btn');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            const profileBtn = document.getElementById('profile-menu-btn');
            const profileDropdown = document.getElementById('profile-dropdown');
            const profileChevron = document.getElementById('profile-chevron');

            // Notifications dropdown
            if (notificationsBtn && notificationsDropdown) {
                notificationsBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Close profile dropdown if open
                    profileDropdown?.classList.add('hidden');
                    profileChevron?.classList.remove('rotate-180');
                    // Toggle notifications dropdown
                    notificationsDropdown.classList.toggle('hidden');
                });
            }

            // Profile dropdown
            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Close notifications dropdown if open
                    notificationsDropdown?.classList.add('hidden');
                    // Toggle profile dropdown and chevron
                    profileDropdown.classList.toggle('hidden');
                    profileChevron?.classList.toggle('rotate-180');
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!notificationsBtn?.contains(e.target) && !notificationsDropdown?.contains(e.target)) {
                    notificationsDropdown?.classList.add('hidden');
                }
                if (!profileBtn?.contains(e.target) && !profileDropdown?.contains(e.target)) {
                    profileDropdown?.classList.add('hidden');
                    profileChevron?.classList.remove('rotate-180');
                }
            });

            // Close dropdowns on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    notificationsDropdown?.classList.add('hidden');
                    profileDropdown?.classList.add('hidden');
                    profileChevron?.classList.remove('rotate-180');
                }
            });
        }

        // Initialize tooltips
        function initTooltips() {
            const tooltipElements = document.querySelectorAll('[data-tooltip]');
            tooltipElements.forEach(element => {
                element.addEventListener('mouseenter', showTooltip);
                element.addEventListener('mouseleave', hideTooltip);
            });
        }

        function showTooltip(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute z-50 px-2 py-1 text-xs bg-gray-900 text-white rounded shadow-lg';
            tooltip.textContent = e.target.getAttribute('data-tooltip');
            tooltip.style.left = e.pageX + 10 + 'px';
            tooltip.style.top = e.pageY - 30 + 'px';
            document.body.appendChild(tooltip);
            e.target.tooltipElement = tooltip;
        }

        function hideTooltip(e) {
            if (e.target.tooltipElement) {
                document.body.removeChild(e.target.tooltipElement);
                e.target.tooltipElement = null;
            }
        }

        // Update sidebar counters
        function updateSidebarCounters() {
            // Update unread messages
            checkUnreadMessages();

            // Update new tickets
            checkNewTickets();
        }

        // Function to check unread messages
        function checkUnreadMessages() {
            axios.get('{{ route("admin.contact-messages.unread-count") }}')
                .then(function(response) {
                    const count = response.data.count;
                    updateNotificationBadge(count);
                })
                .catch(function(error) {
                    console.error('Error fetching unread messages:', error);
                });
        }

        // Function to check new tickets
        function checkNewTickets() {
            axios.get('{{ route("admin.tickets.new-count") }}')
                .then(function(response) {
                    const count = response.data.count;
                    updateTicketNotificationBadge(count);
                })
                .catch(function(error) {
                    console.error('Error fetching new tickets:', error);
                });
        }

        // Update notification badge
        function updateNotificationBadge(count) {
            const badge = document.getElementById('messages-notification-badge');
            const mobileBadge = document.getElementById('mobile-messages-badge');

            [badge, mobileBadge].forEach(element => {
                if (element) {
                    if (count > 0) {
                        element.textContent = count > 99 ? '99+' : count;
                        element.classList.remove('hidden');
                        // Add pulsing animation for new messages
                        element.classList.add('animate-pulse');
                    } else {
                        element.classList.add('hidden');
                        element.classList.remove('animate-pulse');
                    }
                }
            });
        }

        // Update ticket notification badge
        function updateTicketNotificationBadge(count) {
            const badge = document.getElementById('tickets-notification-badge');
            const mobileBadge = document.getElementById('mobile-tickets-badge');

            [badge, mobileBadge].forEach(element => {
                if (element) {
                    if (count > 0) {
                        element.textContent = count > 99 ? '99+' : count;
                        element.classList.remove('hidden');
                        // Add pulsing animation for new tickets
                        element.classList.add('animate-pulse');
                    } else {
                        element.classList.add('hidden');
                        element.classList.remove('animate-pulse');
                    }
                }
            });
        }

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Alt + D for Dashboard
            if (e.altKey && e.key === 'd') {
                e.preventDefault();
                window.location.href = '{{ route("admin.dashboard") }}';
            }
            // Alt + P for Projects
            if (e.altKey && e.key === 'p') {
                e.preventDefault();
                window.location.href = '{{ route("admin.projects.index") }}';
            }
            // Alt + M for Messages
            if (e.altKey && e.key === 'm') {
                e.preventDefault();
                window.location.href = '{{ route("admin.contact-messages.index") }}';
            }
            // Alt + T for Tickets
            if (e.altKey && e.key === 't') {
                e.preventDefault();
                window.location.href = '{{ route("admin.tickets.index") }}';
            }
        });
    </script>

    @yield('custom_js')
</body>
</html>

