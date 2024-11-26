<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DynamicLinkCategory extends Model
{
    protected $fillable = [
        'category_name',
        'description'
    ];

    public function dynamic_link(): HasMany
    {
        return $this->hasMany(DynamicLink::class);
    }
}
