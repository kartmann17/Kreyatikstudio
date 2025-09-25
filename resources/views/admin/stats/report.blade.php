@extends('admin.layout')

@section('title', 'Rapport de statistiques')

@section('page_title', 'Rapport de statistiques')

@section('content_body')
    <!-- Entête du rapport -->
    <div class="mb-6">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-slate-600 to-slate-700 text-white rounded-t-xl px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                    <i class="fas fa-file-alt mr-2"></i>
                    @if ($reportType == 'revenue')
                        Rapport des revenus
                    @elseif ($reportType == 'tasks')
                        Rapport des tâches
                    @elseif ($reportType == 'time')
                        Rapport du temps passé
                    @endif
                </h3>
                <div class="flex space-x-3">
                    <button class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105" onclick="window.print()">
                        <i class="fas fa-print mr-2"></i> Imprimer
                    </button>
                    <a href="{{ route('admin.stats') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-700 mr-2">Type de rapport:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $reportType == 'revenue' ? 'bg-green-100 text-green-800' : ($reportType == 'tasks' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                @if ($reportType == 'revenue')
                                    Revenus
                                @elseif ($reportType == 'tasks')
                                    Tâches
                                @elseif ($reportType == 'time')
                                    Temps passé
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-700 mr-2">Période:</span>
                            <span class="text-gray-600">{{ request()->start_date }} à {{ request()->end_date }}</span>
                        </div>
                    </div>
                    <div class="space-y-3 text-left md:text-right">
                        <div>
                            <span class="font-semibold text-gray-700">Généré le:</span>
                            <span class="text-gray-600 ml-2">{{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Par:</span>
                            <span class="text-gray-600 ml-2">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu du rapport -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 px-6 py-4 rounded-t-xl">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-chart-bar mr-2 text-gray-600"></i>
                Résultats du rapport
            </h3>
        </div>
        <div class="p-6">
            <!-- Affichage conditionnel selon le type de rapport -->
            @if ($reportType == 'revenue')
                <div class="mb-8">
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 mb-6">
                        <h4 class="text-lg font-semibold text-green-800 mb-2">Évolution des revenus</h4>
                        <div class="h-80">
                            <canvas id="reportRevenueChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wider border-b border-green-200">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wider border-b border-green-200">Projet</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wider border-b border-green-200">Client</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-green-800 uppercase tracking-wider border-b border-green-200">Montant (€)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Exemple de données - à remplacer par les vraies données -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">01/06/2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Site e-commerce</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Client A</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-green-600">5,000.00</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/06/2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Application mobile</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Client B</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-green-600">8,500.00</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">22/06/2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Refonte site web</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Client C</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-green-600">3,200.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-gradient-to-r from-green-600 to-emerald-600 text-white">
                            <tr>
                                <th colspan="3" class="px-6 py-4 text-right text-sm font-bold uppercase tracking-wider">Total:</th>
                                <th class="px-6 py-4 text-right text-lg font-bold">16,700.00 €</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                    @elseif ($reportType == 'tasks')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4">
                                <h4 class="text-lg font-semibold text-blue-800 mb-4">Tâches par statut</h4>
                                <div class="h-64">
                                    <canvas id="taskStatusChart" class="w-full h-full"></canvas>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl p-4">
                                <h4 class="text-lg font-semibold text-purple-800 mb-4">Tâches par priorité</h4>
                                <div class="h-64">
                                    <canvas id="taskPriorityChart" class="w-full h-full"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 uppercase tracking-wider border-b border-blue-200">Titre</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 uppercase tracking-wider border-b border-blue-200">Projet</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 uppercase tracking-wider border-b border-blue-200">Statut</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 uppercase tracking-wider border-b border-blue-200">Priorité</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 uppercase tracking-wider border-b border-blue-200">Progression</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 uppercase tracking-wider border-b border-blue-200">Échéance</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Exemple de données - à remplacer par les vraies données -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Créer maquette</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Site e-commerce</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Terminé</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Normal</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                                                </div>
                                                <span class="text-sm font-medium text-green-600">100%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/06/2023</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Développer API</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Application mobile</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">En cours</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Haute</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 60%"></div>
                                                </div>
                                                <span class="text-sm font-medium text-blue-600">60%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">30/06/2023</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @elseif ($reportType == 'time')
                        <div class="mb-8">
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl p-4 mb-6">
                                <h4 class="text-lg font-semibold text-purple-800 mb-2">Répartition du temps par projet</h4>
                                <div class="h-80">
                                    <canvas id="timeReportChart" class="w-full h-full"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-purple-50 to-violet-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-800 uppercase tracking-wider border-b border-purple-200">Date</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-800 uppercase tracking-wider border-b border-purple-200">Projet</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-800 uppercase tracking-wider border-b border-purple-200">Tâche</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-800 uppercase tracking-wider border-b border-purple-200">Utilisateur</th>
                                        <th class="px-6 py-4 text-right text-sm font-semibold text-purple-800 uppercase tracking-wider border-b border-purple-200">Durée</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-800 uppercase tracking-wider border-b border-purple-200">Description</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Exemple de données - à remplacer par les vraies données -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12/06/2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Site e-commerce</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Créer maquette</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Jean Dupont</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-purple-600">3h 20m</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Création de maquettes pour la page d'accueil</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">13/06/2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Application mobile</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Développer API</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Marie Martin</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-purple-600">5h 45m</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Développement des endpoints API pour l'authentification</td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-gradient-to-r from-purple-600 to-violet-600 text-white">
                                    <tr>
                                        <th colspan="4" class="px-6 py-4 text-right text-sm font-bold uppercase tracking-wider">Total:</th>
                                        <th class="px-6 py-4 text-right text-lg font-bold">9h 05m</th>
                                        <th class="px-6 py-4"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration des couleurs modernes
    const chartColors = {
        primary: '#4f46e5',
        success: '#059669', 
        warning: '#d97706',
        danger: '#dc2626',
        info: '#0284c7',
        purple: '#7c3aed',
        pink: '#db2777'
    };
    
    @if ($reportType == 'revenue')
    // Graphique pour les revenus avec design moderne
    const revenueData = {
        labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
        datasets: [{
            label: 'Revenus (€)',
            backgroundColor: chartColors.success + '30',
            borderColor: chartColors.success,
            pointBackgroundColor: chartColors.success,
            pointBorderColor: '#fff',
            pointRadius: 8,
            pointHoverRadius: 10,
            tension: 0.4,
            fill: true,
            data: [4500, 3800, 5200, 3200]
        }]
    };
    
    new Chart(document.getElementById('reportRevenueChart').getContext('2d'), {
        type: 'line',
        data: revenueData,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: { size: 14, weight: 'bold' }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { 
                        borderDash: [5, 5],
                        color: '#e5e7eb'
                    },
                    ticks: { 
                        callback: function(value) { return value + ' €'; },
                        font: { size: 12 }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 } }
                }
            }
        }
    });
    
    @elseif ($reportType == 'tasks')
    // Graphiques pour les tâches avec couleurs modernes
    const taskStatusData = {
        labels: ['À faire', 'En cours', 'Terminées'],
        datasets: [{
            data: [5, 8, 12],
            backgroundColor: [chartColors.danger, chartColors.warning, chartColors.success],
            borderWidth: 3,
            borderColor: '#fff',
            hoverBorderWidth: 4
        }]
    };
    
    new Chart(document.getElementById('taskStatusChart').getContext('2d'), {
        type: 'doughnut',
        data: taskStatusData,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: { size: 12 }
                    }
                }
            },
            cutout: '60%'
        }
    });
    
    const taskPriorityData = {
        labels: ['Basse', 'Normale', 'Haute', 'Urgente'],
        datasets: [{
            data: [3, 10, 8, 4],
            backgroundColor: [chartColors.info, chartColors.primary, chartColors.warning, chartColors.danger],
            borderWidth: 2,
            borderColor: '#fff',
            hoverBorderWidth: 3
        }]
    };
    
    new Chart(document.getElementById('taskPriorityChart').getContext('2d'), {
        type: 'pie',
        data: taskPriorityData,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: { size: 12 }
                    }
                }
            }
        }
    });
    
    @elseif ($reportType == 'time')
    // Graphique pour le temps passé avec design moderne
    const timeData = {
        labels: ['Site e-commerce', 'Application mobile', 'Refonte site web', 'Maintenance', 'Support'],
        datasets: [{
            label: 'Heures',
            backgroundColor: chartColors.purple + 'CC',
            borderColor: chartColors.purple,
            borderWidth: 2,
            borderRadius: 8,
            data: [12, 19, 8, 5, 3]
        }]
    };
    
    new Chart(document.getElementById('timeReportChart').getContext('2d'), {
        type: 'bar',
        data: timeData,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: { size: 14, weight: 'bold' }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { 
                        borderDash: [5, 5],
                        color: '#e5e7eb'
                    },
                    ticks: { 
                        callback: function(value) { return value + 'h'; },
                        font: { size: 12 }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        maxRotation: 45,
                        font: { size: 12 }
                    }
                }
            }
        }
    });
    @endif
});
</script>
@stop 