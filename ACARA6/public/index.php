<?php
// Muat konfigurasi (timezone, error reporting, BASE_URL)
require_once __DIR__ . '/../config/app.php';

session_start();

// Autoloader: ubah namespace App\Core\Router menjadi file app/Core/Router.php
spl_autoload_register(function ($class) {
    $class = str_replace('App\\', '', $class);
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Ambil daftar route dari routes/web.php
$routes = require __DIR__ . '/../routes/web.php';

// Ambil path URL tanpa query string
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($uri, BASE_URL)) {
    $uri = substr($uri, strlen(BASE_URL)) ?: '/';
}
$uri = rtrim($uri, '/') ?: '/';

$router = new App\Core\Router($routes);
$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);