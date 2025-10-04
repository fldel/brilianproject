<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipController;

Route::get('/', function () {
    return view('welcome');
});

// ---------------- Role chooser ---------------- //
Route::get('/choose-role', function () {
    return view('auth.choose-role');
})->middleware('guest')->name('choose-role');

// ---------------- USER ---------------- //
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role.user'])
    ->name('dashboard');

// ---------------- ADMIN ---------------- //
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth','verified','admin'])->name('admin.dashboard');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/bookmark', function() {
    return view('bookmark');
})->name('bookmark');

Route::get('/tips', function() {
    return view('tips');
})->name('tips');

Route::get('/test', [ScholarshipController::class, 'create']);
Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
