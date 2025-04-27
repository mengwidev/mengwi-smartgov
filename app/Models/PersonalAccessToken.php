<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumToken;

class PersonalAccessToken extends SanctumToken
{
    protected $table = 'personal_access_tokens';
    protected $fillable = [
        'name',
        'token',
        'tokenable_type',
        'tokenable_id',
        'abilities',
        'last_used_at',
        'expires_at',
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }
}
