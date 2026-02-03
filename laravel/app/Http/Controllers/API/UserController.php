<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::with('roles.permissions')->paginate(10);
        return $this->success($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6',
        ]);

        $user = DB::transaction(function() use ($request) {
            return User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'status'     => 'active',
            ]);
        });

        return $this->success($user, "User created successfully");
    }

    public function show(User $user)
    {
        $user->load('roles.permissions');
        return $this->success($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'sometimes|string',
            'last_name'  => 'sometimes|string',
            'email'      => ['sometimes','email', Rule::unique('users')->ignore($user->user_id, 'user_id')],
            'status'     => 'sometimes|in:active,inactive',
        ]);

        DB::transaction(function() use ($request, $user) {
            $user->update($request->only('first_name','last_name','email','status'));
        });

        return $this->success($user, "User updated successfully");
    }

    public function destroy(User $user)
    {
        DB::transaction(function() use ($user) {
            $user->delete();
        });

        return $this->success([], "User deleted successfully");
    }
}
