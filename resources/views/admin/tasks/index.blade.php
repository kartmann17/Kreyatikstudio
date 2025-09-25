@extends('admin.layout')

@section('title', 'Gestion des tâches')

@section('page_title', 'Gestion des tâches')

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

    <!-- Statistiques des tâches -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">Total Tâches</h3>
                    <p class="text-3xl font-bold">{{ $tasks->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-tasks text-3xl opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">En cours</h3>
                    <p class="text-3xl font-bold">{{ $tasks->where('status', 'en-cours')->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-spinner text-3xl opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">Terminées</h3>
                    <p class="text-3xl font-bold">{{ $tasks->where('status', 'termine')->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-3xl opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium opacity-90">Urgentes</h3>
                    <p class="text-3xl font-bold">{{ $tasks->where('priority', 'urgent')->count() }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-3xl opacity-75"></i>
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
                        <i class="fas fa-plus mr-2"></i> Nouvelle tâche
                    </button>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Projet</label>
                        <select id="projectFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les projets</option>
                            @foreach ($projects ?? [] as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                        <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="a-faire">En attente</option>
                            <option value="en-cours">En cours</option>
                            <option value="a-tester">À tester</option>
                            <option value="termine">Terminé</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Priorité</label>
                        <select id="priorityFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Toutes les priorités</option>
                            <option value="low">Basse</option>
                            <option value="medium">Moyenne</option>
                            <option value="high">Haute</option>
                            <option value="urgent">Urgente</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                        <div class="relative">
                            <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Rechercher...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des tâches -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-blue-600"></i>Liste des tâches
                </h3>
                <div class="flex rounded-lg border border-gray-300" role="group">
                    <button type="button" class="px-3 py-2 text-sm bg-white hover:bg-gray-50 border-r border-gray-300 rounded-l-lg transition-colors" id="viewBoard">
                        <i class="fas fa-columns"></i>
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
                <table class="w-full" id="tasksTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tâche</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Projet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priorité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Échéance</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progression</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tasks ?? [] as $task)
                        <tr class="hover:bg-gray-50 transition-colors" data-project="{{ $task->project_id ?? '' }}" data-status="{{ $task->status }}" data-priority="{{ $task->priority }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-tasks text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                        <div class="text-sm text-gray-500">ID: #{{ $task->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $task->project->title ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($task->priority == 'low')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-chevron-down mr-1"></i>Basse
                                    </span>
                                @elseif($task->priority == 'medium')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-minus mr-1"></i>Moyenne
                                    </span>
                                @elseif($task->priority == 'high')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-chevron-up mr-1"></i>Haute
                                    </span>
                                @elseif($task->priority == 'urgent')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Urgente
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($task->status == 'a-faire')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-circle mr-1"></i>En attente
                                    </span>
                                @elseif($task->status == 'en-cours')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-play mr-1"></i>En cours
                                    </span>
                                @elseif($task->status == 'a-tester')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-flask mr-1"></i>À tester
                                    </span>
                                @elseif($task->status == 'termine')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Terminé
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $task->due_date ? date('d/m/Y', strtotime($task->due_date)) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-1 mr-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="h-2 rounded-full 
                                                @if($task->progress < 30) bg-red-500
                                                @elseif($task->progress < 70) bg-yellow-500  
                                                @else bg-green-500
                                                @endif" 
                                                style="width: {{ $task->progress }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500 ml-2">{{ $task->progress }}%</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-1">
                                    <button type="button" class="view-task-btn text-blue-600 hover:text-blue-900 p-1" 
                                            data-task-id="{{ $task->id }}" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="edit-task-btn text-yellow-600 hover:text-yellow-900 p-1" 
                                            data-task-id="{{ $task->id }}" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="progress-task-btn text-green-600 hover:text-green-900 p-1" 
                                            data-task-id="{{ $task->id }}" data-progress="{{ $task->progress }}" title="Progression">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                    <button type="button" class="delete-task-btn text-red-600 hover:text-red-900 p-1" 
                                            data-task-id="{{ $task->id }}" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-20 text-center">
                                <div class="empty-state">
                                    <i class="fas fa-tasks text-5xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune tâche trouvée</h3>
                                    <p class="text-gray-500 mb-4">Commencez par créer votre première tâche</p>
                                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors" id="createFirstTask">
                                        <i class="fas fa-plus mr-2"></i> Créer une tâche
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Vue tableau Kanban -->
            <div id="boardView" class="hidden p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Colonne En attente -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-700 flex items-center">
                                <i class="fas fa-circle text-gray-400 mr-2"></i>En attente
                            </h3>
                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs">
                                {{ $tasks->where('status', 'a-faire')->count() }}
                            </span>
                        </div>
                        <div class="space-y-3" data-status="a-faire">
                            @foreach ($tasks->where('status', 'a-faire') as $task)
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 cursor-pointer hover:shadow-md transition-shadow task-card">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $task->project->title ?? 'N/A' }}</p>
                                <div class="flex justify-between items-center">
                                    <div class="priority-badge">
                                        @if($task->priority == 'urgent')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Urgente
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $task->progress }}%</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colonne En cours -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-blue-700 flex items-center">
                                <i class="fas fa-play text-blue-500 mr-2"></i>En cours
                            </h3>
                            <span class="bg-blue-200 text-blue-700 px-2 py-1 rounded-full text-xs">
                                {{ $tasks->where('status', 'en-cours')->count() }}
                            </span>
                        </div>
                        <div class="space-y-3" data-status="en-cours">
                            @foreach ($tasks->where('status', 'en-cours') as $task)
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-200 cursor-pointer hover:shadow-md transition-shadow task-card">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $task->project->title ?? 'N/A' }}</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $task->progress }}%"></div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="priority-badge">
                                        @if($task->priority == 'urgent')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Urgente
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $task->progress }}%</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colonne À tester -->
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-purple-700 flex items-center">
                                <i class="fas fa-flask text-purple-500 mr-2"></i>À tester
                            </h3>
                            <span class="bg-purple-200 text-purple-700 px-2 py-1 rounded-full text-xs">
                                {{ $tasks->where('status', 'a-tester')->count() }}
                            </span>
                        </div>
                        <div class="space-y-3" data-status="a-tester">
                            @foreach ($tasks->where('status', 'a-tester') as $task)
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-purple-200 cursor-pointer hover:shadow-md transition-shadow task-card">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $task->project->title ?? 'N/A' }}</p>
                                <div class="flex justify-between items-center">
                                    <div class="priority-badge">
                                        @if($task->priority == 'urgent')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Urgente
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $task->progress }}%</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colonne Terminé -->
                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-green-700 flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>Terminé
                            </h3>
                            <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs">
                                {{ $tasks->where('status', 'termine')->count() }}
                            </span>
                        </div>
                        <div class="space-y-3" data-status="termine">
                            @foreach ($tasks->where('status', 'termine') as $task)
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-green-200 cursor-pointer hover:shadow-md transition-shadow task-card">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $task->project->title ?? 'N/A' }}</p>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-green-600">
                                        <i class="fas fa-check-circle mr-1"></i>Complété
                                    </div>
                                    <div class="text-xs text-gray-400">100%</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout/édition de tâche -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="taskModal">
        <div class="relative top-10 mx-auto p-5 border w-11/12 lg:w-3/4 shadow-lg rounded-md bg-white">
            <div class="bg-blue-600 text-white p-4 rounded-t-md -m-5 mb-5">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold flex items-center" id="taskModalTitle">
                        <i class="fas fa-plus mr-2"></i>Ajouter une tâche
                    </h3>
                    <button type="button" class="text-white hover:text-gray-200" id="closeTaskModal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <form id="taskForm" action="{{ route('admin.tasks.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="taskMethod" value="POST">
                <input type="hidden" name="task_id" id="taskId">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   id="title" name="title" required>
                        </div>
                        <div>
                            <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Projet <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    id="project_id" name="project_id" required>
                                <option value="" selected disabled>Sélectionner un projet</option>
                                @foreach ($projects ?? [] as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  id="description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priorité</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    id="priority" name="priority">
                                <option value="low">Basse</option>
                                <option value="medium" selected>Moyenne</option>
                                <option value="high">Haute</option>
                                <option value="urgent">Urgente</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    id="status" name="status">
                                <option value="a-faire" selected>En attente</option>
                                <option value="en-cours">En cours</option>
                                <option value="a-tester">À tester</option>
                                <option value="termine">Terminé</option>
                            </select>
                        </div>
                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Date d'échéance</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   id="due_date" name="due_date">
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
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="cancelTaskBtn">
                        <i class="fas fa-times mr-1"></i>Annuler
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors" id="submitTaskBtn">
                        <i class="fas fa-save mr-1"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de visualisation de tâche -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="viewTaskModal">
        <div class="relative top-10 mx-auto p-5 border w-11/12 lg:w-2/3 shadow-lg rounded-md bg-white">
            <div class="bg-blue-500 text-white p-4 rounded-t-md -m-5 mb-5">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-eye mr-2"></i>Détails de la tâche
                    </h3>
                    <button type="button" class="text-white hover:text-gray-200" id="closeViewTaskModal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titre:</label>
                            <p id="view-title" class="text-gray-900 font-medium"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Projet:</label>
                            <p id="view-project" class="text-gray-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                            <p id="view-description" class="text-gray-900"></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Priorité:</label>
                                <p id="view-priority"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Statut:</label>
                                <p id="view-status"></p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date d'échéance:</label>
                            <p id="view-due-date" class="text-gray-900"></p>
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
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="closeViewTaskModalBtn">
                    <i class="fas fa-times mr-1"></i>Fermer
                </button>
                <button type="button" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors" id="editFromView">
                    <i class="fas fa-edit mr-1"></i>Modifier
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de progression -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="progressModal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="bg-green-600 text-white p-4 rounded-t-md -m-5 mb-5">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Mettre à jour la progression</h3>
                    <button type="button" class="text-white hover:text-gray-200" id="closeProgressModal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <form id="progressForm" action="{{ route('admin.tasks.update.progress') }}" method="POST">
                @csrf
                <input type="hidden" name="task_id" id="progressTaskId">
                <div class="space-y-4">
                    <div>
                        <label for="taskProgress" class="block text-sm font-medium text-gray-700 mb-2">Progression</label>
                        <div class="flex items-center space-x-4">
                            <input type="range" class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" 
                                   id="taskProgress" name="progress" min="0" max="100" value="0">
                            <span id="taskProgressValue" class="bg-green-600 text-white px-2 py-1 rounded text-sm font-medium min-w-12 text-center">0%</span>
                        </div>
                    </div>
                    <div>
                        <label for="progressNote" class="block text-sm font-medium text-gray-700 mb-2">Note (optionnel)</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                  id="progressNote" name="note" rows="3" placeholder="Ajouter une note sur l'avancement..."></textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="cancelProgressBtn">
                        Annuler
                    </button>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Variables globales
        let currentTaskId = null;
        
        // Éléments du DOM
        const taskModal = document.getElementById('taskModal');
        const viewTaskModal = document.getElementById('viewTaskModal');
        const progressModal = document.getElementById('progressModal');
        const progressSlider = document.getElementById('progress');
        const progressValue = document.getElementById('progressValue');
        const taskProgressSlider = document.getElementById('taskProgress');
        const taskProgressValue = document.getElementById('taskProgressValue');
        
        // Gestion des sliders de progression avec vérifications
        if (progressSlider && progressValue) {
            progressSlider.addEventListener('input', function() {
                progressValue.textContent = this.value + '%';
            });
        }
        
        if (taskProgressSlider && taskProgressValue) {
            taskProgressSlider.addEventListener('input', function() {
                taskProgressValue.textContent = this.value + '%';
            });
        }
        
        // Filtres de recherche
        const searchInput = document.getElementById('searchInput');
        const projectFilter = document.getElementById('projectFilter');
        const statusFilter = document.getElementById('statusFilter');
        const priorityFilter = document.getElementById('priorityFilter');
        
        if (searchInput) searchInput.addEventListener('keyup', filterTasks);
        if (projectFilter) projectFilter.addEventListener('change', filterTasks);
        if (statusFilter) statusFilter.addEventListener('change', filterTasks);
        if (priorityFilter) priorityFilter.addEventListener('change', filterTasks);
        
        function filterTasks() {
            const search = searchInput ? searchInput.value.toLowerCase() : '';
            const project = projectFilter ? projectFilter.value : '';
            const status = statusFilter ? statusFilter.value : '';
            const priority = priorityFilter ? priorityFilter.value : '';
            
            // Filtrer la vue tableau
            const tableRows = document.querySelectorAll('#tasksTable tbody tr');
            tableRows.forEach(row => {
                if (row.querySelector('.empty-state')) return;
                
                const text = row.textContent.toLowerCase();
                const rowProject = row.dataset.project;
                const rowStatus = row.dataset.status;
                const rowPriority = row.dataset.priority;
                
                let show = true;
                if (search && !text.includes(search)) show = false;
                if (project && rowProject !== project) show = false;
                if (status && rowStatus !== status) show = false;
                if (priority && rowPriority !== priority) show = false;
                
                row.style.display = show ? '' : 'none';
            });
        }
        
        // Basculer entre vue tableau et kanban
        const viewTableBtn = document.getElementById('viewTable');
        const viewBoardBtn = document.getElementById('viewBoard');
        const tableView = document.getElementById('tableView');
        const boardView = document.getElementById('boardView');
        
        if (viewTableBtn && viewBoardBtn && tableView && boardView) {
            viewTableBtn.addEventListener('click', function() {
                this.classList.add('bg-blue-50', 'text-blue-600');
                this.classList.remove('bg-white');
                viewBoardBtn.classList.remove('bg-blue-50', 'text-blue-600');
                viewBoardBtn.classList.add('bg-white');
                tableView.classList.remove('hidden');
                boardView.classList.add('hidden');
            });
            
            viewBoardBtn.addEventListener('click', function() {
                this.classList.add('bg-blue-50', 'text-blue-600');
                this.classList.remove('bg-white');
                viewTableBtn.classList.remove('bg-blue-50', 'text-blue-600');
                viewTableBtn.classList.add('bg-white');
                boardView.classList.remove('hidden');
                tableView.classList.add('hidden');
            });
        }
        
        // Gestion des modals
        function openTaskModal() {
            if (taskModal) {
                taskModal.classList.remove('hidden');
                resetTaskForm();
            }
        }
        
        function closeTaskModal() {
            taskModal.classList.add('hidden');
        }
        
        function openViewTaskModal() {
            viewTaskModal.classList.remove('hidden');
        }
        
        function closeViewTaskModal() {
            viewTaskModal.classList.add('hidden');
        }
        
        function openProgressModal() {
            progressModal.classList.remove('hidden');
        }
        
        function closeProgressModal() {
            progressModal.classList.add('hidden');
        }
        
        function resetTaskForm() {
            // Ne pas réinitialiser le formulaire si on est en mode édition
            if (currentTaskId) {
                return;
            }
            
            document.getElementById('taskModalTitle').innerHTML = '<i class="fas fa-plus mr-2"></i>Ajouter une tâche';
            document.getElementById('taskMethod').value = 'POST';
            document.getElementById('taskForm').action = '{{ route("admin.tasks.store") }}';
            document.getElementById('taskForm').reset();
            if (progressValue) {
                progressValue.textContent = '0%';
            }
            currentTaskId = null;
        }
        
        // Event listeners pour les modals avec vérifications
        const openAddModalBtn = document.getElementById('openAddModal');
        const createFirstTaskBtn = document.getElementById('createFirstTask');
        const closeTaskModalBtn = document.getElementById('closeTaskModal');
        const cancelTaskBtn = document.getElementById('cancelTaskBtn');
        const closeViewTaskModalBtn = document.getElementById('closeViewTaskModal');
        const closeViewTaskModalBtn2 = document.getElementById('closeViewTaskModalBtn');
        const closeProgressModalBtn = document.getElementById('closeProgressModal');
        const cancelProgressBtn = document.getElementById('cancelProgressBtn');
        
        if (openAddModalBtn) openAddModalBtn.addEventListener('click', openTaskModal);
        if (createFirstTaskBtn) createFirstTaskBtn.addEventListener('click', openTaskModal);
        if (closeTaskModalBtn) closeTaskModalBtn.addEventListener('click', closeTaskModal);
        if (cancelTaskBtn) cancelTaskBtn.addEventListener('click', closeTaskModal);
        if (closeViewTaskModalBtn) closeViewTaskModalBtn.addEventListener('click', closeViewTaskModal);
        if (closeViewTaskModalBtn2) closeViewTaskModalBtn2.addEventListener('click', closeViewTaskModal);
        if (closeProgressModalBtn) closeProgressModalBtn.addEventListener('click', closeProgressModal);
        if (cancelProgressBtn) cancelProgressBtn.addEventListener('click', closeProgressModal);
        
        // Fermer modals en cliquant en dehors
        window.addEventListener('click', function(e) {
            if (e.target === taskModal) closeTaskModal();
            if (e.target === viewTaskModal) closeViewTaskModal();
            if (e.target === progressModal) closeProgressModal();
        });
        
        // Actions CRUD
        document.addEventListener('click', function(e) {
            if (e.target.closest('.view-task-btn')) {
                e.preventDefault();
                const taskId = e.target.closest('.view-task-btn').dataset.taskId;
                viewTask(taskId);
            }
            
            if (e.target.closest('.edit-task-btn')) {
                e.preventDefault();
                const taskId = e.target.closest('.edit-task-btn').dataset.taskId;
                editTask(taskId);
            }
            
            if (e.target.closest('.progress-task-btn')) {
                e.preventDefault();
                const button = e.target.closest('.progress-task-btn');
                const taskId = button.dataset.taskId;
                const progress = button.dataset.progress;
                updateProgress(taskId, progress);
            }
            
            if (e.target.closest('.delete-task-btn')) {
                e.preventDefault();
                const taskId = e.target.closest('.delete-task-btn').dataset.taskId;
                deleteTask(taskId);
            }
        });
        
        function viewTask(taskId) {
            fetch(`/admin/tasks/${taskId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const task = data.task;
                    
                    document.getElementById('view-title').textContent = task.title;
                    document.getElementById('view-project').textContent = task.project ? task.project.title : 'N/A';
                    document.getElementById('view-description').textContent = task.description || 'Aucune description';
                    
                    // Priorité avec badge
                    let priorityHTML = '';
                    if (task.priority === 'low') {
                        priorityHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><i class="fas fa-chevron-down mr-1"></i>Basse</span>';
                    } else if (task.priority === 'medium') {
                        priorityHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-minus mr-1"></i>Moyenne</span>';
                    } else if (task.priority === 'high') {
                        priorityHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-chevron-up mr-1"></i>Haute</span>';
                    } else if (task.priority === 'urgent') {
                        priorityHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"><i class="fas fa-exclamation-triangle mr-1"></i>Urgente</span>';
                    }
                    document.getElementById('view-priority').innerHTML = priorityHTML;
                    
                    // Statut avec badge
                    let statusHTML = '';
                    if (task.status === 'a-faire') {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><i class="fas fa-circle mr-1"></i>En attente</span>';
                    } else if (task.status === 'en-cours') {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><i class="fas fa-play mr-1"></i>En cours</span>';
                    } else if (task.status === 'a-tester') {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800"><i class="fas fa-flask mr-1"></i>À tester</span>';
                    } else if (task.status === 'termine') {
                        statusHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check mr-1"></i>Terminé</span>';
                    }
                    document.getElementById('view-status').innerHTML = statusHTML;
                    
                    // Date d'échéance
                    document.getElementById('view-due-date').textContent = task.due_date || 'Non définie';
                    
                    // Progression
                    const progress = task.progress || 0;
                    let progressClass = 'bg-red-500';
                    if (progress >= 70) progressClass = 'bg-green-500';
                    else if (progress >= 30) progressClass = 'bg-yellow-500';
                    
                    const progressBar = document.getElementById('view-progress-bar');
                    progressBar.style.width = progress + '%';
                    progressBar.className = `h-3 rounded-full ${progressClass}`;
                    document.getElementById('view-progress-text').textContent = progress + '%';
                    
                    currentTaskId = taskId;
                    openViewTaskModal();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Impossible de récupérer les détails de la tâche',
                    icon: 'error'
                });
            });
        }
        
        function editTask(taskId) {
            fetch(`/admin/tasks/${taskId}/edit`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const task = data.task;
                    
                    // Définir currentTaskId AVANT d'ouvrir le modal
                    currentTaskId = taskId;
                    
                    document.getElementById('taskModalTitle').innerHTML = '<i class="fas fa-edit mr-2"></i>Modifier la tâche';
                    document.getElementById('taskMethod').value = 'PUT';
                    document.getElementById('title').value = task.title || '';
                    document.getElementById('description').value = task.description || '';
                    document.getElementById('project_id').value = task.project_id || '';
                    document.getElementById('priority').value = task.priority || '';
                    document.getElementById('status').value = task.status || '';
                    document.getElementById('due_date').value = task.due_date || '';
                    document.getElementById('progress').value = task.progress || 0;
                    document.getElementById('progressValue').textContent = (task.progress || 0) + '%';
                    document.getElementById('taskForm').action = `/admin/tasks/${taskId}`;
                    
                    openTaskModal();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Impossible de récupérer les données de la tâche',
                    icon: 'error'
                });
            });
        }
        
        function updateProgress(taskId, progress) {
            document.getElementById('progressTaskId').value = taskId;
            document.getElementById('taskProgress').value = progress;
            document.getElementById('taskProgressValue').textContent = progress + '%';
            openProgressModal();
        }
        
        function deleteTask(taskId) {
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
                if (result.isConfirmed) {
                    fetch(`/admin/tasks/${taskId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Supprimé !', 'La tâche a été supprimée avec succès.', 'success')
                                .then(() => window.location.reload());
                        } else {
                            Swal.fire('Erreur !', data.message || 'Une erreur est survenue.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Erreur !', 'Une erreur est survenue lors de la suppression.', 'error');
                    });
                }
            });
        }
        
        // Éditer depuis la vue détaillée
        document.getElementById('editFromView').addEventListener('click', function() {
            closeViewTaskModal();
            editTask(currentTaskId);
        });
        
        // Soumission du formulaire de tâche
        document.getElementById('taskForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitTaskBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Enregistrement...';
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
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
                        closeTaskModal();
                        window.location.href = '{{ route("admin.tasks.index") }}';
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
        
        // Soumission du formulaire de progression
        document.getElementById('progressForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Succès !',
                        text: 'Progression mise à jour avec succès',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        closeProgressModal();
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
            });
        });
    });
</script>
@stop