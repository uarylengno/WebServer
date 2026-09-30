<?php

namespace App\Repositories;

use App\Models\Mahasiswa;
use PDO;

class MahasiswaRepository
{
    private PDO $pdo;

    // Constructor Dependency Injection: menerima koneksi dari luar (Database::getInstance()),
    // bukan membuat koneksinya sendiri -> lebih fleksibel dan mudah diuji (testable)
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(string $keyword = ''): array
    {
        $sql = "SELECT m.*, p.nama AS prodi_nama
                FROM mahasiswa m
                JOIN prodi p ON m.prodi_id = p.id";
        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE m.nama LIKE :keyword OR m.nim LIKE :keyword";
            $params['keyword'] = '%' . $keyword . '%';
        }
        $sql .= " ORDER BY m.nama ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        // Ubah setiap baris array hasil query menjadi objek Mahasiswa
        return array_map(fn($row) => $this->mapToEntity($row), $stmt->fetchAll());
    }

    public function find(int $id): ?Mahasiswa
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? $this->mapToEntity($row) : null;
    }

    public function create(Mahasiswa $mhs): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan)
             VALUES (:nim, :nama, :email, :prodi_id, :angkatan)"
        );
        $stmt->execute([
            'nim' => $mhs->getNim(),
            'nama' => $mhs->getNama(),
            'email' => $mhs->getEmail(),
            'prodi_id' => $mhs->getProdiId(),
            'angkatan' => $mhs->getAngkatan(),
        ]);
    }

    public function update(Mahasiswa $mhs): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan
             WHERE id = :id"
        );
        $stmt->execute([
            'nim' => $mhs->getNim(),
            'nama' => $mhs->getNama(),
            'email' => $mhs->getEmail(),
            'prodi_id' => $mhs->getProdiId(),
            'angkatan' => $mhs->getAngkatan(),
            'id' => $mhs->getId(),
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // Helper: ubah array hasil query menjadi objek Mahasiswa
    private function mapToEntity(array $row): Mahasiswa
    {
        return new Mahasiswa(
            $row['nim'],
            $row['nama'],
            $row['email'] ?? '',
            (int) $row['prodi_id'],
            (int) $row['angkatan'],
            (int) $row['id'],
            $row['prodi_nama'] ?? null
        );
    }
}