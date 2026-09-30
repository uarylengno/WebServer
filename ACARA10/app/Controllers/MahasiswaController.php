<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\MahasiswaRepository;
use App\Models\Mahasiswa;
use App\Models\ProdiModel;

class MahasiswaController extends Controller
{
    private MahasiswaRepository $repo;
    private ProdiModel $prodiModel;

    // Repository disuntikkan dari luar (lihat public/index.php), controller tidak lagi
    // membuat koneksi database atau Repository-nya sendiri
    public function __construct(MahasiswaRepository $repo)
    {
        $this->repo = $repo;
        $this->prodiModel = new ProdiModel(); // hanya untuk dropdown, tetap dari Acara 8
    }

    public function index(): void
    {
        $keyword = trim($_GET['q'] ?? '');
        $mahasiswa = $this->repo->all($keyword);

        $this->view('mahasiswa/index', [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'keyword' => $keyword,
        ]);
    }

    public function create(): void
    {
        $this->view('mahasiswa/create', [
            'title' => 'Tambah Mahasiswa',
            'prodiList' => $this->prodiModel->all(),
        ]);
    }

    public function store(): void
    {
        try {
            // Validasi (NIM angka, nama tidak kosong) terjadi otomatis di constructor Mahasiswa
            $mhs = new Mahasiswa(
                $_POST['nim'] ?? '',
                $_POST['nama'] ?? '',
                $_POST['email'] ?? '',
                (int) ($_POST['prodi_id'] ?? 0),
                (int) ($_POST['angkatan'] ?? date('Y'))
            );
            $this->repo->create($mhs);
            $this->flash('success', 'Data mahasiswa berhasil ditambahkan.');
            $this->redirect('/mahasiswa');
        } catch (\InvalidArgumentException $e) {
            $this->flash('danger', $e->getMessage());
            $this->redirect('/mahasiswa/create');
        }
    }

    public function edit($id): void
    {
        $mahasiswa = $this->repo->find((int) $id);
        if (!$mahasiswa) {
            $this->flash('danger', 'Data mahasiswa tidak ditemukan.');
            $this->redirect('/mahasiswa');
        }

        $this->view('mahasiswa/edit', [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'prodiList' => $this->prodiModel->all(),
        ]);
    }

    public function update($id): void
    {
        try {
            $mhs = new Mahasiswa(
                $_POST['nim'] ?? '',
                $_POST['nama'] ?? '',
                $_POST['email'] ?? '',
                (int) ($_POST['prodi_id'] ?? 0),
                (int) ($_POST['angkatan'] ?? date('Y')),
                (int) $id
            );
            $this->repo->update($mhs);
            $this->flash('success', 'Data mahasiswa berhasil diperbarui.');
            $this->redirect('/mahasiswa');
        } catch (\InvalidArgumentException $e) {
            $this->flash('danger', $e->getMessage());
            $this->redirect('/mahasiswa/' . $id . '/edit');
        }
    }

    public function destroy($id): void
    {
        $this->repo->delete((int) $id);
        $this->flash('success', 'Data mahasiswa berhasil dihapus.');
        $this->redirect('/mahasiswa');
    }
}