<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthController; 

// Registration Routes
Route::get('register', [CustomAuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [CustomAuthController::class, 'register']);

// Login Routes
Route::get('login', [CustomAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [CustomAuthController::class, 'login'])->name('login.submit');

// Logout Route
Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');


// Home Route (Protected)
Route::get('/', function () {
    return view('home'); // Ensure you have a home.blade.php file in resources/views
})->name('home')->middleware('auth');




Route::prefix('admin')->group(function () {
    // Show the login form
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');

    // Handle login
    Route::post('login', [AuthController::class, 'login']);

    // Show the dashboard (protected route)
    Route::get('dashboard', [AuthController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Handle logout
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

