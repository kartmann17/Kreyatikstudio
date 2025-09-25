@extends('admin.layout')

@section('title', 'Timer & Suivi de temps')

@section('page_title', 'Timer & Suivi de temps')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-blue-100 mb-1">Temps aujourd'hui</h3>
                    <p class="text-2xl font-bold" id="todayTime">0h 00m</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-green-100 mb-1">Cette semaine</h3>
                    <p class="text-2xl font-bold" id="weekTime">0h 00m</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-calendar-week text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-yellow-100 mb-1">Projets actifs</h3>
                    <p class="text-2xl font-bold" id="activeProjects">{{ count($projects ?? []) }}</p>
                </div>
                <div class="bg-yellow-400 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-red-100 mb-1">Sessions</h3>
                    <p class="text-2xl font-bold" id="todaySessions">0</p>
                </div>
                <div class="bg-red-400 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-play-circle text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Timer Card -->
    <div class="bg-white rounded-xl shadow-lg mb-8">
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-stopwatch mr-2"></i>
                Chronométrer votre temps
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <label for="project" class="block text-sm font-semibold text-gray-700 mb-2">Projet</label>
                    <select id="project" name="project_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="" selected disabled>Sélectionner un projet</option>
                        @foreach ($projects ?? [] as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="task" class="block text-sm font-semibold text-gray-700 mb-2">Tâche</label>
                    <select id="task" name="task_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white disabled:bg-gray-100 disabled:cursor-not-allowed" disabled>
                        <option value="" selected disabled>Sélectionner une tâche</option>
                    </select>
                </div>
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <input type="text" id="description" name="description" placeholder="Description de l'activité..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                </div>
            </div>

            <div class="text-center">
                <div class="timer-display text-6xl font-mono font-bold text-gray-800 mb-8 bg-gray-50 rounded-xl py-8 px-4 border-2 border-gray-200 shadow-inner">
                    00:00:00
                </div>
                <div class="flex flex-wrap justify-center gap-4">
                    <button id="startTimer" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold flex items-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-play mr-2"></i> 
                        Démarrer
                    </button>
                    <button id="pauseTimer" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold flex items-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none" disabled>
                        <i class="fas fa-pause mr-2"></i> 
                        Pause
                    </button>
                    <button id="stopTimer" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold flex items-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none" disabled>
                        <i class="fas fa-stop mr-2"></i> 
                        Arrêter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Time Logs Card -->
    <div class="bg-white rounded-xl shadow-lg mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gray-50 rounded-t-xl px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-2 sm:mb-0">
                <i class="fas fa-history mr-2 text-indigo-600"></i>
                Historique de temps
            </h3>
            <div class="relative">
                <button id="filterDropdown" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-filter mr-2"></i> 
                    Filtrer
                    <i class="fas fa-chevron-down ml-2 transform transition-transform duration-200" id="filterChevron"></i>
                </button>
                <div id="filterMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-50 hidden">
                    <div class="py-2">
                        <a href="#" class="filter-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-150" data-period="today">Aujourd'hui</a>
                        <a href="#" class="filter-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-150" data-period="week">Cette semaine</a>
                        <a href="#" class="filter-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-150" data-period="month">Ce mois</a>
                        <div class="border-t border-gray-200 my-1"></div>
                        <a href="#" class="filter-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-150" data-period="all">Tous</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Projet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tâche</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="logsTableBody">
                    @forelse ($recentLogs ?? [] as $log)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $log->formatted_started_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-gray-900">{{ $log->project->title ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($log->task)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $log->task->title }}
                                </span>
                            @else
                                <span class="text-sm text-gray-500">N/A</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate">{{ $log->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $log->formatted_duration }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button type="button" class="edit-log bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md" 
                                    data-id="{{ $log->id }}" 
                                    data-project="{{ $log->project ? $log->project->id : '' }}" 
                                    data-task="{{ $log->task ? $log->task->id : '' }}" 
                                    data-description="{{ $log->description ?? '' }}" 
                                    data-duration="{{ $log->duration }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="delete-log bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md" 
                                    data-id="{{ $log->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-clock text-4xl text-gray-300 mb-4"></i>
                                <h5 class="text-lg font-semibold text-gray-600 mb-2">Aucun enregistrement de temps trouvé</h5>
                                <p class="text-sm text-gray-500">Commencez à chronométrer pour voir vos enregistrements ici</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Time Statistics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-lg">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-t-xl px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Temps par projet
                </h3>
            </div>
            <div class="p-6">
                <div class="relative" style="height: 250px;">
                    <canvas id="projectTimeChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-t-xl px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Temps par jour
                </h3>
            </div>
            <div class="p-6">
                <div class="relative" style="height: 250px;">
                    <canvas id="dailyTimeChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script>
    // Utiliser DOMContentLoaded au lieu de jQuery
    document.addEventListener('DOMContentLoaded', function() {

        // Variables pour le timer
        let timer;
        let isRunning = false;
        let isPaused = false;
        let startTime;
        let pausedTime = 0;
        let seconds = 0;
        let totalSeconds = 0; // Variable manquante
        let currentProjectId = null;

        // Éléments du DOM
        const timerDisplay = document.querySelector('.timer-display');
        const projectSelect = document.getElementById('project');
        const taskSelect = document.getElementById('task');
        const descriptionInput = document.getElementById('description');
        const startTimerBtn = document.getElementById('startTimer');
        const pauseTimerBtn = document.getElementById('pauseTimer');
        const stopTimerBtn = document.getElementById('stopTimer');

        // Charger les tâches quand un projet est sélectionné
        projectSelect.addEventListener('change', function() {
            const projectId = this.value;
            if (projectId) {
                loadTasksByProject(projectId);
            } else {
                // Réinitialiser la liste des tâches
                taskSelect.innerHTML = '<option value="" selected disabled>Sélectionner une tâche</option>';
                taskSelect.disabled = true;
            }
        });

        // Fonction pour charger les tâches d'un projet
        function loadTasksByProject(projectId) {
            // Réinitialiser la liste des tâches
            taskSelect.innerHTML = '<option value="" selected disabled>Chargement...</option>';
            taskSelect.disabled = true;

            // Requête AJAX pour récupérer les tâches du projet
            fetch(`/admin/tasks/project/${projectId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(function(data) {
                if (data.success) {
                    const tasks = data.data || data.tasks || [];

                    // Réinitialiser le select
                    taskSelect.innerHTML = '<option value="" selected disabled>Sélectionner une tâche</option>';

                    // Ajouter les options de tâches
                    tasks.forEach(function(task) {
                        const option = document.createElement('option');
                        option.value = task.id;
                        option.textContent = task.title;
                        taskSelect.appendChild(option);
                    });

                    // Activer le select
                    taskSelect.disabled = false;
                } else {
                    taskSelect.innerHTML = '<option value="" selected disabled>Aucune tâche trouvée</option>';
                }
            })
            .catch(function(error) {
                taskSelect.innerHTML = '<option value="" selected disabled>Erreur de chargement</option>';
            });
        }

        // Formatage du temps (HH:MM:SS)
        function formatTime(seconds) {
            const h = Math.floor(seconds / 3600);
            const m = Math.floor((seconds % 3600) / 60);
            const s = Math.floor(seconds % 60);
            return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
        }

        // Mise à jour du timer
        function updateTimer() {
            const currentTime = Date.now();
            const elapsedTime = Math.floor((currentTime - startTime) / 1000) + pausedTime;
            seconds = elapsedTime;
            totalSeconds = elapsedTime; // Synchroniser totalSeconds avec seconds
            timerDisplay.textContent = formatTime(seconds);
        }

        // Démarrer le timer
        startTimerBtn.addEventListener('click', function() {
            if (!projectSelect.value) {
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
                startTime = Date.now();
                pausedTime = 0;
                timer = setInterval(updateTimer, 1000);
                isRunning = true;
                isPaused = false;
                currentProjectId = projectSelect.value;

                startTimerBtn.disabled = true;
                pauseTimerBtn.disabled = false;
                stopTimerBtn.disabled = false;
                projectSelect.disabled = true;
            } else if (isPaused) {
                startTime = Date.now() - (pausedTime * 1000);
                timer = setInterval(updateTimer, 1000);
                isPaused = false;

                startTimerBtn.disabled = true;
                startTimerBtn.innerHTML = '<i class="fas fa-play mr-2"></i> Démarrer';
                pauseTimerBtn.disabled = false;
            }
        });

        // Mettre en pause le timer
        pauseTimerBtn.addEventListener('click', function() {
            if (isRunning && !isPaused) {
                clearInterval(timer);
                pausedTime = totalSeconds; // Sauvegarder le temps écoulé
                isPaused = true;

                startTimerBtn.disabled = false;
                startTimerBtn.innerHTML = '<i class="fas fa-play mr-2"></i> Reprendre';
                pauseTimerBtn.disabled = true;
            }
        });

        // Arrêter le timer et enregistrer
        stopTimerBtn.addEventListener('click', function() {
            if (isRunning || isPaused) {
                clearInterval(timer);

                if (totalSeconds > 0) {
                    saveTimeLog();
                } else {
                    resetTimer();
                }
            }
        });

        // Réinitialiser le timer
        function resetTimer() {
            clearInterval(timer);
            isRunning = false;
            isPaused = false;
            totalSeconds = 0;
            timerDisplay.textContent = '00:00:00';
            currentProjectId = null;

            startTimerBtn.disabled = false;
            startTimerBtn.innerHTML = '<i class="fas fa-play mr-2"></i> Démarrer';
            pauseTimerBtn.disabled = true;
            stopTimerBtn.disabled = true;
            projectSelect.disabled = false;
        }

        // Fonction pour sauvegarder le temps écoulé
        function saveTimeLog() {
            if (totalSeconds <= 0) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Attention',
                        text: 'Aucun temps enregistré',
                        icon: 'warning'
                    });
                } else {
                    alert('Aucun temps enregistré');
                }
                return;
            }

            const projectId = projectSelect.value;
            if (!projectId) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Attention',
                        text: 'Veuillez sélectionner un projet',
                        icon: 'warning'
                    });
                } else {
                    alert('Veuillez sélectionner un projet');
                }
                return;
            }

            const taskId = taskSelect.value;
            const description = descriptionInput.value || 'Temps enregistré via chronomètre';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Enregistrement...',
                    text: 'Veuillez patienter',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            // Utiliser fetch au lieu d'axios
            fetch('/admin/timer/log-time', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    project_id: projectId,
                    task_id: taskId || null,
                    description: description,
                    duration: totalSeconds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resetTimer();
                    
                    descriptionInput.value = '';
                    
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
                    
                    setTimeout(() => location.reload(), 1500);
                } else {
                    throw new Error(data.message || 'Erreur inconnue');
                }
            })
            .catch(error => {
                let errorMessage = 'Une erreur est survenue lors de l\'enregistrement.';

                if (error.message) {
                    errorMessage = error.message;
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Erreur',
                        text: errorMessage,
                        icon: 'error'
                    });
                } else {
                    alert('Erreur: ' + errorMessage);
                }
            });
        }

        // Fonction pour recharger les logs récents (optionnelle)
        function loadRecentLogs() {
            // Route à adapter selon votre configuration
        }

        // Fonction pour supprimer un enregistrement
        function deleteTimeLog(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) {
                fetch(`/admin/timer/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Enregistrement supprimé avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression: ' + (data.message || 'Erreur inconnue'));
                    }
                })
                .catch(error => {
                    alert('Erreur lors de la suppression');
                });
            }
        }

        // Gestionnaire d'événements pour les boutons de suppression
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-log') || e.target.closest('.delete-log')) {
                const btn = e.target.closest('.delete-log') || e.target;
                const id = btn.getAttribute('data-id');
                deleteTimeLog(id);
            }
        });

        // Gestion de la modification des logs
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-log') || e.target.closest('.edit-log')) {
                const btn = e.target.closest('.edit-log') || e.target;
                const logId = btn.getAttribute('data-id');
                const projectId = btn.getAttribute('data-project');
                const taskId = btn.getAttribute('data-task');
                const description = btn.getAttribute('data-description');
                const duration = btn.getAttribute('data-duration');

                // Version simplifiée sans SweetAlert
                const newDuration = prompt('Nouvelle durée (secondes):', duration);
                const newDescription = prompt('Nouvelle description:', description);
                
                if (newDuration && newDuration > 0) {
                    fetch(`/admin/timer/${logId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            duration: newDuration,
                            description: newDescription || description
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Enregistrement mis à jour avec succès');
                            location.reload();
                        } else {
                            alert('Erreur lors de la mise à jour: ' + (data.message || 'Erreur inconnue'));
                        }
                    })
                    .catch(error => {
                        alert('Erreur lors de la mise à jour');
                    });
                }
            }
        });

        // Graphiques
        if (typeof Chart !== 'undefined') {
            // Charger les données pour les graphiques
            fetch('/admin/timer/logs', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Données pour le graphique de temps par projet
                    const projectStats = data.stats.projectStats || [];
                        const projectLabels = projectStats.map(project => project.name);
                        const projectDurations = projectStats.map(project => project.duration / 3600); // Convertir en heures
                        const projectColors = [
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(201, 203, 207, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 205, 86, 0.6)'
                        ];

                        // Graphique temps par projet
                        new Chart(document.getElementById('projectTimeChart'), {
                            type: 'pie',
                            data: {
                                labels: projectLabels.length ? projectLabels : ['Aucune donnée'],
                                datasets: [{
                                    data: projectDurations.length ? projectDurations : [1],
                                    backgroundColor: projectLabels.length ?
                                        projectLabels.map((_, i) => projectColors[i % projectColors.length]) :
                                        ['rgba(201, 203, 207, 0.6)'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.raw || 0;
                                                return `${context.label}: ${value.toFixed(2)} heures`;
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Données pour le graphique de temps par jour
                        const dailyStats = data.stats.dailyStats || [];
                        // Créer un tableau pour les 7 derniers jours
                        const dayLabels = [];
                        const dayDurations = [];

                        // Obtenir les 7 derniers jours (en utilisant JavaScript natif)
                        for (let i = 6; i >= 0; i--) {
                            const date = new Date();
                            date.setDate(date.getDate() - i);
                            const dayNames = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
                            const dayName = dayNames[date.getDay()];

                            dayLabels.push(dayName);

                            // Formater la date pour la comparaison (YYYY-MM-DD)
                            const year = date.getFullYear();
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const day = String(date.getDate()).padStart(2, '0');
                            const dateStr = `${year}-${month}-${day}`;

                            // Chercher si on a des données pour ce jour
                            const dayStat = dailyStats.find(stat => stat.date === dateStr);
                            dayDurations.push(dayStat ? dayStat.duration / 3600 : 0); // Convertir en heures
                        }

                        // Graphique temps quotidien
                        new Chart(document.getElementById('dailyTimeChart'), {
                            type: 'bar',
                            data: {
                                labels: dayLabels,
                                datasets: [{
                                    label: 'Heures travaillées',
                                    data: dayDurations,
                                    backgroundColor: 'rgba(60, 141, 188, 0.6)',
                                    borderColor: 'rgba(60, 141, 188, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Heures'
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.raw || 0;
                                                return `${value.toFixed(2)} heures`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                })
                .catch(error => {

                    // Afficher des graphiques vides en cas d'erreur
                    new Chart(document.getElementById('projectTimeChart'), {
                        type: 'pie',
                        data: {
                            labels: ['Aucune donnée'],
                            datasets: [{
                                data: [1],
                                backgroundColor: ['rgba(201, 203, 207, 0.6)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    new Chart(document.getElementById('dailyTimeChart'), {
                        type: 'bar',
                        data: {
                            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                            datasets: [{
                                label: 'Heures travaillées',
                                data: [0, 0, 0, 0, 0, 0, 0],
                                backgroundColor: 'rgba(156, 163, 175, 0.6)',
                                borderColor: 'rgba(156, 163, 175, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Heures'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                });
        }
        
        // Gestion du dropdown de filtres
        const filterDropdownBtn = document.getElementById('filterDropdown');
        const filterMenu = document.getElementById('filterMenu');
        const filterChevron = document.getElementById('filterChevron');
        const filterOptions = document.querySelectorAll('.filter-option');
        
        if (filterDropdownBtn && filterMenu) {
            filterDropdownBtn.addEventListener('click', function(e) {
                e.preventDefault();
                filterMenu.classList.toggle('hidden');
                filterChevron.classList.toggle('rotate-180');
            });
            
            // Fermer le dropdown si on clique ailleurs
            document.addEventListener('click', function(e) {
                if (!filterDropdownBtn.contains(e.target) && !filterMenu.contains(e.target)) {
                    filterMenu.classList.add('hidden');
                    filterChevron.classList.remove('rotate-180');
                }
            });
            
            // Gestion des options de filtre
            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const period = this.getAttribute('data-period');
                    // Ici vous pouvez ajouter la logique de filtrage
                    filterMenu.classList.add('hidden');
                    filterChevron.classList.remove('rotate-180');
                });
            });
        }
        
        // Raccourcis clavier
        document.addEventListener('keydown', function(e) {
            // Ctrl + Espace pour démarrer/pause
            if (e.ctrlKey && e.code === 'Space') {
                e.preventDefault();
                if (!isRunning && !isPaused) {
                    startTimerBtn.click();
                } else if (isRunning && !isPaused) {
                    pauseTimerBtn.click();
                } else if (isPaused) {
                    startTimerBtn.click();
                }
            }
            // Escape pour arrêter
            else if (e.key === 'Escape' && (isRunning || isPaused)) {
                stopTimerBtn.click();
            }
        });
        
        // Animation pour les boutons hover
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            if (!button.disabled) {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }
        });
        
        // Initialiser l'état des boutons
        pauseTimerBtn.disabled = true;
        stopTimerBtn.disabled = true;
        
        console.log('Timer page initialisée avec succès');
    });
</script>
@stop 