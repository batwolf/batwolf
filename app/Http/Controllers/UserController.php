<?php

namespace App\Http\Controllers;

use App\Http\Crud\User\CreateConfig;
use App\Http\Crud\User\EditConfig;
use App\Http\Crud\User\ListConfig;
use App\Http\Crud\User\ShowConfig;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends CrudController
{
    public function create(): \Inertia\Response
    {
        $this->authorized('user-create');
        return Inertia::render('Crud/Create', new CreateConfig());
    }

    public function index(): \Inertia\Response
    {
        $this->authorized('user-read');
        return Inertia::render('Crud/Index', new ListConfig());
    }

    public function show(User $user): \Inertia\Response
    {
        $this->authorized('user-read');
        return Inertia::render('Crud/Show', new ShowConfig($user));
    }

    public function edit(User $user): \Inertia\Response
    {
        $this->authorized('user-update');
        $user->pass = '';
        return Inertia::render('Crud/Edit', new EditConfig($user));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorized('user-create');
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
        $this->authorized('user-update');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $this->userRepository->updateUser(
            $user,
            $request->name,
            $request->email,
            $request->pass,
            $request->rls
        );
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Updated Successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorized('user-delete');
        $user->delete();
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Delete Successfully');
    }
}
