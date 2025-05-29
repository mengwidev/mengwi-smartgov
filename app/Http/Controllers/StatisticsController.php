<?php

namespace App\Http\Controllers;

use App\Models\ApplicationHistory;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function applicationStatusSummary(): JsonResponse
    {
        $query = ApplicationHistory::query();

        $masuk = (clone $query)
            ->whereHas(
                'applicationStatus',
                fn($q) =>
                $q->where('name', 'Permohonan Diajukan')
            )
            ->distinct()
            ->count('public_information_application_id');

        $ditindaklanjuti = (clone $query)
            ->whereHas(
                'applicationStatus',
                fn($q) =>
                $q->where('name', 'Sedang Diproses')
            )
            ->distinct()
            ->count('public_information_application_id');

        $selesai = (clone $query)
            ->whereHas(
                'applicationStatus',
                fn($q) =>
                $q->where('name', 'Permohonan Selesai')
            )
            ->distinct()
            ->count('public_information_application_id');

        $keberatan = (clone $query)
            ->whereHas(
                'applicationStatus',
                fn($q) =>
                $q->where('name', 'Pemohon Keberatan')
            )
            ->distinct()
            ->count('public_information_application_id');

        return response()->json([
            'data' => [
                [
                    'name' => 'Permintaan Masuk',
                    'count' => $masuk,
                ],
                [
                    'name' => 'Permintaan Ditindaklanjuti',
                    'count' => $ditindaklanjuti,
                ],
                [
                    'name' => 'Permintaan Selesai',
                    'count' => $selesai,
                ],
                [
                    'name' => 'Mengajukan Keberatan',
                    'count' => $keberatan,
                ],
            ]
        ]);
    }
}
