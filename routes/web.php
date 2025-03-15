<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RolesController; 

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;

Route::group(['middleware' => ['auth', 'role:Super-Admin|Admin|Staff']], function() {
    
    // Roles Management (Super-Admin and Admin have these permissions)
    Route::resource('roles', RolesController::class);


    // Permission Assignment to Roles (Only for users with 'assign permissions to roles' permission)
    Route::get('give-permission/{id}', [RolesController::class, 'addPermissionToRole'])->name('roles.addPermission');
    Route::put('give-permission/{id}', [RolesController::class, 'storePermissionToRole'])->name('roles.storePermission');
    
    // Permissions Management (Super-Admin and Admin have these permissions)
    Route::resource('permissions', PermissionsController::class); // CRUD for permissions

    // Users Management (Super-Admin and Admin have these permissions)
    Route::resource('users', UsersController::class); // CRUD for users
});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
