<?php

namespace App\Controllers;

use Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Renderiza a view do dashboard
        $this->view('dashboard/index', null, 'admin');
    }
}
