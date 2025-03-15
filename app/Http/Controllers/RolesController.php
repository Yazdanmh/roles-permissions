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
        $roles = Role::all();
        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);

        $role->update($request->all());
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }

    public function addPermissionToRole($roleId)
    {
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
        $request->validate([
            'permissions' => 'required'
        ]);
        $role = Role::findById($roleId);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }
}
