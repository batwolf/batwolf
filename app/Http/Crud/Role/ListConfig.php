<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ListConfig extends Config
{
    protected string $name = 'roles';
    protected array $columns = [
        'id',
        'name',
    ];

    public function query(?Model $model = null)
    {
        return Role::all();
    }
}
