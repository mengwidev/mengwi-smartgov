<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagePpidCategory extends Model
{
    protected $fillable = ['name'];

    public function pagePpid()
    {
        return $this->hasMany(PagePpid::class);
    }
}
