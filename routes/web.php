<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');

Route::inertia('/test', 'Testing')->name('test');

Route::middleware(['guest', 'throttle:30,1'])->group(function (): void {
    Route::inertia('/', 'landing/Home')->name('home');
    Route::inertia('/about-me', 'landing/About')->name('about-me');
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/{slug}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::inertia('/contact', 'landing/Contact')->name('contact');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
});

// Route::middleware(['auth'])

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';
