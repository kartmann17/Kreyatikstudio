@extends('admin.layout')

@section('title', 'Modifier une Dépense')

@section('page_title', 'Modifier une Dépense')

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
                    <span class="text-sm font-medium text-gray-500">Modifier</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Modifier la dépense : {{ $expense->title }}
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.expenses.update', $expense->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Titre et Montant -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Titre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                               id="title" name="title" value="{{ old('title', $expense->title) }}" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="amount" class="block text-sm font-medium text-gray-700">
                            Montant (€) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" step="0.01" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('amount') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="amount" name="amount" value="{{ old('amount', $expense->amount) }}" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">€</span>
                            </div>
                        </div>
                        @error('amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Date et Catégorie -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="expense_date" class="block text-sm font-medium text-gray-700">
                            Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('expense_date') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                               id="expense_date" name="expense_date" value="{{ old('expense_date', $expense->expense_date ? $expense->expense_date->format('Y-m-d') : date('Y-m-d')) }}" required>
                        @error('expense_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('category') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                               id="category" name="category" value="{{ old('category', $expense->category) }}" 
                               placeholder="Ex: Hébergement, Logiciels..."
                               list="category-list">
                        <datalist id="category-list">
                            <option value="Hébergement">Hébergement</option>
                            <option value="Nom de domaine">Nom de domaine</option>
                            <option value="Logiciels">Logiciels</option>
                            <option value="Matériel informatique">Matériel informatique</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Comptabilité">Comptabilité</option>
                            <option value="Formation">Formation</option>
                        </datalist>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Type et Récurrence -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="type" class="block text-sm font-medium text-gray-700">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('type') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="type" name="type" required>
                            <option value="one_time" {{ old('type', $expense->type) == 'one_time' ? 'selected' : '' }}>🔄 Ponctuelle</option>
                            <option value="monthly" {{ old('type', $expense->type) == 'monthly' ? 'selected' : '' }}>📅 Mensuelle</option>
                            <option value="annual" {{ old('type', $expense->type) == 'annual' ? 'selected' : '' }}>🗓️ Annuelle</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Récurrence</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300" 
                                       id="is_recurring" name="is_recurring" value="1" {{ old('is_recurring', $expense->is_recurring) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm text-gray-700">Dépense récurrente</span>
                            </label>
                        </div>
                        @error('is_recurring')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                              id="description" name="description" rows="4" 
                              placeholder="Décrivez cette dépense...">{{ old('description', $expense->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="space-y-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none @error('notes') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                              id="notes" name="notes" rows="2" 
                              placeholder="Notes additionnelles...">{{ old('notes', $expense->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.expenses.index') }}" 
                       class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 text-center">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments du formulaire
    const typeSelect = document.getElementById('type');
    const recurringCheckbox = document.getElementById('is_recurring');
    const amountInput = document.getElementById('amount');
    
    // Auto-check récurrence pour les dépenses mensuelles/annuelles
    typeSelect.addEventListener('change', function() {
        if (this.value === 'monthly' || this.value === 'annual') {
            recurringCheckbox.checked = true;
            // Animation de notification
            animateCheckbox(recurringCheckbox);
        } else if (this.value === 'one_time') {
            recurringCheckbox.checked = false;
        }
    });
    
    // Animation pour les changements
    function animateCheckbox(element) {
        element.parentElement.classList.add('animate-pulse');
        setTimeout(() => {
            element.parentElement.classList.remove('animate-pulse');
        }, 1000);
    }
    
    // Validation en temps réel du montant
    amountInput.addEventListener('input', function() {
        const value = parseFloat(this.value);
        if (value && value > 0) {
            this.classList.remove('border-red-500');
            this.classList.add('border-blue-500');
        } else {
            this.classList.remove('border-blue-500');
        }
    });
    
    // Validation du formulaire avant soumission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const amount = parseFloat(document.getElementById('amount').value);
        
        if (!title) {
            e.preventDefault();
            document.getElementById('title').focus();
            showNotification('Le titre est requis', 'error');
            return;
        }
        
        if (!amount || amount <= 0) {
            e.preventDefault();
            document.getElementById('amount').focus();
            showNotification('Le montant doit être supérieur à 0', 'error');
            return;
        }
        
        // Animation du bouton de soumission
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mise à jour...';
        submitButton.disabled = true;
    });
    
    // Système de notifications
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
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => notification.classList.remove('translate-x-full'), 100);
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Déclenchement initial pour l'état par défaut
    if (typeSelect.value === 'monthly' || typeSelect.value === 'annual') {
        recurringCheckbox.checked = true;
    }
});
</script>
@endsection 