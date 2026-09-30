<h1 class="mb-4">Tambah Prodi</h1>
<form action="<?= BASE_URL ?>/prodi/store" method="POST">
    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Prodi</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <a href="<?= BASE_URL ?>/prodi" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>