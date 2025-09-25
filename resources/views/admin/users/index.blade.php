@extends('admin.layout')

@section('title', 'Gestion des utilisateurs')

@section('content_body')
<!-- Header avec statistiques en temps réel -->
<div class="mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
        <div class="flex items-center space-x-4">
            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl shadow-lg">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1" style="color: #111827; font-size: 1.5rem; font-weight: 700;">Équipe & Utilisateurs</h1>
                <p class="text-gray-600">Gérez votre équipe et les accès utilisateurs</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-lg transform transition-all duration-200 hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i>
                Nouvel utilisateur
            </a>
        </div>
    </div>

    <!-- Statistiques rapides avec animations -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600" style="color: #4B5563; font-size: 0.875rem;">Total Utilisateurs</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900" id="totalUsers">{{ \App\Models\User::count() }}</p>
                        <span class="ml-2 text-xs text-green-600">
                            <i class="fas fa-arrow-up"></i> +2%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-shield text-red-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600" style="color: #4B5563; font-size: 0.875rem;">Administrateurs</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-tie text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600" style="color: #4B5563; font-size: 0.875rem;">Staff</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::where('role', 'staff')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600" style="color: #4B5563; font-size: 0.875rem;">Clients</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::where('role', 'client')->count() }}</p>
                        <span class="ml-2 text-xs text-green-600">
                            <i class="fas fa-arrow-up"></i> +5%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtres et recherche améliorés -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
    <div class="p-6">
        <div class="flex flex-col space-y-6">
            
            <!-- Barre de recherche principale (version corrigée) -->
            <div style="position: relative; display: block; margin-bottom: 20px;">
                <form action="{{ request()->url() }}" method="GET" style="display: flex; align-items: center; gap: 16px;">
                    @if(request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                    @endif
                    <div style="flex: 1; position: relative;">
                        <div style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                            🔍
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Rechercher par nom, email ou rôle..." 
                               style="width: 100%; padding: 12px 60px 12px 40px; background-color: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 12px; font-size: 14px; color: #111827; min-height: 48px; transition: all 0.2s; outline: none;"
                               onFocus="this.style.backgroundColor='#FFFFFF'; this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)';"
                               onBlur="this.style.backgroundColor='#F9FAFB'; this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <div style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; gap: 4px;">
                            <button type="submit" style="padding: 8px; color: #9CA3AF; background: none; border: none; border-radius: 6px; cursor: pointer; transition: all 0.2s;" 
                                    onMouseOver="this.style.color='#3B82F6'; this.style.backgroundColor='#EFF6FF';"
                                    onMouseOut="this.style.color='#9CA3AF'; this.style.backgroundColor='transparent';">
                                🔍
                            </button>
                            @if(request('search'))
                            <a href="{{ request()->url() }}" style="padding: 8px; color: #9CA3AF; text-decoration: none; border-radius: 6px; transition: all 0.2s; display: flex; align-items: center;"
                               onMouseOver="this.style.color='#EF4444'; this.style.backgroundColor='#FEF2F2';"
                               onMouseOut="this.style.color='#9CA3AF'; this.style.backgroundColor='transparent';">
                                ❌
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Filtres par rôle avec design moderne -->
            <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <span style="font-size: 14px; font-weight: 500; color: #374151;">Filtrer par rôle :</span>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        <a href="{{ request()->url() }}{{ request('search') ? '?search=' . request('search') : '' }}" 
                           style="display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ !request('role') ? 'background: linear-gradient(to right, #3B82F6, #2563EB); color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);' : 'background-color: #F3F4F6; color: #6B7280;' }}"
                           onMouseOver="this.style.transform='scale(1.05)'" 
                           onMouseOut="this.style.transform='scale(1)'">
                            👥 Tous
                            <span style="margin-left: 6px; padding: 2px 6px; background-color: rgba(255,255,255,0.2); border-radius: 10px; font-size: 10px;">
                                {{ \App\Models\User::count() }}
                            </span>
                        </a>
                        
                        <a href="{{ request()->url() }}?role=admin{{ request('search') ? '&search=' . request('search') : '' }}" 
                           style="display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request('role') == 'admin' ? 'background: linear-gradient(to right, #EF4444, #DC2626); color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);' : 'background-color: #F3F4F6; color: #6B7280;' }}"
                           onMouseOver="this.style.transform='scale(1.05)'" 
                           onMouseOut="this.style.transform='scale(1)'">
                            🛡️ Admins
                            <span style="margin-left: 6px; padding: 2px 6px; background-color: rgba(255,255,255,0.2); border-radius: 10px; font-size: 10px;">
                                {{ \App\Models\User::where('role', 'admin')->count() }}
                            </span>
                        </a>
                        
                        <a href="{{ request()->url() }}?role=staff{{ request('search') ? '&search=' . request('search') : '' }}" 
                           style="display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request('role') == 'staff' ? 'background: linear-gradient(to right, #8B5CF6, #7C3AED); color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);' : 'background-color: #F3F4F6; color: #6B7280;' }}"
                           onMouseOver="this.style.transform='scale(1.05)'" 
                           onMouseOut="this.style.transform='scale(1)'">
                            👔 Staff
                            <span style="margin-left: 6px; padding: 2px 6px; background-color: rgba(255,255,255,0.2); border-radius: 10px; font-size: 10px;">
                                {{ \App\Models\User::where('role', 'staff')->count() }}
                            </span>
                        </a>
                        
                        <a href="{{ request()->url() }}?role=client{{ request('search') ? '&search=' . request('search') : '' }}" 
                           style="display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request('role') == 'client' ? 'background: linear-gradient(to right, #10B981, #059669); color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);' : 'background-color: #F3F4F6; color: #6B7280;' }}"
                           onMouseOver="this.style.transform='scale(1.05)'" 
                           onMouseOut="this.style.transform='scale(1)'">
                            👤 Clients
                            <span style="margin-left: 6px; padding: 2px 6px; background-color: rgba(255,255,255,0.2); border-radius: 10px; font-size: 10px;">
                                {{ \App\Models\User::where('role', 'client')->count() }}
                            </span>
                        </a>
                    </div>
                </div>
                
                <!-- Options d'affichage -->
                <div class="flex items-center space-x-3">
                    @if(request()->hasAny(['search', 'role']))
                    <a href="{{ request()->url() }}" class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-medium rounded-lg transition-all duration-200">
                        <i class="fas fa-times mr-1"></i>
                        Effacer filtres
                    </a>
                    @endif
                    <div class="flex items-center space-x-1 bg-gray-100 rounded-lg p-1">
                        <button onclick="setView('table')" id="tableViewBtn" class="p-2 rounded-md text-gray-600 hover:bg-white hover:shadow-sm transition-all duration-200" title="Vue tableau">
                            <i class="fas fa-list"></i>
                        </button>
                        <button onclick="setView('cards')" id="cardsViewBtn" class="p-2 rounded-md text-gray-600 hover:bg-white hover:shadow-sm transition-all duration-200" title="Vue cartes">
                            <i class="fas fa-th"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section titre des résultats -->
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center space-x-3">
        <h2 class="text-lg font-semibold text-gray-900" style="color: #111827; font-size: 1.125rem; font-weight: 600;">
            @if(request('role'))
                @switch(request('role'))
                    @case('admin')
                        Administrateurs
                        @break
                    @case('staff') 
                        Équipe Staff
                        @break
                    @case('client')
                        Clients
                        @break
                @endswitch
            @else
                Tous les utilisateurs
            @endif
        </h2>
        @if(request('search'))
        <span class="text-sm text-gray-500">
            pour "{{ request('search') }}"
        </span>
        @endif
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
            {{ $users->total() }} {{ $users->total() > 1 ? 'résultats' : 'résultat' }}
        </span>
    </div>
</div>

<!-- Vue en cartes (par défaut) -->
<div id="cardsView">
    @forelse($users as $user)
    @if($loop->first)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-6">
    @endif
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 hover:scale-105">
            <div class="p-6">
                <!-- En-tête de la carte avec avatar et statut -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            @if($user->role == 'admin')
                            <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            @elseif($user->role == 'staff')
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            @else
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            @endif
                            @if($user->last_login_at && $user->last_login_at->diffInHours() < 24)
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-semibold text-gray-900 truncate" style="color: #111827; font-size: 0.875rem; font-weight: 600;">{{ $user->name }}</h3>
                            <p class="text-xs text-gray-500">#{{ $user->id }}</p>
                        </div>
                    </div>
                    
                    <!-- Rôle badge -->
                    @if($user->role == 'admin')
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-user-shield mr-1"></i>
                            Admin
                        </span>
                    @elseif($user->role == 'staff')
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-user-tie mr-1"></i>
                            Staff
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-user mr-1"></i>
                            Client
                        </span>
                    @endif
                </div>
                
                <!-- Informations utilisateur -->
                <div class="space-y-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-envelope mr-2 text-gray-400 w-4"></i>
                        <a href="mailto:{{ $user->email }}" class="truncate hover:text-blue-600 transition-colors duration-200">
                            {{ $user->email }}
                        </a>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-calendar-alt mr-2 text-gray-400 w-4"></i>
                        <span>{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    @if($user->client)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-building mr-2 text-gray-400 w-4"></i>
                        <span class="truncate">{{ $user->client->name }}</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center text-xs text-gray-500">
                        <i class="fas fa-clock mr-2 text-gray-400 w-4"></i>
                        @if($user->last_login_at)
                            <span>Connexion: {{ $user->last_login_at->diffForHumans() }}</span>
                        @else
                            <span class="text-amber-600">Jamais connecté</span>
                        @endif
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                           class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-all duration-200"
                           title="Modifier">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                        @if(auth()->id() !== $user->id)
                        <button type="button" 
                                onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')" 
                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-all duration-200"
                                title="Supprimer">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                        @endif
                    </div>
                    
                    @if($user->role === 'client' && !$user->client)
                    <button type="button" 
                            onclick="openAssignModal({{ $user->id }})" 
                            class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-medium hover:bg-green-200 transition-colors duration-200">
                        <i class="fas fa-plus mr-1"></i>
                        Associer client
                    </button>
                    @endif
                </div>
            </div>
        </div>
    @if($loop->last)
    </div>
    @endif
    @empty
    <div class="flex flex-col items-center justify-center py-12">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-users text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun utilisateur trouvé</h3>
        <p class="text-gray-500 text-center mb-6">
            @if(request('search') || request('role'))
                Aucun résultat ne correspond à vos critères de recherche
            @else
                Commencez par créer votre premier utilisateur
            @endif
        </p>
        @if(!request('search') && !request('role'))
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-lg transform transition-all duration-200 hover:scale-105">
            <i class="fas fa-user-plus mr-2"></i>
            Créer un utilisateur
        </a>
        @endif
    </div>
    @endforelse
</div>

<!-- Vue tableau (cachée par défaut) -->
<div id="tableView" class="hidden">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Inscription</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($user->role == 'admin')
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-red-400 to-red-600 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        @elseif($user->role == 'staff')
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        @else
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">#{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="mailto:{{ $user->email }}" class="text-sm text-blue-600 hover:text-blue-800">{{ $user->email }}</a>
                                <div class="text-xs text-gray-500">
                                    @if($user->last_login_at)
                                        Connexion: {{ $user->last_login_at->diffForHumans() }}
                                    @else
                                        Jamais connecté
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($user->role == 'admin')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-user-shield mr-1"></i> Admin
                                    </span>
                                @elseif($user->role == 'staff')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-user-tie mr-1"></i> Staff
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-user mr-1"></i> Client
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                @if($user->client)
                                    <span class="text-gray-900">{{ $user->client->name }}</span>
                                @elseif($user->role === 'client')
                                    <button onclick="openAssignModal({{ $user->id }})" class="text-blue-600 hover:text-blue-800">Associer</button>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->id() !== $user->id)
                                    <button onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-users text-2xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-900">Aucun utilisateur trouvé</h3>
                                    <p class="text-sm text-gray-500">
                                        @if(request('search') || request('role'))
                                            Aucun résultat ne correspond à vos critères
                                        @else
                                            Commencez par créer votre premier utilisateur
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Pagination moderne -->
@if($users->hasPages())
<div class="mt-6 flex items-center justify-between">
    <div class="flex-1 flex justify-between sm:hidden">
        @if($users->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                Précédent
            </span>
        @else
            <a href="{{ $users->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Précédent
            </a>
        @endif
        
        @if($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Suivant
            </a>
        @else
            <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                Suivant
            </span>
        @endif
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700">
                Affichage de <span class="font-medium">{{ $users->firstItem() }}</span>
                à <span class="font-medium">{{ $users->lastItem() }}</span>
                sur <span class="font-medium">{{ $users->total() }}</span> résultats
            </p>
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endif

<!-- Modals de gestion -->
<!-- Modal de suppression -->
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
                        Êtes-vous sûr de vouloir supprimer l'utilisateur <span id="deleteUserName" class="font-semibold"></span> ?
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
                    <form id="deleteForm" method="POST" class="inline">
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

<!-- Modal d'assignation de client -->
<div id="assignModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                <i class="fas fa-building text-blue-600"></i>
            </div>
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Associer à un client</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 mb-4">
                        Sélectionnez un client à associer à cet utilisateur.
                    </p>
                    <form id="assignForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="text-left">
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                            <select name="client_id" id="client_id" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach(\App\Models\Client::orderBy('name')->get() as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-center space-x-4 pt-6">
                            <button type="button" onclick="closeAssignModal()" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md hover:bg-gray-400 transition-colors duration-200">
                                Annuler
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-save mr-1"></i>
                                Confirmer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Styles de base pour la cohérence visuelle */
h1, h2, h3, h4, h5, h6 {
    color: #111827;
    font-weight: 600;
    line-height: 1.2;
}

/* Styles pour les inputs */
input[type="text"], input[type="email"], input[type="search"], textarea, select {
    background-color: #F9FAFB;
    border: 1px solid #D1D5DB;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 14px;
    color: #111827;
    transition: all 0.2s;
}

input:focus, textarea:focus, select:focus {
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background-color: #FFFFFF;
    outline: none;
}

/* Animation pour les cartes */
.card-animate {
    transition: all 0.2s ease;
}

.card-animate:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Styles pour les badges de rôle */
.role-badge {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
</style>
@endpush

@section('custom_js')
<script>
// Variables pour la gestion des vues
let currentView = localStorage.getItem('usersView') || 'cards';

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    setView(currentView);
    updateStatistics();
    
    // Animation d'entrée pour les cartes
    animateCards();
});

// Fonction pour changer de vue
function setView(view) {
    currentView = view;
    localStorage.setItem('usersView', view);
    
    const cardsView = document.getElementById('cardsView');
    const tableView = document.getElementById('tableView');
    const tableBtn = document.getElementById('tableViewBtn');
    const cardsBtn = document.getElementById('cardsViewBtn');
    
    if (view === 'table') {
        cardsView.classList.add('hidden');
        tableView.classList.remove('hidden');
        tableBtn.classList.add('bg-blue-100', 'text-blue-600');
        tableBtn.classList.remove('text-gray-600');
        cardsBtn.classList.remove('bg-blue-100', 'text-blue-600');
        cardsBtn.classList.add('text-gray-600');
    } else {
        cardsView.classList.remove('hidden');
        tableView.classList.add('hidden');
        cardsBtn.classList.add('bg-blue-100', 'text-blue-600');
        cardsBtn.classList.remove('text-gray-600');
        tableBtn.classList.remove('bg-blue-100', 'text-blue-600');
        tableBtn.classList.add('text-gray-600');
    }
}

// Animation d'entrée pour les cartes
function animateCards() {
    const cards = document.querySelectorAll('#cardsView .bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.4s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

// Mise à jour des statistiques avec animations
function updateStatistics() {
    const counters = document.querySelectorAll('[id*="Users"], .text-2xl');
    counters.forEach(counter => {
        const target = parseInt(counter.textContent);
        let current = 0;
        const increment = target / 30;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            counter.textContent = Math.floor(current);
        }, 50);
    });
}

// Fonction pour ouvrir le modal de suppression avec animation
function openDeleteModal(userId, userName) {
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('deleteForm').action = `/admin/users/${userId}`;
    
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    
    // Animation d'entrée
    setTimeout(() => {
        modal.querySelector('.relative').style.transform = 'scale(1)';
        modal.querySelector('.relative').style.opacity = '1';
    }, 10);
}

// Fonction pour fermer le modal de suppression avec animation
function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const content = modal.querySelector('.relative');
    
    content.style.transform = 'scale(0.95)';
    content.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        content.style.transform = 'scale(1)';
        content.style.opacity = '1';
    }, 200);
}

