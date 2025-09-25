<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Client;
use App\Models\Project;

class ClientController extends Controller
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
     * Display a listing of clients with performance optimization.
     */
    public function index()
    {
        $clients = Client::query()
            ->withCount(['projects', 'users', 'tickets'])
            ->orderBy('name')
            ->paginate(15);
        
        return view('admin.clients.index', compact('clients'));
    }
    
    /**
     * Affiche le formulaire d'ajout de client.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('admin.clients.create');
    }
    
    /**
     * Enregistre un nouveau client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        // Créer le client avec le modèle Client
        $client = new \App\Models\Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->company = $request->company;
        $client->address = $request->address;
        $client->notes = $request->notes;
        $client->save();
        
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client ajouté avec succès');
    }
    
    /**
     * Affiche la fiche d'un client.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        // Récupérer le client avec ses projets associés
        $client = \App\Models\Client::findOrFail($id);
        
        // Récupérer les projets liés à ce client
        $projects = $client->projects;
        
        return view('admin.clients.show', compact('client', 'projects'));
    }
    
    /**
     * Affiche le formulaire d'édition d'un client.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        // Récupérer le client
        $client = \App\Models\Client::findOrFail($id);
        
        return view('admin.clients.edit', compact('client'));
    }
    
    /**
     * Met à jour un client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        // Mettre à jour le client
        $client = \App\Models\Client::findOrFail($id);
        $client->update($request->all());
        
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client mis à jour avec succès');
    }
    
    /**
     * Supprime un client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Récupérer le client
            $client = \App\Models\Client::findOrFail($id);
            
            // Vérifier si le client a des projets
            if ($client->projects()->count() > 0) {
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ce client a des projets associés et ne peut pas être supprimé. Supprimez d\'abord les projets.'
                    ], 400);
                }
                
                return redirect()->route('admin.clients.index')
                    ->with('error', 'Ce client a des projets associés et ne peut pas être supprimé. Supprimez d\'abord les projets.');
            }
            
            // Supprimer le client
            $clientName = $client->name;
            $client->delete();
            
            // Si la requête attend une réponse JSON (AJAX)
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Client \"{$clientName}\" supprimé avec succès"
                ]);
            }
            
            // Sinon, rediriger avec un message flash
            return redirect()->route('admin.clients.index')
                ->with('success', "Client \"{$clientName}\" supprimé avec succès");
                
        } catch (\Exception $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('admin.clients.index')
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Associe un client à un projet
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function assignToProject(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id'
        ]);

        try {
            $client = Client::findOrFail($id);
            $success = $client->assignToProject($request->project_id);

            if ($success) {
                $project = Project::find($request->project_id);
                $message = "Client '{$client->name}' associé au projet '{$project->title}' avec succès";
                
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $message
                    ]);
                }
                
                return redirect()->back()->with('success', $message);
            } else {
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erreur lors de l\'association'
                    ], 400);
                }
                
                return redirect()->back()->with('error', 'Erreur lors de l\'association');
            }
        } catch (\Exception $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur : ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
} 