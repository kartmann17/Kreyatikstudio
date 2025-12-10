@extends('admin.layout')

@section('title', 'Gestion du Portfolio')

@section('page_title', 'Gestion du Portfolio')

@section('content_body')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Éléments du Portfolio</h3>
                <a href="{{ route('admin.portfolio.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter un élément</span>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 relative">
                    <button type="button" class="absolute top-2 right-2 text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">×</button>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            @if(count($portfolioItems) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="portfolio-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aperçu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technologie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="w-36 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-items" class="bg-white divide-y divide-gray-200">
                            @foreach($portfolioItems as $item)
                                <tr data-id="{{ $item->id }}" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->order }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->isImage())
                                            <img src="{{ asset('storage/' . $item->path) }}" alt="{{ $item->title }}" class="h-15 w-15 object-cover rounded-lg border border-gray-200">
                                        @else
                                            <video muted class="h-15 w-15 object-cover rounded-lg border border-gray-200">
                                                <source src="{{ asset('storage/' . $item->path) }}" type="video/mp4">
                                                Votre navigateur ne supporte pas la vidéo.
                                            </video>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($item->description, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->technology }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $item->isImage() ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $item->isImage() ? 'Image' : 'Vidéo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.portfolio.visibility', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="inline-flex px-3 py-1 text-xs font-semibold rounded-full transition-colors {{ $item->is_visible ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                                {{ $item->is_visible ? 'Visible' : 'Masqué' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.portfolio.edit', $item->id) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-600 p-2 rounded-lg transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-lg transition-colors" onclick="openDeleteModal('{{ $item->id }}', '{{ $item->title }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-600 p-2 rounded-lg transition-colors handle cursor-move">
                                                <i class="fas fa-arrows-alt"></i>
                                            </button>
                                        </div>

                                        <!-- Modal de confirmation de suppression avec animations -->
                                        <div id="delete-modal-{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 opacity-0 transition-opacity duration-300">
                                            <div class="flex min-h-screen items-center justify-center p-4">
                                                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform scale-95 transition-all duration-300">
                                                    <!-- Header avec icône -->
                                                    <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-t-2xl">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center">
                                                                <div class="bg-red-400 bg-opacity-30 rounded-full p-3 mr-3">
                                                                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                                                </div>
                                                                <h3 class="text-xl font-bold text-white">Confirmer la suppression</h3>
                                                            </div>
                                                            <button type="button" class="text-red-100 hover:text-white transition-colors duration-200 p-2 hover:bg-red-400 hover:bg-opacity-20 rounded-full" onclick="closeDeleteModal('{{ $item->id }}')">
                                                                <i class="fas fa-times text-lg"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Body -->
                                                    <div class="p-6">
                                                        <div class="text-center mb-6">
                                                            <p class="text-gray-600 text-lg leading-relaxed">
                                                                Êtes-vous sûr de vouloir supprimer cet élément du portfolio ?
                                                            </p>
                                                            <div class="mt-4 p-4 bg-gray-50 rounded-xl">
                                                                <p class="font-semibold text-gray-900">{{ $item->title }}</p>
                                                            </div>
                                                            <p class="text-sm text-red-600 mt-3 font-medium">
                                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                                Cette action est irréversible
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Footer -->
                                                    <div class="flex justify-end space-x-3 p-6 bg-gray-50 rounded-b-2xl">
                                                        <button type="button" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition-all duration-200 transform hover:scale-105" onclick="closeDeleteModal('{{ $item->id }}')">
                                                            <i class="fas fa-times mr-2"></i>Annuler
                                                        </button>
                                                        <form action="{{ route('admin.portfolio.destroy', $item->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg">
                                                                <i class="fas fa-trash mr-2"></i>Supprimer définitivement
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-blue-800">
                        Aucun élément dans le portfolio. <a href="{{ route('admin.portfolio.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">Ajoutez-en un</a> pour commencer.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les vidéos pour qu'elles soient muettes
    document.querySelectorAll('video').forEach(video => {
        video.muted = true;
    });

    // Drag & Drop moderne avec SortableJS alternative
    const tbody = document.getElementById('sortable-items');
    if (tbody) {
        let dragSrcEl = null;

        tbody.addEventListener('dragstart', handleDragStart);
        tbody.addEventListener('dragover', handleDragOver);
        tbody.addEventListener('drop', handleDrop);
        tbody.addEventListener('dragend', handleDragEnd);

        function handleDragStart(e) {
            if (!e.target.closest('tr') || !e.target.closest('.handle')) return;
            dragSrcEl = e.target.closest('tr');
            e.dataTransfer.effectAllowed = 'move';
            dragSrcEl.classList.add('opacity-50');
        }

        function handleDragOver(e) {
            if (e.preventDefault) e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            return false;
        }

        function handleDrop(e) {
            if (e.stopPropagation) e.stopPropagation();
            const targetRow = e.target.closest('tr');
            if (dragSrcEl !== targetRow && targetRow) {
                const rect = targetRow.getBoundingClientRect();
                const midpoint = rect.top + rect.height / 2;
                
                if (e.clientY < midpoint) {
                    tbody.insertBefore(dragSrcEl, targetRow);
                } else {
                    tbody.insertBefore(dragSrcEl, targetRow.nextSibling);
                }
                updateOrder();
            }
            return false;
        }

        function handleDragEnd(e) {
            document.querySelectorAll('#sortable-items tr').forEach(row => {
                row.classList.remove('opacity-50', 'bg-blue-50');
            });
        }

        // Rendre les lignes draggables
        document.querySelectorAll('.handle').forEach(handle => {
            handle.closest('tr').setAttribute('draggable', 'true');
            handle.addEventListener('mousedown', () => {
                handle.closest('tr').classList.add('cursor-grabbing');
            });
        });

        function updateOrder() {
            const items = Array.from(document.querySelectorAll('#sortable-items tr')).map(row => 
                row.dataset.id
            );
            
            // Mettre à jour l'affichage des numéros
            document.querySelectorAll('#sortable-items tr').forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1;
            });

            // Envoyer au serveur
            fetch('{{ route("admin.portfolio.order") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ items })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Ordre mis à jour avec succès', 'success');
                } else {
                    showNotification('Erreur lors de la mise à jour', 'error');
                }
            })
            .catch(() => {
                showNotification('Erreur de connexion', 'error');
            });
        }
    }

    // Système de notifications moderne
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check' : type === 'error' ? 'fa-exclamation-triangle' : 'fa-info'} mr-2"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
});

// Fonctions pour gérer les modals de suppression avec animations
function openDeleteModal(itemId, title) {
    const modal = document.getElementById('delete-modal-' + itemId);
    const modalContent = modal.querySelector('.relative');
    
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    // Animation d'entrée
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
}

function closeDeleteModal(itemId) {
    const modal = document.getElementById('delete-modal-' + itemId);
    const modalContent = modal.querySelector('.relative');
    
    // Animation de sortie
    modal.classList.add('opacity-0');
    modalContent.classList.remove('scale-100');
    modalContent.classList.add('scale-95');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }, 300);
}

// Fermer modal avec Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('[id^="delete-modal-"]').forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                const itemId = modal.id.replace('delete-modal-', '');
                closeDeleteModal(itemId);
            }
        });
    }
});
</script>
@endsection 