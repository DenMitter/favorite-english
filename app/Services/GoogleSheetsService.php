<?php

namespace App\Services;

use Exception;
use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

class GoogleSheetsService
{
    /**
     * Отримуємо налаштованого Google клієнта.
     *
     * @return Google_Client
     * @throws \Google\Exception
     */
    private function getGoogleClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path(env('GOOGLE_CREDENTIALS_PATH')));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);

        return $client;
    }

    /**
     * Отримуємо останній заповнений рядок на листі.
     *
     * @param Google_Service_Sheets $service
     * @param string $spreadsheetId
     * @param string $sheetName
     * @return int
     * @throws \Google\Service\Exception
     */
    private function getLastRow(Google_Service_Sheets $service, string $spreadsheetId, string $sheetName): int
    {
        $response = $service->spreadsheets_values->get($spreadsheetId, "{$sheetName}!A:A");
        return count($response->getValues());
    }

    /**
     * Додаємо дані у таблицю Google Sheets.
     *
     * @param array $data
     * @param string $spreadsheetId
     * @param string $sheetName
     * @return bool
     */
    public function addDataToSheet(array $data, string $spreadsheetId, string $sheetName): bool
    {
        try {
            $client = $this->getGoogleClient();
            $service = new Google_Service_Sheets($client);

            $lastRow = $this->getLastRow($service, $spreadsheetId, $sheetName);
            $range = "{$sheetName}!A" . ($lastRow + 1);

            $values = [$data];
            $body = new Google_Service_Sheets_ValueRange(['values' => $values]);

            $service->spreadsheets_values->append($spreadsheetId, $range, $body, ['valueInputOption' => 'RAW']);
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
