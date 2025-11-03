<x-header :seoData="$SEOData ?? null" />

<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden pt-20">
  @if($article->image)
    <div class="absolute inset-0 z-0">
      <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
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
                {{ Str::limit($article->plain_text, 200) }}...
              </p>
            </div>

            {!! $article->content !!}
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

@php

  $absUrl = secure_url(request()->path());
  $twText = $article->title . ' - Kréyatik Studio';
  $igTitle = $article->title . ' - Kréyatik Studio';
  $igImage = $article->image ? secure_asset('storage/'.$article->image) : secure_asset('images/default-og.jpg');
@endphp

            <div class="bg-gray-50 rounded-2xl p-6 mb-8">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Partager cet article</h3>

              <div class="grid grid-cols-2 gap-3 mb-4">

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($absUrl) }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center justify-center p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                  <i class="fab fa-facebook-f w-4 h-4 mr-2"></i>
                  <span class="text-sm font-medium">Facebook</span>
                </a>


                <a href="https://twitter.com/intent/tweet?url={{ urlencode($absUrl) }}&text={{ urlencode($twText) }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center justify-center p-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors duration-300">
                  <i class="fab fa-x-twitter w-4 h-4 mr-2"></i>
                  <span class="text-sm font-medium">X (Twitter)</span>
                </a>


                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($absUrl) }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center justify-center p-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors duration-300">
                  <i class="fab fa-linkedin-in w-4 h-4 mr-2"></i>
                  <span class="text-sm font-medium">LinkedIn</span>
                </a>

                <button type="button" id="igShareBtn"
                   class="flex items-center justify-center p-3 bg-gradient-to-tr from-pink-500 to-purple-600 text-white rounded-lg hover:opacity-90 transition-colors duration-300">
                  <i class="fab fa-instagram w-4 h-4 mr-2"></i>
                  <span class="text-sm font-medium">Instagram</span>
                </button>
              </div>

              <button type="button" id="nativeShareBtn"
                      class="w-full flex items-center justify-center p-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors duration-300 mb-3">
                <i class="fas fa-share-alt w-4 h-4 mr-2"></i>
                <span class="text-sm font-medium">Partager…</span>
              </button>

              <div class="border-t border-gray-200 pt-4">
                <button id="copyLinkBtn"
                        class="w-full flex items-center justify-center p-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-300">
                  <i class="fas fa-copy w-4 h-4 mr-2"></i>
                  <span class="text-sm font-medium">Copier le lien</span>
                </button>
              </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Navigation</h3>
              <a href="{{ route('blog') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                <i class="fas fa-arrow-left w-4 h-4 mr-2"></i>Retour aux articles
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
                <img src="{{ asset('storage/' . $similarArticle->image) }}" alt="{{ $similarArticle->title }}" class="w-full h-full object-cover">
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
              <p class="text-gray-600 mb-4">{{ Str::limit($similarArticle->plain_text, 100) }}</p>
              <a href="{{ route('blog.show', $similarArticle->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">Lire plus →</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif


<script>
(function () {
  const absUrl   = @json($absUrl);
  const igTitle  = @json($igTitle);
  const igImage  = @json($igImage);
  const excerpt  = @json($article->excerpt);

  // Expose globalement
  window.copyToClipboard = async function(text, btn) {
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(text);
        return flash(btn, 'Lien copié ✅', true);
      }
    } catch(e){}
    // fallback
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    ta.style.top = '0';
    ta.style.left = '0';
    document.body.appendChild(ta);
    ta.focus(); ta.select();
    try {
      document.execCommand('copy') ? flash(btn, 'Lien copié ✅', true) : flash(btn, 'Erreur de copie', false);
    } catch(_) {
      flash(btn, 'Erreur de copie', false);
    } finally {
      document.body.removeChild(ta);
    }
  };

  function flash(btn, msg, ok) {
    if (!btn) return;
    const span = btn.querySelector('span') || btn;
    const old = span.textContent;
    span.textContent = msg;
    btn.classList.toggle('bg-green-500', ok);
    btn.classList.toggle('text-white', ok);
    btn.classList.toggle('bg-red-500', !ok);
    setTimeout(() => {
      span.textContent = old;
      btn.classList.remove('bg-green-500','bg-red-500','text-white');
    }, 1800);
  }


  const nativeBtn = document.getElementById('nativeShareBtn');
  if (nativeBtn) {
    nativeBtn.addEventListener('click', async () => {
      const data = { title: igTitle, text: excerpt, url: absUrl };
      if (navigator.share) {
        try { await navigator.share(data); return; } catch(e) {}
      }
      window.copyToClipboard(absUrl, nativeBtn);
    });
  }


  const igBtn = document.getElementById('igShareBtn');
  if (igBtn) {
    igBtn.addEventListener('click', async () => {

      if (navigator.share) {
        try { await navigator.share({ title: igTitle, text: excerpt, url: absUrl }); return; } catch(e){}
      }

      await window.copyToClipboard(absUrl, igBtn);
      window.open('https://www.instagram.com/', '_blank', 'noopener,noreferrer');
    });
  }


  const copyBtn = document.getElementById('copyLinkBtn');
  if (copyBtn) {
    copyBtn.addEventListener('click', () => window.copyToClipboard(absUrl, copyBtn));
  }
})();
</script>