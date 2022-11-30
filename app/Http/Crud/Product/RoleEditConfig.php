<?php

namespace App\Http\Crud\Product;

use App\Http\Crud\Config;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleEditConfig extends Config
{
    protected string $name = 'role';
    protected string $postRoute = 'roles.update';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Your name',
        ],
        'rls' => [
            'name' => 'Roles',
            'type' => 'checkbox',
            'label' => 'Roles',
            'placeholder' => ''
        ]
    ];

    /**
     * @param User|null $model
     * @return array
     */
    public function query(?Model $model = null)
    {
        $roles = Role::all(['id', 'name']);

        $finalRoles = [];
        /** @var Permission[] $roles */
        foreach ($roles as $role) {
            $finalRole = $this->columns['rls'];
            $finalRole['id'] = $role['id'];
            $finalRole['name'] = $role['name'];
            $finalRole['checked'] = false;
            if ($model->hasRole($role['name'])) {
                $finalRole['checked'] = true;
            }
            $finalRoles[] = $finalRole;
        }

        return $finalRoles;
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
