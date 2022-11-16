<?php

namespace App\Http\Controllers;

use App\Http\Crud\Role\CreateConfig;
use App\Http\Crud\Role\EditConfig;
use App\Http\Crud\Role\ListConfig;
use App\Http\Crud\Role\ShowConfig;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Crud/Create', new CreateConfig());
    }

    public function index(): Response
    {
        return Inertia::render('Crud/Index', new ListConfig());
    }

    public function show(Role $role): Response
    {
        return Inertia::render('Crud/Show', new ShowConfig($role));
    }

    public function edit(Role $role): Response
    {
        return Inertia::render('Crud/Edit', new EditConfig($role));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create(['guard_name' => 'web', 'name' => $request->name]);
        sleep(1);

        return redirect()->route('roles.index')->with('message', 'Role Created Successfully');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->forceFill([
            'name' => $request->name,
        ]);

        $role->save();
        $this->postUpdateHook($request, $role);
        sleep(1);

        return redirect()->route('roles.index')->with('message', 'Role Updated Successfully');
    }

    public function postUpdateHook(Request $request, Role $role)
    {
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
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        sleep(1);

        return redirect()->route('roles.index')->with('message', 'Role Delete Successfully');
    }
}
