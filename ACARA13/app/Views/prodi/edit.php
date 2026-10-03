<h1 class="mb-4">Edit Prodi</h1>
<form action="<?= BASE_URL ?>/prodi/<?= $prodi['id'] ?>/update" method="POST">
    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($prodi['kode']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Prodi</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($prodi['nama']) ?>" required>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <a href="<?= BASE_URL ?>/prodi" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>