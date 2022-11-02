<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HandleUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }


    public function update(HandleUserRequest $request, User $user)
    {

        $validated = $request->validated();

        if ((request('admin') && !$user->admin || !request('admin') && $user->admin) && $this->authorize('give-admin') && $user->id !== 11) {
            $validated = (array_merge($validated,
                request()->validate([
                    'password' => 'required_if_accepted:admin|current_password|nullable|exclude'
                ])
            ));
            request('admin') ? $validated['admin'] = true : $validated['admin'] = false;
        }

        $user->update($validated);

        return redirect(route('users.show', $user));
    }

}
