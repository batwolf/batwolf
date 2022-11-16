<?php

namespace App\Http\Crud\Permission;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;

class EditConfig extends Config
{
    protected string $name = 'permission';
    protected string $postRoute = 'permissions.update';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Your name',
        ],
    ];

    public function query(?Model $model = null)
    {
        return $model;
    }
}
