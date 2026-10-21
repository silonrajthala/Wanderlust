
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// TEMPORARY DIAGNOSTICS
error_log('APP BOOTSTRAPPED');

try {
    $app->make(\Illuminate\Contracts\Http\Kernel::class);
    error_log('HTTP KERNEL RESOLVED');

    error_log(
        'VIEW BOUND: '.($app->bound('view') ? 'YES' : 'NO')
    );
} catch (\Throwable $e) {
    error_log('BOOTSTRAP DIAGNOSTIC: '.(string) $e);
    throw $e;
}

// Handle the request
$app->handleRequest(Request::capture());
