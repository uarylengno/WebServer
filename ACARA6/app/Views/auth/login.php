<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h3 mb-4 text-center">Login</h1>

        <!-- Data dikirim POST ke route /login, lalu diproses AuthController::login() -->
        <form action="<?= BASE_URL ?>/login" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
    </div>
</div>
