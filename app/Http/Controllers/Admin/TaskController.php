<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la liste des tâches.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Récupérer les projets réels depuis la base de données
        $projects = Project::all();
        
        // Récupérer les tâches réelles depuis la base de données
        $tasks = Task::with('project')->get();
        
        return view('admin.tasks.index', compact('tasks', 'projects'));
    }
    
    /**
     * Affiche les détails d'une tâche
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Récupérer la tâche avec les relations
        $task = Task::with('project')->find($id);
        
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Tâche non trouvée'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }
    
    /**
     * Récupère les données d'une tâche pour l'édition
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        // Récupérer la tâche
        $task = Task::find($id);
        
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Tâche non trouvée'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }
    
    /**
     * Ajoute une nouvelle tâche.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|integer',
            'priority' => ['required', 'string', Rule::in([
                Task::PRIORITY_LOW, Task::PRIORITY_MEDIUM, Task::PRIORITY_HIGH, Task::PRIORITY_URGENT
            ])],
            'status' => ['required', 'string', Rule::in([
                Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_REVIEW, Task::STATUS_DONE
            ])],
            'due_date' => 'nullable|date',
            'progress' => 'required|integer|min:0|max:100',
        ]);
        
        // Créer une nouvelle tâche en base de données
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->progress = $request->progress;
        $task->user_id = auth()->id(); // Assigner l'utilisateur courant
        $task->save();
        
        // Si la requête attend une réponse JSON (AJAX)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche ajoutée avec succès',
                'task' => $task
            ]);
        }
        
        // Sinon, rediriger avec un message flash
        return redirect()->route('admin.tasks.index')
            ->with('success', 'Tâche ajoutée avec succès');
    }
    
    /**
     * Met à jour une tâche existante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|integer',
            'priority' => ['required', 'string', Rule::in([
                Task::PRIORITY_LOW, Task::PRIORITY_MEDIUM, Task::PRIORITY_HIGH, Task::PRIORITY_URGENT
            ])],
            'status' => ['required', 'string', Rule::in([
                Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_REVIEW, Task::STATUS_DONE
            ])],
            'due_date' => 'nullable|date',
            'progress' => 'required|integer|min:0|max:100',
        ]);
        
        // Récupérer et mettre à jour la tâche
        $task = Task::find($id);
        
        if (!$task) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tâche non trouvée'
                ], 404);
            }
            
            return redirect()->route('admin.tasks.index')
                ->with('error', 'Tâche non trouvée');
        }
        
        // Mettre à jour les propriétés
        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->progress = $request->progress;
        $task->save();
        
        // Si la requête attend une réponse JSON (AJAX)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche mise à jour avec succès',
                'task' => $task
            ]);
        }
        
        // Sinon, rediriger avec un message flash
        return redirect()->route('admin.tasks.index')
            ->with('success', 'Tâche mise à jour avec succès');
    }
    
    /**
     * Met à jour la progression d'une tâche
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function updateProgress(Request $request)
    {
        // Validation des données
        $request->validate([
            'task_id' => 'required|integer',
            'progress' => 'required|integer|min:0|max:100',
            'note' => 'nullable|string',
        ]);
        
        // Récupérer la tâche
        $task = Task::find($request->task_id);
        
        if (!$task) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tâche non trouvée'
                ], 404);
            }
            
            return redirect()->route('admin.tasks.index')
                ->with('error', 'Tâche non trouvée');
        }
        
        // Mettre à jour la progression
        $task->progress = $request->progress;
        
        // Mettre à jour automatiquement le statut en fonction de la progression
        if ($task->progress == 0) {
            $task->status = 'a-faire';
        } elseif ($task->progress == 100) {
            $task->status = 'termine';
        } elseif ($task->progress > 0 && $task->progress < 100) {
            $task->status = 'en-cours';
        }
        
        $task->save();
        
        // Si une note est fournie, on pourrait l'enregistrer dans un système de commentaires
        // (à implémenter si nécessaire)
        
        // Si la requête attend une réponse JSON (AJAX)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Progression mise à jour avec succès',
                'task' => $task
            ]);
        }
        
        // Sinon, rediriger avec un message flash
        return redirect()->route('admin.tasks.index')
            ->with('success', 'Progression mise à jour avec succès');
    }
    
    /**
     * Supprime une tâche.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Récupérer la tâche
            $task = Task::findOrFail($id);
            
            // Vérifier et supprimer les time logs associés
            $task->timeLogs()->delete();
            
            // Supprimer la tâche
            $task->delete();
            
            // Si la requête attend une réponse JSON (AJAX)
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tâche supprimée avec succès'
                ]);
            }
            
            return redirect()->route('admin.tasks.index')->with('success', 'Tâche supprimée avec succès');
        } catch (\Exception $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('admin.tasks.index')->with('error', 'Erreur lors de la suppression');
        }
    }
    
    /**
     * Récupère les tâches par projet pour le timer
     *
     * @param  int  $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTasksByProject($projectId)
    {
        $tasks = Task::where('project_id', $projectId)
                     ->orderBy('title')
                     ->get(['id', 'title', 'status', 'progress', 'priority']);
        
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }
} 