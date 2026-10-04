<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                $host = 'localhost';
                 $db = 'si_akademik_webserver';
                $user = 'root';
                $pass = '';

                self::$instance = new PDO(
                    "mysql:host={$host};dbname={$db};charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                Logger::error('Koneksi database gagal: ' . $e->getMessage());
                die('Terjadi kesalahan pada server. Silakan coba lagi nanti.');
            }
        }

        return self::$instance;
    }
}