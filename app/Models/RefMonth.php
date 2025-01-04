<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefMonth extends Model
{
    protected $table = 'ref_month';

    //fillable
    //...

    //relationship
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
