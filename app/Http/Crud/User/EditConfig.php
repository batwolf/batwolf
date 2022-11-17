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
    public function query(?Model $user = null)
    {
        $rolesObj = new RoleEditConfig($user);
        $this->columns['rls'] = $rolesObj->getColumns('rls');
        $user->rls = $rolesObj->getData();

        return $user;
    }
}
