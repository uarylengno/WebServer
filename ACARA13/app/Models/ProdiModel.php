<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class ProdiModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM prodi ORDER BY nama ASC");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM prodi WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO prodi (kode, nama) VALUES (:kode, :nama)");
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $stmt = $this->pdo->prepare("UPDATE prodi SET kode = :kode, nama = :nama WHERE id = :id");
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM prodi WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}