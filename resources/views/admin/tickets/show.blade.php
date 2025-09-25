@extends('admin.layout')

@section('title', 'Détail du ticket #' . $ticket->ticket_number)

@section('page_title', 'Détail du ticket #' . $ticket->ticket_number)

@section('content_header')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Ticket #{{ $ticket->ticket_number }}</h1>
        <nav class="flex mt-2 sm:mt-0" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.tickets.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600">Tickets</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500">{{ $ticket->ticket_number }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content_body')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Ticket Details -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $ticket->title }}</h3>
                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 transition-colors">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-medium text-gray-700">Client:</span>
                            <span class="ml-2 text-gray-900">{{ $ticket->client->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="font-medium text-gray-700">Projet:</span>
                            <span class="ml-2 text-gray-900">{{ $ticket->project->title ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium text-gray-700">Créé le:</span>
                            <span class="ml-2 text-gray-900">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium text-gray-700">Créé par:</span>
                            <span class="ml-2 text-gray-900">{{ $ticket->creator->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium text-gray-700">Statut:</span>
                            <div class="ml-2">
                                @if ($ticket->status === 'ouvert')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Ouvert</span>
                                @elseif ($ticket->status === 'en-cours')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">En cours</span>
                                @elseif ($ticket->status === 'résolu')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Résolu</span>
                                    <small class="text-gray-500 ml-1">({{ $ticket->resolved_at ? $ticket->resolved_at->format('d/m/Y H:i') : 'N/A' }})</small>
                                @elseif ($ticket->status === 'fermé')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Fermé</span>
                                    <small class="text-gray-500 ml-1">({{ $ticket->closed_at ? $ticket->closed_at->format('d/m/Y H:i') : 'N/A' }})</small>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="font-medium text-gray-700">Priorité:</span>
                            <div class="ml-2">
                                @if ($ticket->priority === 'basse')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Basse</span>
                                @elseif ($ticket->priority === 'moyenne')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">Moyenne</span>
                                @elseif ($ticket->priority === 'haute')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Haute</span>
                                @elseif ($ticket->priority === 'urgente')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Urgente</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="font-medium text-gray-700">Assigné à:</span>
                            <span class="ml-2 text-gray-900">{{ $ticket->assignedUser->name ?? 'Non assigné' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium text-gray-700">Navigateur:</span>
                            <span class="ml-2 text-gray-500 text-sm">{{ $ticket->browser }}</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <h5 class="text-lg font-medium text-gray-900 mb-3">Description</h5>
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                            <div class="text-gray-700 whitespace-pre-line">
                                {!! nl2br(e($ticket->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Comments -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Commentaires et activité</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @forelse($ticket->comments->sortBy('created_at') as $comment)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full {{ $comment->is_private ? 'bg-gray-600' : 'bg-blue-600' }} flex items-center justify-center">
                                        @if($comment->is_private)
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.11 8.11m1.768 1.768l-.442.442a3 3 0 001.768 1.768m-4.984 0L8.11 15.89m4.242-4.242L15.89 8.11m-1.768 1.768l-.442.442a3 3 0 01-1.768-1.768M9.878 9.878l4.242 4.242" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <h4 class="text-sm font-medium text-gray-900">
                                                {{ $comment->user ? $comment->user->name : 'Utilisateur supprimé' }}
                                            </h4>
                                            @if($comment->is_private)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Privé</span>
                                            @endif
                                            @if($comment->is_solution)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Solution</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $comment->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-700 whitespace-pre-line">
                                        {!! nl2br(e($comment->content)) !!}
                                    </div>
                                    
                                    @if($comment->hasAttachment())
                                        <div class="mt-3">
                                            <a href="{{ url('storage/ticket_attachments/' . $comment->attachment) }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-sm text-blue-600 hover:bg-blue-50 transition-colors">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                Pièce jointe
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if(!$loop->last)
                                <div class="border-t border-gray-100"></div>
                            @endif
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="text-gray-500">Aucun commentaire pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <!-- Comment Form -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Ajouter un commentaire</h3>
                </div>
                <form action="{{ route('admin.tickets.comment.add', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <textarea name="content" rows="4" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Votre commentaire..." required></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pièce jointe (optionnel)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Télécharger un fichier</span>
                                            <input id="attachment" name="attachment" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">ou glissez-déposez</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF jusqu'à 2MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="is_private" name="is_private" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_private" class="ml-2 block text-sm text-gray-900">
                                    Commentaire privé (visible uniquement par l'équipe)
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="is_solution" name="is_solution" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="is_solution" class="ml-2 block text-sm text-gray-900">
                                    Marquer comme solution (fermera automatiquement le ticket)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="lg:col-span-1">
            <!-- Status Actions -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Actions</h3>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <h5 class="text-sm font-medium text-gray-900 mb-3">Changer le statut</h5>
                        <div class="grid grid-cols-2 gap-2">
                            <form action="{{ route('admin.tickets.status.change', $ticket->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="ouvert">
                                <button type="submit" class="w-full px-3 py-2 text-sm font-medium rounded-md {{ $ticket->status === 'ouvert' ? 'bg-blue-100 text-blue-800 cursor-not-allowed' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }} border border-blue-200 transition-colors">
                                    Ouvert
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.tickets.status.change', $ticket->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="en-cours">
                                <button type="submit" class="w-full px-3 py-2 text-sm font-medium rounded-md {{ $ticket->status === 'en-cours' ? 'bg-yellow-100 text-yellow-800 cursor-not-allowed' : 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100' }} border border-yellow-200 transition-colors">
                                    En cours
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.tickets.status.change', $ticket->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="résolu">
                                <button type="submit" class="w-full px-3 py-2 text-sm font-medium rounded-md {{ $ticket->status === 'résolu' ? 'bg-green-100 text-green-800 cursor-not-allowed' : 'bg-green-50 text-green-700 hover:bg-green-100' }} border border-green-200 transition-colors">
                                    Résolu
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.tickets.status.change', $ticket->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="fermé">
                                <button type="submit" class="w-full px-3 py-2 text-sm font-medium rounded-md {{ $ticket->status === 'fermé' ? 'bg-gray-100 text-gray-800 cursor-not-allowed' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }} border border-gray-200 transition-colors">
                                    Fermé
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h5 class="text-sm font-medium text-gray-900 mb-3">Assignation</h5>
                        <form action="{{ route('admin.tickets.assign', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <select name="assigned_to" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">-- Non assigné --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="w-full inline-flex justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    Assigner
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <button type="button" onclick="document.getElementById('delete-modal').classList.remove('hidden')" class="w-full inline-flex justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Supprimer le ticket
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Related Info -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Informations complémentaires</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @if($ticket->client)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                                <span class="text-sm font-medium text-gray-700">Client:</span>
                                <a href="{{ route('admin.clients.show', $ticket->client_id) }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $ticket->client->name }}
                                </a>
                            </div>
                        @endif
                        
                        @if($ticket->project)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                                <span class="text-sm font-medium text-gray-700">Projet:</span>
                                <a href="{{ route('admin.projects.show', $ticket->project_id) }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $ticket->project->title }}
                                </a>
                            </div>
                        @endif
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-700">Adresse IP:</span>
                            <span class="text-sm text-gray-900 font-mono">{{ $ticket->ip_address }}</span>
                        </div>
                        
                        <div class="flex justify-between items-start py-2">
                            <span class="text-sm font-medium text-gray-700">Navigateur:</span>
                            <span class="text-xs text-gray-500 max-w-xs text-right break-words">{{ $ticket->browser }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal de confirmation de suppression -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" id="delete-modal">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Confirmer la suppression</h3>
                <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-sm text-gray-700">
                    Êtes-vous sûr de vouloir supprimer le ticket <strong class="text-gray-900">{{ $ticket->ticket_number }}</strong> ?
                    <br><br>
                    <span class="text-red-600 font-medium">Cette action est irréversible.</span>
                </p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Annuler
                </button>
                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload feedback
    const fileInput = document.getElementById('attachment');
    const fileLabel = fileInput ? fileInput.closest('div').querySelector('label') : null;
    
    if (fileInput && fileLabel) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Télécharger un fichier';
            fileLabel.querySelector('span').textContent = fileName;
        });
    }
    
    // Close modal on outside click
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
});
</script>
@endsection 