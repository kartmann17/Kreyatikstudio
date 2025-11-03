<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerformanceHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Cache control pour les assets statiques
        if ($this->isStaticAsset($request)) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
        }

        // Preconnect et DNS Prefetch
        $response->headers->set('Link', '<https://fonts.googleapis.com>; rel=preconnect; crossorigin', false);
        $response->headers->set('Link', '<https://cdnjs.cloudflare.com>; rel=preconnect; crossorigin', false);

        // Compression
        if (!$response->headers->has('Content-Encoding')) {
            $acceptEncoding = $request->header('Accept-Encoding', '');

            if (str_contains($acceptEncoding, 'br')) {
                $response->headers->set('Content-Encoding', 'br');
            } elseif (str_contains($acceptEncoding, 'gzip')) {
                $response->headers->set('Content-Encoding', 'gzip');
            }
        }

        return $response;
    }

    /**
     * Déterminer si la requête concerne un asset statique
     */
    private function isStaticAsset(Request $request): bool
    {
        $path = $request->path();

        return str_starts_with($path, 'build/') ||
               str_starts_with($path, 'storage/') ||
               preg_match('/\.(css|js|jpg|jpeg|png|gif|svg|woff|woff2|ttf|eot)$/', $path);
    }
}
