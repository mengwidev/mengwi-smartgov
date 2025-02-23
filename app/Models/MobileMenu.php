<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileMenu extends Model
{
    protected $rules = [
        'description' => 'max:110',
    ];

    protected $fillable = [
        'title',
        'url',
        'description',
        'icon',
        'bgColor'
    ];
}
