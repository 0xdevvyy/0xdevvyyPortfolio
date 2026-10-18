<?php

use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScreenshotController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [SessionsController::class, 'index'])->name('login.index');
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

Route::prefix('auth')->middleware(['auth', 'throttle:30,1'])->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('project')->group(function (): void {
        Route::get('/', [ProjectController::class, 'indexAuth'])->name('auth.project.index');

        Route::get('/create', [ProjectController::class, 'create'])->name('auth.project.create');
        Route::post('/store', [ProjectController::class, 'store'])->name('auth.project.store');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('auth.project.edit');
        Route::put('/{project}/update', [ProjectController::class, 'update'])->name('auth.project.update');

        Route::delete('/{project}/delete', [ProjectController::class, 'delete'])->name('auth.project.delete');

        Route::delete('/{screenshot}/delete', [ScreenshotController::class, 'destroy'])->name('auth.screenshot.delete');
    });

    Route::prefix('tag')->group(function (): void {
        Route::get('/', [TagController::class, 'index'])->name('auth.tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('auth.tag.create');
        Route::post('/store', [TagController::class, 'store'])->name('auth.tag.store');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('auth.tag.edit');
        Route::put('/{tag}/update', [TagController::class, 'update'])->name('auth.tag.update');
        Route::delete('/{tag}/delete', [TagController::class, 'destroy'])->name('auth.tag.delete');
    });

    Route::prefix('blogs')->group(function (): void {
        // Route::get('/', [BlogController::class, 'index'])->name('auth.blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('auth.blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('auth.blog.store');
        Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('auth.blog.edit');
        Route::put('/{blog}/update', [BlogController::class, 'update'])->name('auth.blog.update');
        Route::delete('/{blog}/delete', [BlogController::class, 'destroy'])->name('auth.blog.delete');
    });
});

// settings or changing passsword
