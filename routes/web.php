<?php

use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');

Route::inertia('/test', 'Testing')->name('test');

Route::middleware(['guest', 'throttle:6,1'])->group(function (): void {
    Route::inertia('/', 'landing/Home')->name('home');
    Route::inertia('/about-me', 'landing/About')->name('about-me');
    Route::inertia('/projects', 'landing/Projects')->name('project');
});
