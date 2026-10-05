<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\MahasiswaService;

class MahasiswaController extends Controller
{
    // Controller hanya menerima Service -> tidak ada lagi validasi atau query di sini
    public function __construct(private MahasiswaService $service) {}

    public function index(): void
    {
        $keyword = trim($_GET['q'] ?? '');
        $mahasiswa = $this->service->list($keyword);

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
            'prodiList' => $this->service->prodiOptions(),
        ]);
    }

    public function store(): void
    {
        // Controller hanya meneruskan request ke Service, lalu menentukan response
        $result = $this->service->create($_POST);

        if ($result['success']) {
            $this->flash('success', 'Data mahasiswa berhasil ditambahkan.');
            $this->redirect('/mahasiswa');
        }

        $firstError = array_values($result['errors'])[0] ?? 'Data gagal disimpan.';
        $this->flash('danger', $firstError);
        $this->redirect('/mahasiswa/create');
    }

    public function edit($id): void
    {
        $mahasiswa = $this->service->find((int) $id);
        if (!$mahasiswa) {
            $this->flash('danger', 'Data mahasiswa tidak ditemukan.');
            $this->redirect('/mahasiswa');
        }

        $this->view('mahasiswa/edit', [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'prodiList' => $this->service->prodiOptions(),
        ]);
    }

    public function update($id): void
    {
        $result = $this->service->update((int) $id, $_POST);

        if ($result['success']) {
            $this->flash('success', 'Data mahasiswa berhasil diubah.');
            $this->redirect('/mahasiswa');
        }

        $firstError = array_values($result['errors'])[0] ?? 'Data gagal disimpan.';
        $this->flash('danger', $firstError);
        $this->redirect('/mahasiswa/' . $id . '/edit');
    }

    public function destroy($id): void
    {
        if ($this->service->delete((int) $id)) {
            $this->flash('success', 'Data mahasiswa berhasil dihapus.');
        } else {
            $this->flash('danger', 'Data gagal dihapus.');
        }
        $this->redirect('/mahasiswa');
    }
}