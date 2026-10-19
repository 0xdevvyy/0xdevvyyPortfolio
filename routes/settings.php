<?php

use App\Http\Controllers\Auth\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->middleware(['auth', 'throttle:30,1'])->group(function (): void {
    Route::get('/profile', [SettingsController::class, 'index'])->name('auth.settings.index');
    Route::put('/profile', [SettingsController::class, 'update'])->name('auth.settings.update');
});
