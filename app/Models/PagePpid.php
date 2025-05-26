<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PagePpid extends Model
{
    protected $table = "page_ppid";

    protected $fillable = [
        'title',
        'slug',
        'page_ppid_category_id',
        'content',
        'pdf_path',
        'featured_image',
        'is_published'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            $page->slug = static::generateSlug($page->title);
        });

        static::updating(function ($page) {
            // Optional: Only regenerate if title changed
            if ($page->isDirty('title')) {
                $page->slug = static::generateSlug($page->title, $page->id);
            }
        });
    }

    protected static function generateSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(PagePpidCategory::class, 'page_ppid_category_id');
    }
}
