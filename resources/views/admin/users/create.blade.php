@extends('admin.layout')

@section('title', 'Créer un nouvel utilisateur')

@section('page_title', 'Créer un nouvel utilisateur')

@section('content_body')
<!-- Header avec navigation -->
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-3">
        <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg">
            <i class="fas fa-user-plus text-green-600"></i>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Créer un nouvel utilisateur</h2>
            <p class="text-sm text-gray-600">Ajoutez un nouveau membre à votre équipe</p>
        </div>
    </div>
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>

<!-- Messages d'erreur -->
@if($errors->any())
<div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-red-400"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">
                Il y a {{ $errors->count() }} erreur(s) dans le formulaire
            </h3>
            <div class="mt-2 text-sm text-red-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                    Informations de l'utilisateur
                </h3>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <!-- Nom complet -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nom complet <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="Entrez le nom complet"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                    </div>
                    @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Adresse email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="exemple@domaine.com"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                    </div>
                    @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rôle -->
                <div class="space-y-2">
                    <label for="role" class="block text-sm font-medium text-gray-700">
                        Rôle <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400"></i>
                        </div>
                        <select id="role" 
                                name="role" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('role') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="client" {{ (old('role') == 'client' || old('role') == null) ? 'selected' : '' }}>Client</option>
                        </select>
                    </div>
                    @error('role')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client associé -->
                <div id="client-section" class="space-y-2 {{ old('role') && old('role') != 'client' ? 'hidden' : '' }}">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">
                        Client associé
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-building text-gray-400"></i>
                        </div>
                        <select id="client_id" 
                                name="client_id" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('client_id') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <option value="">Sélectionnez un client (optionnel)</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('client_id')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Mot de passe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               placeholder="Mot de passe sécurisé"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                    </div>
                    @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Confirmation du mot de passe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required 
                               placeholder="Confirmez le mot de passe"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                </div>

                <!-- Option d'envoi d'email -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="send_credentials" 
                           name="send_credentials" 
                           {{ old('send_credentials') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="send_credentials" class="ml-2 block text-sm text-gray-900">
                        Envoyer les identifiants par email
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-user-plus mr-2"></i>
                        Créer l'utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Panneau d'informations -->
    <div class="space-y-6">
        <!-- Guide des rôles -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    Guide des rôles
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="border border-red-200 rounded-lg p-4 bg-red-50">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-shield text-red-600"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-red-800">Administrateur</h4>
                            <p class="text-sm text-red-700 mt-1">
                                Accès complet au système, peut gérer tous les aspects du site et tous les utilisateurs.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="border border-purple-200 rounded-lg p-4 bg-purple-50">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-tie text-purple-600"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-purple-800">Staff</h4>
                            <p class="text-sm text-purple-700 mt-1">
                                Peut gérer les projets, tickets et contenu. Accès restreint aux fonctions administratives.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="border border-green-200 rounded-lg p-4 bg-green-50">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-green-800">Client</h4>
                            <p class="text-sm text-green-700 mt-1">
                                Accès uniquement à l'interface client, peut consulter ses projets et créer des tickets.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conseils de sécurité -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-green-600"></i>
                    Sécurité
                </h3>
            </div>
            <div class="p-6">
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-amber-600"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-amber-800">Conseils pour le mot de passe</h4>
                            <div class="mt-2 text-sm text-amber-700">
                                <ul class="list-disc space-y-1 pl-5">
                                    <li>Minimum 8 caractères</li>
                                    <li>Combinaison de lettres et chiffres</li>
                                    <li>Inclure des caractères spéciaux</li>
                                    <li>Éviter les mots du dictionnaire</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-indigo-600"></i>
                    Statistiques
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</div>
                        <div class="text-xs text-gray-500">Total utilisateurs</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ \App\Models\User::where('role', 'client')->count() }}</div>
                        <div class="text-xs text-gray-500">Clients</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ \App\Models\User::where('role', 'staff')->count() }}</div>
                        <div class="text-xs text-gray-500">Staff</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                        <div class="text-xs text-gray-500">Admins</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Affichage conditionnel du champ client selon le rôle
    const roleSelect = document.getElementById('role');
    const clientSection = document.getElementById('client-section');
    
    roleSelect.addEventListener('change', function() {
        if (this.value === 'client') {
            clientSection.classList.remove('hidden');
        } else {
            clientSection.classList.add('hidden');
        }
    });
});
</script>
@endsection 