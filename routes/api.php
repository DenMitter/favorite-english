<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GoogleSheetsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApplicationController::class)->group(function () {
    Route::get('applications', 'index');
    Route::post('applications', 'store');
});

Route::post('/google-sheets/add-to-sheet', [GoogleSheetsController::class, 'addToSheet']);

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
    Route::post('/', [DashboardController::class, 'router'])->name('dashboard.router')->middleware('auth');
});

// Маршрути для адмінки
Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/', [AdminController::class, 'index'])->name('admin.router');

    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
});
