<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PageController::class, 'about']);
// Route::view('/about', [PageController::class, 'about'])->name('about');
Route::get('/dashboard', [UserController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('admin/dashboard', [UserController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');
Route::get('admin/dashboard/post', [UserController::class, 'post'])->middleware(['auth', 'admin']);
// post controller routes
Route::resource('posts', PostController::class);
// blog controller routes
Route::resource('blogs', BlogController::class)->except(['show', 'index'])->middleware('auth');
Route::resource('blogs', BlogController::class)->only(['show', 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
