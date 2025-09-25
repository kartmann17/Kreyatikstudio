@extends('admin.layout')

@section('title', 'Projets et chronométrage')

@section('page_title', 'Projets en cours & Chronométrage')

@section('content_body')
<!-- Hero Section avec Timer -->
<div class="mb-8">
    <!-- Breadcrumb moderne -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white px-4 py-2 rounded-full shadow-sm border">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-home mr-2 text-indigo-500"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-300 mx-2"></i>
                    <span class="text-sm font-medium text-indigo-600">⏱️ Chronométrage</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Timer Card -->
    <div class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 rounded-2xl shadow-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-white/10">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-green-400 to-blue-500 rounded-full p-3 mr-4">
                    <i class="fas fa-stopwatch text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Chronométrage de Projet</h2>
                    <p class="text-purple-200 text-sm">Suivez votre temps de travail en temps réel</p>
                </div>
            </div>
        </div>
        
        <div class="p-6 space-y-6">
            <!-- Timer Display - En haut pour la visibilité -->
            <div class="text-center bg-black/20 rounded-2xl p-6 backdrop-blur-sm">
                <div class="timer-display text-5xl md:text-6xl font-mono font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 mb-4">
                    00:00:00
                </div>
                <div class="flex flex-wrap justify-center gap-3">
                    <button id="startTimer" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-play mr-2"></i>Démarrer
                    </button>
                    <button id="pauseTimer" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg opacity-50 cursor-not-allowed" disabled>
                        <i class="fas fa-pause mr-2"></i>Pause
                    </button>
                    <button id="stopTimer" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg opacity-50 cursor-not-allowed" disabled>
                        <i class="fas fa-stop mr-2"></i>Arrêter
                    </button>
                </div>
            </div>

            <!-- Formulaire - En bas avec grid simple -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Sélection du projet -->
                <div class="space-y-3">
                    <label for="timerProject" class="block text-sm font-semibold text-white">
                        <i class="fas fa-project-diagram mr-2 text-blue-400"></i>Projet
                    </label>
                    <select id="timerProject" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent backdrop-blur-sm transition-all duration-200">
                        <option value="" selected disabled>Sélectionner un projet</option>
                        @foreach ($activeProjects as $project)
                        <option value="{{ $project->id }}" class="text-gray-900">{{ $project->title }} ({{ $project->client->name ?? 'Sans client' }})</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Description de la tâche -->
                <div class="space-y-3">
                    <label for="timerTask" class="block text-sm font-semibold text-white">
                        <i class="fas fa-edit mr-2 text-green-400"></i>Description
                    </label>
                    <input type="text" id="timerTask" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent backdrop-blur-sm transition-all duration-200" placeholder="Description de la tâche...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Projects Section -->
