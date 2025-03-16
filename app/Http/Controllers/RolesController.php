<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {
        // Check if the user has permission to view roles
        if (!auth()->user()->can('view role')) {
            abort(403, 'Unauthorized');
        }
        $permissions = auth()->user()->getAllPermissions()->pluck('name');
        $roles = Role::all();
        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        // Check if the user has permission to create a role
        if (!auth()->user()->can('create role')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index');
    }

    public function update(Request $request, Role $role)
    {
        // Check if the user has permission to update a role
        if (!auth()->user()->can('update role')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);

        $role->update($request->all());
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        // Check if the user has permission to delete a role
        if (!auth()->user()->can('delete role')) {
            abort(403, 'Unauthorized');
        }

        $role->delete();
        return redirect()->route('roles.index');
    }

    public function addPermissionToRole($roleId)
    {
        // Check if the user has permission to assign permissions to roles
        if (!auth()->user()->can('assign permissions to roles')) {
            abort(403, 'Unauthorized');
        }

        $role = Role::findById($roleId);
        $permissions = Permission::all();
        
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        
        return Inertia::render('Roles/AddPermission', [
            'role' => $role,
            'permissions' => $permissions,
            'assignedPermissions' => $assignedPermissions,
        ]);
    }

    public function storePermissionToRole(Request $request, $roleId)
    {
        // Check if the user has permission to assign permissions to roles
        if (!auth()->user()->can('assign permissions to roles')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'permissions' => 'required'
        ]);

        $role = Role::findById($roleId);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }
}
