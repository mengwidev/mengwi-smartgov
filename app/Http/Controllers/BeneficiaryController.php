<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Banjar;
use App\Models\SocialAssistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $totalBeneficiaries = Beneficiary::count();

        // Get gender statistics with proper counts
        $genderStatsRaw = DB::table('beneficiaries')
            ->join('genders', 'beneficiaries.gender_id', '=', 'genders.id')
            ->select(
                'genders.name',
                DB::raw('COUNT(beneficiaries.id) as count')
            )
            ->groupBy('genders.id', 'genders.name')
            ->get();

        // Format for view - ensure we have both genders
        $genderStats = [
            'male' => $genderStatsRaw->firstWhere('name', 'Laki-Laki')->count ?? 0,
            'female' => $genderStatsRaw->firstWhere('name', 'Perempuan')->count ?? 0,
            'total_male' => $genderStatsRaw->firstWhere('name', 'Laki-Laki')->count ?? 0,
            'total_female' => $genderStatsRaw->firstWhere('name', 'Perempuan')->count ?? 0,
            'labels' => ['Laki-Laki', 'Perempuan'],
            'data' => [
                $genderStatsRaw->firstWhere('name', 'Laki-Laki')->count ?? 0,
                $genderStatsRaw->firstWhere('name', 'Perempuan')->count ?? 0
            ]
        ];

        // Get social assistance statistics (excluding IDs 1-4)
        $socialAssistanceStats = SocialAssistance::whereNotIn('id', [1, 2, 3, 4])
            ->get()
            ->map(function ($assistance) {
                // Get count using query builder
                $count = DB::table('beneficiary_assistance')
                    ->where('social_assistance_id', $assistance->id)
                    ->count();

                // Assign colors based on assistance type
                $colors = [
                    'BLT-DD' => '#EF4444', // Red
                    'BPNT' => '#3B82F6',   // Blue
                    'PKH' => '#10B981',    // Green
                    'Ketahanan Pangan' => '#F59E0B', // Amber
                    'BUHR' => '#8B5CF6',   // Purple
                    'BRLH/Bedah Rumah' => '#EC4899', // Pink
                    'Rehab Rumah' => '#06B6D4', // Cyan
                    'UEP' => '#84CC16',    // Lime
                ];

                $assistance->beneficiaries_count = $count;
                $assistance->color = $colors[$assistance->name] ?? '#6B7280';

                return $assistance;
            });

        // Get banjar statistics with count
        $banjars = DB::table('banjars')
            ->leftJoin('beneficiaries', 'banjars.id', '=', 'beneficiaries.banjar_id')
            ->select(
                'banjars.id',
                'banjars.name',
                DB::raw('COUNT(beneficiaries.id) as beneficiaries_count')
            )
            ->groupBy('banjars.id', 'banjars.name')
            ->orderBy('banjars.name')
            ->get();

        // Prepare banjar stats for cards (only show assistances with data)
        $banjarStats = $banjars->map(function ($banjar) use ($socialAssistanceStats) {
            $stats = collect();

            foreach ($socialAssistanceStats as $assistance) {
                $count = DB::table('beneficiary_assistance')
                    ->join('beneficiaries', 'beneficiary_assistance.beneficiary_id', '=', 'beneficiaries.id')
                    ->where('beneficiaries.banjar_id', $banjar->id)
                    ->where('beneficiary_assistance.social_assistance_id', $assistance->id)
                    ->count();

                if ($count > 0) {
                    $stats->push((object)[
                        'id' => $assistance->id,
                        'name' => $assistance->name,
                        'count' => $count,
                        'color' => $assistance->color
                    ]);
                }
            }

            return (object)[
                'id' => $banjar->id,
                'name' => $banjar->name,
                'total' => $banjar->beneficiaries_count,
                'assistance_stats' => $stats
            ];
        })->filter(fn($banjar) => $banjar->total > 0);

        // Get detailed banjar statistics for table
        $banjarDetails = $banjars->map(function ($banjar) use ($socialAssistanceStats) {
            $assistance_counts = [];

            foreach ($socialAssistanceStats as $assistance) {
                $count = DB::table('beneficiary_assistance')
                    ->join('beneficiaries', 'beneficiary_assistance.beneficiary_id', '=', 'beneficiaries.id')
                    ->where('beneficiaries.banjar_id', $banjar->id)
                    ->where('beneficiary_assistance.social_assistance_id', $assistance->id)
                    ->count();

                $assistance_counts[$assistance->id] = $count;
            }

            return (object)[
                'id' => $banjar->id,
                'name' => $banjar->name,
                'assistance_counts' => $assistance_counts,
                'total' => $banjar->beneficiaries_count
            ];
        });

        // Get all banjars for filter dropdown
        $allBanjars = DB::table('banjars')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        // Get all social assistances (excluding IDs 1-4) for filter
        $allSocialAssistances = SocialAssistance::whereNotIn('id', [1, 2, 3, 4])
            ->orderBy('name')
            ->get()
            ->map(function ($assistance) {
                // Assign colors
                $colors = [
                    'BLT-DD' => '#EF4444',
                    'BPNT' => '#3B82F6',
                    'PKH' => '#10B981',
                    'Ketahanan Pangan' => '#F59E0B',
                    'BUHR' => '#8B5CF6',
                    'BRLH/Bedah Rumah' => '#EC4899',
                    'Rehab Rumah' => '#06B6D4',
                    'UEP' => '#84CC16',
                ];
                $assistance->color = $colors[$assistance->name] ?? '#6B7280';

                // ADD THIS: Calculate total count for each assistance
                $assistance->total_count = DB::table('beneficiary_assistance')
                    ->where('social_assistance_id', $assistance->id)
                    ->count();

                return $assistance;
            });

        return view('beneficiaries.index', [
            'totalBeneficiaries' => $totalBeneficiaries,
            'socialAssistanceStats' => $socialAssistanceStats,
            'socialAssistances' => $allSocialAssistances,
            'banjars' => $allBanjars,
            'banjarStats' => $banjarStats,
            'banjarDetails' => $banjarDetails,
            'genderStats' => $genderStats, // Add this line
        ]);
    }

    public function getBeneficiariesData(Request $request)
    {
        $query = DB::table('beneficiaries')
            ->leftJoin('banjars', 'beneficiaries.banjar_id', '=', 'banjars.id')
            ->leftJoin('genders', 'beneficiaries.gender_id', '=', 'genders.id')
            ->select(
                'beneficiaries.*',
                'banjars.name as banjar_name',
                'genders.name as gender_name'
            );

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('beneficiaries.nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('beneficiaries.nomor_induk_kependudukan', 'like', "%{$search}%");
            });
        }

        // Filter by banjar
        if ($request->filled('banjar') && $request->banjar !== '') {
            $query->where('beneficiaries.banjar_id', $request->banjar);
        }

        // Filter by social assistance (excluding IDs 1-4)
        if ($request->filled('assistance') && $request->assistance !== '') {
            $query->whereExists(function ($q) use ($request) {
                $q->select(DB::raw(1))
                    ->from('beneficiary_assistance')
                    ->whereColumn('beneficiary_assistance.beneficiary_id', 'beneficiaries.id')
                    ->where('beneficiary_assistance.social_assistance_id', $request->assistance);
            });
        }

        // Get total count
        $total = $query->count();

        // Paginate manually
        $page = $request->page ?? 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        // SORT BY DATABASE ID (PRIMARY KEY) - Oldest first (ascending)
        $beneficiaries = $query->orderBy('beneficiaries.id', 'asc')
            ->offset($offset)
            ->limit($perPage)
            ->get()
            ->map(function ($beneficiary) {
                // Get social assistances for this beneficiary (excluding IDs 1-4)
                $assistances = DB::table('beneficiary_assistance')
                    ->join('social_assistances', 'beneficiary_assistance.social_assistance_id', '=', 'social_assistances.id')
                    ->where('beneficiary_assistance.beneficiary_id', $beneficiary->id)
                    ->whereNotIn('social_assistances.id', [1, 2, 3, 4]) // Exclude IDs 1-4
                    ->select('social_assistances.*')
                    ->get()
                    ->map(function ($assistance) {
                        // Assign colors
                        $colors = [
                            'BLT-DD' => '#EF4444',
                            'BPNT' => '#3B82F6',
                            'PKH' => '#10B981',
                            'Ketahanan Pangan' => '#F59E0B',
                            'BUHR' => '#8B5CF6',
                            'BRLH/Bedah Rumah' => '#EC4899',
                            'Rehab Rumah' => '#06B6D4',
                            'UEP' => '#84CC16',
                        ];
                        $assistance->color = $colors[$assistance->name] ?? '#6B7280';
                        return $assistance;
                    });

                // Format NIK for display
                if (strlen($beneficiary->nomor_induk_kependudukan) >= 16) {
                    $beneficiary->nik_display = substr($beneficiary->nomor_induk_kependudukan, 0, 8) . '******' . substr($beneficiary->nomor_induk_kependudukan, -2);
                } else {
                    $beneficiary->nik_display = $beneficiary->nomor_induk_kependudukan;
                }

                $beneficiary->banjar = (object)['name' => $beneficiary->banjar_name];
                $beneficiary->gender = (object)['name' => $beneficiary->gender_name];
                $beneficiary->social_assistances = $assistances;

                return $beneficiary;
            });

        // Generate pagination links
        $lastPage = ceil($total / $perPage);
        $links = [];

        // Previous link
        if ($page > 1) {
            $links[] = [
                'url' => "?page=" . ($page - 1),
                'label' => '«',
                'active' => false
            ];
        }

        // Page links - show 5 pages around current
        $startPage = max(1, $page - 2);
        $endPage = min($lastPage, $page + 2);

        // First page link
        if ($startPage > 1) {
            $links[] = [
                'url' => "?page=1",
                'label' => '1',
                'active' => false
            ];
            if ($startPage > 2) {
                $links[] = [
                    'url' => null,
                    'label' => '...',
                    'active' => false
                ];
            }
        }

        // Middle pages
        for ($i = $startPage; $i <= $endPage; $i++) {
            $links[] = [
                'url' => "?page=" . $i,
                'label' => (string)$i,
                'active' => $i == $page
            ];
        }

        // Last page link
        if ($endPage < $lastPage) {
            if ($endPage < $lastPage - 1) {
                $links[] = [
                    'url' => null,
                    'label' => '...',
                    'active' => false
                ];
            }
            $links[] = [
                'url' => "?page=" . $lastPage,
                'label' => (string)$lastPage,
                'active' => false
            ];
        }

        // Next link
        if ($page < $lastPage) {
            $links[] = [
                'url' => "?page=" . ($page + 1),
                'label' => '»',
                'active' => false
            ];
        }

        return response()->json([
            'data' => $beneficiaries,
            'from' => $total > 0 ? $offset + 1 : 0,
            'to' => min($offset + $perPage, $total),
            'total' => $total,
            'current_page' => (int)$page,
            'last_page' => $lastPage,
            'links' => $links,
        ]);
    }
}