<div class="mb-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <h2 class="text-2xl font-bold text-gray-900 flex items-center">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-3 mr-4">
                <i class="fas fa-project-diagram text-white text-lg"></i>
            </div>
            Projets Actifs
        </h2>
        <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
            {{ count($activeProjects) }} projet(s)
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach ($activeProjects as $project)
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Header du projet -->
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-6 text-white">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="font-bold text-lg leading-tight">{{ $project->title }}</h3>
                    <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold">
                        {{ number_format($project->price) }}€
                    </span>
                </div>
                <p class="text-indigo-100 text-sm">{{ $project->client->name ?? 'Sans client' }}</p>
            </div>

            <!-- Body du projet -->
            <div class="p-6">
                <!-- Barre de progression -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Avancement global</span>
                        <span class="text-sm font-bold text-indigo-600">{{ $project->progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-500" style="width: {{ $project->progress }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-xs text-gray-500">Progression</span>
                        <span class="text-xs text-gray-600 font-medium">
                            <i class="fas fa-clock mr-1 text-gray-400"></i>{{ $project->formatted_total_time }}
                        </span>
                    </div>
                </div>

                <!-- Tâches récentes -->
                <div class="border-t border-gray-100 pt-4 mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-tasks mr-2 text-indigo-500"></i>
                        Tâches récentes
                    </h4>
                    <div class="space-y-2">
                        @forelse ($project->tasks->take(3) as $task)
                        <div class="flex items-center text-sm">
                            @if($task->status == 'terminé')
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            @elseif($task->status == 'en-cours')
                                <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3 animate-pulse"></div>
                                <i class="fas fa-clock text-yellow-500 mr-2"></i>
                            @else
                                <div class="w-2 h-2 bg-gray-400 rounded-full mr-3"></div>
                                <i class="fas fa-circle text-gray-400 mr-2"></i>
                            @endif
                            <span class="text-gray-700 truncate">{{ Str::limit($task->title, 25) }}</span>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-inbox text-gray-300 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500">Aucune tâche enregistrée</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center space-x-3">
                    <button class="start-project-timer flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center"
                        data-project-id="{{ $project->id }}" data-project-name="{{ $project->title }}">
                        <i class="fas fa-play mr-2"></i>Démarrer
                    </button>
                    <a href="#" class="flex-1 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>Détails
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Recent Time Logs -->
<div class="mb-12 mt-16">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-600 p-6 text-white">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 mr-3">
                        <i class="fas fa-history text-lg"></i>
                    </div>
                    Activité récente
                </h3>
                <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium">
                    {{ count($recentLogs) }} entrée(s)
                </span>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            @if(count($recentLogs) > 0)
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-project-diagram mr-2 text-gray-400"></i>Projet
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-edit mr-2 text-gray-400"></i>Description
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>Durée
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentLogs as $log)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $log->created_at->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500 ml-2">
                                        {{ $log->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg p-2 mr-3">
                                        <i class="fas fa-briefcase text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $log->project->title }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $log->project->client->name ?? 'Sans client' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $log->description ?: 'Aucune description' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-stopwatch mr-1 text-green-600"></i>
                                    {{ $log->formatted_duration }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-16">
                    <div class="flex justify-center mb-4">
                        <div class="bg-gray-100 rounded-full p-6">
                            <i class="fas fa-history text-4xl text-gray-400"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune activité récente</h3>
                    <p class="text-gray-500">Les entrées de temps apparaîtront ici une fois que vous aurez commencé à chronométrer.</p>
                    <div class="mt-6">
                        <button onclick="document.getElementById('timerProject').focus()" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-play mr-2"></i>Commencer maintenant
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables pour le chronomètre
        let timer;
        let isRunning = false;
        let isPaused = false;
        let startTime;
        let totalSeconds = 0;
        let currentProjectId = null;

        // Éléments du DOM
        const timerDisplay = document.querySelector('.timer-display');
        const timerProject = document.getElementById('timerProject');
        const timerTask = document.getElementById('timerTask');
        const startTimerBtn = document.getElementById('startTimer');
        const pauseTimerBtn = document.getElementById('pauseTimer');
        const stopTimerBtn = document.getElementById('stopTimer');
        const startProjectTimerBtns = document.querySelectorAll('.start-project-timer');

        // Formatage du temps (HH:MM:SS)
        function formatTime(seconds) {
            const h = Math.floor(seconds / 3600);
            const m = Math.floor((seconds % 3600) / 60);
            const s = Math.floor(seconds % 60);
            return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
        }

        // Mise à jour du chronomètre
        function updateTimer() {
            const currentTime = Date.now();
            const elapsedTime = Math.floor((currentTime - startTime) / 1000);
            totalSeconds = elapsedTime;
            timerDisplay.textContent = formatTime(totalSeconds);
        }

        // Démarrage du chronomètre
        function startTimer() {
            if (!timerProject.value) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Attention',
                        text: 'Veuillez sélectionner un projet avant de démarrer le chronomètre.',
                        icon: 'warning'
                    });
                } else {
                    alert('Veuillez sélectionner un projet avant de démarrer le chronomètre.');
                }
                return;
            }

            if (!isRunning) {
                // Premier démarrage
                startTime = Date.now() - (totalSeconds * 1000);
                timer = setInterval(updateTimer, 1000);
                isRunning = true;
                isPaused = false;
                currentProjectId = timerProject.value;

                // Mise à jour des boutons
                startTimerBtn.disabled = true;
                pauseTimerBtn.disabled = false;
                stopTimerBtn.disabled = false;
                timerProject.disabled = true;
            } else if (isPaused) {
                // Reprise après pause
                startTime = Date.now() - (totalSeconds * 1000);
                timer = setInterval(updateTimer, 1000);
                isPaused = false;

                // Mise à jour des boutons
                startTimerBtn.disabled = true;
                startTimerBtn.innerHTML = '<i class="fas fa-play mr-1"></i> Démarrer';
                pauseTimerBtn.disabled = false;
            }
        }

        // Mise en pause du chronomètre
        function pauseTimer() {
            if (isRunning && !isPaused) {
                clearInterval(timer);
                isPaused = true;

                // Mise à jour des boutons
                startTimerBtn.disabled = false;
                startTimerBtn.innerHTML = '<i class="fas fa-play mr-1"></i> Reprendre';
                pauseTimerBtn.disabled = true;
            }
        }

        // Arrêt du chronomètre
        function stopTimer() {
            if (isRunning || isPaused) {
                clearInterval(timer);

                // Enregistrement du temps
                if (totalSeconds > 0) {
                    saveTimeLog();
                }

                // Réinitialisation du chronomètre
                resetTimer();
            }
        }

        // Réinitialisation du chronomètre
        function resetTimer() {
            clearInterval(timer);
            isRunning = false;
            isPaused = false;
            totalSeconds = 0;
            timerDisplay.textContent = '00:00:00';
            currentProjectId = null;

            // Mise à jour des boutons
            startTimerBtn.disabled = false;
            startTimerBtn.innerHTML = '<i class="fas fa-play mr-1"></i> Démarrer';
            pauseTimerBtn.disabled = true;
            stopTimerBtn.disabled = true;
            timerProject.disabled = false;
        }

        // Enregistrement du temps en base de données
        function saveTimeLog() {
            const projectId = currentProjectId;
            const description = timerTask.value || 'Temps enregistré automatiquement';
            const duration = totalSeconds;

            // Vérifier si axios est disponible
            if (typeof axios === 'undefined') {
                console.error('Axios n\'est pas chargé');
                alert('Erreur: Impossible d\'enregistrer le temps (axios manquant)');
                return;
            }

            axios.post('/admin/time/log', {
                    project_id: projectId,
                    duration: duration,
                    description: description
                })
                .then(function(response) {
                    if (response.data.success) {
                        // Notification
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Succès',
                                text: 'Temps enregistré avec succès !',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            alert('Temps enregistré avec succès !');
                        }

                        // Réinitialisation des champs
                        timerTask.value = '';

                        // Actualiser la page pour afficher le nouveau log
                        setTimeout(() => location.reload(), 1500);
                    }
                })
                .catch(function(error) {
                    console.error('Erreur lors de l\'enregistrement du temps :', error);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de l\'enregistrement du temps.',
                            icon: 'error'
                        });
                    } else {
                        alert('Erreur lors de l\'enregistrement du temps.');
                    }
                });
        }

        // Événements
        startTimerBtn.addEventListener('click', startTimer);
        pauseTimerBtn.addEventListener('click', pauseTimer);
        stopTimerBtn.addEventListener('click', stopTimer);

        // Pour démarrer le chronomètre depuis les cartes de projet
        startProjectTimerBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Vérifier si le chronomètre est déjà en cours
                if (isRunning || isPaused) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Chronomètre en cours',
                            text: 'Un chronomètre est déjà actif. Arrêtez-le d\'abord.',
                            icon: 'warning'
                        });
                    } else {
                        alert('Un chronomètre est déjà actif. Arrêtez-le d\'abord.');
                    }
                    return;
                }
                
                const projectId = this.dataset.projectId;
                const projectName = this.dataset.projectName;

                // Sélectionner le projet dans la liste déroulante
                timerProject.value = projectId;

                // Démarrer le chronomètre
                startTimer();
            });
        });

        // Gestion du clavier (optionnel)
        document.addEventListener('keydown', function(e) {
            if (e.key === ' ' && e.ctrlKey) { // Ctrl + Espace
                e.preventDefault();
                if (!isRunning && !isPaused) {
                    startTimer();
                } else if (isRunning && !isPaused) {
                    pauseTimer();
                } else if (isPaused) {
                    startTimer();
                }
            }
        });
    });
</script>
@stop