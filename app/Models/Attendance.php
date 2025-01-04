<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $table = 'attendances';

    //fillable
    protected $fillable = [
        'att_helper_identification',
        'employee_id',
        'scan_date',
        'month_id',
        'att_type_id'
    ];

    //relationship
    public function employee(): BelongsTo
    {
        return $this->belongsTo(GovEmployee::class);
    }

    public function month(): BelongsTo
    {
        return $this->belongsTo(RefMonth::class);
    }

    public function attType(): BelongsTo
    {
        return $this->belongsTo(RefAttType::class);
    }
}
