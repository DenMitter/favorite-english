<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'nickname' => auth()->user()->name,
                'avatar' => auth()->user()->avatar,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
