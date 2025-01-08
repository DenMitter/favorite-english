<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingRequest\StoreRequest;
use App\Models\TrainingRequest;
use App\Services\Admin\UserService;
use App\Services\TrainingRequestService;
use Exception;

class TrainingRequestController extends Controller
{
    protected TrainingRequestService $trainingRequestService;

    public function __construct(TrainingRequestService $trainingRequestService)
    {
        $this->trainingRequestService = $trainingRequestService;
    }

    public function getTrainingRequests()
    {
        try {
            return response()->json([
                'success' => true,
                'data' => TrainingRequest::query()->get()
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function store(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => TrainingRequest::query()->create($request->validated())
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
