<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;

class DynamicLink extends Model
{
    protected $fillable = [
        'original_link',
        'custom_slug',
        'category_id',
        'notes',
        'qr_code_filename',
    ];

    public function category()
    {
        return $this->belongsTo(DynamicLinkCategory::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (DynamicLink $dynamicLink) {
            Log::debug("DynamicLink created. Generating QR Code for slug: " . $dynamicLink->custom_slug);
            $dynamicLink->generateQrCode(); // Generate QR code when the record is created
            $dynamicLink->save(); // Save the updated QR code filename
            Log::debug("QR Code generated: " . $dynamicLink->qr_code_filename);
        });

        // Regenerate the QR code when the custom slug changes
        static::updating(function (DynamicLink $dynamicLink) {
            // Only regenerate the QR code if the slug has changed
            if ($dynamicLink->isDirty('custom_slug')) {
                Log::debug("Custom slug is being updated for DynamicLink ID: " . $dynamicLink->id);
                // Delete the old QR code before updating the slug
                $dynamicLink->deleteOldQrCode();
                // Generate a new QR code with the updated slug
                $dynamicLink->generateQrCode();
                Log::debug("Old QR Code deleted and new QR Code generated: " . $dynamicLink->qr_code_filename);
            }
        });

        // Delete the QR code file when the model is deleted
        static::deleted(function (DynamicLink $dynamicLink) {
            Log::debug("DynamicLink deleted. Deleting QR Code for slug: " . $dynamicLink->custom_slug);
            $dynamicLink->deleteOldQrCode();
        });
    }

    /**
     * Generate a QR code for the dynamic link and save it to a file.
     */
    public function generateQrCode(): void
    {
        $url = url('/link/' . $this->custom_slug); // Generate the URL with the custom slug
        Log::debug("Generating QR Code for URL: " . $url);

        // Generate the QR code
        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $url, // Store the custom URL in the QR code
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );

        $result = $builder->build();

        // Define the path where the QR code will be saved
        $path = storage_path('app/public/qr_codes');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Create a unique filename for the QR code
        $fileName = uniqid('qr_') . '.png';
        $filePath = "$path/$fileName";
        $result->saveToFile($filePath);

        // Update the model's qr_code_filename attribute
        $this->qr_code_filename = "qr_codes/$fileName";
        Log::debug("QR Code saved to: " . $this->qr_code_filename);
    }

    /**
     * Delete the old QR code file from storage.
     */
    public function deleteOldQrCode()
    {
        // Ensure there is a QR code filename before attempting to delete
        if ($this->qr_code_filename) {
            // Correct the file path to match the actual file location in the storage
            $filePath = storage_path("app/public/{$this->qr_code_filename}");

            if (file_exists($filePath)) {
                unlink($filePath);
                Log::debug("Deleted old QR Code: " . $this->qr_code_filename);
            } else {
                Log::debug("QR Code file not found for deletion: " . $filePath);
            }
        }
    }
}
