<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ---------------- USER ---------------- //
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------- ADMIN ---------------- //
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])->name('login.store');

    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth:organizers')->name('dashboard');

    // Logout
    Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Kalau perlu register admin
    Route::get('/register', function () {
        return view('admin.register');
    })->name('register');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin_auth.php';
