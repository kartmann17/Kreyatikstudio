@extends('admin.layout')

@section('title', 'Créer un nouveau projet')

@section('page_title', 'Créer un nouveau projet')

@section('content_body')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-plus mr-2 text-blue-600"></i>Nouveau projet
                </h3>
                <a href="{{ route('admin.projects.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
        </div>
        
        <form action="{{ route('admin.projects.store') }}" method="POST" class="p-6">
            @csrf
            
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <h4 class="font-medium">Erreurs de validation</h4>
                    </div>
                    <ul class="ml-6 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Titre du projet <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Statut <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="status" 
                                name="status" 
                                required>
                            <option value="en-cours" {{ old('status') == 'en-cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminé" {{ old('status') == 'terminé' ? 'selected' : '' }}>Terminé</option>
                            <option value="en-attente" {{ old('status') == 'en-attente' ? 'selected' : '' }}>En attente</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('client_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="client_id" 
                                name="client_id">
                            <option value="">Sélectionner un client</option>
                            @foreach ($clients ?? [] as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Montant (€)</label>
                        <div class="relative">
                            <input type="number" 
                                   class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price') }}"
                                   step="0.01" 
                                   min="0">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="progress" class="block text-sm font-medium text-gray-700 mb-2">Progression (%)</label>
                    <div class="flex items-center space-x-4">
                        <input type="range" 
                               class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" 
                               id="progress" 
                               name="progress" 
                               min="0" 
                               max="100" 
                               value="{{ old('progress', 0) }}">
                        <span id="progressValue" class="bg-blue-600 text-white px-2 py-1 rounded text-sm font-medium min-w-12 text-center">{{ old('progress', 0) }}%</span>
                    </div>
                    @error('progress')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Décrivez le projet...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.projects.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i> Créer le projet
                </button>
            </div>
        </form>
    </div>
@stop

@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gestion du slider de progression
        const progressSlider = document.getElementById('progress');
        const progressValue = document.getElementById('progressValue');
        
        if (progressSlider && progressValue) {
            progressSlider.addEventListener('input', function() {
                progressValue.textContent = this.value + '%';
            });
        }
    });
</script>
@stop