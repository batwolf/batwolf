<?php

namespace App\Http\Crud\User;

use App\Http\Crud\Config;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CreateConfig extends Config
{
    protected string $name = 'users';
    protected string $postRoute = 'users.store';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Name',
            'required' => 'required',
        ],
        'pass' => [
            'type' => 'password',
            'required' => 'required',
            'label' => 'Password',
            'placeholder' => 'Password',
        ],
        'email' => [
            'type' => 'email',
            'required' => 'required',
            'label' => 'Email Address',
            'placeholder' => 'name@example.com',
        ]
    ];

    protected function query(?Model $model = null)
    {
        $user = new User();
        $user->forceFill([
            'name' => '',
            'email' => '',
            'pass' => '',
        ]);

        return $user;
    }
}
