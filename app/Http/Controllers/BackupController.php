<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index'); // Create a corresponding view
    }

    public function downloadDatabase()
    {
        // Export the database to an SQL file
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $filePath = storage_path('app/backup.sql');

        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s %s > %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName),
            escapeshellarg($filePath)
        );

        exec($command);

        if (file_exists($filePath)) {
            return response()->download($filePath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Failed to create database backup.');
    }

    public function downloadQrCodes()
    {
        $folderPath = Storage::disk('public')->path('qr-codes');
        $zipPath = storage_path('app/qr-codes.zip');

        // Check if folder exists
        if (!is_dir($folderPath)) {
            return back()->with('error', 'The QR Codes folder does not exist.');
        }

        // Create the ZIP file
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($folderPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }

            $zip->close();

            // Send the ZIP file for download
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Failed to create QR Codes zip file.');
    }
}
