@extends('admin.layout')

@section('title', 'Gestion des Dépenses')

@section('page_title', 'Gestion des Dépenses')

@section('content_body')
    <!-- Hero Section avec Statistics -->
    <div class="mb-8">
        <!-- Breadcrumb moderne -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white px-4 py-2 rounded-full shadow-sm border">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">
                        <i class="fas fa-home mr-2 text-indigo-500"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-300 mx-2"></i>
                        <span class="text-sm font-medium text-indigo-600">💰 Dépenses</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Dépenses</p>
                        <p class="text-2xl font-bold">{{ number_format($expenses->sum('amount'), 0, ',', ' ') }}€</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-euro-sign text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Nombre de Dépenses</p>
                        <p class="text-2xl font-bold">{{ $expenses->count() }}</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-receipt text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Dépenses Récurrentes</p>
                        <p class="text-2xl font-bold">{{ $expenses->where('is_recurring', true)->count() }}</p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-sync-alt text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Moyenne par Dépense</p>
                        <p class="text-2xl font-bold">{{ $expenses->count() > 0 ? number_format($expenses->sum('amount') / $expenses->count(), 0, ',', ' ') : 0 }}€</p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 rounded-full p-3">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400 text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button type="button" class="text-green-400 hover:text-green-600 transition-colors" onclick="this.parentElement.parentElement.parentElement.style.display='none'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <!-- Header avec design moderne -->
        <div class="bg-gradient-to-r from-slate-800 via-gray-800 to-slate-900 text-white">
            <div class="px-8 py-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="bg-white bg-opacity-10 rounded-full p-3 mr-4">
                            <i class="fas fa-chart-bar text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Gestion des Dépenses</h2>
                            <p class="text-gray-300 text-sm">Suivi et analyse de vos dépenses professionnelles</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.expenses.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Nouvelle Dépense
                        </a>
                        <button id="export-btn" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center">
                            <i class="fas fa-download mr-2"></i>
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filtres Section Moderne -->
        <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl p-6 mb-8 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-2 mr-3">
                        <i class="fas fa-search text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Filtres & Recherche</h3>
                </div>
                <div class="flex items-center space-x-2">
                    <span id="results-count" class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full"></span>
                    <button id="toggle-filters" class="lg:hidden bg-indigo-100 text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-indigo-200 transition-colors">
                        <i class="fas fa-sliders-h mr-1"></i>Filtres
                    </button>
                </div>
            </div>

            <div id="filters-container" class="space-y-4 lg:space-y-0">
                <!-- Barre de recherche principale -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" 
                           id="search-input" 
                           placeholder="🔍 Rechercher une dépense, catégorie..." 
                           class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white shadow-sm">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <kbd class="hidden sm:inline-block px-2 py-1 text-xs text-gray-500 bg-gray-100 rounded">⌘K</kbd>
                    </div>
                </div>

                <!-- Filtres avancés -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="category-filter" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select id="category-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-white">
                            <option value="">🏷️ Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="type-filter" class="block text-sm font-medium text-gray-700 mb-1">Type de dépense</label>
                        <select id="type-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-white">
                            <option value="">📋 Tous les types</option>
                            <option value="one_time">🔄 Ponctuelle</option>
                            <option value="monthly">📅 Mensuelle</option>
                            <option value="annual">🗓️ Annuelle</option>
                        </select>
                    </div>

                    <div>
                        <label for="date-start" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                        <input type="date" id="date-start" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-white">
                    </div>

                    <div>
                        <label for="date-end" class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                        <input type="date" id="date-end" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-white">
                    </div>
                </div>

                <!-- Actions des filtres -->
                <div class="flex flex-wrap items-center justify-between pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        <button id="clear-filters" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium">
                            <i class="fas fa-eraser mr-2"></i>
                            Effacer les filtres
                        </button>
                        <button id="save-filters" class="inline-flex items-center px-4 py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-lg transition-colors font-medium">
                            <i class="fas fa-bookmark mr-2"></i>
                            Sauvegarder
                        </button>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-info-circle"></i>
                        <span>Utilisez Ctrl+F pour une recherche rapide</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau moderne des dépenses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="expensesTable" class="w-full">
                    <thead class="bg-gradient-to-r from-slate-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors group">
                                <div class="flex items-center space-x-2">
                                    <span>💼 Titre</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors group">
                                <div class="flex items-center justify-end space-x-2">
                                    <span>💰 Montant</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors group">
                                <div class="flex items-center space-x-2">
                                    <span>📅 Date</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors group">
                                <div class="flex items-center space-x-2">
                                    <span>🏷️ Catégorie</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors group">
                                <div class="flex items-center space-x-2">
                                    <span>📋 Type</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">🔄 Récurrente</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($expenses as $expense)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-receipt text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $expense->title }}</div>
                                        @if($expense->description)
                                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($expense->description, 50) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-lg font-bold text-green-600">{{ number_format($expense->amount, 0, ',', ' ') }}€</div>
                                <div class="text-xs text-gray-500">{{ number_format($expense->amount, 2, ',', ' ') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($expense->expense_date)->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800">
                                    {{ $expense->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($expense->type == 'one_time')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800">
                                        🔄 Ponctuelle
                                    </span>
                                @elseif($expense->type == 'monthly')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">
                                        📅 Mensuelle
                                    </span>
                                @elseif($expense->type == 'annual')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800">
                                        🗓️ Annuelle
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($expense->is_recurring)
                                    <div class="inline-flex items-center justify-center w-8 h-8 bg-green-100 rounded-full">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                @else
                                    <div class="inline-flex items-center justify-center w-8 h-8 bg-red-100 rounded-full">
                                        <i class="fas fa-times text-red-600"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    @if(Route::has('admin.expenses.show'))
                                        <a href="{{ route('admin.expenses.show', $expense->id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors"
                                           title="Voir">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.expenses.edit', $expense->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors"
                                       title="Modifier">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <button type="button" 
                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors delete-expense" 
                                            data-id="{{ $expense->id }}" 
                                            data-title="{{ $expense->title }}" 
                                            title="Supprimer">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gradient-to-r from-slate-800 to-gray-900 text-white">
                        <tr>
                            <td class="px-6 py-4 text-left font-bold">
                                <div class="flex items-center">
                                    <i class="fas fa-calculator mr-2"></i>
                                    Total des dépenses
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="text-2xl font-bold">{{ number_format($expenses->sum('amount'), 0, ',', ' ') }}€</div>
                                <div class="text-sm opacity-75">{{ $expenses->count() }} dépense(s)</div>
                            </td>
                            <td colspan="5" class="px-6 py-4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-6">
                {{ $expenses->links() }}
            </div>
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
    // Variables pour le filtrage
    let expenses = [];
    let filteredExpenses = [];
    let currentSort = { column: 2, direction: 'desc' };
    const table = document.getElementById('expensesTable');
    const tbody = table.querySelector('tbody');
    const searchInput = document.getElementById('search-input');
    const categoryFilter = document.getElementById('category-filter');
    const typeFilter = document.getElementById('type-filter');
    const dateStart = document.getElementById('date-start');
    const dateEnd = document.getElementById('date-end');
    const clearFiltersBtn = document.getElementById('clear-filters');

    // Récupérer les données depuis le tableau
    function initializeData() {
        const rows = tbody.querySelectorAll('tr');
        expenses = Array.from(rows).map(row => ({
            element: row,
            title: row.cells[0].textContent.trim(),
            amount: parseFloat(row.cells[1].textContent.replace(/[^\d,.-]/g, '').replace(',', '.')),
            date: row.cells[2].textContent.trim(),
            category: row.cells[3].textContent.trim(),
            type: row.cells[4].textContent.trim(),
            recurring: row.cells[5].querySelector('i').classList.contains('fa-check-circle')
        }));
        filteredExpenses = [...expenses];
    }

    // Fonction de filtrage
    function filterExpenses() {
        filteredExpenses = expenses.filter(expense => {
            // Filtre par recherche globale
            if (searchInput.value) {
                const searchTerm = searchInput.value.toLowerCase();
                const searchableText = (expense.title + ' ' + expense.category).toLowerCase();
                if (!searchableText.includes(searchTerm)) {
                    return false;
                }
            }

            // Filtre par catégorie
            if (categoryFilter.value && !expense.category.includes(categoryFilter.value)) {
                return false;
            }

            // Filtre par type
            if (typeFilter.value) {
                const typeMap = {
                    'one_time': 'Ponctuelle',
                    'monthly': 'Mensuelle', 
                    'annual': 'Annuelle'
                };
                if (!expense.type.includes(typeMap[typeFilter.value])) {
                    return false;
                }
            }

            // Filtre par dates
            if (dateStart.value || dateEnd.value) {
                const expenseDate = parseDate(expense.date);
                const startDate = dateStart.value ? new Date(dateStart.value) : null;
                const endDate = dateEnd.value ? new Date(dateEnd.value) : null;

                if (startDate && expenseDate < startDate) return false;
                if (endDate && expenseDate > endDate) return false;
            }

            return true;
        });

        sortExpenses();
        renderTable();
    }

    // Fonction de tri
    function sortExpenses() {
        filteredExpenses.sort((a, b) => {
            let aValue, bValue;
            
            switch(currentSort.column) {
                case 0: // Titre
                    aValue = a.title.toLowerCase();
                    bValue = b.title.toLowerCase();
                    break;
                case 1: // Montant
                    aValue = a.amount;
                    bValue = b.amount;
                    break;
                case 2: // Date
                    aValue = parseDate(a.date);
                    bValue = parseDate(b.date);
                    break;
                case 3: // Catégorie
                    aValue = a.category.toLowerCase();
                    bValue = b.category.toLowerCase();
                    break;
                case 4: // Type
                    aValue = a.type.toLowerCase();
                    bValue = b.type.toLowerCase();
                    break;
                default:
                    return 0;
            }

            if (aValue < bValue) return currentSort.direction === 'asc' ? -1 : 1;
            if (aValue > bValue) return currentSort.direction === 'asc' ? 1 : -1;
            return 0;
        });
    }

    // Fonction pour effacer tous les filtres
    function clearAllFilters() {
        searchInput.value = '';
        categoryFilter.value = '';
        typeFilter.value = '';
        dateStart.value = '';
        dateEnd.value = '';
        filterExpenses();
    }

    // Fonction pour parser la date française
    function parseDate(dateStr) {
        const parts = dateStr.split('/');
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }

    // Fonction pour afficher le tableau
    function renderTable() {
        // Masquer toutes les lignes
        expenses.forEach(expense => {
            expense.element.style.display = 'none';
        });

        // Afficher les lignes filtrées
        filteredExpenses.forEach(expense => {
            expense.element.style.display = '';
        });

        // Mettre à jour le total et le compteur
        updateTotal();
        updateResultsCount();
    }

    // Mettre à jour le total
    function updateTotal() {
        const total = filteredExpenses.reduce((sum, expense) => sum + expense.amount, 0);
        const totalAmountDiv = table.querySelector('tfoot .text-2xl');
        const totalCountDiv = table.querySelector('tfoot .text-sm');
        
        if (totalAmountDiv) {
            totalAmountDiv.textContent = new Intl.NumberFormat('fr-FR', {
                style: 'currency',
                currency: 'EUR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(total);
        }
        
        if (totalCountDiv) {
            totalCountDiv.textContent = `${filteredExpenses.length} dépense(s) affichée(s)`;
        }
    }

    // Event listeners pour les filtres
    searchInput.addEventListener('input', filterExpenses);
    categoryFilter.addEventListener('change', filterExpenses);
    typeFilter.addEventListener('change', filterExpenses);
    dateStart.addEventListener('change', filterExpenses);
    dateEnd.addEventListener('change', filterExpenses);
    clearFiltersBtn.addEventListener('click', clearAllFilters);

    // Mettre à jour le compteur de résultats
    function updateResultsCount() {
        const resultsCount = document.getElementById('results-count');
        const count = filteredExpenses.length;
        const total = expenses.length;
        resultsCount.textContent = `${count} sur ${total} dépenses`;
        resultsCount.className = count === total ? 
            'text-sm text-green-600 bg-green-100 px-3 py-1 rounded-full font-medium' :
            'text-sm text-blue-600 bg-blue-100 px-3 py-1 rounded-full font-medium';
    }

    // Raccourci clavier pour la recherche
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
    });

    // Fonction d'export (placeholder)
    document.getElementById('export-btn').addEventListener('click', function() {
        Swal.fire({
            title: 'Exporter les données',
            text: 'Choisissez le format d\'export',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Export Excel',
            cancelButtonText: 'Export PDF',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Export Excel logic
                Swal.fire('Export Excel', 'Fonctionnalité à implémenter', 'info');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Export PDF logic
                Swal.fire('Export PDF', 'Fonctionnalité à implémenter', 'info');
            }
        });
    });

    // Event listeners pour le tri sur les en-têtes
    const headers = table.querySelectorAll('th');
    headers.forEach((header, index) => {
        if (index < 5) { // Seulement les colonnes triables
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                if (currentSort.column === index) {
                    currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSort.column = index;
                    currentSort.direction = 'asc';
                }
                
                // Mettre à jour les indicateurs visuels
                headers.forEach(h => h.classList.remove('bg-orange-100'));
                header.classList.add('bg-orange-100');
                
                filterExpenses();
            });
        }
    });

    // Initialisation
    initializeData();
    filterExpenses();

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

    // Function to attach delete handlers
    function attachDeleteHandlers() {
        const deleteButtons = document.querySelectorAll('.delete-expense');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                openDeleteModal(id, title);
            });
        });
    }

    // Initial attachment
    attachDeleteHandlers();

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