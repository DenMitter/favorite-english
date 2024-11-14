<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

class AdminController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'users' => User::query()->count(),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
