@extends('admin.layout')

@section('title', 'Créer un Plan Tarifaire')

@section('page_title', 'Créer un Plan Tarifaire')

@section('content_body')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Créer un Plan Tarifaire</h1>
    
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Tableau de bord</a></li>
            <li class="text-gray-500">/</li>
            <li><a href="{{ route('admin.pricing-plans.index') }}" class="text-blue-600 hover:text-blue-800">Plans Tarifaires</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-700">Créer</li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex items-center space-x-2">
                <i class="fas fa-plus text-gray-500"></i>
                <h3 class="text-lg font-medium text-gray-900">Nouveau plan tarifaire</h3>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.pricing-plans.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du plan</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-300 @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                        <p class="mt-1 text-sm text-gray-500">Laissez vide pour générer automatiquement à partir du nom</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Section Promotion -->
                <div class="mb-6">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center mb-4">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" id="has_promotion" name="has_promotion" value="1" {{ old('has_promotion') ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-gray-700" for="has_promotion">Activer une promotion</label>
                        </div>
                        
                        <div id="promotion_container" style="{{ old('has_promotion') ? '' : 'display: none;' }}">
                            <div class="mb-4">
                                <label for="promotion_text" class="block text-sm font-medium text-gray-700 mb-2">Texte de la promotion</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('promotion_text') border-red-300 @enderror" id="promotion_text" name="promotion_text" value="{{ old('promotion_text', 'Offre spéciale') }}" placeholder="Ex: -20% jusqu'au 31 décembre">
                                @error('promotion_text')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="original_monthly_price" class="block text-sm font-medium text-gray-700 mb-2">Prix mensuel original</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-500">€</span>
                                        <input type="number" step="0.01" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('original_monthly_price') border-red-300 @enderror" id="original_monthly_price" name="original_monthly_price" value="{{ old('original_monthly_price') }}" placeholder="Prix avant promotion">
                                    </div>
                                    @error('original_monthly_price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="original_annual_price" class="block text-sm font-medium text-gray-700 mb-2">Prix annuel original</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-500">€</span>
                                        <input type="number" step="0.01" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('original_annual_price') border-red-300 @enderror" id="original_annual_price" name="original_annual_price" value="{{ old('original_annual_price') }}" placeholder="Prix avant promotion">
                                    </div>
                                    @error('original_annual_price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="monthly_price" class="block text-sm font-medium text-gray-700 mb-2">Prix mensuel <span class="text-sm text-gray-500">(prix affiché)</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">€</span>
                            <input type="number" step="0.01" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('monthly_price') border-red-300 @enderror" id="monthly_price" name="monthly_price" value="{{ old('monthly_price', 0) }}">
                        </div>
                        @error('monthly_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="annual_price" class="block text-sm font-medium text-gray-700 mb-2">Prix annuel <span class="text-sm text-gray-500">(prix affiché)</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">€</span>
                            <input type="number" step="0.01" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('annual_price') border-red-300 @enderror" id="annual_price" name="annual_price" value="{{ old('annual_price', 0) }}">
                        </div>
                        @error('annual_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="intro_text" class="block text-sm font-medium text-gray-700 mb-2">Texte d'introduction</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('intro_text') border-red-300 @enderror" id="intro_text" name="intro_text" value="{{ old('intro_text') }}">
                        @error('intro_text')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Texte du bouton</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('button_text') border-red-300 @enderror" id="button_text" name="button_text" value="{{ old('button_text', 'Choisir ce plan') }}">
                        @error('button_text')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="features" class="block text-sm font-medium text-gray-700 mb-2">Caractéristiques</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('features') border-red-300 @enderror" id="features" name="features" rows="5">{{ old('features') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Entrez une fonctionnalité par ligne</p>
                    @error('features')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <div class="flex items-center mb-4">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" id="is_highlighted" name="is_highlighted" value="1" {{ old('is_highlighted') ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm text-gray-700" for="is_highlighted">Mettre en avant ce plan</label>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div id="highlight_text_container" style="{{ old('is_highlighted') ? '' : 'display: none;' }}">
                            <label for="highlight_text" class="block text-sm font-medium text-gray-700 mb-2">Texte de mise en avant</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('highlight_text') border-red-300 @enderror" id="highlight_text" name="highlight_text" value="{{ old('highlight_text', 'Recommandé') }}">
                            @error('highlight_text')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <div class="flex items-center mb-4">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm text-gray-700" for="is_active">Activer ce plan</label>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center mb-4">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" id="is_custom_plan" name="is_custom_plan" value="1" {{ old('is_custom_plan') ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm text-gray-700" for="is_custom_plan">Plan sur mesure</label>
                        </div>
                    </div>
                    <div>
                        <div id="custom_plan_text_container" style="{{ old('is_custom_plan') ? '' : 'display: none;' }}">
                            <label for="custom_plan_text" class="block text-sm font-medium text-gray-700 mb-2">Texte du plan sur mesure</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('custom_plan_text') border-red-300 @enderror" id="custom_plan_text" name="custom_plan_text" value="{{ old('custom_plan_text', 'Contactez-nous pour un devis') }}">
                            @error('custom_plan_text')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-300 @enderror" id="order" name="order" value="{{ old('order', 999) }}" min="1" max="999">
                    <p class="mt-1 text-sm text-gray-500">Les plans sont affichés du plus petit nombre au plus grand</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.pricing-plans.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition-colors">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-génération du slug
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        nameInput.addEventListener('input', function() {
            if (!slugInput.value) {
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
            }
        });

        // Afficher/masquer le texte de mise en avant
        const isHighlightedCheckbox = document.getElementById('is_highlighted');
        const highlightTextContainer = document.getElementById('highlight_text_container');
        
        isHighlightedCheckbox.addEventListener('change', function() {
            highlightTextContainer.style.display = this.checked ? 'block' : 'none';
        });

        // Afficher/masquer le texte du plan sur mesure
        const isCustomPlanCheckbox = document.getElementById('is_custom_plan');
        const customPlanTextContainer = document.getElementById('custom_plan_text_container');
        
        isCustomPlanCheckbox.addEventListener('change', function() {
            customPlanTextContainer.style.display = this.checked ? 'block' : 'none';
        });

        // Afficher/masquer la section promotion
        const hasPromotionCheckbox = document.getElementById('has_promotion');
        const promotionContainer = document.getElementById('promotion_container');
        
        hasPromotionCheckbox.addEventListener('change', function() {
            promotionContainer.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@endsection 