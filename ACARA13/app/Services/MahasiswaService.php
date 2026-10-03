<?php

namespace App\Services;

use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Models\Mahasiswa;

class MahasiswaService
{
    // Constructor Dependency Injection: Service menerima kedua Repository dari luar
    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {}

    // Controller memanggil ini untuk index(), bukan repo langsung
    public function list(string $keyword = ''): array
    {
        return $this->repo->all($keyword);
    }

    public function find(int $id): ?Mahasiswa
    {
        return $this->repo->find($id);
    }

    // Dipakai untuk dropdown prodi di form create/edit
    public function prodiOptions(): array
    {
        return $this->prodiRepo->all();
    }

    public function create(array $input): array
    {
        $errors = $this->validate($input);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        try {
            $mhs = new Mahasiswa(
                $input['nim'],
                $input['nama'],
                $input['email'] ?? '',
                (int) ($input['prodi_id'] ?? 0),
                (int) ($input['angkatan'] ?? date('Y'))
            );
            $this->repo->create($mhs);
            return ['success' => true];
        } catch (\InvalidArgumentException $e) {
            return ['success' => false, 'errors' => ['nama' => $e->getMessage()]];
        }
    }

    public function update(int $id, array $input): array
    {
        // Saat update, NIM milik data ini sendiri tidak dianggap duplikat (lihat $ignoreId)
        $errors = $this->validate($input, $id);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        try {
            $mhs = new Mahasiswa(
                $input['nim'],
                $input['nama'],
                $input['email'] ?? '',
                (int) ($input['prodi_id'] ?? 0),
                (int) ($input['angkatan'] ?? date('Y')),
                $id
            );
            $this->repo->update($mhs);
            return ['success' => true];
        } catch (\InvalidArgumentException $e) {
            return ['success' => false, 'errors' => ['nama' => $e->getMessage()]];
        }
    }

    public function delete(int $id): bool
    {
        $this->repo->delete($id);
        return true;
    }

    // Seluruh logika bisnis/validasi ada di sini, bukan di Controller
    private function validate(array $input, ?int $ignoreId = null): array
    {
        $errors = [];

        if (empty($input['nim'])) {
            $errors['nim'] = 'NIM wajib diisi.';
        } elseif (!ctype_digit($input['nim'])) {
            $errors['nim'] = 'NIM harus berupa angka.';
        } elseif ($this->repo->existsByNim($input['nim'], $ignoreId)) {
            $errors['nim'] = 'NIM sudah terdaftar.';
        }

        if (empty($input['nama'])) {
            $errors['nama'] = 'Nama wajib diisi.';
        }

        if (!empty($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Format email tidak valid.';
        }

        $prodiId = (int) ($input['prodi_id'] ?? 0);
        if ($prodiId <= 0 || !$this->prodiRepo->exists($prodiId)) {
            $errors['prodi_id'] = 'Program studi tidak valid.';
        }

        return $errors;
    }
}