<?php

namespace App\Http\Controllers;

use App\Http\Requests\Applications\StoreRequest;
use App\Models\Applications;
use App\Services\GoogleSheetsService;
use Exception;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    protected GoogleSheetsService $googleSheetsService;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

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
            $data = $request->validated();
            $application = Applications::query()->create($data);

            $this->googleSheetsService->addDataToSheet(
                [
                    $application->id,
                    $application->name,
                    $application->email,
                    'Новий учень',
                    'Лендінг',
                    now()->toDateTimeString(),
                    strtoupper($application->level),
                ],
                '1QBQO3a3AvZAJxMJVviZGoqVmChL-G9eQDr9nRiwKT9M',
                'Заявки'
            );

            return response()->json([
                'success' => true,
                'data' => $application->makeHidden(['updated_at']),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
