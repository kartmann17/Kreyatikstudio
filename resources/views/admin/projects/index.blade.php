@extends('admin.layout')

@section('title', 'Gestion des projets')

@section('page_title', 'Gestion des projets')

@section('content_body')
    <!-- Messages de notification -->
    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm flex items-center" role="alert">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm flex items-center" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="ml-auto text-red-600 hover:text-red-800" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Statistiques des projets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">Total Projets</h3>
                    <p class="text-3xl font-bold">{{ $projects->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-project-diagram text-3xl opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">En Cours</h3>
                    <p class="text-3xl font-bold">{{ $projects->where('status', 'en-cours')->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-3xl opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">Terminés</h3>
                    <p class="text-3xl font-bold">{{ $projects->where('status', 'terminé')->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-3xl opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">Valeur Total</h3>
                    <p class="text-3xl font-bold">{{ number_format($projects->sum('price'), 0) }}€</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-euro-sign text-3xl opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et actions -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                <div class="mb-4 lg:mb-0">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-filter mr-2 text-blue-600"></i>Filtres et recherche
                    </h3>
                </div>
                <div>
                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200 flex items-center" id="openAddModal">
                        <i class="fas fa-plus mr-2"></i> Nouveau projet
                    </button>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                        <div class="relative">
                            <input type="text" id="searchProjects" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Titre, client...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                        <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="en-cours">En cours</option>
                            <option value="terminé">Terminés</option>
                            <option value="en-attente">En attente</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                        <select id="filterClient" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les clients</option>
                            @foreach ($clients ?? [] as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des projets -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-blue-600"></i>Liste des projets
                </h3>
                <div class="flex rounded-lg border border-gray-300" role="group">
                    <button type="button" class="px-3 py-2 text-sm bg-white hover:bg-gray-50 border-r border-gray-300 rounded-l-lg transition-colors" id="viewGrid">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="px-3 py-2 text-sm bg-blue-50 text-blue-600 border-l border-gray-300 rounded-r-lg transition-colors" id="viewTable">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="p-0">
            <!-- Vue tableau -->
            <div id="tableView" class="overflow-x-auto">
                <table class="w-full" id="projectsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left border-0">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-0">Projet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-0">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-0">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-0">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-0">Progression</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($projects ?? [] as $project)
                        <tr class="hover:bg-gray-50 transition-colors" data-status="{{ $project->status }}" data-client="{{ $project->client_id ?? '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="project-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $project->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-folder text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                        <div class="text-sm text-gray-500">ID: #{{ $project->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $project->client->name ?? 'Non assigné' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-green-600">{{ number_format($project->price, 2) }} €</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($project->status == 'en-cours')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>En cours
                                    </span>
                                @elseif($project->status == 'terminé')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Terminé
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-pause mr-1"></i>En attente
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-1 mr-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="h-2 rounded-full 
                                                @if($project->manual_progress < 30) bg-red-500
                                                @elseif($project->manual_progress < 70) bg-yellow-500  
                                                @else bg-green-500
                                                @endif" 
                                                style="width: {{ $project->manual_progress }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500 ml-2">{{ $project->manual_progress }}%</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-1">
                                    <button type="button" class="view-project-btn text-blue-600 hover:text-blue-900 p-1" 
                                            data-project-id="{{ $project->id }}" 
                                            title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="edit-project-btn text-yellow-600 hover:text-yellow-900 p-1" 
                                            data-project-id="{{ $project->id }}"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="delete-project-btn text-red-600 hover:text-red-900 p-1" 
                                            data-project-id="{{ $project->id }}"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun projet trouvé</h3>
                                    <p class="text-gray-500 mb-4">Commencez par créer votre premier projet</p>
                                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors" id="createFirstProject">
                                        <i class="fas fa-plus mr-2"></i> Créer un projet
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Vue grille -->
            <div id="gridView" class="hidden p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($projects ?? [] as $project)
                    <div class="project-card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow" 
                         data-status="{{ $project->status }}" data-client="{{ $project->client_id ?? '' }}">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 rounded-t-lg">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium">{{ $project->title }}</h4>
                                <div class="relative">
                                    <button class="text-white hover:text-gray-200 p-1 dropdown-toggle" type="button" data-project-id="{{ $project->id }}">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 view-project-btn" href="#" data-project-id="{{ $project->id }}">
                                            <i class="fas fa-eye mr-2"></i>Voir
                                        </a>
                                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 edit-project-btn" href="#" data-project-id="{{ $project->id }}">
                                            <i class="fas fa-edit mr-2"></i>Modifier
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 delete-project-btn" href="#" data-project-id="{{ $project->id }}">
                                            <i class="fas fa-trash mr-2"></i>Supprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="mb-3">
                                <div class="text-sm text-gray-500">Client</div>
                                <div class="font-medium">{{ $project->client->name ?? 'Non assigné' }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-sm text-gray-500">Montant</div>
                                <div class="font-bold text-green-600">{{ number_format($project->price, 2) }} €</div>
                            </div>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-500">Progression</span>
                                    <span class="font-medium">{{ $project->manual_progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="h-2 rounded-full 
                                        @if($project->manual_progress < 30) bg-red-500
                                        @elseif($project->manual_progress < 70) bg-yellow-500  
                                        @else bg-green-500
                                        @endif" 
                                        style="width: {{ $project->manual_progress }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 rounded-b-lg">
                            <div class="flex justify-between items-center">
                                @if($project->status == 'en-cours')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">En cours</span>
                                @elseif($project->status == 'terminé')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Terminé</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">En attente</span>
                                @endif
                                <div class="text-sm text-gray-500">#{{ $project->id }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Actions groupées -->
    <div id="bulkActions" class="hidden bg-white border border-gray-200 rounded-lg shadow-sm mt-4">
        <div class="p-4">
            <div class="flex justify-between items-center">
                <span class="text-gray-700"><span id="selectedCount">0</span> projet(s) sélectionné(s)</span>
                <div class="flex space-x-2">
                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm transition-colors" id="bulkDelete">
                        <i class="fas fa-trash mr-1"></i>Supprimer
                    </button>
                    <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded text-sm transition-colors" id="bulkExport">
                        <i class="fas fa-download mr-1"></i>Exporter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout/édition de projet -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="modal-add-project">
        <div class="relative top-20 mx-auto p-5 border w-11/12 lg:w-3/4 xl:w-1/2 shadow-lg rounded-md bg-white">
            <div class="bg-blue-600 text-white p-4 rounded-t-md -m-5 mb-5">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold flex items-center" id="modalTitle">
                        <i class="fas fa-plus mr-2"></i>Ajouter un nouveau projet
                    </h3>
                    <button type="button" class="text-white hover:text-gray-200" id="closeModal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <form id="projectForm" action="{{ route('admin.projects.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="projectMethod" value="POST">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="lg:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre du projet <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   id="title" name="title" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    id="status" name="status" required>
                                <option value="en-cours">En cours</option>
                                <option value="terminé">Terminé</option>
                                <option value="en-attente">En attente</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    id="client_id" name="client_id">
                                <option value="">Sélectionner un client</option>
                                @foreach ($clients ?? [] as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Montant (€)</label>
                            <div class="relative">
                                <input type="number" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       id="price" name="price" step="0.01" min="0">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="progress" class="block text-sm font-medium text-gray-700 mb-2">Progression (%)</label>
                        <div class="flex items-center space-x-4">
                            <input type="range" class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" 
                                   id="progress" name="progress" min="0" max="100" value="0">
                            <span id="progressValue" class="bg-blue-600 text-white px-2 py-1 rounded text-sm font-medium min-w-12 text-center">0%</span>
                        </div>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  id="description" name="description" rows="4" placeholder="Décrivez le projet..."></textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="cancelBtn">
                        <i class="fas fa-times mr-1"></i>Annuler
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors" id="submitBtn">
                        <i class="fas fa-save mr-1"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modal de visualisation du projet -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="viewProjectModal">
        <div class="relative top-10 mx-auto p-5 border w-11/12 xl:w-4/5 shadow-lg rounded-md bg-white">
            <div class="bg-blue-500 text-white p-4 rounded-t-md -m-5 mb-5">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-eye mr-2"></i>Détails du projet
                    </h3>
                    <button type="button" class="text-white hover:text-gray-200" id="closeViewModal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 rounded-t-lg">
                            <h4 class="font-medium flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informations générales
                            </h4>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Titre:</label>
                                <p id="view-title" class="text-gray-900"></p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Client:</label>
                                    <p id="view-client" class="text-gray-900"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Montant:</label>
                                    <p id="view-price" class="text-green-600 font-bold"></p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut:</label>
                                    <p id="view-status"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Progression:</label>
                                    <div class="space-y-2">
                                        <div class="w-full bg-gray-200 rounded-full h-3">
                                            <div id="view-progress-bar" class="h-3 rounded-full bg-blue-600" style="width: 0%"></div>
                                        </div>
                                        <span id="view-progress-text" class="text-sm text-gray-600"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                                <p id="view-description" class="text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 rounded-t-lg">
                            <h4 class="font-medium flex items-center">
                                <i class="fas fa-tasks mr-2 text-blue-600"></i>Tâches associées
                            </h4>
                        </div>
                        <div class="p-4">
                            <ul id="view-tasks" class="space-y-2"></ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="closeViewModalBtn">
                    <i class="fas fa-times mr-1"></i>Fermer
                </button>
                <button type="button" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors" id="editFromView">
                    <i class="fas fa-edit mr-1"></i>Modifier
                </button>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Vérifier que SweetAlert est chargé
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert n\'est pas chargé !');
    } else {
        console.log('SweetAlert chargé avec succès');
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Variables globales
        let currentProjectId = null;
        
        // Éléments du DOM (avec vérifications)
        const modal = document.getElementById('modal-add-project');
        const viewModal = document.getElementById('viewProjectModal');
        const progressSlider = document.getElementById('progress');
        const progressValue = document.getElementById('progressValue');
        
        // Gestion du slider de progression (avec vérifications)
        if (progressSlider && progressValue) {
            progressSlider.addEventListener('input', function() {
                progressValue.textContent = this.value + '%';
            });
        }
        
        // Filtres de recherche (avec vérifications)
        const searchInput = document.getElementById('searchProjects');
        const statusFilter = document.getElementById('filterStatus');
        const clientFilter = document.getElementById('filterClient');
        
        if (searchInput) searchInput.addEventListener('keyup', filterProjects);
        if (statusFilter) statusFilter.addEventListener('change', filterProjects);
        if (clientFilter) clientFilter.addEventListener('change', filterProjects);
        
        function filterProjects() {
            const search = searchInput ? searchInput.value.toLowerCase() : '';
            const status = statusFilter ? statusFilter.value : '';
            const client = clientFilter ? clientFilter.value : '';
            
            // Filtrer la vue tableau
            const tableRows = document.querySelectorAll('#projectsTable tbody tr');
            tableRows.forEach(row => {
                if (row.querySelector('.empty-state')) return;
                
                const text = row.textContent.toLowerCase();
                const rowStatus = row.dataset.status;
                const rowClient = row.dataset.client;
                
                let show = true;
                if (search && !text.includes(search)) show = false;
                if (status && rowStatus !== status) show = false;
                if (client && rowClient !== client) show = false;
                
                row.style.display = show ? '' : 'none';
            });
            
            // Filtrer la vue grille
            const gridCards = document.querySelectorAll('.project-card');
            gridCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const cardStatus = card.dataset.status;
                const cardClient = card.dataset.client;
                
                let show = true;
                if (search && !text.includes(search)) show = false;
                if (status && cardStatus !== status) show = false;
                if (client && cardClient !== client) show = false;
                
                card.style.display = show ? '' : 'none';
            });
        }
        
        // Basculer entre vue tableau et grille (avec vérifications)
        const viewTableBtn = document.getElementById('viewTable');
        const viewGridBtn = document.getElementById('viewGrid');
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        
        if (viewTableBtn && viewGridBtn && tableView && gridView) {
            viewTableBtn.addEventListener('click', function() {
                this.classList.add('bg-blue-50', 'text-blue-600');
                this.classList.remove('bg-white');
                viewGridBtn.classList.remove('bg-blue-50', 'text-blue-600');
                viewGridBtn.classList.add('bg-white');
                tableView.classList.remove('hidden');
                gridView.classList.add('hidden');
            });
            
            viewGridBtn.addEventListener('click', function() {
                this.classList.add('bg-blue-50', 'text-blue-600');
                this.classList.remove('bg-white');
                viewTableBtn.classList.remove('bg-blue-50', 'text-blue-600');
                viewTableBtn.classList.add('bg-white');
                gridView.classList.remove('hidden');
                tableView.classList.add('hidden');
            });
        }
        
        // Sélection multiple (avec vérifications)
        const selectAllBtn = document.getElementById('selectAll');
        if (selectAllBtn) {
            selectAllBtn.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.project-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                updateBulkActions();
            });
        }
        
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('project-checkbox')) {
                updateBulkActions();
            }
        });
        
        function updateBulkActions() {
            const selected = document.querySelectorAll('.project-checkbox:checked').length;
            const selectedCountEl = document.getElementById('selectedCount');
            const bulkActionsEl = document.getElementById('bulkActions');
            
            if (selectedCountEl) {
                selectedCountEl.textContent = selected;
            }
            
            if (bulkActionsEl) {
                if (selected > 0) {
                    bulkActionsEl.classList.remove('hidden');
                } else {
                    bulkActionsEl.classList.add('hidden');
                }
            }
        }
        
        // Gestion des modals (avec vérifications)
        function openModal() {
            if (modal) {
                modal.classList.remove('hidden');
                resetForm();
            }
        }
        
        function closeModal() {
            if (modal) {
                modal.classList.add('hidden');
            }
        }
        
        function openViewModal() {
            if (viewModal) {
                viewModal.classList.remove('hidden');
            }
        }
        
        function closeViewModal() {
            if (viewModal) {
                viewModal.classList.add('hidden');
            }
        }
        
        function resetForm() {
            // Ne pas réinitialiser le formulaire si on est en mode édition
            if (currentProjectId) {
                return;
            }
            
            const modalTitle = document.getElementById('modalTitle');
            const projectMethod = document.getElementById('projectMethod');
            const projectForm = document.getElementById('projectForm');
            
            if (modalTitle) {
                modalTitle.innerHTML = '<i class="fas fa-plus mr-2"></i>Ajouter un nouveau projet';
            }
            if (projectMethod) {
                projectMethod.value = 'POST';
            }
            if (projectForm) {
                projectForm.action = '{{ route("admin.projects.store") }}';
                projectForm.reset();
            }
            if (progressValue) {
                progressValue.textContent = '0%';
            }
            currentProjectId = null;
        }
        
        // Event listeners pour les modals (avec vérifications)
        const openAddModalBtn = document.getElementById('openAddModal');
        const createFirstProjectBtn = document.getElementById('createFirstProject');
        const closeModalBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const closeViewModalBtn = document.getElementById('closeViewModal');
        const closeViewModalBtn2 = document.getElementById('closeViewModalBtn');
        
        if (openAddModalBtn) {
            openAddModalBtn.addEventListener('click', openModal);
        } else {
            console.error('Bouton openAddModal non trouvé');
        }
        
        // Alternative avec délégation d'événements
        document.addEventListener('click', function(e) {
            if (e.target.id === 'openAddModal' || e.target.closest('#openAddModal')) {
                e.preventDefault();
                openModal();
            }
        });
        if (createFirstProjectBtn) createFirstProjectBtn.addEventListener('click', openModal);
        if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        if (closeViewModalBtn) closeViewModalBtn.addEventListener('click', closeViewModal);
        if (closeViewModalBtn2) closeViewModalBtn2.addEventListener('click', closeViewModal);
        
        // Fermer modal en cliquant en dehors
        window.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
            if (e.target === viewModal) closeViewModal();
        });
        
        // Gestion des dropdowns
        document.addEventListener('click', function(e) {
            // Fermer tous les dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
            
            // Ouvrir le dropdown cliqué
            if (e.target.closest('.dropdown-toggle')) {
                e.preventDefault();
                const dropdown = e.target.closest('.project-card').querySelector('.dropdown-menu');
                dropdown.classList.toggle('hidden');
            }
        });
        
        // Actions CRUD
        document.addEventListener('click', function(e) {
            if (e.target.closest('.view-project-btn')) {
                e.preventDefault();
                const projectId = e.target.closest('.view-project-btn').dataset.projectId;
                if (projectId) {
                    viewProject(projectId);
                }
            }
            
            if (e.target.closest('.edit-project-btn')) {
                e.preventDefault();
                const projectId = e.target.closest('.edit-project-btn').dataset.projectId;
                if (projectId) {
                    editProject(projectId);
                }
            }
            
            if (e.target.closest('.delete-project-btn')) {
                e.preventDefault();
                const projectId = e.target.closest('.delete-project-btn').dataset.projectId;
                console.log('Delete button clicked for project ID:', projectId);
                if (projectId) {
                    deleteProject(projectId);
                } else {
                    console.error('Project ID is missing!');
                }
            }
        });
        
        function viewProject(projectId) {
            fetch(`/admin/projects/${projectId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const project = data.project;
                    
                    document.getElementById('view-title').textContent = project.title;
                    document.getElementById('view-client').textContent = project.client ? project.client.name : 'Non assigné';
                    document.getElementById('view-price').textContent = parseFloat(project.price).toFixed(2) + ' €';
                    
                    // Statut avec badge
                    let statusHTML = '';
                    if (project.status === 'en-cours') {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>En cours</span>';
                    } else if (project.status === 'terminé') {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check mr-1"></i>Terminé</span>';
                    } else {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><i class="fas fa-pause mr-1"></i>En attente</span>';
                    }
                    document.getElementById('view-status').innerHTML = statusHTML;
                    
                    // Progression
                    const progress = project.progress || 0;
                    let progressClass = 'bg-red-500';
                    if (progress >= 70) progressClass = 'bg-green-500';
                    else if (progress >= 30) progressClass = 'bg-yellow-500';
                    
                    const progressBar = document.getElementById('view-progress-bar');
                    progressBar.style.width = progress + '%';
                    progressBar.className = `h-3 rounded-full ${progressClass}`;
                    document.getElementById('view-progress-text').textContent = progress + '%';
                    
                    // Description
                    document.getElementById('view-description').textContent = project.description || 'Aucune description disponible';
                    
                    // Tâches
                    const tasksList = document.getElementById('view-tasks');
                    tasksList.innerHTML = '';
                    
                    if (project.tasks && project.tasks.length > 0) {
                        project.tasks.forEach(task => {
                            tasksList.innerHTML += `
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    ${task.title}
                                </li>
                            `;
                        });
                    } else {
                        tasksList.innerHTML = '<li class="text-gray-500 flex items-center"><i class="fas fa-info-circle mr-2"></i>Aucune tâche associée</li>';
                    }
                    
                    currentProjectId = projectId;
                    openViewModal();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Impossible de récupérer les détails du projet',
                    icon: 'error'
                });
            });
        }
        
        function editProject(projectId) {
            fetch(`/admin/projects/${projectId}/edit`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const project = data.project;
                    
                    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit mr-2"></i>Modifier le projet';
                    document.getElementById('projectMethod').value = 'PUT';
                    document.getElementById('title').value = project.title || '';
                    document.getElementById('client_id').value = project.client_id || '';
                    document.getElementById('price').value = project.price || '';
                    document.getElementById('status').value = project.status || '';
                    document.getElementById('progress').value = project.progress || 0;
                    document.getElementById('progressValue').textContent = (project.progress || 0) + '%';
                    document.getElementById('description').value = project.description || '';
                    document.getElementById('projectForm').action = `/admin/projects/${projectId}`;
                    
                    // Définir currentProjectId AVANT d'ouvrir le modal
                    currentProjectId = projectId;
                    
                    openModal();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Impossible de récupérer les données du projet',
                    icon: 'error'
                });
            });
        }
        
        function deleteProject(projectId) {
            console.log('deleteProject function called with ID:', projectId);
            
            // Vérifier que SweetAlert est chargé
            if (typeof Swal === 'undefined') {
                alert('Erreur: SweetAlert n\'est pas chargé');
                return;
            }
            
            // Vérifier que le token CSRF existe
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                alert('Erreur: Token CSRF introuvable');
                return;
            }
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: 'Cette action est irréversible !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                console.log('SweetAlert result:', result);
                if (result.isConfirmed) {
                    console.log('User confirmed deletion, sending DELETE request...');
                    
                    // Utiliser fetch au lieu de créer un formulaire
                    fetch(`/admin/projects/${projectId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            Swal.fire({
                                title: 'Supprimé !',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // Recharger la page pour mettre à jour la liste
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Erreur',
                                text: data.message || 'Une erreur est survenue lors de la suppression',
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la suppression',
                            icon: 'error'
                        });
                    });
                }
            }).catch((error) => {
                console.error('SweetAlert error:', error);
                // Fallback si SweetAlert échoue
                if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
                    // Code de suppression de secours
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/projects/${projectId}`;
                    form.style.display = 'none';
                    
                    const csrfTokenInput = document.createElement('input');
                    csrfTokenInput.type = 'hidden';
                    csrfTokenInput.name = '_token';
                    csrfTokenInput.value = csrfToken.getAttribute('content');
                    form.appendChild(csrfTokenInput);
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        
        // Éditer depuis la vue détaillée (avec vérification)
        const editFromViewBtn = document.getElementById('editFromView');
        if (editFromViewBtn) {
            editFromViewBtn.addEventListener('click', function() {
                closeViewModal();
                editProject(currentProjectId);
            });
        }
        
        // Soumission du formulaire (avec vérification)
        const projectForm = document.getElementById('projectForm');
        if (projectForm) {
            projectForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = document.getElementById('submitBtn');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Enregistrement...';
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Succès !',
                            text: data.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            closeModal();
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Erreur',
                            text: data.message || 'Une erreur est survenue',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Une erreur est survenue',
                        icon: 'error'
                    });
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            });
        }
        
        // Actions groupées (avec vérification)
        const bulkDeleteBtn = document.getElementById('bulkDelete');
        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('.project-checkbox:checked')).map(cb => cb.value);
                
                if (selectedIds.length === 0) return;
                
                Swal.fire({
                    title: 'Supprimer les projets sélectionnés ?',
                    text: `Cette action supprimera ${selectedIds.length} projet(s) de façon irréversible !`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Oui, supprimer !',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Implémentation de la suppression groupée
                        console.log('Suppression des projets:', selectedIds);
                    }
                });
            });
        }
    });
</script>
@stop