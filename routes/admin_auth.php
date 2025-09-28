<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\AdminRegisteredUserController;
use App\Http\Controllers\Auth\AdminEmailVerificationPromptController;
use App\Http\Controllers\Auth\AdminVerifyEmailController;
use App\Http\Controllers\Auth\AdminEmailVerificationNotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AdminRegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [AdminRegisteredUserController::class, 'store'])->name('register.store');

    Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:organizers','verified'])->name('dashboard');

    Route::middleware('auth:organizers')->group(function () {
        Route::get('verify-email', AdminEmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', AdminVerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [AdminEmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');
    });
});
