@extends('admin.layout')

@section('title', 'Détail du message')

@section('page_title', 'Détail du message')

@section('content_body')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb et bouton retour -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Tableau de bord
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('admin.contact-messages.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600">Messages de contact</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500">Détail</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.contact-messages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
            </a>
        </div>
    </div>

    <!-- Messages de session -->
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

    <!-- Carte principale du message -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- En-tête de la carte -->
        <div class="flex justify-between items-center bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-xl px-6 py-4">
            <div class="flex items-center">
                <i class="fas fa-envelope mr-3"></i>
                <span class="text-lg font-semibold">Message de {{ $message->name }}</span>
                @if($message->is_read)
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check mr-1"></i>Lu
                    </span>
                @else
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-exclamation mr-1"></i>Non lu
                    </span>
                @endif
            </div>
            <div>
                <span class="text-blue-100">{{ $message->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>

        <!-- Contenu de la carte -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Informations de contact -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Informations de contact</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium text-gray-700">Nom :</span> {{ $message->name }}</p>
                        <p><span class="font-medium text-gray-700">Email :</span> <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:text-blue-800">{{ $message->email }}</a></p>
                        <p><span class="font-medium text-gray-700">IP :</span> {{ $message->ip_address ?? 'Non disponible' }}</p>
                        <p><span class="font-medium text-gray-700">Date :</span> {{ $message->created_at->format('d/m/Y H:i') }}</p>
                        <p>
                            <span class="font-medium text-gray-700">Statut :</span>
                            @if($message->is_read)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Lu le {{ $message->read_at->format('d/m/Y H:i') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation mr-1"></i>Non lu
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Actions</h3>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" id="replyBtn" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-reply mr-2"></i> Répondre
                        </button>
                        
                        @if(!$message->is_read)
                            <form action="{{ route('admin.contact-messages.mark-as-read', $message->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-check mr-2"></i> Marquer comme lu
                                </button>
                            </form>
                        @endif
                        
                        <button type="button" id="deleteBtn" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Sujet et message -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Sujet</h3>
                    <p class="font-semibold text-gray-900">{{ $message->subject }}</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Message</h3>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $message->message }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulaire de suppression (caché) -->
<form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" id="deleteForm" class="hidden">
    @csrf
    @method('DELETE')
</form>

<!-- Modal de réponse -->
<div id="replyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Répondre au message</h3>
                <button type="button" id="closeReplyModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.contact-messages.reply', $message->id) }}" method="POST" id="replyForm">
                @csrf
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="space-y-4">
                    <div>
                        <label for="reply-to" class="block text-sm font-medium text-gray-700 mb-1">Destinataire</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100" id="reply-to" name="email" value="{{ $message->email }}" readonly>
                    </div>
                    <div>
                        <label for="reply-subject" class="block text-sm font-medium text-gray-700 mb-1">Sujet</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="reply-subject" name="subject" value="Re: {{ $message->subject }}">
                    </div>
                    <div>
                        <label for="reply-content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="reply-content" name="content" rows="10" required>Bonjour {{ $message->name }},

Merci pour votre message.

Cordialement,
L'équipe d'administration</textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancelReplyBtn" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium rounded-lg transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Confirmation de suppression</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Êtes-vous sûr de vouloir supprimer ce message ?
                </p>
            </div>
            <div class="flex justify-center space-x-3 mt-4">
                <button type="button" id="cancelDeleteBtn" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium rounded-lg transition-colors duration-200">
                    Annuler
                </button>
                <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Récupération des éléments
    const replyBtn = document.getElementById('replyBtn');
    const replyModal = document.getElementById('replyModal');
    const closeReplyModal = document.getElementById('closeReplyModal');
    const cancelReplyBtn = document.getElementById('cancelReplyBtn');
    
    const deleteBtn = document.getElementById('deleteBtn');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    // Fonctions pour ouvrir/fermer les modals
    function openModal(modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal(modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Gestion du modal de réponse
    if (replyBtn && replyModal) {
        replyBtn.addEventListener('click', function() {
            openModal(replyModal);
        });
        
        if (closeReplyModal) {
            closeReplyModal.addEventListener('click', function() {
                closeModal(replyModal);
            });
        }
        
        if (cancelReplyBtn) {
            cancelReplyBtn.addEventListener('click', function() {
                closeModal(replyModal);
            });
        }
        
        // Fermer le modal en cliquant sur le fond
        replyModal.addEventListener('click', function(e) {
            if (e.target === replyModal) {
                closeModal(replyModal);
            }
        });
    }
    
    // Gestion du modal de suppression
    if (deleteBtn && deleteModal) {
        deleteBtn.addEventListener('click', function() {
            openModal(deleteModal);
        });
        
        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', function() {
                closeModal(deleteModal);
            });
        }
        
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function() {
                document.getElementById('deleteForm').submit();
            });
        }
        
        // Fermer le modal en cliquant sur le fond
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeModal(deleteModal);
            }
        });
    }
    
    // Fermer les modals avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!replyModal.classList.contains('hidden')) {
                closeModal(replyModal);
            }
            if (!deleteModal.classList.contains('hidden')) {
                closeModal(deleteModal);
            }
        }
    });
    
    // Auto-masquer les messages de succès/erreur après 5 secondes
    const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
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
</script>
@endsection 