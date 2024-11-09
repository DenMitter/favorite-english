<?php

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

        // Маршрути для особистого кабінету
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        });
    });
});
