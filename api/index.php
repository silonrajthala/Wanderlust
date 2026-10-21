
<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__);

try {
    require $root . '/vendor/autoload.php';

    $app = require $root . '/bootstrap/app.php';

    // Ensure runtime directories exist.
    foreach ([
        '/tmp/laravel-bootstrap/cache',
        '/tmp/laravel-storage/app',
        '/tmp/laravel-storage/framework/cache/data',
        '/tmp/laravel-storage/framework/sessions',
        '/tmp/laravel-storage/framework/views',
        '/tmp/laravel-storage/logs',
    ] as $directory) {
        if (! is_dir($directory)
            && ! mkdir($directory, 0775, true)
            && ! is_dir($directory)) {
            throw new RuntimeException(
                "Cannot create directory: {$directory}"
            );
        }
    }

    // Capture the incoming request.
    $request = Request::capture();

    // Register the request instance in Laravel's container.
    $app->instance('request', $request);
    $app->instance('Illuminate\Http\Request', $request);

    // Use Laravel's standard HTTP kernel lifecycle.
    $kernel = $app->make(Kernel::class);

    $response = $kernel->handle($request);

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    error_log('[LARAVEL ORIGINAL ERROR] ' . get_class($e));
    error_log('[LARAVEL ORIGINAL MESSAGE] ' . $e->getMessage());
    error_log('[LARAVEL ORIGINAL FILE] ' . $e->getFile()
        . ':' . $e->getLine());
    error_log('[LARAVEL ORIGINAL TRACE] ' . $e->getTraceAsString());

    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');

    echo 'Laravel initialization failed. Check Vercel Runtime Logs.';
}
