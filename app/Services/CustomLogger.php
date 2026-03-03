<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CustomLogger
{
    /**
     * Log an error to a custom file.
     *
     * @param string $title
     * @param string $code
     * @param string $description
     * @return void
     */
    public static function logError($title, $code, $description)
    {
        // Define the directory path
        $directory = storage_path('logs/custom_errors');

        // Ensure the directory exists
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Generate the filename with the current date
        $filename = 'error-' . Carbon::now()->format('Y-m-d') . '.log';
        $filePath = $directory . '/' . $filename;

        // Format the log entry
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] | Code: {$code} | Title: {$title} | Description: {$description}" . PHP_EOL;

        // Append the log entry to the file
        File::append($filePath, $logEntry);
    }
}
