<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Landmark extends Model
{
    protected $fillable = ['name', 'description', 'lattitude', 'longitude', 'picture'];
}
