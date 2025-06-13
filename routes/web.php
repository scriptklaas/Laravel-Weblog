<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', [PostController::class, 'welcome'])->name('welcome');

Route::post('/', [PostController::class, 'index'])->name('welcome');

Route::get('/login', function () {
    return view('posts.login');
})->name('posts.login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('posts.authenticate');

Route::get('/logout', [LoginController::class, 'logout'])->name('posts.logout');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::get('/posts/{post}/show', [PostController::class, 'show'])->name('posts.show');

Route::get('/premium', [PostController::class, 'premium'])->name('premium.index');

Route::get('/premium/purchase', [UserController::class, 'purchase'])->name('users.purchase');

Route::post('/premium/purchase', [UserController::class, 'membership'])->name('users.membership');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');

Route::post('/posts/{post}/show', [CommentController::class, 'store'])->name('comments.store');

Route::patch('/posts/{post}/edit', [PostController::class, 'update'])->name('posts.update');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/show', [CategoryController::class, 'show'])->name('categories.show');