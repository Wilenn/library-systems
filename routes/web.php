<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowingController;

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');
    // Dibatasi 5 percobaan per menit untuk mencegah tebak password.
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');
});

// Semua halaman aplikasi hanya boleh diakses setelah login.
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('books', BookController::class);
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');
    Route::get('/members', [MemberController::class, 'index'])
        ->name('members.index');
    Route::resource('borrowings', BorrowingController::class)
        ->only(['index', 'create', 'store']);
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');
});


// Hanya admin (Gate manage-users) yang boleh mengelola pengguna.
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('users', UserController::class)->only(['index']);
});
