<?php

namespace App\Core;

class Controller
{
    // Menampilkan view di dalam layout (default: layout 'main')
    protected function view(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data);
        // Lokasi file view yang akan dimuat oleh layout lewat $content
        $content = __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/layouts/' . $layout . '.php';
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . BASE_URL . $path);
        exit; // wajib, supaya kode di bawahnya tidak ikut jalan
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }
}