<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class MahasiswaController extends Controller
{
    private MahasiswaModel $model;
    private ProdiModel $prodiModel;

    public function __construct()
    {
        $this->model = new MahasiswaModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index(): void
    {
        // Tugas Mandiri: kata kunci pencarian dari ?q=
        $keyword = trim($_GET['q'] ?? '');
        $mahasiswa = $this->model->all($keyword);

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
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $prodiId = (int) ($_POST['prodi_id'] ?? 0);
        $angkatan = (int) ($_POST['angkatan'] ?? date('Y'));

        // Validasi sederhana
        if ($nim === '' || $nama === '') {
            $this->flash('danger', 'NIM dan Nama wajib diisi.');
            $this->redirect('/mahasiswa/create');
        }

        $this->model->create([
            'nim' => $nim, 'nama' => $nama, 'email' => $email,
            'prodi_id' => $prodiId, 'angkatan' => $angkatan,
        ]);

        $this->flash('success', 'Data mahasiswa berhasil ditambahkan.');
        $this->redirect('/mahasiswa');
    }

    public function edit($id): void
    {
        $mahasiswa = $this->model->find((int) $id);
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
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $prodiId = (int) ($_POST['prodi_id'] ?? 0);
        $angkatan = (int) ($_POST['angkatan'] ?? date('Y'));

        if ($nim === '' || $nama === '') {
            $this->flash('danger', 'NIM dan Nama wajib diisi.');
            $this->redirect('/mahasiswa/' . $id . '/edit');
        }

        $this->model->update((int) $id, [
            'nim' => $nim, 'nama' => $nama, 'email' => $email,
            'prodi_id' => $prodiId, 'angkatan' => $angkatan,
        ]);

        $this->flash('success', 'Data mahasiswa berhasil diperbarui.');
        $this->redirect('/mahasiswa');
    }

    public function destroy($id): void
    {
        $this->model->delete((int) $id);
        $this->flash('success', 'Data mahasiswa berhasil dihapus.');
        $this->redirect('/mahasiswa');
    }
}