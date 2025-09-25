@extends('admin.layout')

@section('title', 'Détails du client')

@section('page_title', 'Détails du client')

@section('content_body')
    <!-- Informations du client -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-600"></i>Informations du client
                </h3>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.clients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                    </a>
                    <a href="{{ route('admin.clients.edit', $client->id ?? 1) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <div>
                        <h4 class="font-medium">Succès!</h4>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user text-3xl opacity-75"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Nom</p>
                            <p class="text-xl font-bold">{{ $client->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-building text-3xl opacity-75"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-cyan-100 text-sm font-medium">Entreprise</p>
                            <p class="text-xl font-bold">{{ $client->company ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope text-3xl opacity-75"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Email</p>
                            <p class="text-xl font-bold break-all">{{ $client->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone text-3xl opacity-75"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Téléphone</p>
                            <p class="text-xl font-bold">{{ $client->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg border border-gray-200">
                    <div class="px-4 py-3 bg-gray-100 border-b border-gray-200 rounded-t-lg">
                        <h4 class="font-medium text-gray-900 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-gray-600"></i>Adresse
                        </h4>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-700">{{ $client->address ?? 'Aucune adresse enregistrée' }}</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg border border-gray-200">
                    <div class="px-4 py-3 bg-gray-100 border-b border-gray-200 rounded-t-lg">
                        <h4 class="font-medium text-gray-900 flex items-center">
                            <i class="fas fa-sticky-note mr-2 text-gray-600"></i>Notes
                        </h4>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-700">{{ $client->notes ?? 'Aucune note enregistrée' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Projets du client -->
    <div class="bg-white rounded-lg shadow-sm mt-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-project-diagram mr-2 text-blue-600"></i>Projets du client
                </h3>
                <a href="{{ route('admin.projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Nouveau projet
                </a>
            </div>
        </div>
        
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de début</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de fin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($projects ?? [] as $project)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $project->id ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $project->title ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(isset($project->status))
                                    @if($project->status == 'en-cours')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-play mr-1"></i>En cours
                                        </span>
                                    @elseif($project->status == 'termine' || $project->status == 'terminé')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Terminé
                                        </span>
                                    @elseif($project->status == 'en-attente')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-pause mr-1"></i>En attente
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $project->status }}
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ isset($project->start_date) ? date('d/m/Y', strtotime($project->start_date)) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ isset($project->end_date) ? date('d/m/Y', strtotime($project->end_date)) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-1">
                                    <a href="{{ route('admin.projects.show', $project->id ?? 1) }}" class="text-blue-600 hover:text-blue-900 p-2" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project->id ?? 1) }}" class="text-yellow-600 hover:text-yellow-900 p-2" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="empty-state">
                                    <i class="fas fa-project-diagram text-5xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun projet trouvé</h3>
                                    <p class="text-gray-500 mb-4">Ce client n'a encore aucun projet associé</p>
                                    <a href="{{ route('admin.projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                        <i class="fas fa-plus mr-2"></i> Créer un projet
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop 