<?php

namespace App\Http\Crud\User;

use App\Http\Crud\Config;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ListConfig extends Config
{
    protected string $name = 'users';
    protected array $columns = [
        'id',
        'name',
        'email',
        'registered'
    ];

    protected function query(?Model $model = null)
    {
        return User::all()->each(function($user) {
            $user['registered'] = $user['created_at']->format('Y-m-d H:i:s');
        });
    }
}
