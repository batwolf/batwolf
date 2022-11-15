<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class EditConfig extends Config
{
    protected string $name = 'role';
    protected string $postRoute = 'roles.update';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Your name',
        ],
    ];

    protected function query(?Model $model = null)
    {
        return $model;
    }

    protected function relatedConfig()
    {
        return PermissionEditConfig::class;
    }
}
