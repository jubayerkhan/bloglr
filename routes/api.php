<?php

use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\LikeController;

// Public Routes
Route::get('/blogs', [BlogApiController::class, 'index']);
Route::get('/blogs/{blog}', [BlogApiController::class, 'show']);

// Auth Routes
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/blogs', [BlogApiController::class, 'index']);
    Route::get('/blogs/{blog}', [BlogApiController::class, 'show']);
    Route::post('/blogs', [BlogApiController::class, 'store']);
    Route::put('/blogs/{blog}', [BlogApiController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogApiController::class, 'destroy']);
    // Route::post('/blogs/{blog}/like', [LikeController::class, 'toggleLike']);
    // Route::get('/blogs/{blog}/likes', [LikeController::class, 'likesCount']);
    // Route::get('/my-likes', [LikeController::class, 'myLikes']);
});
