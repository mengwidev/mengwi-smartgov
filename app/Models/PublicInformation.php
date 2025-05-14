<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PublicInformation extends Model
{
    protected $fillable = [
        'information_classification_id',
        'document_category_id',
        'summary',
        'year',
        'filepath'
    ];

    protected static function booted(): void
    {
        static::updating(function ($document) {
            if ($document->isDirty('filepath')) {
                self::deleteFile($document->getOriginal('filepath'));
            }
        });

        static::deleting(function ($document) {
            self::deleteFile($document->filepath);
        });
    }

    protected static function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function informationClassification()
    {
        return $this->belongsTo(InformationClassification::class);
    }

    public function documentCategory()
    {
        return $this->belongsTo(DocumentCategory::class);
    }
}
