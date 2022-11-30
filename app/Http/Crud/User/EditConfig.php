<?php

namespace App\Http\Crud\User;

use App\Http\Crud\Config;
use Illuminate\Database\Eloquent\Model;

class EditConfig extends Config
{
    protected string $name = 'users';
    protected string $postRoute = 'users.update';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Your name',
        ],
        'pass' => [
            'type' => 'password',
            'label' => 'Password',
            'placeholder' => 'Password',
        ],
        'email' => [
            'type' => 'email',
            'required' => 'required',
            'label' => 'Email Address',
            'placeholder' => 'name@example.com',
        ],
    ];

    /** User $user */
    public function query(?Model $face = null)
    {
        $rolesObj = new RoleEditConfig($face);
        $this->columns['rls'] = $rolesObj->getColumns('rls');
        $face->rls = $rolesObj->getData();

        return $face;
    }
}
