<?php

use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');

Route::inertia('/test', 'Testing')->name('test');


Route::middleware('guest')->group(function (): void {
    Route::inertia('/', 'landing/Home')->name('home');
});
