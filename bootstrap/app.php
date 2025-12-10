<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\EnsureUserHasClient;
use App\Http\Middleware\PerformanceHeaders;
use App\Http\Middleware\HandleInertiaRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware global de sécurité
        $middleware->web(append: [
            HandleInertiaRequests::class,
            SecurityHeaders::class,
            // PerformanceHeaders désactivé en local (conflit compression avec Nginx/Apache)
        ]);

        $middleware->alias([
            'role' => CheckRole::class,
            'security.headers' => SecurityHeaders::class,
            'ensure.client' => EnsureUserHasClient::class,
            'performance.headers' => PerformanceHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
