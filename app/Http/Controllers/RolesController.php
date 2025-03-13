<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class RolesController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/Index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $role = Role::create($request->all());
        return redirect()->route('roles.index');

    }
}
