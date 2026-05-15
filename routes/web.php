<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes - VOIDX LUXURY PORTAL
|--------------------------------------------------------------------------
*/

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// REDIRECT: Elite Sliding Login/Register
Route::get('/register', function () {
    return redirect('/login?action=register');
});

// 2. Protected Routes (Dapat Naka-Login ang User)
Route::middleware(['auth', 'verified'])->group(function () {

    // --- USER DASHBOARD & ACTIONS ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/process-booking', [DashboardController::class, 'processBooking'])->name('process.booking');
    Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // Standard Profile Routes (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update_patch');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ADMIN ACCESS AREA (Admin, High Admin, Owner) ---
    Route::middleware(['role:admin,high_admin,owner'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');

        // Travel Management (CRUD)
        Route::get('/travel/manage', [TravelController::class, 'manage'])->name('travel.manage');
        Route::post('/travel/store', [TravelController::class, 'store'])->name('travel.store');
        Route::put('/travel/{id}', [TravelController::class, 'update'])->name('travel.update');
        Route::get('/travel/{id}/edit', [TravelController::class, 'edit'])->name('travel.edit');

        // Reports/Messages
        Route::get('/admin/reports', [PostController::class, 'index'])->name('admin.reports');

        // PROMO MANAGEMENT
        Route::post('/admin/promo', [DashboardController::class, 'storePromo'])->name('admin.promo.store');
        Route::put('/admin/promo/{id}', [DashboardController::class, 'updatePromo'])->name('admin.promo.update');
    });

    // --- HIGH ADMIN & OWNER ONLY (Delete Permissions) ---
    Route::middleware(['role:high_admin,owner'])->group(function () {
        Route::delete('/travel/{id}', [TravelController::class, 'destroy'])->name('travel.destroy');
        Route::delete('/admin/promo/{id}', [DashboardController::class, 'destroyPromo'])->name('admin.promo.destroy');
    });

    // --- OWNER ONLY (GOD MODE) ---
    Route::middleware(['role:owner'])->group(function () {
        Route::get('/admin/income', [DashboardController::class, 'income'])->name('admin.income');
        Route::get('/admin/users', [DashboardController::class, 'manageUsers'])->name('admin.users');
        Route::patch('/admin/users/{user}/role', [DashboardController::class, 'updateRole'])->name('admin.updateRole');
    });

    // --- POSTS SYSTEM ---
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

});

// Auth Routes (Login, Logout, etc.)
// FIXED: Changed _DIR_ to __DIR__
require __DIR__.'/auth.php';