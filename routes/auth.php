<?php

use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [SessionsController::class, 'index'])->name('login.index');
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

Route::prefix('auth')->middleware(['auth', 'throttle:30,1'])->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('project')->group(function (): void {
        Route::get('/', [ProjectController::class, 'indexAuth'])->name('auth.project.index');
    });
});

// settings or changing passsword
