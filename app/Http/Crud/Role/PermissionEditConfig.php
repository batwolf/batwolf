<?php

namespace App\Http\Crud\Role;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

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
        'perms' => [
            'name' => 'Permissions',
            'type' => 'checkbox',
            'label' => 'Permissions',
            'placeholder' => ''
        ]
    ];

    public function query(?Model $role = null)
    {
        $permissions = Permission::all(['id', 'name']);

        $finalPermissions = [];
        /** @var Permission[] $permissions */
        foreach ($permissions as $perms) {
            $finalPermission = $this->columns['perms'];
            $finalPermission['id'] = $perms['id'];
            $finalPermission['name'] = $perms['name'];
            $finalPermission['checked'] = false;
            if ($role->hasPermissionTo($perms['name'])) {
                $finalPermission['checked'] = true;
            }
            $finalPermissions[] = $finalPermission;
        }

        return $finalPermissions;

    }

    public function toArray(): array
    {
        $returnArray = [];
        foreach ($this->data as $data) {
            $returnArray[] = [
                'id' => $data['id'],
                'name' => $data['name']
            ];
        }

        return $returnArray;
    }
}
