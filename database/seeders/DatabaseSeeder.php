<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'permission-create']);
        Permission::create(['name' => 'permission-read']);
        Permission::create(['name' => 'permission-update']);
        Permission::create(['name' => 'permission-delete']);

        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-read']);
        Permission::create(['name' => 'role-update']);
        Permission::create(['name' => 'role-delete']);

        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-read']);
        Permission::create(['name' => 'user-update']);
        Permission::create(['name' => 'user-delete']);

        Permission::create(['name' => 'product-create']);
        Permission::create(['name' => 'product-read']);
        Permission::create(['name' => 'product-update']);
        Permission::create(['name' => 'product-delete']);

        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'web']);

        $owner = Role::create(['name' => 'owner']);
        $owner->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'dashboard',
            'web',
            'user-read',
            'user-update',
            'product-create',
            'product-read',
            'product-update',
            'product-delete',
        ]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['dashboard', 'web']);

        User::create([
            'name' => 'Batwolf',
            'email' => 'batwolf@batwolfwatches.com',
            'password' => Hash::make('Emily2006@'),
        ]);

        $user = User::find(1);
        $user->assignRole('owner');
    }
}
