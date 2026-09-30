<?php $title = 'Data Mahasiswa'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Label</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mahasiswaList as $mhs): ?>
        <tr>
            <td><?= htmlspecialchars($mhs->getNim()) ?></td>
            <td><?= htmlspecialchars($mhs->getNama()) ?></td>
            <td><?= htmlspecialchars($mhs->getProdi()) ?></td>
            <td><?= htmlspecialchars($mhs->getAngkatan()) ?></td>
            <td><?= htmlspecialchars($mhs->getLabel()) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>