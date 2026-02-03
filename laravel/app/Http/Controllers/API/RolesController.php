<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RolesController extends BaseController
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return $this->success($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|unique:roles,name',
            'description' => 'sometimes|string',
            'slug'        => 'required|string|unique:roles,slug'
        ]);

        $role = DB::transaction(function() use ($request) {
            return Role::create($request->only('name','description','slug'));
        });

        return $this->success($role, "Role created successfully");
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        return $this->success($role);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'        => ['sometimes','string', Rule::unique('roles')->ignore($role->role_id, 'role_id')],
            'description' => 'sometimes|string',
            'slug'        => ['sometimes','string', Rule::unique('roles')->ignore($role->role_id, 'role_id')]
        ]);

        DB::transaction(function() use ($request, $role) {
            $role->update($request->only('name','description','slug'));
        });

        return $this->success($role, "Role updated successfully");
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return $this->error("Cannot delete role assigned to users", 403);
        }

        DB::transaction(function() use ($role) {
            $role->delete();
        });

        return $this->success([], "Role deleted successfully");
    }
}
