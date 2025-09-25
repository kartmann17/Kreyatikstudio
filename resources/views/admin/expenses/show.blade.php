@extends('admin.layout')

@section('title', 'Détail de la Dépense')

@section('page_title', 'Détail de la Dépense')

@section('content_body')
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home mr-2"></i>
                    Tableau de bord
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('admin.expenses.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">Dépenses</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-sm font-medium text-gray-500">{{ $expense->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-t-xl px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                        <i class="fas fa-receipt mr-2"></i>
                        Informations de la Dépense
                    </h3>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center">
                            <i class="fas fa-edit mr-2"></i> Modifier
                        </a>
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center delete-expense" data-id="{{ $expense->id }}" data-title="{{ $expense->title }}">
                            <i class="fas fa-trash mr-2"></i> Supprimer
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Titre</th>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $expense->title }}</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Montant</th>
                                <td class="px-6 py-4 text-sm font-bold text-right text-indigo-600">{{ number_format($expense->amount, 2, ',', ' ') }} €</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Date</th>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $expense->expense_date ? $expense->expense_date->format('d/m/Y') : 'Non définie' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Catégorie</th>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $expense->category ?? 'Non catégorisé' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Type</th>
                                <td class="px-6 py-4">
                                    @if ($expense->type == 'one_time')
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">🔄 Ponctuelle</span>
                                    @elseif ($expense->type == 'monthly')
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">📅 Mensuelle</span>
                                    @elseif ($expense->type == 'annual')
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">🗓️ Annuelle</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Récurrent</th>
                                <td class="px-6 py-4">
                                    @if ($expense->is_recurring)
                                        <span class="flex items-center text-green-600 font-semibold"><i class="fas fa-check-circle mr-2"></i> Oui</span>
                                    @else
                                        <span class="flex items-center text-red-500 font-semibold"><i class="fas fa-times-circle mr-2"></i> Non</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Description</th>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $expense->description ?? 'Aucune description fournie' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Notes</th>
                                <td class="px-6 py-4">
                                    @if ($expense->notes)
                                        <div class="text-sm text-gray-600 whitespace-pre-line">
                                            {!! nl2br(e($expense->notes)) !!}
                                        </div>
                                    @else
                                        <em class="text-gray-400 text-sm">Aucune note</em>
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Créé le</th>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $expense->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold text-gray-700 bg-gray-50">Dernière modification</th>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $expense->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-t-xl px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-history mr-2"></i>
                        Dépenses similaires
                    </h3>
                </div>
                <div class="p-6">
                    @if (count($similarExpenses) > 0)
                        <div class="space-y-3">
                            @foreach ($similarExpenses as $similar)
                                <a href="{{ route('admin.expenses.show', $similar->id) }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-all duration-200 transform hover:scale-105 border border-gray-200 hover:border-green-300">
                                    <div class="flex justify-between items-start mb-2">
                                        <h6 class="text-sm font-semibold text-gray-900 truncate">{{ $similar->title }}</h6>
                                        <span class="text-xs text-gray-500 ml-2 whitespace-nowrap">{{ $similar->expense_date ? $similar->expense_date->format('d/m/Y') : 'Non définie' }}</span>
                                    </div>
                                    <p class="text-right text-sm font-bold text-green-600 mb-1">{{ number_format($similar->amount, 2, ',', ' ') }} €</p>
                                    @if ($similar->category)
                                        <span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{ $similar->category }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Aucune dépense similaire trouvée</p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($expense->type != 'one_time')
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-t-xl px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Occurrences de cette dépense
                    </h3>
                </div>
                <div class="p-6">
                    @if (count($relatedExpenses) > 0)
                        <div class="space-y-3">
                            @foreach ($relatedExpenses as $related)
                                <a href="{{ route('admin.expenses.show', $related->id) }}" class="block p-4 rounded-lg transition-all duration-200 transform hover:scale-105 border-2 {{ $related->id == $expense->id ? 'bg-purple-50 border-purple-300 ring-2 ring-purple-200' : 'bg-gray-50 hover:bg-gray-100 border-gray-200 hover:border-purple-300' }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <h6 class="text-sm font-semibold {{ $related->id == $expense->id ? 'text-purple-900' : 'text-gray-900' }}">
                                            {{ $related->expense_date ? $related->expense_date->format('M Y') : 'Non définie' }}
                                            @if ($related->id == $expense->id)
                                                <span class="ml-2 text-xs bg-purple-200 text-purple-800 px-2 py-1 rounded-full">Actuel</span>
                                            @endif
                                        </h6>
                                        <span class="text-xs text-gray-500 ml-2 whitespace-nowrap">{{ $related->expense_date ? $related->expense_date->format('d/m/Y') : 'Non définie' }}</span>
                                    </div>
                                    <p class="text-right text-sm font-bold {{ $related->id == $expense->id ? 'text-purple-600' : 'text-gray-600' }}">{{ number_format($related->amount, 2, ',', ' ') }} €</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Aucune occurrence associée trouvée</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 opacity-0 transition-opacity duration-300">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform scale-95 transition-all duration-300">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-red-400 bg-opacity-30 rounded-full p-3 mr-3">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Confirmation de suppression</h3>
                    </div>
                    <button type="button" class="text-red-100 hover:text-white transition-colors duration-200 p-2 hover:bg-red-400 hover:bg-opacity-20 rounded-full" onclick="closeDeleteModal()">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Êtes-vous sûr de vouloir supprimer la dépense ?
                    </p>
                    <div class="mt-4 p-4 bg-gray-50 rounded-xl">
                        <p class="font-semibold text-gray-900" id="expense-title"></p>
                    </div>
                    <p class="text-sm text-red-600 mt-3 font-medium">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Cette action est irréversible
                    </p>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex justify-end space-x-3 p-6 bg-gray-50 rounded-b-2xl">
                <button type="button" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition-all duration-200 transform hover:scale-105" onclick="closeDeleteModal()">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                <form id="delete-form" method="POST" class="inline">
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
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal de suppression moderne
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('delete-form');
    const expenseTitle = document.getElementById('expense-title');

    // Fonctions du modal
    window.openDeleteModal = function(id, title) {
        deleteForm.action = `{{ url('admin/expenses') }}/${id}`;
        expenseTitle.textContent = title;
        
        deleteModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        setTimeout(() => {
            deleteModal.classList.remove('opacity-0');
            deleteModal.querySelector('.relative').classList.remove('scale-95');
            deleteModal.querySelector('.relative').classList.add('scale-100');
        }, 10);
    };

    window.closeDeleteModal = function() {
        deleteModal.classList.add('opacity-0');
        deleteModal.querySelector('.relative').classList.remove('scale-100');
        deleteModal.querySelector('.relative').classList.add('scale-95');
        
        setTimeout(() => {
            deleteModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    };

    // Event listeners pour les boutons de suppression
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-expense')) {
            e.preventDefault();
            const button = e.target.closest('.delete-expense');
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            openDeleteModal(id, title);
        }
    });

    // Fermer modal avec Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
            closeDeleteModal();
        }
    });

    // Fermer modal en cliquant en dehors
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });
});
</script>
@endsection 