<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPpid extends Model
{
    protected $fillable = [
        'role_id',
        'employee_id'
    ];

    public function role()
    {
        return $this->belongsTo(KedudukanPpid::class, 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
