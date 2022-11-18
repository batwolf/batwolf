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

    public function createUser(
        string $name,
        string $email,
        string $rawPassword
    ): void
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($rawPassword),
        ]);
    }

    public function updateUser(
        User $user,
        string $name,
        string $email,
        array $rls,
        ?string $password = null
    ): void {
        $fill = [
            'name' => $name,
            'email' => $email,
        ];

        if (!empty($password)) {
            $fill['password'] = Hash::make($password);
        }

        $user->forceFill($fill);
        $user->save();

        foreach ($rls as $roles) {
            if ($user->hasRole($roles['name'])) {
                if ($roles['checked'] === false) {
                    $user->removeRole($roles['name']);
                }
            } else {
                if ($roles['checked']) {
                    $user->assignRole($roles['name']);
                }
            }
        }
    }
}
