<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');

Route::inertia('/test', 'Testing')->name('test');

Route::middleware(['guest', 'throttle:30,1'])->group(function (): void {
    Route::inertia('/', 'landing/Home')->name('home');
    Route::inertia('/about-me', 'landing/About')->name('about-me');
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/{slug}', [ProjectController::class, 'show'])->name('project.show');
    Route::inertia('/contact', 'landing/Contact')->name('contact');
});

// Route::middleware(['auth'])

Route::prefix('auth')->middleware(['auth', 'throttle:30,1'])->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
