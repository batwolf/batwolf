<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class CreateConfig extends Config
{
    protected string $name = 'roles';
    protected string $postRoute = 'roles.store';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Name',
            'required' => 'required',
        ],
    ];

    public function query(?Model $model = null)
    {
        $model = new Role();
        $model->forceFill([
            'name' => '',
        ]);

        return $model;
    }
}
