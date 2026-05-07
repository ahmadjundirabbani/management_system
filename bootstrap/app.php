<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Import Request
use Tymon\JWTAuth\Exceptions\TokenExpiredException; // Import Exception JWT
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Tangkap error jika token habis waktu (Expired)
        $exceptions->render(function (TokenExpiredException $e, Request $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token has expired'
            ], 401);
        });

        // Tangkap error jika token tidak valid atau dimanipulasi
        $exceptions->render(function (TokenInvalidException $e, Request $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is invalid'
            ], 401);
        });
    })->create();
