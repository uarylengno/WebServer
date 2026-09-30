<h1 class="mb-4">Tambah Mata Kuliah</h1>
<form action="<?= BASE_URL ?>/matakuliah/store" method="POST">
    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control" min="1" max="6" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Prodi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            <?php foreach ($prodiList as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <a href="<?= BASE_URL ?>/matakuliah" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>