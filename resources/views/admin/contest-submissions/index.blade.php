@extends('admin.layout')

@section('title', 'Participations au concours')

@section('page_title', 'Participations au concours')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-purple-100">Total participations</h3>
                    <p class="text-2xl font-bold mt-1">{{ $submissions->total() }}</p>
                </div>
                <div class="bg-purple-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-blue-100">Aujourd'hui</h3>
                    <p class="text-2xl font-bold mt-1">{{ $submissions->where('created_at', '>=', today())->count() }}</p>
                </div>
                <div class="bg-blue-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-calendar-day text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-green-100">Opt-in marketing</h3>
                    <p class="text-2xl font-bold mt-1">{{ $submissions->where('opt_in_marketing', true)->count() }}</p>
                </div>
                <div class="bg-green-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-orange-100">Cette semaine</h3>
                    <p class="text-2xl font-bold mt-1">{{ $submissions->where('created_at', '>=', now()->startOfWeek())->count() }}</p>
                </div>
                <div class="bg-orange-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <nav class="mb-4 sm:mb-0">
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
                <li class="text-gray-900 font-medium">Participations au concours</li>
            </ol>
        </nav>

        <a href="{{ route('admin.contest-submissions.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
            <i class="fas fa-download mr-2"></i>
            Exporter en CSV
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r">
            <div class="flex">
                <i class="fas fa-check-circle mr-3 mt-1"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom / Prénom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marketing</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($submissions as $submission)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $submission->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $submission->nom_prenom }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $submission->email }}</div>
                                @if($submission->telephone)
                                    <div class="text-xs text-gray-500">{{ $submission->telephone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $submission->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ Str::limit($submission->activite, 30) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $submission->budget }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($submission->opt_in_marketing)
                                    <i class="fas fa-check-circle text-green-500"></i>
                                @else
                                    <i class="fas fa-times-circle text-gray-400"></i>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.contest-submissions.show', $submission->id) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.contest-submissions.destroy', $submission->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette participation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 text-gray-400"></i>
                                <p class="text-lg">Aucune participation pour le moment</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $submissions->links() }}
        </div>
    </div>
@endsection
