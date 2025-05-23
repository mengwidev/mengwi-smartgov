<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicInformationApplication extends Model
{
    protected $fillable = [
        'uuid',
        'reg_num',
        'applicant_id',
        'application_method_id',
        'information_requested',
        'information_purposes',
        'information_receival_id',
        'is_get_copy',
        'get_copy_method',
        'note',
    ];

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

    public function applicationHistory()
    {
        return $this->hasMany(ApplicationHistory::class);
    }

    public function latestHistory()
    {
        return $this->hasOne(ApplicationHistory::class)->latestOfMany();
    }

    public function getLatestStatusLabelAttribute()
    {
        return $this->latestHistory?->applicationStatus?->name ?? '-';
    }

    public function getLatestStatusDateFormattedAttribute()
    {
        return $this->latestHistory?->created_at?->format('d M Y H:i') ?? '-';
    }

    public function getLatestStatusColorAttribute()
    {
        $map = [
            'Permohonan Diajukan' => 'bg-indigo-100 text-indigo-800',
            'Sedang Diproses' => 'bg-blue-100 text-blue-800',
            'Pemohon Keberatan' => 'bg-yellow-100 text-yellow-800',
            'Permohonan Ditolak' => 'bg-red-100 text-red-800',
            'Pemohon Mengajukan Sengketa' => 'bg-red-100 text-red-800',
            'Permohonan Selesai' => 'bg-green-100 text-green-800',
            'Proses Verifikasi Pemohon' => 'bg-blue-100 text-blue-800',
            'Informasi Terkirim' => 'bg-blue-100 text-blue-800',
        ];

        $status = trim($this->latest_status_label ?? '');
        return $map[$status] ?? 'bg-gray-100 text-gray-800';
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
