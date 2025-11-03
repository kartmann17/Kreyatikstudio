@extends('admin.layout')

@section('title', 'Détails de la participation')

@section('page_title', 'Détails de la participation')

@section('content_body')
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                    <i class="fas fa-home mr-1"></i>
                    Tableau de bord
                </a>
            </li>
            <li>
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
            </li>
            <li>
                <a href="{{ route('admin.contest-submissions.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                    Participations au concours
                </a>
            </li>
            <li>
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
            </li>
            <li class="text-gray-900 font-medium">Détails</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user-circle mr-3 text-purple-600"></i>
                    Informations du participant
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nom / Prénom</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $submission->nom_prenom }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-lg text-gray-900">
                            <a href="mailto:{{ $submission->email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $submission->email }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Téléphone</label>
                        <p class="text-lg text-gray-900">
                            @if($submission->telephone)
                                <a href="tel:{{ $submission->telephone }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $submission->telephone }}
                                </a>
                            @else
                                <span class="text-gray-400">Non renseigné</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Date de participation</label>
                        <p class="text-lg text-gray-900">{{ $submission->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Statut</label>
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $submission->statut }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Activité</label>
                        <p class="text-lg text-gray-900">{{ $submission->activite }}</p>
                    </div>
                </div>
            </div>

            <!-- Project Details -->
            <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-briefcase mr-3 text-blue-600"></i>
                    Détails du projet
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Besoins</label>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach(explode(', ', $submission->besoins) as $besoin)
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                    {{ $besoin }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Budget estimé</label>
                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $submission->budget }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Deadline souhaitée</label>
                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-orange-100 text-orange-800">
                                {{ $submission->deadline }}
                            </span>
                        </div>
                    </div>

                    @if($submission->message)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Message</label>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <p class="text-gray-900 whitespace-pre-wrap">{{ $submission->message }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Consent & Marketing -->
            <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-green-600"></i>
                    Consentements
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">RGPD</span>
                        @if($submission->consent_rgpd)
                            <span class="flex items-center text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>
                                Accepté
                            </span>
                        @else
                            <span class="flex items-center text-red-600">
                                <i class="fas fa-times-circle mr-1"></i>
                                Refusé
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">Opt-in marketing</span>
                        @if($submission->opt_in_marketing)
                            <span class="flex items-center text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>
                                Accepté
                            </span>
                        @else
                            <span class="flex items-center text-gray-400">
                                <i class="fas fa-times-circle mr-1"></i>
                                Refusé
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- UTM Tracking -->
            @if($submission->utm_source || $submission->utm_medium || $submission->utm_campaign)
                <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                        Tracking UTM
                    </h3>

                    <div class="space-y-2 text-sm">
                        @if($submission->utm_source)
                            <div>
                                <span class="text-gray-500">Source:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $submission->utm_source }}</span>
                            </div>
                        @endif
                        @if($submission->utm_medium)
                            <div>
                                <span class="text-gray-500">Medium:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $submission->utm_medium }}</span>
                            </div>
                        @endif
                        @if($submission->utm_campaign)
                            <div>
                                <span class="text-gray-500">Campaign:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $submission->utm_campaign }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>

                <div class="space-y-3">
                    <a href="{{ route('admin.contest-submissions.index') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center justify-center transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à la liste
                    </a>

                    <form action="{{ route('admin.contest-submissions.destroy', $submission->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette participation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center justify-center transition-all duration-200">
                            <i class="fas fa-trash mr-2"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
