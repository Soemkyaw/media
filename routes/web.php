<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('App.dashboard');
    })->name('dashboard');

    // user
    Route::get('/users',[UserController::class,'index'])->name('users');
    Route::get('/users/{user:id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/users/{user:id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/users/{user:id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{user:id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/users/{user:id}/change/password', [UserController::class, 'changePassword'])->name('user.change.password');
    Route::patch('/users/{user:id}/update/password', [UserController::class, 'passwordHandler'])->name('user.password.update');

    // category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{category:slug}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category:slug}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
