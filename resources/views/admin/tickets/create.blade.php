@extends('admin.layout')

@section('title', 'Créer un nouveau ticket')
@section('page_title', 'Créer un nouveau ticket')

@section('content_header')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 py-6">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Créer un nouveau ticket</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            <i class="fas fa-home mr-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li>
                        <a href="{{ route('admin.tickets.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            <i class="fas fa-ticket-alt mr-1"></i>Tickets
                        </a>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li class="font-medium text-gray-900">Créer</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>
    </div>
</div>
@endsection

@section('content_body')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <div class="flex items-center">
                <i class="fas fa-plus-circle text-white text-xl mr-3"></i>
                <h2 class="text-xl font-bold text-white">Informations du ticket</h2>
            </div>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 mb-2">Veuillez corriger les erreurs suivantes :</h3>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.tickets.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-500 mr-2"></i>Client
                        </label>
                        <select 
                            name="client_id" 
                            id="client_id" 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('client_id') border-red-500 ring-red-200 @enderror">
                            <option value="">Sélectionner un client (optionnel)</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-project-diagram text-blue-500 mr-2"></i>Projet
                        </label>
                        <select 
                            name="project_id" 
                            id="project_id" 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('project_id') border-red-500 ring-red-200 @enderror">
                            <option value="">Sélectionner un projet (optionnel)</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->title }} ({{ $project->client->name ?? 'Sans client' }})
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading text-blue-500 mr-2"></i>Titre du ticket *
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}" 
                        required 
                        class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('title') border-red-500 ring-red-200 @enderror" 
                        placeholder="Titre du ticket">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left text-blue-500 mr-2"></i>Description *
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required 
                        rows="5"
                        class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none @error('description') border-red-500 ring-red-200 @enderror" 
                        placeholder="Description détaillée du problème ou de la demande">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-exclamation text-blue-500 mr-2"></i>Priorité *
                        </label>
                        <select 
                            name="priority" 
                            id="priority" 
                            required 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('priority') border-red-500 ring-red-200 @enderror">
                            <option value="basse" {{ old('priority') == 'basse' ? 'selected' : '' }}>
                                🟢 Basse
                            </option>
                            <option value="moyenne" {{ old('priority', 'moyenne') == 'moyenne' ? 'selected' : '' }}>
                                🟡 Moyenne
                            </option>
                            <option value="haute" {{ old('priority') == 'haute' ? 'selected' : '' }}>
                                🟠 Haute
                            </option>
                            <option value="urgente" {{ old('priority') == 'urgente' ? 'selected' : '' }}>
                                🔴 Urgente
                            </option>
                        </select>
                        @error('priority')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-flag text-blue-500 mr-2"></i>Statut *
                        </label>
                        <select 
                            name="status" 
                            id="status" 
                            required 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('status') border-red-500 ring-red-200 @enderror">
                            <option value="ouvert" {{ old('status', 'ouvert') == 'ouvert' ? 'selected' : '' }}>
                                🔓 Ouvert
                            </option>
                            <option value="en-cours" {{ old('status') == 'en-cours' ? 'selected' : '' }}>
                                ⚙️ En cours
                            </option>
                            <option value="résolu" {{ old('status') == 'résolu' ? 'selected' : '' }}>
                                ✅ Résolu
                            </option>
                            <option value="fermé" {{ old('status') == 'fermé' ? 'selected' : '' }}>
                                🔒 Fermé
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user-tag text-blue-500 mr-2"></i>Assigner à
                        </label>
                        <select 
                            name="assigned_to" 
                            id="assigned_to" 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('assigned_to') border-red-500 ring-red-200 @enderror">
                            <option value="">Non assigné</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment text-blue-500 mr-2"></i>Commentaire initial (optionnel)
                    </label>
                    <textarea 
                        id="comment" 
                        name="comment" 
                        rows="3"
                        class="block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none @error('comment') border-red-500 ring-red-200 @enderror" 
                        placeholder="Commentaire initial (optionnel)">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="is_private" 
                        name="is_private" 
                        {{ old('is_private') ? 'checked' : '' }}
                        class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <label for="is_private" class="ml-3 text-sm text-gray-700">
                        <i class="fas fa-lock text-gray-500 mr-2"></i>
                        <span class="font-medium">Commentaire privé</span> (visible uniquement par l'équipe)
                    </label>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Créer le ticket
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const clientSelect = document.getElementById('client_id');
    const projectSelect = document.getElementById('project_id');

    function resetProjects() {
        const firstOption = projectSelect.querySelector('option:first-child');
        projectSelect.innerHTML = '';
        projectSelect.appendChild(firstOption);
    }

    function addOption(value, label, selected = false) {
        const opt = document.createElement('option');
        opt.value = value;
        opt.textContent = label;
        if (selected) opt.selected = true;
        projectSelect.appendChild(opt);
    }

    clientSelect.addEventListener('change', function () {
        const clientId = this.value;
        resetProjects();

        if (clientId) {
            @foreach($projects as $project)
                if ('{{ $project->client_id }}' == clientId) {
                    addOption('{{ $project->id }}', `{{ $project->title }}`);
                }
            @endforeach
        } else {
            @foreach($projects as $project)
                addOption('{{ $project->id }}', `{{ $project->title }} ({{ $project->client->name ?? "Sans client" }})`, '{{ old('project_id') }}' == '{{ $project->id }}');
            @endforeach
        }
    });

    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Form validation enhancement
    const form = document.querySelector('form');
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            if (this.classList.contains('border-red-500')) {
                validateField(this);
            }
        });
    });

    function validateField(field) {
        if (field.value.trim() === '') {
            field.classList.add('border-red-500', 'ring-red-200');
            field.classList.remove('border-gray-300', 'focus:border-blue-500');
        } else {
            field.classList.remove('border-red-500', 'ring-red-200');
            field.classList.add('border-gray-300');
        }
    }

    form.addEventListener('submit', function(e) {
        let hasErrors = false;
        
        requiredFields.forEach(field => {
            if (field.value.trim() === '') {
                field.classList.add('border-red-500', 'ring-red-200');
                hasErrors = true;
            }
        });

        if (hasErrors) {
            e.preventDefault();
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.focus();
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});
</script>
@endsection