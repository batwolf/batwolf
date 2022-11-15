<?php

namespace App\Http\Crud\Permission;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class CreateConfig extends Config
{
    protected string $name = 'Permissions';
    protected string $postRoute = 'permissions.store';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Name',
            'required' => 'required',
        ],
    ];

    protected function query(?Model $model = null)
    {
        $model = new Permission();
        $model->forceFill([
            'name' => '',
        ]);

        return $model;
    }
}
