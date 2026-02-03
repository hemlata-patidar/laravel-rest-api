<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionsController extends BaseController
{
    public function index()
    {
        $permissions = Permission::all();
        return $this->success($permissions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'slug' => 'required|string|unique:permissions,slug',
        ]);

        $permission = DB::transaction(function() use ($request) {
            return Permission::create($request->only('name','slug'));
        });

        return $this->success($permission, "Permission created successfully");
    }

    public function show(Permission $permission)
    {
        return $this->success($permission);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['sometimes','string', Rule::unique('permissions')->ignore($permission->permission_id,'permission_id')],
            'slug' => ['sometimes','string', Rule::unique('permissions')->ignore($permission->permission_id,'permission_id')],
        ]);

        DB::transaction(function() use ($request, $permission) {
            $permission->update($request->only('name','slug'));
        });

        return $this->success($permission, "Permission updated successfully");
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->count() > 0) {
            return $this->error("Cannot delete permission assigned to roles", 403);
        }

        DB::transaction(function() use ($permission) {
            $permission->delete();
        });

        return $this->success([], "Permission deleted successfully");
    }
}
