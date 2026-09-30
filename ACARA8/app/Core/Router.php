<?php

namespace App\Core;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(string $uri, string $method): void
    {
        $routesForMethod = $this->routes[$method] ?? [];

        // 1. Coba cocokkan URL persis dulu
        if (isset($routesForMethod[$uri])) {
            $this->run($routesForMethod[$uri]);
            return;
        }

        // 2. Coba cocokkan pola dinamis, misal /mahasiswa/{id}/edit
        foreach ($routesForMethod as $pattern => $route) {
            if (!str_contains($pattern, '{')) {
                continue;
            }

            $regex = preg_replace('#\{[a-zA-Z_]+\}#', '([^/]+)', $pattern);
            $regex = '#^' . $regex . '$#';

            if (preg_match($regex, $uri, $matches)) {
                array_shift($matches);
                $this->run($route, $matches);
                return;
            }
        }

        // 3. Tidak ditemukan -> 404
        http_response_code(404);
        echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
    }

    private function run(array $route, array $params = []): void
    {
        $controllerClass = "App\\Controllers\\" . $route['controller'];
        $action = $route['action'];
        $controller = new $controllerClass();
        call_user_func_array([$controller, $action], $params);
    }
}