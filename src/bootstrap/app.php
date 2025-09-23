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
   ->withMiddleware(function (Middleware $middleware): void {
        // Exclude CSRF for specific URIs
        $middleware->validateCsrfTokens(except: [
            'blogs/*',                // any route starting with stripe/
            'category/*',                // any route starting with stripe/
            'http://localhost:8080/blogs',   // exact route
            'http://localhost:8080/blogs/*', // any route under foo/
            'http://localhost:8080/category',   // exact route
            'http://localhost:8080/category/*', // any route under foo/
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
