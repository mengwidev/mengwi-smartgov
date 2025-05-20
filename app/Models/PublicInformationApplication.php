<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicInformationApplication extends Model
{
    protected $fillable = [
        'uuid',
        'reg_num',
        'application_status_id',
        'applicant_id',
        'application_method_id',
        'information_requested',
        'information_purposes',
        'information_receival_id',
        'is_get_copy',
        'get_copy_method',
        'note',
        'status_updated_at'
    ];

    public function applicationStatus()
    {
        return $this->belongsTo(ApplicationStatus::class,);
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function applicationMethod()
    {
        return $this->belongsTo(ApplicationMethod::class);
    }

    public function informationReceival()
    {
        return $this->belongsTo(InformationReceival::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
