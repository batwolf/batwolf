<?php

namespace App\Http\Crud\Face;

use App\Http\Crud\Config;
use App\Models\Face;
use Illuminate\Database\Eloquent\Model;

class ShowConfig extends Config
{
    protected string $name = 'users';
    protected array $columns = [
        'id',
        'name',
        'email',
        'assignedRoles'
    ];

    /**
     * @param Face|null $model
     * @return Model|null
     */
    public function query(?Model $model = null)
    {
        $roles = $model->getRoleNames();
        $allRoles = [];
        foreach ($roles as $role) {
            $allRoles[] = $role;
        }
        $model->assignedRoles = implode(', ', $allRoles);

        return $model;
    }
}
