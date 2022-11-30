<?php

namespace App\Http\Controllers;

use App\Http\Crud\Product\CreateConfig;
use App\Http\Crud\Product\EditConfig;
use App\Http\Crud\Product\ListConfig;
use App\Http\Crud\Product\ShowConfig;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends CrudController
{
    public function create(): \Inertia\Response|RedirectResponse
    {
        return $this->respond('Crud/Create', new CreateConfig(), 'product-create');
    }

    public function index(): \Inertia\Response|RedirectResponse
    {
        return $this->respond('Crud/Index', new ListConfig(), 'product-read');
    }

    public function show(Product $product)
    {
        return $this->respond('Crud/Show', new ShowConfig($product), 'product-read');
    }

    public function edit(Product $product): \Inertia\Response|RedirectResponse
    {
        return $this->respond('Crud/Edit', new EditConfig($product), 'product-update');
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

    public function destroy(Product $product): RedirectResponse
    {
        if ($this->authorized('user-delete') === false) {
            return redirect()->route('unauthorized');
        }

        $product->delete();
        sleep(1);

        return redirect()->route('users.index')->with('message', 'User Delete Successfully');
    }
}
