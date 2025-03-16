<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RolesController; 

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;

Route::group(['middleware' => ['auth', 'isAdmin']], function() {
    
    Route::resource('roles', RolesController::class);

    Route::get('give-permission/{id}', [RolesController::class, 'addPermissionToRole'])->name('roles.addPermission');
    Route::put('give-permission/{id}', [RolesController::class, 'storePermissionToRole'])->name('roles.storePermission');
    
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class); 
});


Route::get('/', function () {
    return redirect()->route('login');
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
