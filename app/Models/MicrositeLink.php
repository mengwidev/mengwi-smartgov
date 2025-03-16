<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MicrositeLink extends Model
{
    protected $fillable = [
        'page_id',
        'logo',
        'title',
        'destination_link',
    ];

    public function page()
    {
        return $this->belongsTo(MicrositePage::class, 'page_id');
    }
}
