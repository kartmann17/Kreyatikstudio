@extends('admin.layout')

@section('title', 'Gestion des clients')

@section('page_title', 'Gestion des clients')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-blue-100">Total clients</h3>
                    <p class="text-2xl font-bold mt-1">{{ $clients->total() ?? count($clients) }}</p>
                </div>
                <div class="bg-blue-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-green-100">Clients actifs</h3>
                    <p class="text-2xl font-bold mt-1" id="activeClients">{{ $clients->where('status', 'active')->count() ?? 0 }}</p>
                </div>
                <div class="bg-green-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-purple-100">Avec projets</h3>
                    <p class="text-2xl font-bold mt-1">{{ $clients->filter(function($client) { return $client->projects && $client->projects->count() > 0; })->count() }}</p>
                </div>
                <div class="bg-purple-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-orange-100">Nouveaux ce mois</h3>
                    <p class="text-2xl font-bold mt-1">{{ $clients->where('created_at', '>=', now()->startOfMonth())->count() ?? 0 }}</p>
                </div>
                <div class="bg-orange-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-user-plus text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                <i class="fas fa-users mr-2"></i>
                Liste des clients
            </h3>
            <a href="{{ route('admin.clients.create') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                <i class="fas fa-plus mr-2"></i> 
                Ajouter un client
            </a>
        </div>
        <div class="p-6">
            <!-- Search and Filters -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <form action="{{ route('admin.clients.index') }}" method="GET" class="flex-1 max-w-md mb-4 sm:mb-0">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Rechercher clients..." value="{{ request('search') }}" class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition-colors duration-200">Rechercher</span>
                        </button>
                    </div>
                </form>
                
                <div class="flex items-center space-x-2">
                    <button id="tableViewBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                        <i class="fas fa-table mr-2"></i> Tableau
                    </button>
                    <button id="gridViewBtn" class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                        <i class="fas fa-th-large mr-2"></i> Grille
                    </button>
                </div>
            </div>
            
            <!-- Success Message -->
            @if (session('success'))
                <div id="successMessage" class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-6 flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    <div>
                        <h5 class="font-semibold">Succès!</h5>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="close-message ml-auto text-green-600 hover:text-green-800 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <!-- Error Message -->
            @if (session('error'))
                <div id="errorMessage" class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                    <div>
                        <h5 class="font-semibold">Erreur!</h5>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="close-message ml-auto text-red-600 hover:text-red-800 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <!-- Table View -->
            <div id="tableView" class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Projets</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($clients as $client)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $client->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                            {{ strtoupper(substr($client->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $client->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $client->company ?? 'Particulier' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $client->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $client->phone ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-project-diagram mr-1"></i>
                                        {{ $client->projects->count() ?? 0 }} projet(s)
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(isset($client->status) && $client->status === 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-circle mr-1"></i>
                                            Standard
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.clients.show', $client->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition-colors duration-200" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="delete-client bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $client->id }}" data-name="{{ $client->name }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium">Aucun client trouvé</p>
                                        <p class="text-sm">Commencez par ajouter votre premier client</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Grid View -->
            <div id="gridView" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($clients as $client)
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-200">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-lg mr-3">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $client->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $client->company ?? 'Particulier' }}</p>
                                    </div>
                                </div>
                                @if(isset($client->status) && $client->status === 'active')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Actif
                                    </span>
                                @endif
                            </div>
                            
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                    {{ $client->email }}
                                </div>
                                @if($client->phone)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-phone mr-2 text-gray-400"></i>
                                    {{ $client->phone }}
                                </div>
                                @endif
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-project-diagram mr-2 text-gray-400"></i>
                                    {{ $client->projects->count() ?? 0 }} projet(s)
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.clients.show', $client->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.clients.edit', $client->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition-colors duration-200" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="delete-client bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $client->id }}" data-name="{{ $client->name }}" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <span class="text-xs text-gray-500">ID: {{ $client->id }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg font-medium text-gray-500">Aucun client trouvé</p>
                                <p class="text-sm text-gray-400">Commencez par ajouter votre premier client</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Pagination -->
            @if(isset($clients) && is_object($clients) && method_exists($clients, 'links'))
                <div class="mt-8 flex justify-center">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </div>
@stop

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const tableViewBtn = document.getElementById('tableViewBtn');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const tableView = document.getElementById('tableView');
    const gridView = document.getElementById('gridView');

    tableViewBtn.addEventListener('click', function() {
        tableView.classList.remove('hidden');
        gridView.classList.add('hidden');
        
        tableViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
        tableViewBtn.classList.add('bg-blue-600', 'text-white');
        
        gridViewBtn.classList.remove('bg-blue-600', 'text-white');
        gridViewBtn.classList.add('bg-gray-200', 'text-gray-700');
    });

    gridViewBtn.addEventListener('click', function() {
        gridView.classList.remove('hidden');
        tableView.classList.add('hidden');
        
        gridViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
        gridViewBtn.classList.add('bg-blue-600', 'text-white');
        
        tableViewBtn.classList.remove('bg-blue-600', 'text-white');
        tableViewBtn.classList.add('bg-gray-200', 'text-gray-700');
    });

    // Delete client functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-client')) {
            const button = e.target.closest('.delete-client');
            const clientId = button.dataset.id;
            const clientName = button.dataset.name;
            
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
                text: `Voulez-vous vraiment supprimer le client "${clientName}" ? Cette action est irréversible.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Utiliser fetch au lieu de créer un formulaire
                    fetch(`/admin/clients/${clientId}`, {
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
                if (confirm(`Êtes-vous sûr de vouloir supprimer le client "${clientName}" ?`)) {
                    // Code de suppression de secours avec formulaire
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/clients/${clientId}`;
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
    });

    // Auto-hide messages functionality
    function autoHideMessage(messageId, delay = 5000) {
        const messageElement = document.getElementById(messageId);
        if (messageElement) {
            setTimeout(() => {
                messageElement.style.transition = 'opacity 300ms ease-out';
                messageElement.style.opacity = '0';
                setTimeout(() => {
                    messageElement.style.display = 'none';
                }, 300);
            }, delay);
        }
    }
    
    // Auto-hide success and error messages
    autoHideMessage('successMessage', 5000);
    autoHideMessage('errorMessage', 7000); // Messages d'erreur restent un peu plus longtemps
    
    // Manual close buttons functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.close-message')) {
            e.preventDefault();
            const messageElement = e.target.closest('[id$="Message"]');
            if (messageElement) {
                messageElement.style.transition = 'opacity 200ms ease-out';
                messageElement.style.opacity = '0';
                setTimeout(() => {
                    messageElement.style.display = 'none';
                }, 200);
            }
        }
    });
});
</script>
@stop 