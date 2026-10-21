
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$basePath = dirname(__DIR__);

// Configure writable directories for Vercel.
$runtimePaths = [
    '/tmp/laravel-bootstrap/cache',
    '/tmp/laravel-bootstrap/cache/data',
    '/tmp/laravel-storage/app',
    '/tmp/laravel-storage/framework/cache/data',
    '/tmp/laravel-storage/framework/sessions',
    '/tmp/laravel-storage/framework/views',
    '/tmp/laravel-storage/logs',
    '/tmp/laravel-views',
];

foreach ($runtimePaths as $path) {
    if (! is_dir($path)) {
        if (! mkdir($path, 0775, true) && ! is_dir($path)) {
            error_log('Unable to create runtime directory: ' . $path);
        }
    }
}

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: $basePath . '/routes/web.php',
        commands: $basePath . '/routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register application middleware aliases.
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
        ]);

        // Trust the reverse proxy so Laravel recognizes HTTPS requests.
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR
                | Request::HEADER_X_FORWARDED_HOST
                | Request::HEADER_X_FORWARDED_PORT
                | Request::HEADER_X_FORWARDED_PROTO
                | Request::HEADER_X_FORWARDED_AWS_ELB,
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

// Use a writable bootstrap/cache location.
$app->useBootstrapPath('/tmp/laravel-bootstrap');

return $app;
