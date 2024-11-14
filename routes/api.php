<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('auth/register', 'register');
    Route::post('auth/login', 'login')->name('login');
    Route::post('auth/logout', 'logout');

    Route::middleware('guest')->group(function () {
        Route::post('auth/forgot-password', 'sendResetLinkEmail')->name('password.email');
        Route::get('auth/reset-password/{token}', 'resetPassword')->name('password.reset');
        Route::post('auth/reset-password', 'updatePassword')->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::get('auth/verify-email', 'showVerificationNotice')->name('verification.notice');

        Route::get('auth/verify-email/{id}/{hash}', 'verifyEmail')
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('auth/verification-notification', 'resendVerificationEmail')
            ->middleware('throttle:6,1')
            ->name('verification.send');
    });
});

// Маршрути для особистого кабінету
Route::prefix('dashboard')->group(function () {
    Route::post('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
});

// Маршрути для адмінки
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Головна сторінка адмінки
    Route::post('/', [AdminController::class, 'index'])->name('admin.index');

    // CRUD для користувачів
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // CRUD для курсів
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('admin.courses.show');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
});
