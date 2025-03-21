<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefBanjar extends Model
{
    protected $table = 'ref_banjar';

    // fillable
    // ...

    // relationship
    public function govEmployee(): HasMany
    {
        return $this->hasMany(GovEmployee::class);
    }
}
