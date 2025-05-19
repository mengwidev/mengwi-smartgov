<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $fillable = ['name'];

    public function publicInformationApplication()
    {
        return $this->hasMany(PublicInformationApplications::class);
    }
}
