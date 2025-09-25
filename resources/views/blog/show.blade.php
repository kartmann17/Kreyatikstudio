@push('meta')
<meta name="description" content="{{ $article->meta_description ?: Str::limit(strip_tags($article->content), 160) }}">
<meta name="keywords" content="{{ $article->meta_keywords ?: 'blog web, article, ' . $article->title }}">
<meta name="author" content="Kréyatik Studio">
@endpush

<x-header 
    :title="$article->title"
    :description="$article->meta_description ?: Str::limit(strip_tags($article->content), 160)"
/>

<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden pt-20">
    @if($article->image)
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('storage/' . $article->image) }}" 
             alt="{{ $article->title }}" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>
    @else
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900"></div>
    @endif
    
    <div class="relative z-10 container mx-auto px-4 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-2 mb-6">
                <span class="text-sm font-medium">Article</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight animate-fade-in">
                {{ $article->title }}
            </h1>
            
            <div class="flex items-center justify-center space-x-6 text-sm md:text-base opacity-90">
                <div class="flex items-center">
                    <i class="fas fa-calendar w-5 h-5 mr-2"></i>
                    <span>{{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Non publié' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock w-5 h-5 mr-2"></i>
                    <span>{{ $readingTime ?? 5 }} min de lecture</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8">
                    <article class="prose prose-lg max-w-none">
                        <div class="mb-12">
                            <p class="text-xl text-gray-600 leading-relaxed italic border-l-4 border-blue-500 pl-6">
                                {{ Str::limit(strip_tags($article->content), 200) }}...
                            </p>
                        </div>
                        
                        <div class="text-gray-800 leading-relaxed">
                            {!! $article->content !!}
                        </div>
                    </article>
                </div>
                
                <div class="lg:col-span-4">
                    <div class="sticky top-8">
                        <div class="bg-gray-50 rounded-2xl p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">À propos de l'auteur</h3>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                                    {{ isset($author) && $author ? substr($author->name, 0, 1) : 'K' }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ isset($author) && $author ? $author->name : 'Kréyatik Studio' }}</p>
                                    <p class="text-sm text-gray-600">{{ isset($author) && $author ? $author->email : 'Agence web créative' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-2xl p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Partager cet article</h3>
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}&quote={{ urlencode($article->title) }}" 
                                   target="_blank"
                                   class="flex items-center justify-center p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                    <i class="fab fa-facebook-f w-4 h-4 mr-2"></i>
                                    <span class="text-sm font-medium">Facebook</span>
                                </a>
                                <a href="https://x.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title . ' - Kréyatik Studio') }}&hashtags=web,blog,kreyatik" 
                                   target="_blank"
                                   class="flex items-center justify-center p-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors duration-300">
                                    <i class="fab fa-x-twitter w-4 h-4 mr-2"></i>
                                    <span class="text-sm font-medium">X (Twitter)</span>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}&summary={{ urlencode(Str::limit(strip_tags($article->content), 160)) }}" 
                                   target="_blank"
                                   class="flex items-center justify-center p-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors duration-300">
                                    <i class="fab fa-linkedin-in w-4 h-4 mr-2"></i>
                                    <span class="text-sm font-medium">LinkedIn</span>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}" 
                                   target="_blank"
                                   class="flex items-center justify-center p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                                    <i class="fab fa-whatsapp w-4 h-4 mr-2"></i>
                                    <span class="text-sm font-medium">WhatsApp</span>
                                </a>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <button onclick="copyToClipboard('{{ request()->url() }}', this)" 
                                        class="w-full flex items-center justify-center p-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-300">
                                    <i class="fas fa-copy w-4 h-4 mr-2"></i>
                                    <span class="text-sm font-medium">Copier le lien</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-2xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Navigation</h3>
                            <a href="{{ route('blog') }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                                <i class="fas fa-arrow-left w-4 h-4 mr-2"></i>
                                Retour aux articles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($similarArticles) && $similarArticles->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Articles similaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($similarArticles as $similarArticle)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($similarArticle->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $similarArticle->image) }}" 
                             alt="{{ $similarArticle->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-600"></div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="fas fa-calendar w-4 h-4 mr-2"></i>
                            {{ $similarArticle->published_at ? $similarArticle->published_at->format('d/m/Y') : 'Non publié' }}
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $similarArticle->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($similarArticle->content), 100) }}</p>
                        <a href="{{ route('blog.show', $similarArticle->slug) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium">Lire plus →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<script>
function copyToClipboard(text, buttonElement) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function() {
            showCopySuccess(buttonElement);
        }).catch(function() {
            fallbackCopyTextToClipboard(text, buttonElement);
        });
    } else {
        fallbackCopyTextToClipboard(text, buttonElement);
    }
}

function fallbackCopyTextToClipboard(text, buttonElement) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    textArea.style.opacity = "0";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showCopySuccess(buttonElement);
        } else {
            showCopyError(buttonElement);
        }
    } catch (err) {
        console.error('Fallback: Could not copy text: ', err);
        showCopyError(buttonElement);
    }
    
    document.body.removeChild(textArea);
}

function showCopySuccess(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check w-4 h-4 mr-2"></i><span class="text-sm font-medium">Copié !</span>';
    button.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
    button.classList.add('bg-green-500', 'text-white');
    
    setTimeout(function() {
        button.innerHTML = originalText;
        button.classList.remove('bg-green-500', 'text-white');
        button.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
    }, 2000);
}

function showCopyError(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-times w-4 h-4 mr-2"></i><span class="text-sm font-medium">Erreur</span>';
    button.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
    button.classList.add('bg-red-500', 'text-white');
    
    setTimeout(function() {
        button.innerHTML = originalText;
        button.classList.remove('bg-red-500', 'text-white');
        button.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
    }, 2000);
}
</script>

<x-footer />