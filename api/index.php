<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;

define('LARAVEL_START', microtime(true));

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

try {
    $basePath = dirname(__DIR__);

    // Load Composer
    require $basePath . '/vendor/autoload.php';

    error_log('[DIAG] Composer autoload loaded');

    // Bootstrap Laravel
    $app = require_once $basePath . '/bootstrap/app.php';

    error_log('[DIAG] Laravel app created');

    // Check application bindings before handling request
    error_log(
        '[DIAG] View bound before boot: ' .
        ($app->bound('view') ? 'YES' : 'NO')
    );

    // Resolve and bootstrap the HTTP kernel
    $kernel = $app->make(Kernel::class);

    error_log('[DIAG] HTTP kernel resolved');

    $kernel->bootstrap();

    error_log('[DIAG] HTTP kernel bootstrapped');

    error_log(
        '[DIAG] View bound after boot: ' .
        ($app->bound('view') ? 'YES' : 'NO')
    );

    error_log(
        '[DIAG] View service provider registered: ' .
        ($app->getProvider(
            \Illuminate\View\ViewServiceProvider::class
        ) ? 'YES' : 'NO')
    );

    // Handle request through Laravel's HTTP kernel
    $request = Request::capture();

    $response = $kernel->handle($request);

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    error_log('[DIAG] FATAL: ' . get_class($e));
    error_log('[DIAG] MESSAGE: ' . $e->getMessage());
    error_log('[DIAG] FILE: ' . $e->getFile());
    error_log('[DIAG] LINE: ' . $e->getLine());
    error_log('[DIAG] TRACE: ' . $e->getTraceAsString());

    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');

    echo "Laravel application error. Check Vercel Runtime Logs.";
}
