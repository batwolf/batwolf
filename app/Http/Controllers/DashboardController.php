<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends CrudController
{
    public function index(): \Inertia\Response
    {
        $this->authorized('dashboard');

        return Inertia::render('Dashboard/Index', [
            'userCount' => $this->userRepository->getUserCount(),
        ]);
    }
}
