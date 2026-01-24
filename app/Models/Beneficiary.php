<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Beneficiary extends Model
{
    protected $guarded = [];

    // Many-to-many relationship with SocialAssistance
    public function socialAssistances(): BelongsToMany
    {
        return $this->belongsToMany(
            SocialAssistance::class,
            'beneficiary_assistance', // Pivot table name
            'beneficiary_id',         // Foreign key on pivot table
            'social_assistance_id'    // Related key on pivot table
        )->withTimestamps();
    }

    // Add this casting
    protected $casts = [
        'tanggal_lahir' => 'date', // This will auto-convert to Carbon instance
    ];

    // Relationship with Banjar
    public function banjar()
    {
        return $this->belongsTo(Banjar::class);
    }
}
