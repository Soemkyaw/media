<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\LikeController;
use App\Http\Controllers\api\PostController;
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
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/categories/{category}/posts', [CategoryController::class, 'posts']);


// post api
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/random', [PostController::class, 'randomPosts']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::post('/posts/{post}/update', [PostController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->middleware('auth:sanctum');
// like
// Route::post('/posts/{post}/like/toggle', [PostController::class, 'toggleLike']);
Route::get('/posts/{post}/liked', [PostController::class, 'checkLikeStatus']);


// comment api
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments/store',[CommentController::class,'store'])->middleware('auth:sanctum');
Route::delete('/comments/{comment}/destroy', [CommentController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/likes/toggle', [LikeController::class,'toggleLike']);
