<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;

class PermissionEditConfig extends Config
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

    protected function query(?Model $model = null)
    {
        $data = Permission::all(['id', 'name'])->each(function(Permission $permission) {
            $permission->assignRole('Owner');
            $permission->currentRoles = $permission->getRoleNames();
        });

        dd($data);



        return Permission::all(['id', 'name']);
    }
}
