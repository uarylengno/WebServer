<?php

use App\Core\Middleware\AuthMiddleware;

return [
    'GET' => [
        // Route publik (tanpa middleware)
        '/' => [
            'controller' => 'HomeController',
            'action'     => 'index',
        ],
        '/login' => [
            'controller' => 'AuthController',
            'action'     => 'loginForm',
        ],
        '/logout' => [
            'controller' => 'AuthController',
            'action'     => 'logout',
        ],

        // Route terlindungi: middleware dijalankan sebelum controller
        '/dashboard' => [
            'controller' => 'DashboardController',
            'action'     => 'index',
            'middleware' => [AuthMiddleware::class],
        ],
        '/mahasiswa' => [
            'controller' => 'MahasiswaController',
            'action'     => 'index',
            'middleware' => [AuthMiddleware::class],
        ],
    ],
    'POST' => [
        '/login' => [
            'controller' => 'AuthController',
            'action'     => 'login',
        ],
    ],
];