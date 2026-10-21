
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust the hosting proxy so Laravel can detect HTTPS.
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

// Use a writable bootstrap path on Vercel.
$app->useBootstrapPath('/tmp/laravel-bootstrap');

// Create required writable runtime directories.
foreach ([
    '/tmp/laravel-bootstrap/cache',
    '/tmp/laravel-storage/app',
    '/tmp/laravel-storage/framework/cache/data',
    '/tmp/laravel-storage/framework/sessions',
    '/tmp/laravel-storage/framework/views',
    '/tmp/laravel-storage/logs',
] as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0775, true);
    }
}

// Use writable storage for Laravel runtime files.
$app->useStoragePath('/tmp/laravel-storage');

return $app;
