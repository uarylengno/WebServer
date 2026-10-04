<?php

namespace App\Core;

class Router
{
    private array $routes;
    private array $container; // controller yang sudah "dirakit" dengan dependency-nya

    public function __construct(array $routes, array $container = [])
    {
        $this->routes = $routes;
        $this->container = $container;
    }

    public function dispatch(string $uri, string $method): void
    {
        $routesForMethod = $this->routes[$method] ?? [];

        if (isset($routesForMethod[$uri])) {
            $this->run($routesForMethod[$uri]);
            return;
        }

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

        http_response_code(404);
        echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
    }

    private function run(array $route, array $params = []): void
    {
        $controllerName = $route['controller'];

        // Kalau controller sudah dirakit lewat DI di public/index.php, pakai itu
        if (isset($this->container[$controllerName])) {
            $controller = $this->container[$controllerName];
        } else {
            // Kalau tidak (ProdiController, MatakuliahController), buat seperti biasa
            $controllerClass = "App\\Controllers\\" . $controllerName;
            $controller = new $controllerClass();
        }

        $action = $route['action'];
        call_user_func_array([$controller, $action], $params);
    }
}