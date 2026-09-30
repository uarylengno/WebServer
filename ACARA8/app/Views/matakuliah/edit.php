<h1 class="mb-4">Edit Mata Kuliah</h1>
<form action="<?= BASE_URL ?>/matakuliah/<?= $matakuliah['id'] ?>/update" method="POST">
    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($matakuliah['kode']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($matakuliah['nama']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control" value="<?= htmlspecialchars($matakuliah['sks']) ?>" min="1" max="6" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Prodi</label>
        <select name="prodi_id" class="form-select" required>
            <?php foreach ($prodiList as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $p['id'] == $matakuliah['prodi_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <a href="<?= BASE_URL ?>/matakuliah" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>