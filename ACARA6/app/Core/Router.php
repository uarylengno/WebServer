<?php

namespace App\Core;

class Router
{
    // Daftar route yang diterima dari routes/web.php
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(string $uri, string $method): void
    {
        // Cari route berdasarkan method HTTP dan URL, null jika tidak ada
        $route = $this->routes[$method][$uri] ?? null;

        if ($route === null) {
            http_response_code(404);
            echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
            return;
        }

        // Jalankan semua middleware milik route ini SEBELUM controller dipanggil
        foreach ($route['middleware'] ?? [] as $mw) {
            $mwInstance = new $mw();
            $mwInstance->handle();
        }

        $controllerClass = "App\\Controllers\\" . $route['controller'];
        $action = $route['action'];
        $controller = new $controllerClass();
        $controller->$action();
    }
}