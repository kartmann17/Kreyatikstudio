<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasClient
{
    /**
     * Vérifie que l'utilisateur client a bien un client_id valide
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Vérifier que l'utilisateur est un client ET a un client_id
        if ($user && $user->isClient() && !$user->client_id) {
            abort(403, 'Votre compte n\'est pas correctement associé à un client. Veuillez contacter l\'administrateur.');
        }

        return $next($request);
    }
}
