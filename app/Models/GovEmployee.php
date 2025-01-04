<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GovEmployee extends Model
{
    protected $table = 'gov_employee';

    protected $fillable = [
        'att_pin',
        'name',
        'date_of_birth',
        'prefix_title',
        'suffix_title',
        'last_education_id',
        'banjar_id',
        'employment_position_id'
    ];

    //relationship
    public function lastEducation(): BelongsTo
    {
        return $this->belongsTo(RefLastEducation::class);
    }

    public function banjar(): BelongsTo
    {
        return $this->belongsTo(RefBanjar::class);
    }

    public function employmentPosition(): BelongsTo
    {
        return $this->belongsTo(RefEmploymentPosition::class);
    }

    public function attendance(): HasMany
    {
        return $this->HasMany(Attendance::class);
    }
}
