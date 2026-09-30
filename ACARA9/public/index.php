<?php
require_once __DIR__ . '/../config/app.php';
session_start();

spl_autoload_register(function ($class) {
    $class = str_replace('App\\', '', $class);
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$routes = require __DIR__ . '/../routes/web.php';

// --- Dependency Injection untuk MahasiswaController ---
// 1. Ambil koneksi PDO (singleton) dari Database
$pdo = App\Core\Database::getInstance();
// 2. Suntikkan PDO ke MahasiswaRepository
$mahasiswaRepo = new App\Repositories\MahasiswaRepository($pdo);
// 3. Suntikkan MahasiswaRepository ke MahasiswaController
$mahasiswaController = new App\Controllers\MahasiswaController($mahasiswaRepo);

// Container: controller yang sudah dirakit lengkap dengan dependency-nya
$container = [
    'MahasiswaController' => $mahasiswaController,
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (str_starts_with($uri, BASE_URL)) {
    $uri = substr($uri, strlen(BASE_URL)) ?: '/';
}
$uri = rtrim($uri, '/') ?: '/';

$router = new App\Core\Router($routes, $container);
$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);