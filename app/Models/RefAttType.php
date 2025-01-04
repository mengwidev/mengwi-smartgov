<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefAttType extends Model
{
    protected $table = 'ref_att_type';

    //fillable
    //...

    //relationship
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
