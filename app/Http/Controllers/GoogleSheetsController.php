<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoogleSheets\StoreRequest;
use App\Services\GoogleSheetsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoogleSheetsController extends Controller
{
    protected GoogleSheetsService $googleSheetsService;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    /**
     * Додаємо дані у таблицю Google Sheets.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function addToSheet(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $success = $this->googleSheetsService->addDataToSheet($data['data'], $data['spreadsheet_id'], $data['sheet_name']);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Дані успішно додано в таблицю.',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Не вдалося додати дані в таблицю.',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
