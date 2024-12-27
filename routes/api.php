<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// user api
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/users/{user}/update', [UserController::class, 'update'])->middleware('auth:sanctum');

// category api
Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('/categories/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');
