@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page_title', 'Tableau de bord')

@section('content_body')
    <!-- Dashboard Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Gains Mensuels -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Gains (Mensuel)</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['monthlyEarnings'] ?? 0) }} €</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-euro-sign text-2xl"></i>
                </div>
            </div>
            <div class="flex items-center text-blue-100">
                <i class="fas fa-arrow-up mr-2"></i>
                <span class="text-sm">Revenus du mois en cours</span>
            </div>
        </div>
        
        <!-- Dépenses Mensuelles -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-green-100 text-sm font-medium">Dépenses (Mensuel)</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['expenses'] ?? 0) }} €</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
            </div>
            <div class="flex items-center text-green-100">
                <i class="fas fa-arrow-up mr-2"></i>
                <span class="text-sm">Dépenses du mois en cours</span>
            </div>
        </div>
        
        <!-- Tâches Terminées -->
        <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Tâches Terminées</p>
                    @php
                        $completedTasksPercentage = $stats['tasks'] > 0 ? round(($stats['completedTasks'] / $stats['tasks']) * 100) : 0;
                    @endphp
                    <p class="text-3xl font-bold">{{ $completedTasksPercentage }}%</p>
                </div>
                <div class="bg-yellow-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-tasks text-2xl"></i>
                </div>
            </div>
            <div class="w-full bg-yellow-400 bg-opacity-30 rounded-full h-2">
                <div class="bg-white h-2 rounded-full transition-all duration-500" style="width: {{ $completedTasksPercentage }}%"></div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Projets -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center">
                <div class="bg-blue-100 rounded-full p-3 mr-4">
                    <i class="fas fa-project-diagram text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Projets</h3>
                    <div class="flex items-center mt-1">
                        <span class="text-2xl font-bold text-gray-900 mr-3">{{ $stats['projects'] ?? 0 }}</span>
                        <div class="text-sm">
                            <span class="text-green-600 font-medium">{{ $stats['activeProjects'] ?? 0 }} actifs</span>
                            <br>
                            <span class="text-gray-500">{{ ($stats['projects'] ?? 0) - ($stats['activeProjects'] ?? 0) }} autres</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Clients -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center">
                <div class="bg-green-100 rounded-full p-3 mr-4">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Clients</h3>
                    <div class="flex items-center mt-1">
                        <span class="text-2xl font-bold text-gray-900 mr-3">{{ $stats['clientCount'] ?? 0 }}</span>
                        <div class="text-sm">
                            <span class="text-green-600 font-medium">Clients</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Messages -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center">
                <div class="bg-purple-100 rounded-full p-3 mr-4">
                    <i class="fas fa-envelope text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Messages</h3>
                    <div class="flex items-center mt-1">
                        <span class="text-2xl font-bold text-gray-900">{{ $stats['unreadMessages'] ?? 0 }}</span>
                        <div class="text-sm ml-2">
                            <span class="text-gray-500">Non lus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tâches -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
            <div class="flex items-center">
                <div class="bg-red-100 rounded-full p-3 mr-4">
                    <i class="fas fa-clock text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Tâches</h3>
                    <div class="flex items-center mt-1">
                        <span class="text-2xl font-bold text-gray-900">{{ $stats['tasks'] ?? 0 }}</span>
                        <div class="text-sm ml-2">
                            <span class="text-gray-500">Total</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Real-time Stats Bar -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Temps de travail aujourd'hui -->
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900" id="work-time-today">{{ $stats['workTimeToday'] ?? '0h 0m' }}</h4>
                    <p class="text-sm text-gray-600">Temps travaillé aujourd'hui</p>
                    <div class="mt-2">
                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                            Objectif: 8h
                        </span>
                    </div>
                </div>

                <!-- Nouveaux leads cette semaine -->
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user-plus text-green-600 text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats['weeklyLeads'] ?? 0 }}</h4>
                    <p class="text-sm text-gray-600">Nouveaux leads cette semaine</p>
                    <div class="mt-2">
                        @php $weeklyGrowth = $stats['weeklyLeadsGrowth'] ?? 0; @endphp
                        <span class="text-xs px-2 py-1 {{ $weeklyGrowth >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full">
                            {{ $weeklyGrowth >= 0 ? '+' : '' }}{{ $weeklyGrowth }}% vs semaine dernière
                        </span>
                    </div>
                </div>

                <!-- Tâches en retard -->
                <div class="text-center">
                    <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats['overdueTasks'] ?? 0 }}</h4>
                    <p class="text-sm text-gray-600">Tâches en retard</p>
                    <div class="mt-2">
                        @if(($stats['overdueTasks'] ?? 0) > 0)
                            <a href="{{ route('admin.tasks.index', ['filter' => 'overdue']) }}" class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full hover:bg-red-200">
                                Voir les tâches
                            </a>
                        @else
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                Aucun retard
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Revenus du mois -->
                <div class="text-center">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-euro-sign text-yellow-600 text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ number_format($stats['monthlyRevenue'] ?? 0) }}€</h4>
                    <p class="text-sm text-gray-600">Revenus ce mois</p>
                    <div class="mt-2">
                        @php 
                            $monthlyTarget = $stats['monthlyTarget'] ?? 50000;
                            $progress = $monthlyTarget > 0 ? round((($stats['monthlyRevenue'] ?? 0) / $monthlyTarget) * 100) : 0;
                        @endphp
                        <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">
                            {{ $progress }}% de l'objectif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projets urgents -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center">
                <i class="fas fa-fire text-red-500 mr-3"></i>
                <h3 class="text-lg font-semibold text-gray-900">Projets urgents</h3>
                @if(isset($stats['urgentProjects']) && count($stats['urgentProjects']) > 0)
                    <span class="ml-3 bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full animate-pulse">
                        {{ count($stats['urgentProjects']) }} urgent(s)
                    </span>
                @endif
            </div>
            <a href="{{ route('admin.projects.index', ['filter' => 'urgent']) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Voir tous les projets urgents
            </a>
        </div>
        <div class="p-6">
            @if(isset($stats['urgentProjects']) && count($stats['urgentProjects']) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($stats['urgentProjects'] as $project)
                        <div class="border border-red-200 bg-red-50 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $project->name }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">Client: {{ $project->client->name ?? 'Non assigné' }}</p>
                                    <div class="mt-2 flex items-center">
                                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                            Échéance: {{ $project->deadline ? $project->deadline->format('d/m/Y') : 'Non définie' }}
                                        </span>
                                        @if($project->deadline && $project->deadline->isPast())
                                            <span class="ml-2 text-xs bg-red-600 text-white px-2 py-1 rounded-full">
                                                En retard
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="ml-4 text-red-600 hover:text-red-800">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-check-circle text-green-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucun projet urgent. Bon travail !</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Content Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Derniers Messages -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <i class="fas fa-envelope text-gray-500 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Messages récents</h3>
                    @if(isset($stats['unreadMessages']) && $stats['unreadMessages'] > 0)
                        <span class="ml-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full animate-pulse">{{ $stats['unreadMessages'] }}</span>
                    @endif
                </div>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <i class="fas fa-external-link-alt text-xs"></i>
                </a>
            </div>
            <div class="p-0 max-h-96 overflow-y-auto">
                @if(isset($stats['recentMessages']) && count($stats['recentMessages']) > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($stats['recentMessages'] as $message)
                            <div class="p-4 hover:bg-gray-50 transition-colors duration-150 {{ $message->is_read ? '' : 'bg-blue-50 border-l-4 border-blue-500' }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <span class="font-medium text-gray-900 text-sm">{{ $message->name ?? 'Nom inconnu' }}</span>
                                            @if(!$message->is_read)
                                                <span class="ml-2 w-2 h-2 bg-red-500 rounded-full"></span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ Str::limit($message->subject ?? 'Pas de sujet', 50) }}</p>
                                        <span class="text-xs text-gray-400 mt-2 block">{{ $message->created_at ? $message->created_at->diffForHumans() : 'Date inconnue' }}</span>
                                    </div>
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="ml-2 text-blue-600 hover:text-blue-800 text-xs">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center">
                        <i class="fas fa-inbox text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500 text-sm">Aucun message récent.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Projets Récents -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <i class="fas fa-project-diagram text-gray-500 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Projets actifs</h3>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <i class="fas fa-external-link-alt text-xs"></i>
                </a>
            </div>
            <div class="p-0 max-h-96 overflow-y-auto">
                @if(isset($stats['recentProjects']) && count($stats['recentProjects']) > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($stats['recentProjects'] as $project)
                            <div class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <a href="{{ route('admin.projects.show', $project->id) }}" class="font-medium text-gray-900 hover:text-blue-600 text-sm">
                                            {{ Str::limit($project->name ?? 'Projet sans nom', 30) }}
                                        </a>
                                        <div class="mt-2 flex items-center justify-between">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                                    'in_progress' => 'bg-blue-100 text-blue-700',
                                                    'completed' => 'bg-green-100 text-green-700',
                                                    'on_hold' => 'bg-gray-100 text-gray-700',
                                                    'cancelled' => 'bg-red-100 text-red-700'
                                                ];
                                                $statusColor = $statusColors[$project->status] ?? 'bg-gray-100 text-gray-700';
                                            @endphp
                                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                                                {{ $project->status_label }}
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-xs text-gray-500">Progression</span>
                                                <span class="text-xs text-gray-700 font-medium">{{ $project->completion_percentage }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $project->completion_percentage }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center">
                        <i class="fas fa-folder-open text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500 text-sm">Aucun projet récent.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tâches en cours -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <i class="fas fa-tasks text-gray-500 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Tâches en cours</h3>
                    @if(isset($stats['pendingTasks']) && $stats['pendingTasks'] > 0)
                        <span class="ml-3 bg-orange-100 text-orange-800 text-xs font-bold px-2 py-1 rounded-full">{{ $stats['pendingTasks'] }} en cours</span>
                    @endif
                </div>
                <a href="{{ route('admin.tasks.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <i class="fas fa-external-link-alt text-xs"></i>
                </a>
            </div>
            <div class="p-0 max-h-96 overflow-y-auto">
                @if(isset($stats['currentTasks']) && count($stats['currentTasks']) > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($stats['currentTasks'] as $task)
                            <div class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900 text-sm">{{ Str::limit($task->title ?? 'Tâche sans titre', 40) }}</h4>
                                        <p class="text-xs text-gray-600 mt-1">Projet: {{ $task->project->name ?? 'Aucun projet' }}</p>
                                        <div class="mt-2 flex items-center justify-between">
                                            @php
                                                $priorityColors = [
                                                    'high' => 'bg-red-100 text-red-700',
                                                    'medium' => 'bg-yellow-100 text-yellow-700',
                                                    'low' => 'bg-green-100 text-green-700'
                                                ];
                                                $priorityColor = $priorityColors[$task->priority] ?? 'bg-gray-100 text-gray-700';
                                            @endphp
                                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $priorityColor }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                            <span class="text-xs text-gray-400">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Pas de date' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center">
                        <i class="fas fa-check-circle text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500 text-sm">Toutes les tâches sont terminées !</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Charts
    initializeCharts();
    
    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
    // Auto-refresh stats every 5 minutes
    setInterval(() => {
        checkUnreadMessages();
        updateCharts();
    }, 5 * 60 * 1000);
    @endif
    
    // Auto-hide flash messages after 5 seconds
    const alerts = document.querySelectorAll('[role="alert"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });
});

function initializeCharts() {
    // Charts have been removed - keeping function for compatibility
    console.log('Charts section removed from dashboard');
}

function updateCharts() {
    // This function would update chart data with fresh data from the server
    // Implementation would depend on your data fetching strategy
    console.log('Updating charts with fresh data...');
}

// Revenue period toggle removed with charts

// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading states for action buttons
document.querySelectorAll('.bg-gradient-to-r').forEach(button => {
    button.addEventListener('click', function() {
        const originalContent = this.innerHTML;
        this.innerHTML = '<div class="flex items-center justify-center"><i class="fas fa-spinner fa-spin mr-2"></i><span>Chargement...</span></div>';
        
        // Restore after a short delay (in real app, this would be when navigation completes)
        setTimeout(() => {
            this.innerHTML = originalContent;
        }, 1000);
    });
});
</script>
@endsection