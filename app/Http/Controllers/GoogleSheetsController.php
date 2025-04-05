<?php

namespace App\Http\Controllers;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function addToSheet(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'spreadsheet_id' => 'required|string',
                'sheet_name' => 'required|string',
                'data' => 'required|array',
            ]);

            $spreadsheetId = $validated['spreadsheet_id'];
            $sheetName = $validated['sheet_name'];
            $data = $validated['data'];

            $success = $this->googleSheetsService->addDataToSheet($data, $spreadsheetId, $sheetName);

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
