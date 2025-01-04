<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefEmploymentPosition extends Model
{
    protected $table = 'ref_employment_position';

    public function position_category(): BelongsTo
    {
        return $this->belongsTo(RefEmploymentPositionCategory::class);
    }
}
