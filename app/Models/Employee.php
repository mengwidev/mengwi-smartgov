<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'banjar_id',
        'employment_unit_id',
        'employee_level_id',
        'photo'
    ];

    // handle file orphan
    protected static function booted(): void
    {
        // delete old photo if updated
        static::updating(function ($employee) {
            if ($employee->isDirty('photo')) {
                $oldPhoto = $employee->getOriginal('photo');

                if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }
        });

        // delete photo if record deleted
        static::deleting(function ($employee) {
            if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
                Storage::disk('public')->delete($employee->photo);
            }
        });
    }

    public function banjar(): BelongsTo
    {
        return $this->belongsTo(Banjar::class);
    }

    public function employmentUnit(): BelongsTo
    {
        return $this->belongsTo(EmploymentUnit::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(EmployeeLevel::class, 'employee_level_id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(EmployeeContact::class);
    }
}
