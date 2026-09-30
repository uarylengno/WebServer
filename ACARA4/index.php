<?php

// Autoloader sederhana untuk namespace App\...
spl_autoload_register(function ($class) {
    $class = str_replace('App\\', '', $class);
    $file = __DIR__ . '/app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Models\Mahasiswa;

// Membuat beberapa object Mahasiswa
$mahasiswaList = [
    new Mahasiswa('2401001', 'Budi Santoso', 'Teknik Informatika'),
    new Mahasiswa('2301002', 'Siti Aminah', 'Sistem Informasi'),
    new Mahasiswa('2201003', 'Andi Wijaya', 'Manajemen Informatika'),
];

// Kirim ke View lewat layout
$content = __DIR__ . '/app/Views/mahasiswa/index.php';
require __DIR__ . '/app/Views/layouts/main.php';