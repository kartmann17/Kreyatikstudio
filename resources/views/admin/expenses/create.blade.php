@extends('admin.layout')

@section('title', 'Ajouter une Dépense')

@section('page_title', 'Ajouter une Dépense')

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
                    <span class="text-sm font-medium text-gray-500">Ajouter</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                Ajouter une nouvelle dépense
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.expenses.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Titre et Montant -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Titre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required
                               placeholder="Ex: Hébergement site web">
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
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('amount') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" required
                                   placeholder="0.00">
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
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('expense_date') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                               id="expense_date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required>
                        @error('expense_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <div class="flex">
                            <select class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('category') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                    id="category" name="category">
                                <option value="">Sélectionner une catégorie</option>
                                <optgroup label="💻 Développement" class="bg-blue-50">
                                    <option value="Hébergement" {{ old('category') == 'Hébergement' ? 'selected' : '' }}>Hébergement</option>
                                    <option value="Nom de domaine" {{ old('category') == 'Nom de domaine' ? 'selected' : '' }}>Nom de domaine</option>
                                    <option value="Logiciels" {{ old('category') == 'Logiciels' ? 'selected' : '' }}>Logiciels</option>
                                    <option value="Extensions/Plugins" {{ old('category') == 'Extensions/Plugins' ? 'selected' : '' }}>Extensions/Plugins</option>
                                    <option value="API & Services" {{ old('category') == 'API & Services' ? 'selected' : '' }}>API & Services</option>
                                    <option value="Freelance" {{ old('category') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                </optgroup>
                                <optgroup label="🖥️ Matériel" class="bg-green-50">
                                    <option value="Matériel informatique" {{ old('category') == 'Matériel informatique' ? 'selected' : '' }}>Matériel informatique</option>
                                    <option value="Périphériques" {{ old('category') == 'Périphériques' ? 'selected' : '' }}>Périphériques</option>
                                    <option value="Bureau/Setup" {{ old('category') == 'Bureau/Setup' ? 'selected' : '' }}>Bureau/Setup</option>
                                </optgroup>
                                <optgroup label="📚 Formations" class="bg-purple-50">
                                    <option value="Cours & Formations" {{ old('category') == 'Cours & Formations' ? 'selected' : '' }}>Cours & Formations</option>
                                    <option value="Livres" {{ old('category') == 'Livres' ? 'selected' : '' }}>Livres</option>
                                    <option value="Conférence" {{ old('category') == 'Conférence' ? 'selected' : '' }}>Conférence</option>
                                </optgroup>
                                <optgroup label="🏢 Bureautique" class="bg-yellow-50">
                                    <option value="Internet" {{ old('category') == 'Internet' ? 'selected' : '' }}>Internet</option>
                                    <option value="Téléphone" {{ old('category') == 'Téléphone' ? 'selected' : '' }}>Téléphone</option>
                                    <option value="Espace de travail" {{ old('category') == 'Espace de travail' ? 'selected' : '' }}>Espace de travail</option>
                                </optgroup>
                                <optgroup label="📋 Autres" class="bg-gray-50">
                                    <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="Comptabilité" {{ old('category') == 'Comptabilité' ? 'selected' : '' }}>Comptabilité</option>
                                    <option value="Assurance pro" {{ old('category') == 'Assurance pro' ? 'selected' : '' }}>Assurance pro</option>
                                    <option value="Déplacements" {{ old('category') == 'Déplacements' ? 'selected' : '' }}>Déplacements</option>
                                    <option value="Autres" {{ old('category') == 'Autres' ? 'selected' : '' }}>Autres</option>
                                </optgroup>
                            </select>
                            <input type="text" 
                                   class="flex-1 px-4 py-2 border border-gray-300 border-l-0 rounded-r-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors hidden @error('custom_category') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="custom_category" placeholder="Autre catégorie">
                            <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 border-l-0 rounded-r-lg transition-colors" 
                                    type="button" id="toggle-custom-category">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Type et Récurrence -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="type" class="block text-sm font-medium text-gray-700">
                            Type de dépense <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('type') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="type" name="type" required>
                            <option value="one_time" {{ old('type', 'one_time') == 'one_time' ? 'selected' : '' }}>🔄 Ponctuelle</option>
                            <option value="monthly" {{ old('type') == 'monthly' ? 'selected' : '' }}>📅 Mensuelle</option>
                            <option value="annual" {{ old('type') == 'annual' ? 'selected' : '' }}>🗓️ Annuelle</option>
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
                                       class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500 border-gray-300" 
                                       id="is_recurring" name="is_recurring" value="1" {{ old('is_recurring') ? 'checked' : '' }}>
                                <span class="ml-3 text-sm text-gray-700">Dépense récurrente</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-2">Cochez cette case si cette dépense se répète régulièrement</p>
                        </div>
                        @error('is_recurring')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                              id="description" name="description" rows="4" 
                              placeholder="Décrivez cette dépense...">{{ old('description') }}</textarea>
                    @error('description')
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
                            class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Enregistrer la dépense
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
    const categorySelect = document.getElementById('category');
    const customCategoryInput = document.getElementById('custom_category');
    const toggleButton = document.getElementById('toggle-custom-category');
    const amountInput = document.getElementById('amount');
    
    let customMode = false;
    
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
    
    // Gestion de la catégorie personnalisée moderne
    toggleButton.addEventListener('click', function() {
        customMode = !customMode;
        
        if (customMode) {
            // Mode catégorie personnalisée
            categorySelect.classList.add('hidden');
            customCategoryInput.classList.remove('hidden');
            toggleButton.innerHTML = '<i class="fas fa-minus"></i>';
            toggleButton.classList.remove('bg-gray-100', 'hover:bg-gray-200');
            toggleButton.classList.add('bg-red-100', 'hover:bg-red-200', 'text-red-600');
            
            customCategoryInput.name = 'category';
            categorySelect.name = '';
            customCategoryInput.focus();
        } else {
            // Mode catégorie prédéfinie
            categorySelect.classList.remove('hidden');
            customCategoryInput.classList.add('hidden');
            toggleButton.innerHTML = '<i class="fas fa-plus"></i>';
            toggleButton.classList.remove('bg-red-100', 'hover:bg-red-200', 'text-red-600');
            toggleButton.classList.add('bg-gray-100', 'hover:bg-gray-200');
            
            categorySelect.name = 'category';
            customCategoryInput.name = '';
            categorySelect.focus();
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
            this.classList.add('border-green-500');
        } else {
            this.classList.remove('border-green-500');
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
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Enregistrement...';
        submitButton.disabled = true;
    });
    
    // Système de notifications avec SweetAlert2
    function showNotification(message, type = 'info') {
        Swal.fire({
            title: type === 'success' ? 'Succès' : type === 'error' ? 'Erreur' : 'Information',
            text: message,
            icon: type,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
    
    // Déclenchement initial pour l'état par défaut
    if (typeSelect.value === 'monthly' || typeSelect.value === 'annual') {
        recurringCheckbox.checked = true;
    }
});
</script>
@endsection 