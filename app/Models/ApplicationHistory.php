<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationHistory extends Model
{
    protected $fillable = [
        'application_id',
        'application_status_id',
        'note'
    ];

    public function application()
    {
        return $this->belongsTo(PublicInformationApplication::class, 'application_id');
    }

    public function applicationStatus()
    {
        return $this->belongsTo(ApplicationStatus::class);
    }
}
