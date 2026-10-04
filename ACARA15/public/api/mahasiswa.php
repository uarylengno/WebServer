<?php

require __DIR__ . '/../../config/app.php';
require __DIR__ . '/../../app/Core/Logger.php';
require __DIR__ . '/../../app/Core/Database.php';
require __DIR__ . '/../../app/Models/Mahasiswa.php';
require __DIR__ . '/../../app/Repositories/MahasiswaRepository.php';
require __DIR__ . '/../../app/Repositories/ProdiRepository.php';
require __DIR__ . '/../../app/Services/MahasiswaService.php';

use App\Core\Database;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Services\MahasiswaService;

header('Content-Type: application/json');

try {
    $db = Database::getInstance();
    $service = new MahasiswaService(
        new MahasiswaRepository($db),
        new ProdiRepository($db)
    );

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $mhs = $service->find($id);

            if (!$mhs) {
                http_response_code(404);
                echo json_encode([
                    'success' => false,
                    'message' => 'Data mahasiswa tidak ditemukan',
                ]);
                exit;
            }

            echo json_encode([
                'success' => true,
                'message' => 'Data berhasil diambil',
                'data' => [
                    'id' => $mhs->getId(),
                    'nim' => $mhs->getNim(),
                    'nama' => $mhs->getNama(),
                    'email' => $mhs->getEmail(),
                    'prodi_id' => $mhs->getProdiId(),
                    'angkatan' => $mhs->getAngkatan(),
                ],
            ]);
            exit;
        }

        $list = $service->list();
        $data = array_map(fn($m) => [
            'id' => $m->getId(),
            'nim' => $m->getNim(),
            'nama' => $m->getNama(),
            'email' => $m->getEmail(),
            'prodi_id' => $m->getProdiId(),
            'angkatan' => $m->getAngkatan(),
        ], $list);

        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
        exit;
    }

    if ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true) ?? [];

        $result = $service->create($input);

        http_response_code($result['success'] ? 201 : 400);
        echo json_encode([
            'success' => $result['success'],
            'message' => $result['message'],
        ]);
        exit;
    }

    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method tidak didukung',
    ]);

} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan pada server',
    ]);
}