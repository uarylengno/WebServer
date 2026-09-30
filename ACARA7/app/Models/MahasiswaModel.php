<?php

namespace App\Models;

require_once __DIR__ . '/Model.php';

class MahasiswaModel extends Model
{
    protected string $table = 'mahasiswa';

    public function all(): array
    {
        $sql = "SELECT m.*, p.nama AS nama_prodi
                FROM mahasiswa m
                JOIN prodi p ON p.id = m.prodi_id
                ORDER BY m.nim";

        return $this->db->query($sql)->fetchAll();
    }
}