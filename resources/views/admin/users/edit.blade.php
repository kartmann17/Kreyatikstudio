@extends('admin.layout')

@section('title', 'Modifier un utilisateur')

@section('page_title', 'Modifier un utilisateur')

@section('content_body')
<!-- Header avec navigation -->
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-3">
        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg">
            <i class="fas fa-user-edit text-blue-600"></i>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Modifier un utilisateur</h2>
            <p class="text-sm text-gray-600">Modifier les informations de {{ $user->name }}</p>
        </div>
    </div>
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-user-edit mr-2 text-blue-600"></i>
                    Informations de l'utilisateur
                </h3>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
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
                               value="{{ old('name', $user->name) }}" 
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
                               value="{{ old('email', $user->email) }}" 
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
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                        </select>
                    </div>
                    @error('role')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client associé -->
                <div id="client-section" class="space-y-2 {{ $user->role != 'client' ? 'hidden' : '' }}">
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
                            <option value="{{ $client->id }}" {{ $user->client_id == $client->id ? 'selected' : '' }}>
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
                        Mot de passe <span class="text-sm text-gray-500">(laisser vide pour ne pas changer)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Nouveau mot de passe"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                    </div>
                    @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Confirmation du mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Confirmez le nouveau mot de passe"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Panneau d'informations -->
    <div class="space-y-6">
        <!-- Profil utilisateur -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-user-circle mr-2 text-blue-600"></i>
                    Profil utilisateur
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-2xl mb-4">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 text-center">{{ $user->name }}</h3>
                    <div class="mt-2">
                        @if($user->role == 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-user-shield mr-1"></i>
                                Administrateur
                            </span>
                        @elseif($user->role == 'staff')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <i class="fas fa-user-tie mr-1"></i>
                                Staff
                            </span>
                        @elseif($user->role == 'client')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-user mr-1"></i>
                                Client
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="mt-6 space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Date d'inscription</span>
                        <span class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-500">Dernière mise à jour</span>
                        <span class="text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm font-medium text-gray-500">Dernière connexion</span>
                        <span class="text-sm text-gray-900">
                            @if($user->last_login_at)
                                {{ $user->last_login_at }}
                            @else
                                <span class="text-amber-600">Jamais connecté</span>
                            @endif
                        </span>
                    </div>
                </div>
                
                @if(auth()->id() !== $user->id)
                <div class="mt-6">
                    <button type="button" 
                            onclick="openDeleteModal('{{ $user->id }}', '{{ $user->name }}')"
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>
                        Supprimer cet utilisateur
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Activité récente -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-history mr-2 text-green-600"></i>
                    Activité récente
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center py-8">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-clock text-gray-400"></i>
                    </div>
                    <p class="text-sm text-gray-500">Aucune activité récente</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
@if(auth()->id() !== $user->id)
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Supprimer l'utilisateur</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Êtes-vous sûr de vouloir supprimer l'utilisateur <span id="deleteUserName" class="font-semibold">{{ $user->name }}</span> ?
                    </p>
                    <p class="text-sm text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Cette action est irréversible.
                    </p>
                </div>
                <div class="flex items-center justify-center space-x-4 pt-4">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md hover:bg-gray-400 transition-colors duration-200">
                        Annuler
                    </button>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md hover:bg-red-700 transition-colors duration-200">
                            <i class="fas fa-trash mr-1"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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

// Fonction pour ouvrir le modal de suppression
function openDeleteModal(userId, userName) {
    document.getElementById('deleteModal').classList.remove('hidden');
}

// Fonction pour fermer le modal de suppression
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Fermer le modal en cliquant en dehors
document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Fermer le modal avec la touche Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endsection 