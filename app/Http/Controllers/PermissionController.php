<?php

namespace App\Http\Controllers;

use App\Http\Crud\Permission\CreateConfig;
use App\Http\Crud\Permission\EditConfig;
use App\Http\Crud\Permission\ListConfig;
use App\Http\Crud\Permission\ShowConfig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends CrudController
{
    public function create()
    {
        $this->authorized('permission-create');
        return Inertia::render('Crud/Create', new CreateConfig());
    }

    public function index()
    {
        $this->authorized('permission-read');
        return Inertia::render('Crud/Index', new ListConfig());
    }

    public function show(Permission $permission)
    {
        $this->authorized('permission-read');
        return Inertia::render('Crud/Show', new ShowConfig($permission));
    }

    public function edit(Permission $permission)
    {
        $this->authorized('permission-update');
        return Inertia::render('Crud/Edit', new EditConfig($permission));
    }

    public function store(Request $request)
    {
        $this->authorized('permission-create');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Permission::create(['name' => $request->name]);
        sleep(1);

        return redirect()->route('permissions.index')->with('message', 'Permission Created Successfully');
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $this->authorized('permission-update');

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
        $this->authorized('permission-delete');

        $permission->delete();
        sleep(1);

        return redirect()->route('permission.index')->with('message', 'Permission Delete Successfully');
    }
}
