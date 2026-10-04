<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\MatakuliahModel;
use App\Models\ProdiModel;

class MatakuliahController extends Controller
{
    private MatakuliahModel $model;
    private ProdiModel $prodiModel;

    public function __construct()
    {
        $this->model = new MatakuliahModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index(): void
    {
        $this->view('matakuliah/index', ['title' => 'Data Mata Kuliah', 'matakuliah' => $this->model->all()]);
    }

    public function create(): void
    {
        $this->view('matakuliah/create', [
            'title' => 'Tambah Mata Kuliah',
            'prodiList' => $this->prodiModel->all(),
        ]);
    }

    public function store(): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $sks = (int) ($_POST['sks'] ?? 0);
        $prodiId = (int) ($_POST['prodi_id'] ?? 0);

        if ($kode === '' || $nama === '') {
            $this->flash('danger', 'Kode dan Nama wajib diisi.');
            $this->redirect('/matakuliah/create');
        }

        $this->model->create(['kode' => $kode, 'nama' => $nama, 'sks' => $sks, 'prodi_id' => $prodiId]);
        $this->flash('success', 'Data mata kuliah berhasil ditambahkan.');
        $this->redirect('/matakuliah');
    }

    public function edit($id): void
    {
        $matakuliah = $this->model->find((int) $id);
        if (!$matakuliah) {
            $this->flash('danger', 'Data mata kuliah tidak ditemukan.');
            $this->redirect('/matakuliah');
        }

        $this->view('matakuliah/edit', [
            'title' => 'Edit Mata Kuliah',
            'matakuliah' => $matakuliah,
            'prodiList' => $this->prodiModel->all(),
        ]);
    }

    public function update($id): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $sks = (int) ($_POST['sks'] ?? 0);
        $prodiId = (int) ($_POST['prodi_id'] ?? 0);

        if ($kode === '' || $nama === '') {
            $this->flash('danger', 'Kode dan Nama wajib diisi.');
            $this->redirect('/matakuliah/' . $id . '/edit');
        }

        $this->model->update((int) $id, ['kode' => $kode, 'nama' => $nama, 'sks' => $sks, 'prodi_id' => $prodiId]);
        $this->flash('success', 'Data mata kuliah berhasil diperbarui.');
        $this->redirect('/matakuliah');
    }

    public function destroy($id): void
    {
        $this->model->delete((int) $id);
        $this->flash('success', 'Data mata kuliah berhasil dihapus.');
        $this->redirect('/matakuliah');
    }
}