@extends('admin.layout')

@section('title', 'Gestion des tickets')

@section('page_title', 'Gestion des tickets')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('admin.tickets.index', ['status' => 'ouvert']) }}" class="group">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl p-6 shadow-lg transform transition-all duration-200 group-hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-blue-100">Tickets ouverts</h3>
                        <p class="text-3xl font-bold mt-1">{{ $stats['open'] }}</p>
                    </div>
                    <div class="bg-blue-500 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-ticket-alt text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-blue-100">
                    <span class="text-sm">Voir tous</span>
                    <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.tickets.index', ['status' => 'en-cours']) }}" class="group">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl p-6 shadow-lg transform transition-all duration-200 group-hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-yellow-100">Tickets en cours</h3>
                        <p class="text-3xl font-bold mt-1">{{ $stats['in_progress'] }}</p>
                    </div>
                    <div class="bg-yellow-400 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-cog text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-yellow-100">
                    <span class="text-sm">Voir tous</span>
                    <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.tickets.index', ['status' => 'résolu']) }}" class="group">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl p-6 shadow-lg transform transition-all duration-200 group-hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-green-100">Tickets résolus</h3>
                        <p class="text-3xl font-bold mt-1">{{ $stats['resolved'] }}</p>
                    </div>
                    <div class="bg-green-500 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-green-100">
                    <span class="text-sm">Voir tous</span>
                    <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.tickets.index', ['priority' => 'haute']) }}" class="group">
            <div class="bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl p-6 shadow-lg transform transition-all duration-200 group-hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-red-100">Priorité haute</h3>
                        <p class="text-3xl font-bold mt-1">{{ $stats['high_priority'] }}</p>
                    </div>
                    <div class="bg-red-500 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-red-100">
                    <span class="text-sm">Voir tous</span>
                    <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                <i class="fas fa-ticket-alt mr-2"></i>
                Liste des tickets
            </h3>
            <form action="{{ route('admin.tickets.index') }}" method="GET" class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" name="search" placeholder="Rechercher tickets..." value="{{ request('search') }}" class="w-full px-4 py-2 pl-10 pr-4 text-gray-900 border border-purple-300 rounded-lg focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-200">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-purple-400"></i>
                    </div>
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <span class="bg-white text-purple-600 hover:bg-purple-50 px-3 py-1 rounded text-sm transition-colors duration-200">Rechercher</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="p-6">
            <!-- Actions and Filters -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 space-y-4 lg:space-y-0">
                <a href="{{ route('admin.tickets.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold flex items-center transition-all duration-200 w-fit">
                    <i class="fas fa-plus mr-2"></i> 
                    Nouveau ticket
                </a>
                
                <div class="flex flex-wrap gap-4">
                    <!-- Status Filter -->
                    <div class="relative">
                        <button id="statusDropdown" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                            <i class="fas fa-filter mr-2"></i>
                            Statut: {{ $status === 'all' ? 'Tous' : ucfirst($status) }}
                            <i class="fas fa-chevron-down ml-2 transform transition-transform duration-200" id="statusChevron"></i>
                        </button>
                        <div id="statusMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
                            <div class="py-2">
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('status', 'page'), ['status' => 'all'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $status === 'all' ? 'bg-blue-50 text-blue-700' : '' }}">Tous</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('status', 'page'), ['status' => 'ouvert'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $status === 'ouvert' ? 'bg-blue-50 text-blue-700' : '' }}">Ouvert</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('status', 'page'), ['status' => 'en-cours'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $status === 'en-cours' ? 'bg-blue-50 text-blue-700' : '' }}">En cours</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('status', 'page'), ['status' => 'résolu'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $status === 'résolu' ? 'bg-blue-50 text-blue-700' : '' }}">Résolu</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('status', 'page'), ['status' => 'fermé'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $status === 'fermé' ? 'bg-blue-50 text-blue-700' : '' }}">Fermé</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Priority Filter -->
                    <div class="relative">
                        <button id="priorityDropdown" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Priorité: {{ $priority === 'all' ? 'Toutes' : ucfirst($priority) }}
                            <i class="fas fa-chevron-down ml-2 transform transition-transform duration-200" id="priorityChevron"></i>
                        </button>
                        <div id="priorityMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
                            <div class="py-2">
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('priority', 'page'), ['priority' => 'all'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $priority === 'all' ? 'bg-blue-50 text-blue-700' : '' }}">Toutes</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('priority', 'page'), ['priority' => 'basse'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $priority === 'basse' ? 'bg-blue-50 text-blue-700' : '' }}">Basse</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('priority', 'page'), ['priority' => 'moyenne'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $priority === 'moyenne' ? 'bg-blue-50 text-blue-700' : '' }}">Moyenne</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('priority', 'page'), ['priority' => 'haute'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $priority === 'haute' ? 'bg-blue-50 text-blue-700' : '' }}">Haute</a>
                                <a href="{{ route('admin.tickets.index', array_merge(request()->except('priority', 'page'), ['priority' => 'urgente'])) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $priority === 'urgente' ? 'bg-blue-50 text-blue-700' : '' }}">Urgente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tickets Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client/Projet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priorité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigné à</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tickets as $ticket)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-800 font-medium truncate block">
                                            {{ $ticket->title }}
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $ticket->client->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $ticket->project->title ?? 'Aucun projet' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($ticket->status === 'ouvert')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-circle mr-1"></i>
                                            Ouvert
                                        </span>
                                    @elseif ($ticket->status === 'en-cours')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            En cours
                                        </span>
                                    @elseif ($ticket->status === 'résolu')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Résolu
                                        </span>
                                    @elseif ($ticket->status === 'fermé')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-lock mr-1"></i>
                                            Fermé
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($ticket->priority === 'basse')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-chevron-down mr-1"></i>
                                            Basse
                                        </span>
                                    @elseif ($ticket->priority === 'moyenne')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-minus mr-1"></i>
                                            Moyenne
                                        </span>
                                    @elseif ($ticket->priority === 'haute')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <i class="fas fa-chevron-up mr-1"></i>
                                            Haute
                                        </span>
                                    @elseif ($ticket->priority === 'urgente')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>
                                            Urgente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $ticket->assignedUser->name ?? 'Non assigné' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition-colors duration-200" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="delete-ticket bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $ticket->id }}" data-number="{{ $ticket->ticket_number }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-ticket-alt text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium">Aucun ticket trouvé</p>
                                        <p class="text-sm">Commencez par créer votre premier ticket</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $tickets->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown functionality
    function setupDropdown(buttonId, menuId, chevronId) {
        const button = document.getElementById(buttonId);
        const menu = document.getElementById(menuId);
        const chevron = document.getElementById(chevronId);
        
        if (button && menu && chevron) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                menu.classList.toggle('hidden');
                chevron.classList.toggle('rotate-180');
            });
        }
    }
    
    setupDropdown('statusDropdown', 'statusMenu', 'statusChevron');
    setupDropdown('priorityDropdown', 'priorityMenu', 'priorityChevron');
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        const statusMenu = document.getElementById('statusMenu');
        const priorityMenu = document.getElementById('priorityMenu');
        const statusChevron = document.getElementById('statusChevron');
        const priorityChevron = document.getElementById('priorityChevron');
        
        if (!e.target.closest('#statusDropdown')) {
            if (statusMenu) statusMenu.classList.add('hidden');
            if (statusChevron) statusChevron.classList.remove('rotate-180');
        }
        
        if (!e.target.closest('#priorityDropdown')) {
            if (priorityMenu) priorityMenu.classList.add('hidden');
            if (priorityChevron) priorityChevron.classList.remove('rotate-180');
        }
    });
    
    // Delete ticket functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-ticket')) {
            const button = e.target.closest('.delete-ticket');
            const ticketId = button.dataset.id;
            const ticketNumber = button.dataset.number;
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: `Voulez-vous vraiment supprimer le ticket ${ticketNumber} ? Cette action est irréversible.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonClass: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg mr-2',
                cancelButtonClass: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/tickets/${ticketId}`;
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    });
});
</script>
@stop 