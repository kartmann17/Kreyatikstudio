@extends('admin.layout')

@section('title', 'Mon profil')

@section('page_title', 'Mon profil')

@section('content_body')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Messages de notification -->
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check mr-2"></i>
            <strong class="font-bold">Succès !</strong>
        </div>
        <span class="block sm:inline mt-1">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <div class="flex items-center">
            <i class="fas fa-ban mr-2"></i>
            <strong class="font-bold">Erreur !</strong>
        </div>
        <span class="block sm:inline mt-1">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-4">
            <!-- Profile Image -->
            <div class="bg-white shadow rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-user text-white text-3xl"></i>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-center text-gray-900 mb-2">{{ auth()->user()->name }}</h3>
                    <div class="text-center mb-4">
                        @if(auth()->user()->role == 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-user-shield mr-1"></i>Administrateur
                            </span>
                        @elseif(auth()->user()->role == 'staff')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-user-tie mr-1"></i>Staff
                            </span>
                        @elseif(auth()->user()->role == 'client')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-user mr-1"></i>Client
                            </span>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium text-gray-900">Email</span>
                            <span class="text-sm text-gray-600">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium text-gray-900">Date d'inscription</span>
                            <span class="text-sm text-gray-600">{{ auth()->user()->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Dernière connexion</span>
                            <span class="text-sm text-gray-600">{{ auth()->user()->last_login_at ?? 'Jamais' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- About Me Box -->
            <div class="bg-white shadow rounded-lg border border-gray-200 mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informations supplémentaires</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center font-medium text-gray-900 mb-1">
                                <i class="fas fa-shield-alt mr-2 text-gray-500"></i> Rôle
                            </div>
                            <p class="text-sm text-gray-600 ml-6">
                                @if(auth()->user()->role == 'admin')
                                    Administrateur (Accès complet au système)
                                @elseif(auth()->user()->role == 'staff')
                                    Staff (Accès limité aux fonctionnalités administratives)
                                @elseif(auth()->user()->role == 'client')
                                    Client (Accès à l'interface client uniquement)
                                @endif
                            </p>
                        </div>

                        @if(auth()->user()->role == 'client' && auth()->user()->client)
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex items-center font-medium text-gray-900 mb-1">
                                <i class="fas fa-building mr-2 text-gray-500"></i> Client associé
                            </div>
                            <p class="text-sm text-gray-600 ml-6">{{ auth()->user()->client->name }}</p>
                        </div>
                        @endif

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex items-center font-medium text-gray-900 mb-1">
                                <i class="fas fa-clock mr-2 text-gray-500"></i> Activité récente
                            </div>
                            <p class="text-sm text-gray-600 ml-6">
                                Dernière mise à jour: {{ auth()->user()->updated_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-8">
            <div class="bg-white shadow rounded-lg border border-gray-200">
                <!-- Tabs Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs" id="profile-tabs">
                        <button id="edit-profile-tab" class="tab-btn active py-4 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" data-target="edit-profile">
                            <i class="fas fa-user-edit mr-2"></i>Modifier mon profil
                        </button>
                        <button id="change-password-tab" class="tab-btn py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="change-password">
                            <i class="fas fa-key mr-2"></i>Changer mon mot de passe
                        </button>
                        <button id="preferences-tab" class="tab-btn py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="preferences">
                            <i class="fas fa-cog mr-2"></i>Préférences
                        </button>
                    </nav>
                </div>
                
                <!-- Tabs Content -->
                <div class="p-6">
                    <!-- Tab Contents -->
                    <div id="profile-tabContent">
                        <!-- Modifier mon profil -->
                        <div class="tab-content active" id="edit-profile">
                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                        @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Changer mon mot de passe -->
                        <div class="tab-content hidden" id="change-password">
                            <form action="{{ route('admin.profile.update-password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-6">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-unlock text-gray-400"></i>
                                        </div>
                                        <input type="password" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror" id="current_password" name="current_password" required>
                                        @error('current_password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror" id="password" name="password" required>
                                        @error('password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <i class="fas fa-info-circle mr-1"></i>Le mot de passe doit comporter au moins 8 caractères.
                                    </p>
                                </div>

                                <div class="mb-6">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmation du nouveau mot de passe</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <i class="fas fa-key mr-2"></i>Mettre à jour le mot de passe
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Préférences -->
                        <div class="tab-content hidden" id="preferences">
                            <form action="{{ route('admin.profile.update-preferences') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-4">Notifications par email</label>
                                    <div class="space-y-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out rounded" id="notify_new_ticket" name="preferences[notify_new_ticket]" {{ auth()->user()->preferences['notify_new_ticket'] ?? true ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-900">Nouveaux tickets</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out rounded" id="notify_ticket_update" name="preferences[notify_ticket_update]" {{ auth()->user()->preferences['notify_ticket_update'] ?? true ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-900">Mises à jour des tickets</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out rounded" id="notify_new_project" name="preferences[notify_new_project]" {{ auth()->user()->preferences['notify_new_project'] ?? true ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-900">Nouveaux projets</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Langue</label>
                                    <select class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="language" name="preferences[language]">
                                        <option value="fr" {{ (auth()->user()->preferences['language'] ?? 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                                        <option value="en" {{ (auth()->user()->preferences['language'] ?? 'fr') == 'en' ? 'selected' : '' }}>English</option>
                                    </select>
                                </div>
                                
                                <div class="mb-6">
                                    <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Fuseau horaire</label>
                                    <select class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="timezone" name="preferences[timezone]">
                                        <option value="Europe/Paris" {{ (auth()->user()->preferences['timezone'] ?? 'Europe/Paris') == 'Europe/Paris' ? 'selected' : '' }}>Europe/Paris</option>
                                        <option value="Europe/London" {{ (auth()->user()->preferences['timezone'] ?? 'Europe/Paris') == 'Europe/London' ? 'selected' : '' }}>Europe/London</option>
                                        <option value="America/New_York" {{ (auth()->user()->preferences['timezone'] ?? 'Europe/Paris') == 'America/New_York' ? 'selected' : '' }}>America/New_York</option>
                                        <option value="America/Los_Angeles" {{ (auth()->user()->preferences['timezone'] ?? 'Europe/Paris') == 'America/Los_Angeles' ? 'selected' : '' }}>America/Los_Angeles</option>
                                    </select>
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <i class="fas fa-save mr-2"></i>Enregistrer les préférences
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Activité récente -->
            <div class="bg-white shadow rounded-lg border border-gray-200 mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-history mr-2 text-gray-500"></i>Activité récente
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div>
                                                <div class="text-sm">
                                                    <span class="font-medium text-gray-900">Modification du profil</span>
                                                </div>
                                                <p class="mt-0.5 text-sm text-gray-500 flex items-center">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ now()->subDays(1)->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                            <div class="mt-2 text-sm text-gray-700">
                                                <p>Vous avez mis à jour vos informations de profil.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-lock text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div>
                                                <div class="text-sm">
                                                    <span class="font-medium text-gray-900">Changement de mot de passe</span>
                                                </div>
                                                <p class="mt-0.5 text-sm text-gray-500 flex items-center">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ now()->subDays(7)->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                            <div class="mt-2 text-sm text-gray-700">
                                                <p>Vous avez changé votre mot de passe.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="relative">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-sign-in-alt text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div>
                                                <div class="text-sm">
                                                    <span class="font-medium text-gray-900">Connexion au système</span>
                                                </div>
                                                <p class="mt-0.5 text-sm text-gray-500 flex items-center">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ now()->subDays(14)->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                            <div class="mt-2 text-sm text-gray-700">
                                                <p>Connexion réussie depuis l'adresse IP: 192.168.1.1</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('head')
<style>
    .tab-btn.active {
        border-color: #3b82f6;
        color: #2563eb;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
</style>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    function showTab(targetId) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.remove('active');
            content.classList.add('hidden');
        });
        
        // Remove active class from all buttons
        tabButtons.forEach(btn => {
            btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Show target tab content
        const targetContent = document.getElementById(targetId);
        if (targetContent) {
            targetContent.classList.add('active');
            targetContent.classList.remove('hidden');
        }
        
        // Activate clicked button
        const activeButton = document.querySelector(`[data-target="${targetId}"]`);
        if (activeButton) {
            activeButton.classList.add('active', 'border-blue-500', 'text-blue-600');
            activeButton.classList.remove('border-transparent', 'text-gray-500');
        }
    }
    
    // Add click event listeners to tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            showTab(targetId);
            
            // Update URL hash
            window.location.hash = targetId;
        });
    });
    
    // Handle URL hash on page load
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        showTab(hash);
    }
    
    // Handle hash changes
    window.addEventListener('hashchange', function() {
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            showTab(hash);
        }
    });
});
</script>
@endsection 