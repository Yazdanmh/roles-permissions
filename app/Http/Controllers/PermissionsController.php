<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view permission')) {
            abort(403, 'Unauthorized');
        }
        $user_permissions = auth()->user()->getAllPermissions()->pluck('name');
        return Inertia::render('Permissions/Index', [
            'permissions' => Permission::all(),
            'user_permissions' => $user_permissions,
        ]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create permission')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    public function update(Request $request, Permission $permission)
    {
        if (!auth()->user()->can('update permission')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    public function destroy(Permission $permission)
    {
        if (!auth()->user()->can('delete permission')) {
            abort(403, 'Unauthorized');
        }
        $permission->delete();
        
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
