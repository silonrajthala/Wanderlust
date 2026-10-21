
$app->useBootstrapPath('/tmp/laravel-bootstrap');

// Create writable runtime directories.
$directories = [
    '/tmp/laravel-bootstrap/cache',
    '/tmp/laravel-bootstrap/cache/data',
    '/tmp/laravel-bootstrap/cache',
    '/tmp/laravel-views',
    '/tmp/laravel-sessions',
];

foreach ($directories as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

// Store compiled Blade templates in /tmp.
$app->useEnvironmentPath(dirname(__DIR__));

