<?php

namespace App\Http\Controllers;

use App\Http\Crud\User\CreateConfig;
use App\Http\Crud\User\EditConfig;
use App\Http\Crud\User\ListConfig;
use App\Http\Crud\User\ShowConfig;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends CrudController
{
    public function create()
    {
        return $this->respond('Crud/Create', new CreateConfig(), 'user-create');
    }

    public function index()
    {
        return $this->respond('Crud/Index', new ListConfig(), 'user-read');
    }

    public function show(User $user)
    {
        return $this->respond('Crud/Show', new ShowConfig($user), 'user-read');
    }

    public function edit(User $user)
    {
        $user->pass = '';
        return $this->respond('Crud/Edit', new EditConfig($user), 'user-update');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($this->authorized('user-create') === false) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'pass' => 'required|min:6|max:255',
        ]);

        $this->userRepository->createUser(
            $request->name,
            $request->email,
            $request->pass
        );
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Created Successfully');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($this->authorized('user-update') === false) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $this->userRepository->updateUser(
            $user,
            $request->name,
            $request->email,
            $request->rls,
            $request->pass
        );
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Updated Successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($this->authorized('user-delete') === false) {
            return redirect()->route('unauthorized');
        }

        $user->delete();
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Delete Successfully');
    }
}
