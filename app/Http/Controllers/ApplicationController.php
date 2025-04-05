<?php

namespace App\Http\Controllers;

use App\Http\Requests\Applications\StoreRequest;
use App\Models\Applications;
use Exception;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    /**
     * Отримуємо список заявок.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => Applications::query()->get()->makeHidden(['updated_at']),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Додаємо заявку в базу даних.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => Applications::query()->create($request->validated()),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
