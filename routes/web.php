<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\AuditLog;

// --- Public Access ---
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');

// --- OTP Verification (Guest/Authenticated) ---
Route::get('/verify-otp', function () { return view('auth.verify-otp'); })->name('otp.view');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify')->middleware('throttle:3,1');
Route::post('/resend-otp', [LoginController::class, 'resendOtp'])->name('otp.resend')->middleware('throttle:2,1');

// --- Protected Routes (Requires Login) ---
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- ADMIN ONLY ROUTES ---
    // Uses the 'admin' alias you created in app.php
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        
        // Dashboard
        Route::get('/dashboard', function () {
            $accounts = User::all();
            $logs = AuditLog::with('user')->latest()->take(5)->get();
            return view('admin.manage_accounts', compact('accounts', 'logs'));
        })->name('admin.dashboard');

        // Account Management
        Route::post('/store', [LoginController::class, 'store'])->name('admin.store');
        Route::get('/edit/{id}', [LoginController::class, 'edit'])->name('admin.edit');
        Route::put('/update/{id}', [LoginController::class, 'update'])->name('admin.update');
        Route::delete('/delete/{id}', [LoginController::class, 'destroy'])->name('admin.delete');
        Route::post('/accounts/{id}/toggle-lock', [LoginController::class, 'toggleLock'])->name('accounts.toggleLock');

        // Admin Content
        Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
        Route::get('/events/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
        Route::post('/events/store', [AdminController::class, 'storeEvent'])->name('admin.events.store');
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings/update', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    });

    // --- REGISTRAR ONLY ROUTES ---
    Route::prefix('registrar')->group(function () {
        Route::get('/dashboard', function () {
            return view('registrar.registrar_dashboard');
        })->name('registrar_dashboard');
    });

});