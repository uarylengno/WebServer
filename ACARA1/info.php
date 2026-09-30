<?php
$nama = "Uaryl Engno Laurenca";
$nim = "E41250317";
$waktuServer = date("Y-m-d H:i:s");
$versiPhp = phpversion();
$osServer = PHP_OS;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Info Server</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        table { border-collapse: collapse; width: 100%; max-width: 500px; background: #fff; }
        th, td { border: 1px solid #ddd; padding: 10px 15px; text-align: left; }
        th { background: #2c3e50; color: #fff; width: 40%; }
    </style>
</head>
<body>
    <h2>Informasi Mahasiswa & Server</h2>
    <table>
        <tr>
            <th>Nama</th>
            <td><?= htmlspecialchars($nama) ?></td>
        </tr>
        <tr>
            <th>NIM</th>
            <td><?= htmlspecialchars($nim) ?></td>
        </tr>
        <tr>
            <th>Waktu Server</th>
            <td><?= htmlspecialchars($waktuServer) ?></td>
        </tr>
        <tr>
            <th>Versi PHP</th>
            <td><?= htmlspecialchars($versiPhp) ?></td>
        </tr>
        <tr>
            <th>Sistem Operasi Server</th>
            <td><?= htmlspecialchars($osServer) ?></td>
        </tr>
    </table>
</body>
</html>