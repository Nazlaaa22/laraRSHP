<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // === REGISTER ALIAS MIDDLEWARE YANG BENAR ===
        $middleware->alias([
            'admin'       => App\Http\Middleware\isAdministrator::class,
            'Resepsionis' => App\Http\Middleware\isResepsionis::class,
            'dokter'      => App\Http\Middleware\isDokter::class,
            'perawat'     => App\Http\Middleware\isPerawat::class,
            'pemilik'     => App\Http\Middleware\isPemilik::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
