<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>/dashboard">SI Akademik</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="<?= BASE_URL ?>/dashboard">Dashboard</a>
            <a class="nav-link" href="<?= BASE_URL ?>/mahasiswa">Mahasiswa</a>
        </div>
        <span class="navbar-text me-3">
            <?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>
        </span>
        <a href="<?= BASE_URL ?>/logout" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>