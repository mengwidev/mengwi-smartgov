<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SocialAssistance extends Model
{
    protected $guarded = [];

    public function beneficiaries(): BelongsToMany
    {
        return $this->belongsToMany(
            Beneficiary::class,
            'beneficiary_assistance', // Pivot table name
            'social_assistance_id',   // Foreign key on pivot table
            'beneficiary_id'          // Related key on pivot table
        )->withTimestamps();
    }
}
