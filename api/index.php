
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Temporary PHP diagnostics
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', 'php://stderr');

error_log('DIAGNOSTIC: API INDEX REACHED');

set_error_handler(function ($severity, $message, $file, $line) {
    error_log(
        "PHP ORIGINAL ERROR: {$message} in {$file}:{$line}"
    );

    // Let PHP and Laravel handle the error normally.
    return false;
});

try {
    // Check maintenance mode
    if (file_exists(
        $maintenance = __DIR__ . '/../storage/framework/maintenance.php'
    )) {
        require $maintenance;
    }

    // Load Composer
    require __DIR__ . '/../vendor/autoload.php';
    error_log('DIAGNOSTIC: AUTOLOAD OK');

    // Bootstrap Laravel
    /** @var Application $app */
    $app = require __DIR__ . '/../bootstrap/app.php';
    error_log('DIAGNOSTIC: APP BOOTSTRAPPED');

    // Check Laravel services
    error_log(
        'DIAGNOSTIC: VIEW BOUND = ' .
        ($app->bound('view') ? 'YES' : 'NO')
    );

    // Handle the incoming request
    $app->handleRequest(Request::capture());

} catch (\Throwable $e) {
    error_log(
        'DIAGNOSTIC EXCEPTION: ' .
        get_class($e) . ': ' . $e->getMessage()
    );

    error_log(
        'DIAGNOSTIC LOCATION: ' .
        $e->getFile() . ':' . $e->getLine()
    );

    error_log($e->getTraceAsString());

    http_response_code(500);
    echo 'Application error. Check Vercel Runtime Logs.';
}
