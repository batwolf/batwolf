<?php

namespace App\Http\Controllers;

use App\Http\Crud\Permission\CreateConfig;
use App\Http\Crud\Permission\EditConfig;
use App\Http\Crud\Permission\ListConfig;
use App\Http\Crud\Permission\ShowConfig;
use App\Http\Crud\Role\PermissionEditConfig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Crud/Create', new CreateConfig());
    }

    public function index(): Response
    {
        return Inertia::render('Crud/Index', new ListConfig());
    }

    public function show(Permission $permission): Response
    {
        return Inertia::render('Crud/Show', new ShowConfig($permission));
    }

    public function edit(Permission $permission): Response
    {
        return Inertia::render('Crud/Edit', new EditConfig($permission));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Permission::create(['name' => $request->name]);
        sleep(1);

        return redirect()->route('permissions.index')->with('message', 'Permission Created Successfully');
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
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
        $permission->delete();
        sleep(1);

        return redirect()->route('permission.index')->with('message', 'Permission Delete Successfully');
    }
}
