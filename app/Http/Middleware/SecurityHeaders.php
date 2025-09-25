<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Headers de sécurité avancés
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Configuration CSP adaptée selon l'environnement
        $isDevelopment = app()->environment('local', 'development');
        $disableCSP = env('DISABLE_CSP', false);
        
        // Si CSP est désactivé en développement, ne pas l'appliquer
        if ($isDevelopment && $disableCSP) {
            return $response;
        }
        
        // Sources autorisées pour les scripts
        $scriptSources = [
            "'self'",
            "'unsafe-inline'",
            "'unsafe-eval'",
            "https://www.googletagmanager.com",
            "https://www.google-analytics.com",
            "https://cdnjs.cloudflare.com",
            "https://cdn.jsdelivr.net"
        ];
        
        // Ajouter Vite en développement (HTTP uniquement)
        if ($isDevelopment) {
            $scriptSources[] = "http://{$request->getHost()}:5174";
        }
        
        // Sources autorisées pour les styles
        $styleSources = [
            "'self'",
            "'unsafe-inline'",
            "https://fonts.googleapis.com",
            "https://fonts.bunny.net",
            "https://cdnjs.cloudflare.com",
            "https://cdn.jsdelivr.net"
        ];
        
        // Ajouter Vite en développement (HTTP uniquement)
        if ($isDevelopment) {
            $styleSources[] = "http://{$request->getHost()}:5174";
        }
        
        // Sources autorisées pour les connexions
        $connectSources = [
            "'self'",
            "https://www.google-analytics.com",
            "https://region1.analytics.google.com",
            "https://www.google.com"
        ];
        
        // Ajouter Vite en développement (HTTP et WebSocket)
        if ($isDevelopment) {
            $connectSources[] = "http://{$request->getHost()}:5174";
            $connectSources[] = "ws://{$request->getHost()}:5174";
        }
        
        // Content Security Policy (CSP) adaptée
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src " . implode(' ', $scriptSources),
            "style-src " . implode(' ', $styleSources),
            "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
            "img-src 'self' data: https: blob:",
            "connect-src " . implode(' ', $connectSources),
            "frame-src 'self' https://www.googletagmanager.com",
            "frame-ancestors 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "upgrade-insecure-requests"
        ]);
        
        $response->headers->set('Content-Security-Policy', $csp);
        
        // Permissions Policy (anciennement Feature Policy)
        $permissions = implode(', ', [
            'geolocation=()',
            'microphone=()',
            'camera=()',
            'payment=()',
            'usb=()',
            'magnetometer=()',
            'accelerometer=()',
            'gyroscope=()'
        ]);
        $response->headers->set('Permissions-Policy', $permissions);
        
        // Strict Transport Security (HSTS) - uniquement en HTTPS
        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }
        
        // Server header masking
        $response->headers->remove('Server');
        $response->headers->set('Server', 'Kreyatik-Server');
        
        return $response;
    }
}