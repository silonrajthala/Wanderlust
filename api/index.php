
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__);

try {
    // Load Composer.
    require $root . '/vendor/autoload.php';

    // Create writable runtime directories BEFORE bootstrapping Laravel.
    $directories = [
        '/tmp/laravel-bootstrap/cache',
        '/tmp/laravel-storage/app',
        '/tmp/laravel-storage/framework/cache/data',
        '/tmp/laravel-storage/framework/sessions',
        '/tmp/laravel-storage/framework/views',
        '/tmp/laravel-storage/logs',
        '/tmp/laravel-views',
    ];

    foreach ($directories as $directory) {
        if (! is_dir($directory)) {
            if (! mkdir($directory, 0775, true) && ! is_dir($directory)) {
                throw new RuntimeException(
                    "Unable to create runtime directory: {$directory}"
                );
            }
        }
    }

    // Load the Laravel application.
    $app = require $root . '/bootstrap/app.php';

    // Capture the HTTP request and let Laravel handle its lifecycle.
    $app->handleRequest(Request::capture());

} catch (\Throwable $e) {
    // Log the ORIGINAL exception to Vercel Runtime Logs.
    error_log('[LARAVEL ERROR] ' . get_class($e));
    error_log('[LARAVEL MESSAGE] ' . $e->getMessage());
    error_log('[LARAVEL FILE] ' . $e->getFile());
    error_log('[LARAVEL LINE] ' . $e->getLine());
    error_log('[LARAVEL TRACE] ' . $e->getTraceAsString());

    if (! headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=UTF-8');
    }

    echo 'Laravel initialization failed. Check Vercel Runtime Logs.';
}
