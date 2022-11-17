<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;

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
        'guard_name' => [
            'type' => 'text',
            'label' => 'Guard',
            'placeholder' => 'Guard name',
        ],
    ];

    public function query(?Model $role = null)
    {
        $permissionsObj = new PermissionEditConfig($role);
        $this->columns['perms'] = $permissionsObj->getColumns('perms');
        $role->perms = $permissionsObj->getData();

        return $role;
    }
}
