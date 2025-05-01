<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactType extends Model
{
    protected $fillable = ['name'];

    public function employeeContacts(): HasMany
    {
        return $this->hasMany(EmployeeContact::class, 'contact_type_id');
    }
}
