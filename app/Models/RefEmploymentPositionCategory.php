<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefEmploymentPositionCategory extends Model
{
    protected $table = 'ref_employment_position_category';

    //fillable
    //...

    //relationship
    public function employment_position(): HasMany
    {
        return $this->hasMany(RefEmploymentPosition::class);
    }
}
