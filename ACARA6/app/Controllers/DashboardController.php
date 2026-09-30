<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index(): void
    {
        $this->view('dashboard/index', [
            'title'    => 'Dashboard',
            'userName' => $_SESSION['user_name'] ?? '',
        ]);
    }
}