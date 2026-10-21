
<?php

error_log('DIAGNOSTIC: API INDEX REACHED');

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

try {
    require __DIR__ . '/../vendor/autoload.php';
    error_log('DIAGNOSTIC: AUTOLOAD OK');

    $app = require __DIR__ . '/../bootstrap/app.php';
    error_log('DIAGNOSTIC: APP BOOTSTRAPPED');

    error_log(
        'DIAGNOSTIC: VIEW BOUND = ' .
        ($app->bound('view') ? 'YES' : 'NO')
    );

    $app->handleRequest(Request::capture());

} catch (\Throwable $e) {
    error_log('DIAGNOSTIC ERROR: ' . (string) $e);
    http_response_code(500);
    echo 'Application error. Check Vercel Runtime Logs.';
}
