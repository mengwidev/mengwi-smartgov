<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    protected $fillable = ['name'];

    public function publicInformations()
    {
        return $this->hasMany(\App\Models\PublicInformation::class);
    }
}
