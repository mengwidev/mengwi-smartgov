<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationClassification extends Model
{
    protected $fillable = ['name', 'description'];

    public function publicInformations()
    {
        return $this->hasMany(\App\Models\PublicInformation::class);
    }
}
