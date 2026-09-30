<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Data Mahasiswa</h1>
    <a href="<?= BASE_URL ?>/mahasiswa/create" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

<!-- Tugas Mandiri: form pencarian nama/NIM -->
<form method="GET" action="<?= BASE_URL ?>/mahasiswa" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="q" class="form-control" placeholder="Cari nama atau NIM..." value="<?= htmlspecialchars($keyword) ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($keyword !== ''): ?>
            <a href="<?= BASE_URL ?>/mahasiswa" class="btn btn-outline-secondary">Reset</a>
        <?php endif; ?>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>NIM</th><th>Nama</th><th>Email</th><th>Prodi</th><th>Angkatan</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($mahasiswa)): ?>
            <tr><td colspan="6" class="text-center text-muted">Tidak ada data ditemukan.</td></tr>
            <?php else: foreach ($mahasiswa as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['nim']) ?></td>
                <td><?= htmlspecialchars($m['nama']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars($m['prodi_nama']) ?></td>
                <td><?= htmlspecialchars($m['angkatan']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/mahasiswa/<?= $m['id'] ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                    <!-- Konfirmasi JavaScript sebelum form hapus dikirim -->
                    <form action="<?= BASE_URL ?>/mahasiswa/<?= $m['id'] ?>/delete" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus data ' + <?= json_encode($m['nama']) ?> + '?');">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>