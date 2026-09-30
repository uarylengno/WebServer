<?php

namespace App\Controllers;

use App\Core\Controller;

class MahasiswaController extends Controller
{
    public function index(): void
    {
        // Data contoh statis (belum memakai database)
        $mahasiswa = [
            ['nim' => '2401001', 'nama' => 'Budi Santoso', 'prodi' => 'Teknik Informatika'],
            ['nim' => '2401002', 'nama' => 'Siti Aminah', 'prodi' => 'Sistem Informasi'],
        ];

        $this->view('mahasiswa/index', [
            'title'     => 'Data Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ]);
    }
}