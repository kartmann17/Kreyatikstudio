@extends('admin.layout')

@section('title', 'Gestion des Articles')

@section('page_title', 'Gestion des Articles')

@section('content_body')
    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-blue-100">Total articles</h3>
                    <p class="text-2xl font-bold mt-1">{{ $articles->total() ?? count($articles) }}</p>
                </div>
                <div class="bg-blue-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-green-100">Articles publiés</h3>
                    <p class="text-2xl font-bold mt-1">{{ $articles->where('is_published', true)->count() }}</p>
                </div>
                <div class="bg-green-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-eye text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-orange-100">Brouillons</h3>
                    <p class="text-2xl font-bold mt-1">{{ $articles->where('is_published', false)->count() }}</p>
                </div>
                <div class="bg-orange-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-edit text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-purple-100">Ce mois</h3>
                    <p class="text-2xl font-bold mt-1">{{ $articles->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
                <div class="bg-purple-500 bg-opacity-30 rounded-lg p-3">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                <i class="fas fa-newspaper mr-2"></i>
                Liste des Articles
            </h3>
            <a href="{{ route('admin.articles.create') }}" class="bg-white text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                <i class="fas fa-plus mr-2"></i> 
                Nouvel Article
            </a>
        </div>
        <div class="p-6">
            <!-- Success Message -->
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
            
            <!-- View Toggle -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-2">
                    <button id="tableViewBtn" class="bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                        <i class="fas fa-table mr-2"></i> Tableau
                    </button>
                    <button id="gridViewBtn" class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-lg flex items-center transition-all duration-200">
                        <i class="fas fa-th-large mr-2"></i> Grille
                    </button>
                </div>
                
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">{{ $articles->count() }} article(s)</span>
                </div>
            </div>

            @if(count($articles) > 0)
            <!-- Table View -->
            <div id="tableView">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publication</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($articles as $article)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <div class="text-sm font-medium text-gray-900 truncate">{{ $article->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($article->content ?? ''), 50) }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.articles.toggle-publish', $article) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors duration-200 {{ $article->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                            <i class="fas {{ $article->is_published ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                                            {{ $article->is_published ? 'Publié' : 'Brouillon' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Non publié' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="delete-article bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $article->id }}" data-title="{{ $article->title }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Grid View -->
            <div id="gridView" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($articles as $article)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-200">
                            <!-- Image -->
                            <div class="h-48 bg-gray-200 relative overflow-hidden">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <i class="fas fa-image text-4xl text-gray-400"></i>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-3 right-3">
                                    <form action="{{ route('admin.articles.toggle-publish', $article) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }} hover:opacity-80 transition-opacity">
                                            <i class="fas {{ $article->is_published ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                                            {{ $article->is_published ? 'Publié' : 'Brouillon' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $article->title }}</h3>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content ?? ''), 120) }}</p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <div class="text-sm text-gray-500">
                                        {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Non publié' }}
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition-colors duration-200" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="delete-article bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors duration-200" data-id="{{ $article->id }}" data-title="{{ $article->title }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <div class="flex flex-col items-center">
                    <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                    <p class="text-lg font-medium text-gray-500">Aucun article disponible</p>
                    <p class="text-sm text-gray-400 mb-4">Commencez par créer votre premier article</p>
                    <a href="{{ route('admin.articles.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Créer un article
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    @if(isset($articles) && method_exists($articles, 'links'))
    <div class="mt-8 flex justify-center">
        {{ $articles->links() }}
    </div>
    @endif
@stop

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const tableViewBtn = document.getElementById('tableViewBtn');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const tableView = document.getElementById('tableView');
    const gridView = document.getElementById('gridView');

    if (tableViewBtn && gridViewBtn && tableView && gridView) {
        tableViewBtn.addEventListener('click', function() {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            
            tableViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
            tableViewBtn.classList.add('bg-indigo-600', 'text-white');
            
            gridViewBtn.classList.remove('bg-indigo-600', 'text-white');
            gridViewBtn.classList.add('bg-gray-200', 'text-gray-700');
        });

        gridViewBtn.addEventListener('click', function() {
            gridView.classList.remove('hidden');
            tableView.classList.add('hidden');
            
            gridViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
            gridViewBtn.classList.add('bg-indigo-600', 'text-white');
            
            tableViewBtn.classList.remove('bg-indigo-600', 'text-white');
            tableViewBtn.classList.add('bg-gray-200', 'text-gray-700');
        });
    }

    // Delete article functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-article')) {
            const button = e.target.closest('.delete-article');
            const articleId = button.dataset.id;
            const articleTitle = button.dataset.title;
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: `Voulez-vous vraiment supprimer l'article "${articleTitle}" ? Cette action est irréversible.`,
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
                    form.action = `/admin/articles/${articleId}`;
                    
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

    // Auto-hide success message
    const successAlert = document.querySelector('.bg-green-50');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 300);
        }, 5000);
    }
});
</script>
@stop