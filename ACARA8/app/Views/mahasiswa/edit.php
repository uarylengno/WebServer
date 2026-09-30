<h1 class="mb-4">Edit Mahasiswa</h1>
<form action="<?= BASE_URL ?>/mahasiswa/<?= $mahasiswa['id'] ?>/update" method="POST">
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($mahasiswa['nim']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($mahasiswa['email']) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Prodi</label>
        <select name="prodi_id" class="form-select" required>
            <?php foreach ($prodiList as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $p['id'] == $mahasiswa['prodi_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Angkatan</label>
        <input type="number" name="angkatan" class="form-control" value="<?= htmlspecialchars($mahasiswa['angkatan']) ?>" required>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <a href="<?= BASE_URL ?>/mahasiswa" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>