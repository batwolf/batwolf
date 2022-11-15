<?php

namespace App\Http\Crud\Permission;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;

class ShowConfig extends Config
{
    protected string $name = 'permissions';
    protected array $columns = [
        'id',
        'name',
    ];

    protected function query(?Model $model = null)
    {
        return $model;
    }
}
