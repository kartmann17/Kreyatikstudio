@extends('admin.layout')

@section('title', 'Messages de contact')

@section('page_title', 'Messages de contact')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-blue-100">Total messages</h3>
                    <p class="text-2xl font-bold mt-1">{{ $messages->count() }}</p>
                </div>
                <div class="bg-blue-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-orange-100">Non lus</h3>
                    <p class="text-2xl font-bold mt-1">{{ $unreadCount }}</p>
                </div>
                <div class="bg-orange-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-envelope-open text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-green-100">Messages lus</h3>
                    <p class="text-2xl font-bold mt-1">{{ $messages->where('is_read', true)->count() }}</p>
                </div>
                <div class="bg-green-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-purple-100">Aujourd'hui</h3>
                    <p class="text-2xl font-bold mt-1">{{ $messages->where('created_at', '>=', today())->count() }}</p>
                </div>
                <div class="bg-purple-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-calendar-day text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <nav class="mb-4 sm:mb-0">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                        <i class="fas fa-home mr-1"></i>
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                </li>
                <li class="text-gray-900 font-medium">Messages de contact</li>
            </ol>
        </nav>
        
        @if($unreadCount > 0)
        <form action="{{ route('admin.contact-messages.mark-multiple-as-read') }}" method="POST" id="mark-all-form" class="inline">
            @csrf
            <input type="hidden" name="ids" value="{{ $messages->whereIn('is_read', [false])->pluck('id')->implode(',') }}">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                <i class="fas fa-check-double mr-2"></i> 
                Marquer tous comme lus
            </button>
        </form>
        @endif
    </div>

    <!-- Success/Error Messages -->
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

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                <i class="fas fa-envelope mr-2"></i>
                Messages de contact
                @if($unreadCount > 0)
                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs ml-2">
                    {{ $unreadCount }} non lu(s)
                </span>
                @endif
            </h3>
        </div>
        <div class="p-6">
            @if($messages->isEmpty())
            <div class="text-center py-12">
                <div class="flex flex-col items-center">
                    <i class="fas fa-envelope text-4xl text-gray-300 mb-4"></i>
                    <p class="text-lg font-medium text-gray-500">Aucun message de contact</p>
                    <p class="text-sm text-gray-400">Les nouveaux messages apparaîtront ici</p>
                </div>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($messages as $message)
                        <tr class="{{ $message->is_read ? 'hover:bg-gray-50' : 'bg-blue-50 hover:bg-blue-100' }} transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $message->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                        {{ strtoupper(substr($message->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            <a href="mailto:{{ $message->email }}" class="hover:text-blue-600 transition-colors">
                                                {{ $message->email }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $message->subject }}">
                                    {{ $message->subject }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($message->is_read)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Lu
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 animate-pulse">
                                        <i class="fas fa-circle mr-1"></i>
                                        Non lu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Voir le message">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="delete-message bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $message->id }}" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $messages->links() }}
            </div>
            @endif
        </div>
    </div>
@stop

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete message functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-message')) {
            const button = e.target.closest('.delete-message');
            const messageId = button.dataset.id;
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: 'Voulez-vous vraiment supprimer ce message de contact ? Cette action est irréversible.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonClass: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg mr-2',
                cancelButtonClass: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('admin/contact-messages') }}/${messageId}`;
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    });
    
    // Auto-hide success/error messages
    const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
    alerts.forEach(alert => {
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }, 5000);
        }
    });
});
</script>
@stop