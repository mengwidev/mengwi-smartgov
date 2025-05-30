<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'applicant_identifier_method_id',
        'applicant_identifier_value',
        'applicant_identifier_attachment'
    ];

    public function identifierMethod()
    {
        return $this->belongsTo(ApplicantIdentifierMethod::class, 'applicant_identifier_method_id');
    }

    public function publicInformationApplications()
    {
        return $this->hasMany(PublicInformationApplication::class);
    }
}
