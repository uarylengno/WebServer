<?php

require_once __DIR__ . '/../config/app.php';

// Autoloader sederhana untuk namespace App\...
spl_autoload_register(function ($class) {
    $class = str_replace('App\\', '', $class);
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$routes = require __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Hilangkan base path karena project ada di subfolder
$base = '/BKPM-Web-Server/ACARA5/public';
if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}
$uri = rtrim($uri, '/') ?: '/';

$method = $_SERVER['REQUEST_METHOD'];

// 1. Coba exact match dulu (untuk URL statis seperti /mahasiswa)
if (isset($routes[$method][$uri])) {
    [$controllerName, $action] = $routes[$method][$uri];
    callAction($controllerName, $action);
    exit;
}

// 2. Kalau tidak ketemu, coba cocokkan pola dinamis seperti /mahasiswa/{id}
foreach ($routes[$method] ?? [] as $pattern => $handler) {
    if (!str_contains($pattern, '{')) {
        continue;
    }

    $regex = preg_replace('#\{[a-zA-Z_]+\}#', '([^/]+)', $pattern);
    $regex = '#^' . $regex . '$#';

    if (preg_match($regex, $uri, $matches)) {
        array_shift($matches); // buang hasil full match, sisakan parameter saja
        [$controllerName, $action] = $handler;
        callAction($controllerName, $action, $matches);
        exit;
    }
}

// 3. Tidak ketemu sama sekali -> 404
http_response_code(404);
echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
echo "<p>URL: " . htmlspecialchars($uri) . "</p>";
exit;

function callAction(string $controllerName, string $action, array $params = []): void
{
    $controllerClass = "App\\Controllers\\{$controllerName}";

    if (!class_exists($controllerClass)) {
        http_response_code(500);
        echo "Controller {$controllerClass} tidak ditemukan.";
        return;
    }

    $controller = new $controllerClass();
    call_user_func_array([$controller, $action], $params);
}