@extends('admin.layout')

@section('title', 'Statistiques')

@section('page_title', 'Statistiques et Rapports')

@section('content_body')
    <!-- Filtres et génération de rapports -->
    <div class="mb-8">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-t-xl px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chart-line mr-2"></i>
                    Générer un rapport personnalisé
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.stats.report') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="report_start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" id="report_start_date" name="start_date" required>
                    </div>
                    <div class="space-y-2">
                        <label for="report_end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" id="report_end_date" name="end_date" required>
                    </div>
                    <div class="space-y-2">
                        <label for="report_type" class="block text-sm font-medium text-gray-700">Type de rapport</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" id="report_type" name="type" required>
                            <option value="revenue">Revenus</option>
                            <option value="tasks">Tâches</option>
                            <option value="time">Temps passé</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-6 py-2 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-chart-line mr-2"></i> Générer le rapport
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Revenus mensuels -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 chart-container">
                <div class="flex items-center justify-between bg-gradient-to-r from-green-500 to-green-600 text-white rounded-t-xl px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-euro-sign mr-2"></i>
                        Revenus mensuels
                    </h3>
                    <button type="button" class="text-green-100 hover:text-white transition-colors p-2 hover:bg-green-400 hover:bg-opacity-20 rounded-full" onclick="toggleChart('monthlyRevenue')">
                        <i class="fas fa-compress-alt"></i>
                    </button>
                </div>
                <div class="p-6" id="monthlyRevenueContainer">
                    <div class="h-80">
                        <canvas id="monthlyRevenueChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 chart-container">
                <div class="flex items-center justify-between bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-t-xl px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Sources de revenus
                    </h3>
                    <button type="button" class="text-blue-100 hover:text-white transition-colors p-2 hover:bg-blue-400 hover:bg-opacity-20 rounded-full" onclick="toggleChart('revenueBySource')">
                        <i class="fas fa-compress-alt"></i>
                    </button>
                </div>
                <div class="p-6" id="revenueBySourceContainer">
                    <div class="h-80">
                        <canvas id="revenueBySourceChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tâches et Temps -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 chart-container">
            <div class="flex items-center justify-between bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-t-xl px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-tasks mr-2"></i>
                    Tâches par statut
                </h3>
                <button type="button" class="text-purple-100 hover:text-white transition-colors p-2 hover:bg-purple-400 hover:bg-opacity-20 rounded-full" onclick="toggleChart('tasksByStatus')">
                    <i class="fas fa-compress-alt"></i>
                </button>
            </div>
            <div class="p-6" id="tasksByStatusContainer">
                <div class="h-64">
                    <canvas id="tasksByStatusChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 chart-container">
            <div class="flex items-center justify-between bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-t-xl px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    Temps par projet (Top 5)
                </h3>
                <button type="button" class="text-orange-100 hover:text-white transition-colors p-2 hover:bg-orange-400 hover:bg-opacity-20 rounded-full" onclick="toggleChart('timeByProject')">
                    <i class="fas fa-compress-alt"></i>
                </button>
            </div>
            <div class="p-6" id="timeByProjectContainer">
                <div class="h-64">
                    <canvas id="timeByProjectChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les dates du rapport avec le mois courant
    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    
    document.getElementById('report_start_date').value = firstDay.toISOString().slice(0, 10);
    document.getElementById('report_end_date').value = lastDay.toISOString().slice(0, 10);

    // Fonction pour toggle les graphiques
    window.toggleChart = function(chartName) {
        const container = document.getElementById(chartName + 'Container');
        const button = container.previousElementSibling.querySelector('button i');
        
        if (container.style.display === 'none') {
            container.style.display = 'block';
            container.style.opacity = '0';
            setTimeout(() => {
                container.style.transition = 'opacity 0.3s ease';
                container.style.opacity = '1';
            }, 10);
            button.className = 'fas fa-compress-alt';
        } else {
            container.style.transition = 'opacity 0.3s ease';
            container.style.opacity = '0';
            setTimeout(() => {
                container.style.display = 'none';
            }, 300);
            button.className = 'fas fa-expand-alt';
        }
    };
    
    // Configuration moderne des graphiques avec des couleurs Tailwind
    const chartColors = {
        primary: '#4f46e5', // indigo-600
        success: '#059669', // emerald-600  
        warning: '#d97706', // amber-600
        danger: '#dc2626', // red-600
        info: '#0284c7', // sky-600
        purple: '#7c3aed', // violet-600
        pink: '#db2777', // pink-600
    };
    
    // Revenus mensuels - Line Chart
    const monthlyRevenueData = {
        labels: {!! json_encode($monthlyRevenue['labels']) !!},
        datasets: [{
            label: 'Revenus (€)',
            backgroundColor: chartColors.success + '20',
            borderColor: chartColors.success,
            pointBackgroundColor: chartColors.success,
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: chartColors.success,
            pointRadius: 6,
            pointHoverRadius: 8,
            tension: 0.4,
            fill: true,
            data: {!! json_encode($monthlyRevenue['data']) !!}
        }]
    };
    
    const monthlyRevenueOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    padding: 20,
                    font: { size: 12 }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { borderDash: [5, 5] },
                ticks: { 
                    callback: function(value) { return value + ' €'; }
                }
            },
            x: {
                grid: { display: false }
            }
        }
    };
    
    new Chart(document.getElementById('monthlyRevenueChart').getContext('2d'), {
        type: 'line',
        data: monthlyRevenueData,
        options: monthlyRevenueOptions
    });
    
    // Revenus par source - Pie Chart
    const revenueBySourceData = {
        labels: {!! json_encode($revenueBySource['labels']) !!},
        datasets: [{
            data: {!! json_encode($revenueBySource['data']) !!},
            backgroundColor: [
                chartColors.primary, chartColors.success, chartColors.warning, 
                chartColors.info, chartColors.purple, chartColors.pink
            ],
            borderWidth: 2,
            borderColor: '#fff',
            hoverBorderWidth: 3
        }]
    };
    
    const revenueBySourceOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    usePointStyle: true,
                    font: { size: 11 }
                }
            }
        }
    };
    
    new Chart(document.getElementById('revenueBySourceChart').getContext('2d'), {
        type: 'doughnut',
        data: revenueBySourceData,
        options: revenueBySourceOptions
    });
    
    // Tâches par statut - Doughnut Chart
    const tasksByStatusData = {
        labels: {!! json_encode($tasksByStatus['labels']) !!},
        datasets: [{
            data: {!! json_encode($tasksByStatus['data']) !!},
            backgroundColor: [
                chartColors.danger, chartColors.success, chartColors.warning
            ],
            borderWidth: 3,
            borderColor: '#fff',
            hoverBorderWidth: 4
        }]
    };
    
    const tasksByStatusOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    usePointStyle: true,
                    font: { size: 11 }
                }
            }
        },
        cutout: '60%'
    };
    
    new Chart(document.getElementById('tasksByStatusChart').getContext('2d'), {
        type: 'doughnut',
        data: tasksByStatusData,
        options: tasksByStatusOptions
    });
    
    // Temps par projet - Bar Chart
    const timeByProjectData = {
        labels: {!! json_encode($timeByProject['labels']) !!},
        datasets: [{
            label: 'Heures',
            backgroundColor: chartColors.warning + 'CC',
            borderColor: chartColors.warning,
            borderWidth: 2,
            borderRadius: 6,
            data: {!! json_encode($timeByProject['data']) !!}
        }]
    };
    
    const timeByProjectOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    padding: 20,
                    font: { size: 12 }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { borderDash: [5, 5] },
                ticks: { 
                    callback: function(value) { return value + 'h'; }
                }
            },
            x: {
                grid: { display: false },
                ticks: {
                    maxRotation: 45
                }
            }
        }
    };
    
    new Chart(document.getElementById('timeByProjectChart').getContext('2d'), {
        type: 'bar',
        data: timeByProjectData,
        options: timeByProjectOptions
    });
});
</script>
@stop 