<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileMenu extends Model
{
    protected $fillable = [
        'title',
        'url',
        'description',
        'icon',
        'bgColor',
        'isActive',
    ];

    protected $rules = [
        'description' => 'max:110',
    ];

    protected $casts = [
        'isActive' => 'boolean',
    ];

    // Mutator to ensure URLs start with "https://"
    public function setUrlAttribute($value)
    {
        if (! str_starts_with($value, 'http://') && ! str_starts_with($value, 'https://')) {
            $this->attributes['url'] = 'https://'.$value;
        } else {
            $this->attributes['url'] = $value;
        }
    }
}
