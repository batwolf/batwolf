<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getUserCount(): int
    {
        return User::all(['id'])->count();
    }

    public function createUser(string $name, string $email, string $rawPassword): void
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($rawPassword),
        ]);
    }
}
