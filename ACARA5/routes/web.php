<?php

$routes = [
    'GET' => [
        '/'                 => ['HomeController', 'index'],
        '/mahasiswa'        => ['MahasiswaController', 'index'],
        '/mahasiswa/create' => ['MahasiswaController', 'create'],
        '/mahasiswa/{id}'   => ['MahasiswaController', 'show'], // Tugas Mandiri
        '/login'            => ['AuthController', 'loginForm'],
    ],
    'POST' => [
        '/mahasiswa'        => ['MahasiswaController', 'store'],
        '/login'            => ['AuthController', 'login'],
    ],
];

return $routes;