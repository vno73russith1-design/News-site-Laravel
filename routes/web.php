<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/category/{id}', [NewsController::class, 'category'])->name('category');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:journalist,admin'])->group(function () {
    Route::get('/journalist', [ArticleController::class, 'create'])->name('journalist');
    Route::post('/journalist', [ArticleController::class, 'store']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::patch('/admin/texts/{text}/block', [AdminController::class, 'block'])->name('admin.block');
    Route::delete('/admin/texts/{text}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::patch('/admin/users/{user}/role', [AdminController::class, 'changeRole'])->name('admin.role');
});