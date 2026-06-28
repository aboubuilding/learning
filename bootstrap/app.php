<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAuthSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias des middlewares personnalisés (utilisables dans les routes)
        $middleware->alias([
            'auth.session' => CheckAuthSession::class,
        ]);

        // Si vous aviez besoin d'un middleware global, décommentez la ligne suivante
        // $middleware->append(CheckAuthSession::class);

        // Groupes de middlewares (par exemple pour les routes web)
        // $middleware->group('web', [
        //     \App\Http\Middleware\EncryptCookies::class,
        //     \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        //     \Illuminate\Session\Middleware\StartSession::class,
        //     // ...
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Personnalisation des exceptions (si besoin)
        // $exceptions->render(function (Throwable $e) { ... });
    })
    ->create();