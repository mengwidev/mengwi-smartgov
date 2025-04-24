<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumToken;

class PersonalAccessToken extends SanctumToken
{
    protected $table = 'personal_access_tokens';
    protected $fillable = ['name', 'tokenable_type', 'tokenable_id', 'service', 'used_at', 'last_handshake'];
    protected $casts = [
        'used_at' => 'datetime',
        'last_handshake' => 'datetime',
    ];
}