// Fonction pour ouvrir le modal d'assignation avec animation
function openAssignModal(userId) {
    document.getElementById('assignForm').action = `/admin/users/${userId}/change-to-client`;
    
    const modal = document.getElementById('assignModal');
    modal.classList.remove('hidden');
    
    // Animation d'entrée
    setTimeout(() => {
        modal.querySelector('.relative').style.transform = 'scale(1)';
        modal.querySelector('.relative').style.opacity = '1';
    }, 10);
}

// Fonction pour fermer le modal d'assignation avec animation
function closeAssignModal() {
    const modal = document.getElementById('assignModal');
    const content = modal.querySelector('.relative');
    
    content.style.transform = 'scale(0.95)';
    content.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('client_id').value = '';
        content.style.transform = 'scale(1)';
        content.style.opacity = '1';
    }, 200);
}

// Gestion des événements modals
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

document.getElementById('assignModal').addEventListener('click', function(e) {
    if (e.target === this) closeAssignModal();
});

// Fermer les modals avec la touche Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
        closeAssignModal();
    }
});

// Recherche en temps réel (optionnel)
let searchTimeout;
const searchInput = document.querySelector('input[name="search"]');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        
        // Effet visuel pendant la recherche
        this.style.borderColor = '#3B82F6';
        this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
        
        searchTimeout = setTimeout(() => {
            // Ici vous pourriez implémenter une recherche AJAX
            this.style.borderColor = '';
            this.style.boxShadow = '';
        }, 500);
    });
}

// Animation au survol des cartes
document.querySelectorAll('#cardsView .bg-white').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-4px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// Fonction pour actualiser la page avec des paramètres
function refreshWithParams(params) {
    const url = new URL(window.location);
    Object.keys(params).forEach(key => {
        if (params[key]) {
            url.searchParams.set(key, params[key]);
        } else {
            url.searchParams.delete(key);
        }
    });
    window.location.href = url.toString();
}

// Style pour les modals
const modalStyles = `
    .relative {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.2s ease;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = modalStyles;
document.head.appendChild(styleSheet);
</script>
@endsection 