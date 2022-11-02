<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandleUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $formRoute = ((auth()->user()->admin) ? route('admin.users.update', $user) : route('users.update', $user));

        return view('users.edit', compact('user', 'formRoute'));
    }

    public function update(HandleUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return redirect(route('users.show', $user));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect('posts');
    }
}
