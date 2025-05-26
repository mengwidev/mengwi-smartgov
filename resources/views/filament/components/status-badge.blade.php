@php
    $latestHistory = $record->applicationHistory()->latest()->first();
    if (!$latestHistory) {
        $status = 'No History';
    } elseif (!$latestHistory->applicationStatus) {
        $status = 'No Status Relation';
    } else {
        $status = $latestHistory->applicationStatus->name;
    }

    $statusColors = [
        'Permohonan Diajukan' => ['bg-yellow-100', 'text-yellow-800'],
        'Sedang Diproses' => ['bg-blue-100', 'text-blue-800'],
        'Pemohon Keberatan' => ['bg-yellow-100', 'text-yellow-800'],
        'Permohonan Ditolak' => ['bg-red-100', 'text-red-800'],
        'Pemohon Mengajukan Sengketa' => ['bg-red-100', 'text-red-800'],
        'Permohonan Selesai' => ['bg-green-100', 'text-green-800'],
        'Proses Verifikasi Pemohon' => ['bg-blue-100', 'text-blue-800'],
        'Informasi Terkirim' => ['bg-blue-100', 'text-blue-800'],
    ];

    [$bgColor, $textColor] = $statusColors[$status] ?? ['bg-gray-100', 'text-gray-800'];
@endphp

<span class="{{ $bgColor }} {{ $textColor }} inline-flex items-center rounded px-3 py-1 text-sm font-medium">
    {{ $status }}
</span>
