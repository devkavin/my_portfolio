<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class APIHelper
{
    /**
     * Generate a standardized API response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @param bool $success
     * @return \Illuminate\Http\JsonResponse
     */
    public static function makeAPIResponse($data, $message = "", $status = 200, $success = true)
    {

        $response = [
            'success' => $success,
            'message' => $message,
            'data' => $data,

        ];
        if ($data != null || is_array($data)) {
            $response["data"] = $data;
        }
        return response()->json($response, $status);
    }

    /**
     * Get the content of the log file.
     *
     * @return string|false
     */
    public static function getLogContent()
    {
        $logPath = storage_path('logs/laravel.log');
        return file_get_contents($logPath);
    }

    /**
     * Write a custom message to the Laravel log.
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function writeLog($message, $type = 'info')
    {
        Log::{$type}($message);
    }
}
