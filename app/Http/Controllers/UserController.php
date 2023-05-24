<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'users');
    }

    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('users.index');
    }

    public function create(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('users.index')->with('success', __('User created successfully!'));
    }

    public function show(User $user): Factory|View|\Illuminate\Foundation\Application|Application
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): Factory|View|\Illuminate\Foundation\Application|Application
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()->route('users.index')->with('success', __('User updated successfully!'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', __('User deleted successfully!'));
    }
}
