<?php

namespace App\Http\Controllers;

use App\Http\Crud\Config;
use App\Http\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CrudController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function respond(
        string $page,
        Config $params,
        string $role = ''
    ) {
        if ($this->authorized($role)) {
            return Inertia::render($page, $params);
        }
        return redirect()->route('unauthorized');
    }

    protected function authorized(string $name)
    {
        return Auth::user()->can($name);
    }
}
