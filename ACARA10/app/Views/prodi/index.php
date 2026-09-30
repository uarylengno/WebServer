<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Data Prodi</h1>
    <a href="<?= BASE_URL ?>/prodi/create" class="btn btn-primary">+ Tambah Prodi</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark"><tr><th>Kode</th><th>Nama</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php foreach ($prodi as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['kode']) ?></td>
                <td><?= htmlspecialchars($p['nama']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/prodi/<?= $p['id'] ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?= BASE_URL ?>/prodi/<?= $p['id'] ?>/delete" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus prodi ' + <?= json_encode($p['nama']) ?> + '?');">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>