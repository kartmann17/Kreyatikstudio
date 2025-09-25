<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * Publie un article depuis une API externe (n8n)
     */
    public function publish(Request $request): JsonResponse
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string|url',
            'author_id' => 'nullable|integer|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Données invalides',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Créer l'article
            $article = Article::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image' => $request->image,
                'is_published' => true,
                'published_at' => $request->published_at ?? now(),
                'user_id' => $request->author_id ?? 1, // Utilisateur par défaut si non spécifié
            ]);

            // Le sitemap sera automatiquement mis à jour grâce à l'Observer

            return response()->json([
                'success' => true,
                'message' => 'Article publié avec succès',
                'article' => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'published_at' => $article->published_at,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la publication de l\'article',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 