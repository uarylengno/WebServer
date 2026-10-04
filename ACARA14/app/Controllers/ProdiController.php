<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProdiModel;

class ProdiController extends Controller
{
    private ProdiModel $model;

    public function __construct()
    {
        $this->model = new ProdiModel();
    }

    public function index(): void
    {
        $this->view('prodi/index', ['title' => 'Data Prodi', 'prodi' => $this->model->all()]);
    }

    public function create(): void
    {
        $this->view('prodi/create', ['title' => 'Tambah Prodi']);
    }

    public function store(): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');

        if ($kode === '' || $nama === '') {
            $this->flash('danger', 'Kode dan Nama wajib diisi.');
            $this->redirect('/prodi/create');
        }

        $this->model->create(['kode' => $kode, 'nama' => $nama]);
        $this->flash('success', 'Data prodi berhasil ditambahkan.');
        $this->redirect('/prodi');
    }

    public function edit($id): void
    {
        $prodi = $this->model->find((int) $id);
        if (!$prodi) {
            $this->flash('danger', 'Data prodi tidak ditemukan.');
            $this->redirect('/prodi');
        }

        $this->view('prodi/edit', ['title' => 'Edit Prodi', 'prodi' => $prodi]);
    }

    public function update($id): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');

        if ($kode === '' || $nama === '') {
            $this->flash('danger', 'Kode dan Nama wajib diisi.');
            $this->redirect('/prodi/' . $id . '/edit');
        }

        $this->model->update((int) $id, ['kode' => $kode, 'nama' => $nama]);
        $this->flash('success', 'Data prodi berhasil diperbarui.');
        $this->redirect('/prodi');
    }

    public function destroy($id): void
    {
        try {
            $this->model->delete((int) $id);
            $this->flash('success', 'Data prodi berhasil dihapus.');
        } catch (\PDOException $e) {
            // Tertangkap kalau prodi masih dipakai mahasiswa/matakuliah (FK RESTRICT)
            $this->flash('danger', 'Prodi tidak bisa dihapus karena masih dipakai data lain.');
        }
        $this->redirect('/prodi');
    }
}