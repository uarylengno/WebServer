<?php

namespace App\Controllers;

class MahasiswaController
{
    public function index()
    {
        echo "<h1>Daftar Mahasiswa</h1>";
        echo "<p>Ini adalah MahasiswaController::index()</p>";
    }

    public function create()
    {
        echo "<h1>Form Tambah Mahasiswa</h1>";
        echo "<p>Ini adalah MahasiswaController::create()</p>";
    }

    public function store()
    {
        echo "<h1>Menyimpan Data Mahasiswa (POST)</h1>";
        echo "<p>Ini adalah MahasiswaController::store()</p>";
    }

    // Tugas Mandiri: menerima parameter dari URL, misal /mahasiswa/5
    public function show($id)
    {
        echo "<h1>Detail Mahasiswa</h1>";
        echo "<p>Menampilkan mahasiswa dengan ID: " . htmlspecialchars($id) . "</p>";
    }
}