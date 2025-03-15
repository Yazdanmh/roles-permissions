<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Permissions/Index', [
            'permissions' => Permission::all(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        Permission::create($request->all());
        return redirect()->route('permissions.index');
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        $permission->update($request->all());
        return redirect()->route('permissions.index');
    }
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
