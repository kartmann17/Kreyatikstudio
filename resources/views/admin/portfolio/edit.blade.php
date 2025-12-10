@extends('admin.layout')

@section('title', 'Modifier un élément du Portfolio')

@section('page_title', 'Modifier un élément du Portfolio')

@section('content_body')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Modification: {{ $portfolioItem->title }}</h3>
                <a href="{{ route('admin.portfolio.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour à la liste</span>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <ul class="text-red-800 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.portfolio.update', $portfolioItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="title" name="title" value="{{ old('title', $portfolioItem->title) }}" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="description" name="description" rows="4" required>{{ old('description', $portfolioItem->description) }}</textarea>
                        </div>

                        <div>
                            <label for="technology" class="block text-sm font-medium text-gray-700 mb-2">Technologies utilisées</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="technology" name="technology" value="{{ old('technology', $portfolioItem->technology) }}" placeholder="ex: HTML, CSS, JavaScript, Laravel, etc.">
                            <p class="mt-1 text-sm text-gray-500">Les technologies utilisées pour réaliser ce projet (séparées par des virgules).</p>
                        </div>

                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL du projet</label>
                            <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="url" name="url" value="{{ old('url', $portfolioItem->url) }}" placeholder="https://exemple.com">
                            <p class="mt-1 text-sm text-gray-500">L'URL du projet en ligne (optionnel).</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Type de média <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="type" name="type" required>
                                <option value="">Sélectionnez un type</option>
                                <option value="image" {{ (old('type', $portfolioItem->type) == 'image') ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ (old('type', $portfolioItem->type) == 'video') ? 'selected' : '' }}>Vidéo</option>
                            </select>
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Fichier (Image/Vidéo)</label>
                            <div class="relative">
                                <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="file" name="file" accept=".jpg,.jpeg,.png,.gif,.mp4,.webm">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Formats acceptés: JPEG, PNG, GIF, MP4, WEBM. Taille max: 20MB. Laissez vide pour conserver le fichier existant.</p>
                        </div>

                        <div>
                            <div class="flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="is_visible" name="is_visible" value="1" {{ old('is_visible', $portfolioItem->is_visible) ? 'checked' : '' }}>
                                <label for="is_visible" class="ml-2 block text-sm text-gray-700">Visible sur le site</label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Décochez cette case pour masquer cet élément du portfolio sur le site public.</p>
                        </div>

                        <div>
                            <h5 class="text-lg font-medium text-gray-900 mb-4">Fichier actuel</h5>
                            @if($portfolioItem->isImage())
                                <img src="{{ asset($portfolioItem->path) }}" alt="{{ $portfolioItem->title }}" class="max-h-48 rounded-lg border border-gray-200">
                            @else
                                <video src="{{ asset($portfolioItem->path) }}" controls class="max-h-48 rounded-lg border border-gray-200">
                                    Votre navigateur ne supporte pas la vidéo.
                                </video>
                            @endif
                        </div>

                        <div>
                            <div id="preview-container" class="text-center hidden">
                                <h5 class="text-lg font-medium text-gray-900 mb-4">Aperçu du nouveau fichier</h5>
                                <div id="image-preview" class="hidden">
                                    <img src="" alt="Aperçu" class="max-h-48 mx-auto rounded-lg border border-gray-200">
                                </div>
                                <div id="video-preview" class="hidden">
                                    <video controls class="max-h-48 mx-auto rounded-lg border border-gray-200">
                                        Votre navigateur ne supporte pas la vidéo.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-save"></i>
                        <span>Enregistrer les modifications</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
<script>
    $(function() {
        // Prévisualisation du fichier
        $('#file').on('change', function() {
            previewFile(this);
        });
        
        // Fonction pour prévisualiser le fichier
        function previewFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var file = input.files[0];
                var type = $('#type').val();
                
                $('#preview-container').removeClass('hidden');
                
                if (type == 'image') {
                    $('#image-preview').removeClass('hidden');
                    $('#video-preview').addClass('hidden');
                    
                    reader.onload = function(e) {
                        $('#image-preview img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                } else if (type == 'video') {
                    $('#video-preview').removeClass('hidden');
                    $('#image-preview').addClass('hidden');
                    
                    // Pour les vidéos, nous devons recréer l'élément vidéo pour éviter les problèmes de chargement
                    var videoPreview = $('#video-preview');
                    videoPreview.html('<video controls class="max-h-48 mx-auto rounded-lg border border-gray-200"></video>');
                    
                    reader.onload = function(e) {
                        var video = videoPreview.find('video')[0];
                        video.src = e.target.result;
                        video.load();
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
        
        // Réinitialiser l'aperçu lors du changement de type
        $('#type').on('change', function() {
            $('#file').val('');
            $('#preview-container').addClass('hidden');
        });
    });
</script>
@endsection 