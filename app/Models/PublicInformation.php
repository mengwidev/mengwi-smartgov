<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicInformation extends Model
{
    protected $fillable = [
        'information_classification_id',
        'document_category_id',
        'summary',
        'slug',
        'year',
        'filepath'
    ];

    protected static function booted(): void
    {
        static::creating(function ($document) {
            $document->slug = self::generateSlug($document->summary);
        });

        static::updating(function ($document) {
            if ($document->isDirty('summary')) {
                $document->slug = self::generateSlug($document->summary);
            }

            if ($document->isDirty('filepath')) {
                self::deleteFile($document->getOriginal('filepath'));
            }
        });

        static::deleting(function ($document) {
            self::deleteFile($document->filepath);
        });
    }

    protected static function generateSlug(string $summary): string
    {
        return Str::slug($summary);
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
