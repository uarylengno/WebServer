<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    // static: satu-satunya instance PDO dipakai bersama di seluruh aplikasi
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

            try {
                self::$instance = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Matikan emulasi prepared statement -> query dan data benar-benar dikirim terpisah ke MySQL
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Koneksi database gagal: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}