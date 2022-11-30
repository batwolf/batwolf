<?php

namespace App\Http\Controllers;

use App\Http\Crud\Role\CreateConfig;
use App\Http\Crud\Role\EditConfig;
use App\Http\Crud\Role\ListConfig;
use App\Http\Crud\Role\ShowConfig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends CrudController
{
    public function create(): \Inertia\Response|RedirectResponse
    {
        return $this->respond('Crud/Create', new CreateConfig(), 'role-create');
    }

    public function index(): \Inertia\Response|RedirectResponse
    {
        return $this->respond('Crud/Index', new ListConfig(), 'role-read');
    }

    public function show(Role $role)
    {
        return $this->respond('Crud/Show', new ShowConfig($role), 'role-read');
    }

    public function edit(Role $role): \Inertia\Response|RedirectResponse
    {
        return $this->respond('Crud/Edit', new EditConfig($role), 'role-update');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($this->authorized('role-create') === false) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => $request->name
        ]);
        sleep(1);

        return redirect()->route('roles.index')->with('message', 'Role Created Successfully');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        if ($this->authorized('role-update') === false) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->forceFill([
            'name' => $request->name,
        ]);

        $role->save();

        foreach ($request->perms as $perm) {
            if ($role->hasPermissionTo($perm['name'])) {
                if ($perm['checked'] === false) {
                    $role->revokePermissionTo($perm['name']);
                }
            } else {
                if ($perm['checked']) {
                    $role->givePermissionTo($perm['name']);
                }
            }
        }

        sleep(1);

        return redirect()->route('roles.index')->with('message', 'Role Updated Successfully');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($this->authorized('role-delete') === false) {
            return redirect()->route('unauthorized');
        }

        $role->delete();
        sleep(1);

        return redirect()->route('roles.index')->with('message', 'Role Delete Successfully');
    }
}
