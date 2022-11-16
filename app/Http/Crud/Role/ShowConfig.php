<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;

class ShowConfig extends Config
{
    protected string $name = 'roles';
    protected array $columns = [
        'id',
        'name',
    ];

    public function query(?Model $model = null)
    {
        return $model;
    }
}
