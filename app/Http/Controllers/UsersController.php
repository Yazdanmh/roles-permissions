<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        // Check if the user has permission to view users
        if (!auth()->user()->can('view users')) {
            abort(403, 'Unauthorized');
        }
        $permissions = auth()->user()->getAllPermissions()->pluck('name');
        $users = User::with('roles')->get();
        return Inertia::render('Users/Index', [
            'users' => $users, 
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        if (!auth()->user()->can('create users')) {
            abort(403, 'Unauthorized');
        }

        $roles = Role::all();
        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create users')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id', 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('update users')) {
            abort(403, 'Unauthorized');
        }

        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('update users')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->roles) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete users')) {
            abort(403, 'Unauthorized');
        }

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
