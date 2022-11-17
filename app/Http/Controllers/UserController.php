<?php

namespace App\Http\Controllers;

use App\Http\Crud\User\CreateConfig;
use App\Http\Crud\User\EditConfig;
use App\Http\Crud\User\ListConfig;
use App\Http\Crud\User\ShowConfig;
use App\Http\Repository\UserRepository;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends CrudController
{


    public function create()
    {
        if($this->authorized('user-create')) {
            return redirect()->route('unauthorized');
        }

        return Inertia::render('Crud/Create', new CreateConfig());
    }

    public function index()
    {
        if($this->authorized('user-read')) {
            return redirect()->route('unauthorized');
        }

        return Inertia::render('Crud/Index', new ListConfig());
    }

    public function show(User $user)
    {
        if($this->authorized('user-read')) {
            return redirect()->route('unauthorized');
        }

        return Inertia::render('Crud/Show', new ShowConfig($user));
    }

    public function edit(User $user)
    {
        if($this->authorized('user-update')) {
            return redirect()->route('unauthorized');
        }

        $user->pass = '';
        return Inertia::render('Crud/Edit', new EditConfig($user));
    }

    public function store(Request $request)
    {
        if($this->authorized('user-create')) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'pass' => 'required|min:6|max:255',
        ]);

        $this->userRepository->createUser($request->name, $request->email, $request->pass);
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Created Successfully');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if($this->authorized('user-update')) {
            return redirect()->route('unauthorized');
        }

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
        if($this->authorized('user-delete')) {
            return redirect()->route('unauthorized');
        }

        $user->delete();
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Delete Successfully');
    }
}
