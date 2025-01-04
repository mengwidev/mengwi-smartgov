<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefLastEducation extends Model
{
    protected $table = 'ref_last_education';

    //fillable
    //...

    //relationship
    public function govEmployee(): HasMany
    {
        return $this->hasMany(GovEmployee::class);
    }
}
