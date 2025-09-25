@extends('admin.layout')

@section('title', 'Gestion des Plans Tarifaires')

@section('page_title', 'Gestion des Plans Tarifaires')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-blue-100">Total plans</h3>
                    <p class="text-2xl font-bold mt-1">{{ $pricingPlans->total() ?? count($pricingPlans) }}</p>
                </div>
                <div class="bg-blue-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-tags text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-green-100">Plans actifs</h3>
                    <p class="text-2xl font-bold mt-1">{{ $pricingPlans->where('is_active', true)->count() }}</p>
                </div>
                <div class="bg-green-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-yellow-100">Mis en avant</h3>
                    <p class="text-2xl font-bold mt-1">{{ $pricingPlans->where('is_highlighted', true)->count() }}</p>
                </div>
                <div class="bg-yellow-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-star text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-purple-100">Prix moyen</h3>
                    <p class="text-2xl font-bold mt-1">
                        @php
                            $avgPrice = $pricingPlans->map(function($plan) {
                                return (float)$plan->monthly_price;
                            })->avg();
                        @endphp
                        {{ number_format($avgPrice ?? 0, 0) }}€
                    </p>
                </div>
                <div class="bg-purple-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-euro-sign text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                <i class="fas fa-tags mr-2"></i>
                Liste des Plans Tarifaires
            </h3>
            <a href="{{ route('admin.pricing-plans.create') }}" class="bg-white text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                <i class="fas fa-plus mr-2"></i> 
                Nouveau Plan
            </a>
        </div>
        <div class="p-6">
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-6 flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.style.display='none'" class="ml-auto text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6 flex items-center">
                <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                <div>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.style.display='none'" class="ml-auto text-red-600 hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif
            
            <!-- View Toggle -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-2">
                    <button id="tableViewBtn" class="bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                        <i class="fas fa-table mr-2"></i> Tableau
                    </button>
                    <button id="gridViewBtn" class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                        <i class="fas fa-th-large mr-2"></i> Grille
                    </button>
                </div>
                
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">{{ $pricingPlans->count() }} plan(s)</span>
                </div>
            </div>

            @if(count($pricingPlans) > 0)
            <!-- Table View -->
            <div id="tableView">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix mensuel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix annuel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pricingPlans as $plan)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg text-sm font-semibold">
                                        {{ $plan->order }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-tags text-white text-lg"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $plan->name }}</div>
                                            @if($plan->is_custom_plan)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                    <i class="fas fa-star mr-1"></i>
                                                    Sur mesure
                                                </span>
                                            @endif
                                            @if($plan->is_highlighted)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1 ml-2">
                                                    <i class="fas fa-crown mr-1"></i>
                                                    {{ $plan->highlight_text ?: 'Recommandé' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-semibold text-gray-900">{{ number_format((float)$plan->monthly_price, 0, ',', ' ') }}€</div>
                                    <div class="text-sm text-gray-500">par mois</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-semibold text-gray-900">{{ number_format((float)$plan->annual_price, 0, ',', ' ') }}€</div>
                                    <div class="text-sm text-gray-500">par an</div>
                                    @if((float)$plan->annual_price < ((float)$plan->monthly_price * 12))
                                        <div class="text-xs text-green-600 font-medium mt-1">
                                            Économie: {{ number_format(((float)$plan->monthly_price * 12) - (float)$plan->annual_price, 0, ',', ' ') }}€
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($plan->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.pricing-plans.edit', $plan) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="delete-plan bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $plan->id }}" data-name="{{ $plan->name }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Grid View -->
            <div id="gridView" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pricingPlans as $plan)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-200 {{ $plan->is_highlighted ? 'ring-2 ring-yellow-400' : '' }}">
                            <!-- Header -->
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 relative">
                                @if($plan->is_highlighted)
                                    <div class="absolute top-3 right-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-400 text-yellow-900">
                                            <i class="fas fa-crown mr-1"></i>
                                            {{ $plan->highlight_text ?: 'Recommandé' }}
                                        </span>
                                    </div>
                                @endif
                                
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-tags text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold">{{ $plan->name }}</h3>
                                    @if($plan->is_custom_plan)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-200 text-blue-800 mt-2">
                                            <i class="fas fa-star mr-1"></i>
                                            Sur mesure
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Pricing -->
                            <div class="p-6 text-center border-b border-gray-200">
                                <div class="mb-4">
                                    <div class="text-3xl font-bold text-gray-900">{{ number_format((float)$plan->monthly_price, 0, ',', ' ') }}€</div>
                                    <div class="text-sm text-gray-500">par mois</div>
                                </div>
                                
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-gray-700">{{ number_format((float)$plan->annual_price, 0, ',', ' ') }}€/an</div>
                                    @if((float)$plan->annual_price < ((float)$plan->monthly_price * 12))
                                        <div class="text-sm text-green-600 font-medium">
                                            Économie: {{ number_format(((float)$plan->monthly_price * 12) - (float)$plan->annual_price, 0, ',', ' ') }}€
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Status & Actions -->
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-sm text-gray-500">Statut:</div>
                                    @if($plan->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Inactif
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.pricing-plans.edit', $plan) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-lg text-center transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i>
                                        Modifier
                                    </a>
                                    <button type="button" class="delete-plan flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg transition-colors duration-200" data-id="{{ $plan->id }}" data-name="{{ $plan->name }}">
                                        <i class="fas fa-trash mr-1"></i>
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <div class="flex flex-col items-center">
                    <i class="fas fa-tags text-4xl text-gray-300 mb-4"></i>
                    <p class="text-lg font-medium text-gray-500">Aucun plan tarifaire disponible</p>
                    <p class="text-sm text-gray-400 mb-4">Commencez par créer votre premier plan</p>
                    <a href="{{ route('admin.pricing-plans.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Créer un plan
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    @if(isset($pricingPlans) && method_exists($pricingPlans, 'links'))
    <div class="mt-8 flex justify-center">
        {{ $pricingPlans->links() }}
    </div>
    @endif
@stop

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const tableViewBtn = document.getElementById('tableViewBtn');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const tableView = document.getElementById('tableView');
    const gridView = document.getElementById('gridView');

    if (tableViewBtn && gridViewBtn && tableView && gridView) {
        tableViewBtn.addEventListener('click', function() {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            
            tableViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
            tableViewBtn.classList.add('bg-indigo-600', 'text-white');
            
            gridViewBtn.classList.remove('bg-indigo-600', 'text-white');
            gridViewBtn.classList.add('bg-gray-200', 'text-gray-700');
        });

        gridViewBtn.addEventListener('click', function() {
            gridView.classList.remove('hidden');
            tableView.classList.add('hidden');
            
            gridViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
            gridViewBtn.classList.add('bg-indigo-600', 'text-white');
            
            tableViewBtn.classList.remove('bg-indigo-600', 'text-white');
            tableViewBtn.classList.add('bg-gray-200', 'text-gray-700');
        });
    }

    // Delete plan functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-plan')) {
            const button = e.target.closest('.delete-plan');
            const planId = button.dataset.id;
            const planName = button.dataset.name;
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: `Voulez-vous vraiment supprimer le plan "${planName}" ? Cette action est irréversible.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonClass: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg mr-2',
                cancelButtonClass: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/pricing-plans/${planId}/force-delete`;
                }
            });
        }
    });

    // Auto-hide success message
    const successAlert = document.querySelector('.bg-green-50');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 300);
        }, 5000);
    }
});
</script>
@stop 