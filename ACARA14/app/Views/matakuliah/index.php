<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Data Mata Kuliah</h1>
    <a href="<?= BASE_URL ?>/matakuliah/create" class="btn btn-primary">+ Tambah Mata Kuliah</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark"><tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Prodi</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php foreach ($matakuliah as $mk): ?>
            <tr>
                <td><?= htmlspecialchars($mk['kode']) ?></td>
                <td><?= htmlspecialchars($mk['nama']) ?></td>
                <td><?= htmlspecialchars($mk['sks']) ?></td>
                <td><?= htmlspecialchars($mk['prodi_nama']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/matakuliah/<?= $mk['id'] ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?= BASE_URL ?>/matakuliah/<?= $mk['id'] ?>/delete" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus mata kuliah ' + <?= json_encode($mk['nama']) ?> + '?');">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>