<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::prefix('admin')->middleware(['auth', 'role:Admin,Manager,Staff'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Statistics
    Route::get('/statistics', [AdminDashboardController::class, 'statistics'])
        ->name('admin.statistics');

    // User Management
    Route::get('/users', function() {
        return view('admin.users.index');
    })->name('admin.users');

    // Role Management
    Route::get('/roles', function() {
        return view('admin.roles.index');
    })->name('admin.roles');

    // Settings
    Route::get('/settings', function() {
        return view('admin.settings');
    })->name('admin.settings');
});
