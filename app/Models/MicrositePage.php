<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MicrositePage extends Model
{
    protected $fillable = [
        'logo',
        'title',
        'slug',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    // relation to microsite_links
    public function link()
    {
        return $this->hasMany(MicrositeLink::class, 'page_id');
    }
}
