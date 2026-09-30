<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    // Kredensial sementara (hardcode), nanti diganti data dari database
    private const USERNAME = 'admin';
    private const PASSWORD = 'admin123';

    public function loginForm(): void
    {
        // Jika sudah login, tidak perlu melihat form login lagi
        if (!empty($_SESSION['logged_in'])) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login', ['title' => 'Login'], 'guest');
    }

    public function login(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === self::USERNAME && $password === self::PASSWORD) {
            // Ganti session ID setelah login untuk mencegah session fixation
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = 1;
            $_SESSION['user_name'] = 'Admin';

            // Tugas mandiri: flash message setelah login sukses
            $this->flash('success', 'Selamat datang, ' . $_SESSION['user_name']);
            $this->redirect('/dashboard');
        }

        $this->flash('danger', 'Username atau password salah.');
        $this->redirect('/login');
    }
    public function logout(): void
    {
        session_destroy();
        session_start();
        session_regenerate_id(true);

        // Tugas mandiri: flash message setelah logout
        $this->flash('success', 'Anda telah logout');
        $this->redirect('/login');
    }
}