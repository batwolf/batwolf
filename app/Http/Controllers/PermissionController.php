<?php

namespace App\Http\Controllers;

use App\Http\Crud\Permission\CreateConfig;
use App\Http\Crud\Permission\EditConfig;
use App\Http\Crud\Permission\ListConfig;
use App\Http\Crud\Permission\ShowConfig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends CrudController
{
    public function create(): Response|RedirectResponse
    {
        return $this->respond('Crud/Create', new CreateConfig(), 'permission-create');
    }

    public function index(): Response|RedirectResponse
    {
        return $this->respond('Crud/Index', new ListConfig(), 'permission-read');
    }

    public function show(Permission $permission): Response|RedirectResponse
    {
        return $this->respond('Crud/Show', new ShowConfig($permission), 'permission-read');
    }

    public function edit(Permission $permission): Response|RedirectResponse
    {
        return $this->respond('Crud/Edit', new EditConfig($permission), 'permission-update');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($this->authorized('permission-create') === false) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Permission::create(['name' => $request->name]);
        sleep(1);

        return redirect()->route('permissions.index')->with('message', 'Permission Created Successfully');
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        if ($this->authorized('permission-update') === false) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission->forceFill([
            'name' => $request->name,
        ]);

        $permission->save();
        sleep(1);

        return redirect()->route('permissions.index')->with('message', 'Permission Updated Successfully');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        if ($this->authorized('permission-delete') === false) {
            return redirect()->route('unauthorized');
        }

        $permission->delete();
        sleep(1);

        return redirect()->route('permission.index')->with('message', 'Permission Delete Successfully');
    }
}
