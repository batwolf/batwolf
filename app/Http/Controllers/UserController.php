<?php

namespace App\Http\Controllers;

use App\Http\Crud\User\CreateConfig;
use App\Http\Crud\User\EditConfig;
use App\Http\Crud\User\ListConfig;
use App\Http\Crud\User\ShowConfig;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Crud/Create', new CreateConfig());
    }

    public function index(): Response
    {
        return Inertia::render('Crud/Index', new ListConfig());
    }

    public function show(User $user): Response
    {
        return Inertia::render('Crud/Show', new ShowConfig($user));
    }

    public function edit(User $user): Response
    {
        $user->pass = '';
        return Inertia::render('Crud/Edit', new EditConfig($user));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'pass' => 'required|min:6|max:255',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pass),
        ]);
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Created Successfully');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $fill = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->pass)) {
            $fill['password'] = Hash::make($request->pass);
        }

        $user->forceFill($fill);
        $user->save();
        $this->postUpdateHook($request, $user);
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Updated Successfully');
    }

    public function postUpdateHook(Request $request, User $user)
    {
        foreach ($request->rls as $roles) {
            if ($user->hasRole($roles['name'])) {
                if ($roles['checked'] === false) {
                    $user->removeRole($roles['name']);
                }
            } else {
                if ($roles['checked']) {
                    $user->assignRole($roles['name']);
                }
            }
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Delete Successfully');
    }
}
