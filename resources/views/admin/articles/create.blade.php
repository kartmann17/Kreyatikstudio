@extends('admin.layout')

@section('title', 'Créer un Article')

@section('page_title', 'Créer un Article')

@section('content_body')
    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-green-600 to-green-700 text-white rounded-t-xl px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center mb-2 sm:mb-0">
                <i class="fas fa-plus-circle mr-2"></i>
                Nouvel article
            </h3>
            <a href="{{ route('admin.articles.index') }}" class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg font-semibold flex items-center transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> 
                Retour à la liste
            </a>
        </div>
        <div class="p-6">
            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                    <h5 class="font-semibold">Erreurs de validation :</h5>
                </div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Entrez le titre de l'article...">
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Contenu <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content" name="content" rows="12" required
                                      class="tinymce-editor w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                      placeholder="Rédigez le contenu de votre article...">{{ old('content') }}</textarea>
                            <p class="text-sm text-gray-600 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Utilisez l'éditeur pour formater votre contenu
                            </p>
                        </div>

                        <!-- Publish Switch -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label for="is_published" class="text-sm font-medium text-gray-700">
                                        Publier immédiatement
                                    </label>
                                    <p class="text-sm text-gray-600">Rendre l'article visible sur le site public</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Image de l'article
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition-colors duration-200" id="dropZone">
                                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                                <div id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 mb-2">Cliquez pour sélectionner une image</p>
                                    <p class="text-sm text-gray-500">ou glissez-déposez ici</p>
                                    <p class="text-xs text-gray-400 mt-2">JPEG, PNG, GIF - Max 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div id="preview-container" class="hidden">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">
                                <i class="fas fa-eye mr-2 text-green-600"></i>
                                Aperçu de l'image
                            </h4>
                            <div class="relative">
                                <img id="image-preview" src="" alt="Aperçu" class="w-full h-64 object-cover rounded-lg shadow-sm">
                                <button type="button" id="removeImage" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors duration-200">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="mt-3 text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Cliquez sur la croix pour supprimer l'image
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-lightbulb text-blue-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="text-sm font-semibold text-blue-800">Conseils de rédaction</h4>
                                    <ul class="text-sm text-blue-700 mt-2 space-y-1">
                                        <li>• Utilisez un titre accrocheur</li>
                                        <li>• Ajoutez une image attractive</li>
                                        <li>• Structurez votre contenu</li>
                                        <li>• Relisez avant de publier</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200 mt-8">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold flex items-center transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-save mr-2"></i> 
                        Enregistrer l'article
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('custom_js')
<x-head.tinymce-config />
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const dropZone = document.getElementById('dropZone');
    const uploadArea = document.getElementById('uploadArea');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removeImageBtn = document.getElementById('removeImage');
    const articleForm = document.getElementById('articleForm');

    // Click to upload
    dropZone.addEventListener('click', function() {
        imageInput.click();
    });

    // Drag and drop functionality
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('border-green-400', 'bg-green-50');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-green-400', 'bg-green-50');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-green-400', 'bg-green-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImageSelection(files[0]);
        }
    });

    // Handle file input change
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            handleImageSelection(this.files[0]);
        }
    });

    // Handle image selection
    function handleImageSelection(file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            Swal.fire({
                title: 'Erreur',
                text: 'Veuillez sélectionner une image valide (JPEG, PNG, GIF).',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg'
                }
            });
            return;
        }

        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                title: 'Erreur',
                text: 'L\'image est trop volumineuse. Taille maximum: 2MB.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg'
                }
            });
            return;
        }

        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            dropZone.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Remove image
    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.src = '';
        previewContainer.classList.add('hidden');
        dropZone.classList.remove('hidden');
    });

    // Form validation
    articleForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const title = document.getElementById('title').value.trim();
        if (!title) {
            Swal.fire({
                title: 'Erreur',
                text: 'Le titre est requis.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg'
                }
            });
            return;
        }

        // Check TinyMCE content
        if (window.tinymce && tinymce.get('content')) {
            const content = tinymce.get('content').getContent().trim();
            if (!content) {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Le contenu est requis.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg'
                    }
                });
                return;
            }
        }

        // Show loading
        Swal.fire({
            title: 'Enregistrement...',
            text: 'Veuillez patienter',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Submit form
        this.submit();
    });
});
</script>
@stop