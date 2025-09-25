@extends('admin.layout')

@section('title', 'Tableau de bord administrateur')

@section('page_title', 'Tableau de bord administrateur')

@section('content_body')
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Vue d'ensemble</h3>
            <div>
                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center" id="openAddModal">
                    <i class="fas fa-plus mr-2"></i> Ajouter
                </button>
            </div>
        </div>
    </div>
    <div class="p-6">
        @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="ml-auto text-red-600 hover:text-red-800" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(count($items) > 0)
        <div class="overflow-x-auto">
            <table class="w-full" id="main-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de création</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="sortable-items">
                    @foreach($items as $item)
                    <tr class="hover:bg-gray-50 transition-colors" data-id="{{ $item->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ Str::limit($item->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $item->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $item->status ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-1">
                                <button type="button" class="view-btn text-blue-600 hover:text-blue-900 p-1" 
                                        data-id="{{ $item->id }}" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="edit-btn text-yellow-600 hover:text-yellow-900 p-1" 
                                        data-id="{{ $item->id }}" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="delete-btn text-red-600 hover:text-red-900 p-1" 
                                        data-id="{{ $item->id }}" data-name="{{ $item->title }}" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">
            Aucun élément trouvé. <button type="button" class="font-medium underline hover:no-underline" id="addFirstItem">Ajoutez-en un</button> pour commencer.
        </div>
        @endif
    </div>
</div>

<!-- Modal d'ajout -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="addModal">
    <div class="relative top-20 mx-auto p-5 border w-11/12 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="bg-blue-600 text-white p-4 rounded-t-md -m-5 mb-5">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Ajouter un élément</h3>
                <button type="button" class="text-white hover:text-gray-200" id="closeAddModal">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="modal_title" class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           id="modal_title" name="title" required>
                </div>
                <div>
                    <label for="modal_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                              id="modal_description" name="description" rows="3"></textarea>
                </div>
                <div>
                    <label for="modal_status" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            id="modal_status" name="status">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="cancelAddBtn">
                    Annuler
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="deleteModal">
    <div class="relative top-20 mx-auto p-5 border w-11/12 lg:w-1/3 shadow-lg rounded-md bg-white">
        <div class="bg-red-600 text-white p-4 rounded-t-md -m-5 mb-5">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Confirmer la suppression</h3>
                <button type="button" class="text-white hover:text-gray-200" id="closeDeleteModal">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="mb-6">
            <p class="text-gray-700">Êtes-vous sûr de vouloir supprimer <span id="itemName" class="font-medium"></span> ?</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors" id="cancelDeleteBtn">
                Annuler
            </button>
            <form id="deleteForm" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Éléments du DOM
        const addModal = document.getElementById('addModal');
        const deleteModal = document.getElementById('deleteModal');
        
        // Gestion du modal d'ajout
        function openAddModal() {
            addModal.classList.remove('hidden');
        }
        
        function closeAddModal() {
            addModal.classList.add('hidden');
            document.getElementById('addForm').reset();
        }
        
        // Gestion du modal de suppression
        function openDeleteModal(id, name) {
            document.getElementById('itemName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/projects/${id}`;
            deleteModal.classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
        }
        
        // Event listeners pour les modals
        document.getElementById('openAddModal').addEventListener('click', openAddModal);
        document.getElementById('addFirstItem').addEventListener('click', openAddModal);
        document.getElementById('closeAddModal').addEventListener('click', closeAddModal);
        document.getElementById('cancelAddBtn').addEventListener('click', closeAddModal);
        document.getElementById('closeDeleteModal').addEventListener('click', closeDeleteModal);
        document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);
        
        // Fermer modals en cliquant en dehors
        window.addEventListener('click', function(e) {
            if (e.target === addModal) closeAddModal();
            if (e.target === deleteModal) closeDeleteModal();
        });
        
        // Gestion des boutons d'action
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                const button = e.target.closest('.delete-btn');
                const id = button.dataset.id;
                const name = button.dataset.name;
                openDeleteModal(id, name);
            }
            
            if (e.target.closest('.edit-btn')) {
                const id = e.target.closest('.edit-btn').dataset.id;
                window.location.href = `/admin/projects/${id}/edit`;
            }
            
            if (e.target.closest('.view-btn')) {
                const id = e.target.closest('.view-btn').dataset.id;
                window.location.href = `/admin/projects/${id}`;
            }
        });
        
        // Gestion de la soumission du formulaire de suppression
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const url = form.action;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                closeDeleteModal();
                Swal.fire({
                    title: 'Succès!',
                    text: 'Le projet a été supprimé avec succès.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            })
            .catch(error => {
                closeDeleteModal();
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Une erreur est survenue lors de la suppression.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
        
        // Initialiser les tooltips si nécessaire
        const tooltips = document.querySelectorAll('[title]');
        tooltips.forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute z-10 px-2 py-1 text-xs bg-gray-900 text-white rounded shadow-lg pointer-events-none';
                tooltip.textContent = e.target.title;
                tooltip.style.left = e.pageX + 10 + 'px';
                tooltip.style.top = e.pageY - 30 + 'px';
                document.body.appendChild(tooltip);
                e.target.tooltip = tooltip;
                e.target.removeAttribute('title');
            });
            
            element.addEventListener('mouseleave', function(e) {
                if (e.target.tooltip) {
                    document.body.removeChild(e.target.tooltip);
                    e.target.tooltip = null;
                    e.target.title = e.target.getAttribute('data-original-title') || '';
                }
            });
        });
    });
</script>
@endsection