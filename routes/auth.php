<?php

use App\Http\Controllers\Auth\SessionsController;
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
});

// settings or changing passsword
