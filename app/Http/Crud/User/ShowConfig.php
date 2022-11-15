<?php

namespace App\Http\Crud\User;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;

class ShowConfig extends Config
{
    protected string $name = 'users';
    protected array $columns = [
        'id',
        'name',
        'email',
    ];

    protected function query(?Model $model = null)
    {
        return $model;
    }
}
