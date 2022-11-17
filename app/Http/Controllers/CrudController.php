<?php

namespace App\Http\Controllers;

use App\Http\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

class CrudController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function authorized(string $name)
    {
        if (!Auth::user()->can($name)) {
            return redirect()->route('unauthorized');
        }
    }
}
