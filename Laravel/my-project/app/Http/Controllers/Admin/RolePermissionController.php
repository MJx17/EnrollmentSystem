<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    // Show all roles and permissions
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.role_permission.index', compact('roles', 'permissions'));
    }

    // Store new role
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('admin.roles_permissions.index')->with('success', 'Role created successfully!');
    }

    // Store new permission
    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.roles_permissions.index')->with('success', 'Permission created successfully!');
    }

    // Assign permission to role
    public function assignPermissionToRole(Request $request)
    {
        $role = Role::findById($request->role_id);
        $role->givePermissionTo($request->permission_id);

        return redirect()->route('admin.roles_permissions.index')->with('success', 'Permission assigned to role successfully!');
    }

    // Revoke permission from role
    public function revokePermissionFromRole(Request $request)
    {
        $role = Role::findById($request->role_id);
        $role->revokePermissionTo($request->permission_id);

        return redirect()->route('admin.roles_permissions.index')->with('success', 'Permission revoked from role successfully!');
    }
}
