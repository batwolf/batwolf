<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends CrudController
{
    public function index()
    {
        $this->authorized('dashboard');
        $userCount = $this->userRepository->getUserCount();

        return Inertia::render('Dashboard/Index', [
            'userCount' => $userCount
        ]);
    }
}
