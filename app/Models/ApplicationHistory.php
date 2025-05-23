<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class ApplicationHistory extends Model
{
    protected $fillable = [
        'public_information_application_id',
        'application_status_id',
        'note'
    ];

    public function getStatusBadgeColorAttribute()
    {
        return match ($this->applicationStatus?->name) {
            // ⚠️ Warning statuses
            'Permohonan Diajukan',
            'Pemohon Keberatan' => 'warning',

            // 🔄 Info statuses
            'Sedang Diproses',
            'Proses Verifikasi Pemohon',
            'Informasi Terkirim' => 'info',

            // ❌ Danger statuses
            'Permohonan Ditolak',
            'Pemohon Mengajukan Sengketa' => 'danger',

            // ✅ Success statuses
            'Permohonan Selesai' => 'success',

            // 🔳 Default fallback
            default => 'gray',
        };
    }

    public function getStatusBadgeHtmlAttribute(): HtmlString
    {
        $status = $this->applicationStatus?->name;

        $colorMap = [
            'Permohonan Diajukan' => ['bg-yellow-100', 'text-yellow-800'],
            'Sedang Diproses' => ['bg-blue-100', 'text-blue-800'],
            'Pemohon Keberatan' => ['bg-yellow-100', 'text-yellow-800'],
            'Permohonan Ditolak' => ['bg-red-100', 'text-red-800'],
            'Pemohon Mengajukan Sengketa' => ['bg-red-100', 'text-red-800'],
            'Permohonan Selesai' => ['bg-green-100', 'text-green-800'],
            'Proses Verifikasi Pemohon' => ['bg-blue-100', 'text-blue-800'],
            'Informasi Terkirim' => ['bg-blue-100', 'text-blue-800'],
        ];

        [$bg, $text] = $colorMap[$status] ?? ['bg-gray-100', 'text-gray-800'];

        return new HtmlString("
        <span class='inline-flex items-center px-3 py-1 rounded text-sm font-medium {$bg} {$text}'>
            {$status}
        </span>
    ");
    }

    public function getStatusColorAttribute()
    {
        $map = [
            'Permohonan Diajukan' => 'bg-indigo-500',
            'Sedang Diproses' => 'bg-blue-500',
            'Pemohon Keberatan' => 'bg-yellow-600',
            'Permohonan Ditolak' => 'bg-red-600',
            'Pemohon Mengajukan Sengketa' => 'bg-red-600',
            'Permohonan Selesai' => 'bg-green-600',
            'Proses Verifikasi Pemohon' => 'bg-blue-500',
            'Informasi Terkirim' => 'bg-blue-400',
        ];

        $status = trim($this->applicationStatus->name ?? '');
        return $map[$status] ?? 'bg-gray-400';
    }

    public function application()
    {
        return $this->belongsTo(PublicInformationApplication::class, 'public_information_application_id');
    }

    public function applicationStatus()
    {
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id');
    }
}
