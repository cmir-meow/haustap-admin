<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Enable CORS for cross-origin requests from the UI server
        $middleware->append(\App\Http\Middleware\Cors::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Render all exceptions as consistent JSON for API-style requests
        $exceptions->render(function (Throwable $e, Request $request) {
            // Only intercept for JSON requests
            if (!($request->expectsJson() || str_contains($request->header('Accept', ''), 'application/json'))) {
                return null; // use default HTML error rendering
            }

            $status = 500;
            $payload = [
                'success' => false,
                'message' => 'Server error',
            ];

            if ($e instanceof ValidationException) {
                $status = 422;
                $payload['message'] = 'Validation failed';
                $payload['errors'] = $e->errors();
            } elseif ($e instanceof AuthenticationException) {
                $status = 401;
                $payload['message'] = 'Unauthenticated';
            } elseif ($e instanceof AuthorizationException) {
                $status = 403;
                $payload['message'] = 'Forbidden';
            } elseif ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                $status = 404;
                $payload['message'] = 'Not Found';
            } elseif ($e instanceof HttpExceptionInterface) {
                $status = $e->getStatusCode();
                $payload['message'] = $e->getMessage() ?: 'HTTP error';
            } else {
                // Generic exception
                $payload['message'] = app()->hasDebugModeEnabled() ? ($e->getMessage() ?: 'Server error') : 'Server error';
            }

            // Attach minimal context for debugging (non-sensitive)
            $payload['path'] = $request->path();
            $payload['method'] = $request->method();

            // Log with context
            Log::error('API exception', [
                'status' => $status,
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'path' => $request->path(),
                'method' => $request->method(),
            ]);

            return response()->json($payload, $status);
        });
    })->create();
