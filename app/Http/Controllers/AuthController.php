<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout', 'resetPassword', 'sendResetLinkEmail', 'updatePassword']]);
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $data['ip'] = $request->ip();

            $token = $this->authService->register($data);

            return response()->json([
                'success' => true,
                'token' => $token,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $token = $this->authService->login($request->validated());

            return response()->json([
                'success' => true,
                'token' => $token
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            $this->authService->logout();

            return response()->json([
                'success' => true,
                'message' => 'Logged out'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function resetPassword($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true, 'token' => $token
        ]);
    }

    public function sendResetLinkEmail(ResetPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->authService->sendResetLinkEmail($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Reset password link has been sent to your email'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->authService->updatePassword($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    // Додаємо метод для верифікації пошти
    public function verifyEmail(EmailVerificationRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->fulfill();

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    // Метод для повторного надсилання верифікаційного листа
    public function resendVerificationEmail(): \Illuminate\Http\JsonResponse
    {
        try {
            $this->authService->resendVerificationEmail(auth()->user());

            return response()->json([
                'success' => true,
                'message' => 'Verification email sent'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function showVerificationNotice(): \Illuminate\Http\JsonResponse
    {
        try {
            // Якщо користувач ще не підтвердив email, відправляємо повторне повідомлення
            if (auth()->user() && !auth()->user()->hasVerifiedEmail()) {
                auth()->user()->sendEmailVerificationNotification();
            }

            return response()->json([
                'success' => true,
                'message' => 'Please verify your email address by following the link sent to your email.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
