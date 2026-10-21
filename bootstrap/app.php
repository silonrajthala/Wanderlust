
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$basePath = dirname(__DIR__);

// Create writable runtime directories before Laravel boots.
$runtimePaths = [
    '/tmp/laravel-bootstrap/cache',
    '/tmp/laravel-views',
    '/tmp/laravel-sessions',
];

foreach ($runtimePaths as $path) {
    if (! is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: $basePath . '/routes/web.php',
        commands: $basePath . '/routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
        ]);

        // Trust the reverse proxy used by Vercel.
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

// Use writable paths in Vercel's runtime environment.
$app->useBootstrapPath('/tmp/laravel-bootstrap');

return $app;
