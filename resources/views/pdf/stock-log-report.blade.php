<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Log Report</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter">
    <header class="fixed top-0 flex items-center justify-center w-full h-48 text-gray-800 bg-[#9DDE8B]">
        {{-- @HEADER AREA ------ customize header content here --}}
        {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
        <div class="flex justify-between w-full p-4">
            <div>
                <h1 class="mb-2 text-2xl font-bold">PEMERINTAH DESA MENGWI</h1>
                <div class="flex flex-col items-start gap-1 scale-80">
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>Jl. Rama No. 6, Mengwi, Badung, Bali</span>
                    </div>
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <span>0361-880496</span>
                    </div>
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <span>desamengwi1@gmail.com</span>
                    </div>
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>

                        <span>mengwi-badung.desa.id</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-center gap-2 p-10 bg-[#E6FF94] rounded-lg">
                <h1 class="text-2xl font-bold text-right">Laporan Barang Masuk/Keluar</h1>
                @php
                    $earliestDate = \App\Models\StockLogModel::min('date'); // Get earliest date from database

                    if (!$startDate && !$endDate) {
                        $periodeText = 'Periode: Semua';
                    } elseif (!$startDate && $endDate) {
                        $periodeText =
                            'Periode: ' .
                            \Carbon\Carbon::parse($earliestDate)->locale('id')->isoFormat('DD MMMM Y') .
                            ' s/d ' .
                            \Carbon\Carbon::parse($endDate)->locale('id')->isoFormat('DD MMMM Y');
                    } elseif ($startDate && !$endDate) {
                        $periodeText =
                            'Periode: ' .
                            \Carbon\Carbon::parse($startDate)->locale('id')->isoFormat('DD MMMM Y') .
                            ' s/d Sekarang';
                    } else {
                        $periodeText =
                            'Periode: ' .
                            \Carbon\Carbon::parse($startDate)->locale('id')->isoFormat('DD MMMM Y') .
                            ' s/d ' .
                            \Carbon\Carbon::parse($endDate)->locale('id')->isoFormat('DD MMMM Y');
                    }
                @endphp

                <h2 class="font-semibold text-right">
                    {{ $periodeText }}
                    {{-- Periode : 30 Desember 2024 S/D 30 Desember 2024 --}}
                </h2>
            </div>
        </div>
        {{-- @END OF HEADER AREA --}}
        {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
    </header>
    <footer class="fixed bottom-0 flex flex-col justify-center w-full h-16">
        <hr class="w-full border border-[#9DDE8B]">
        <div class="flex items-center w-64 px-2 py-1 text-sm bg-[#9DDE8B]">
            {{-- @FOOTER AREA ------ customize footer here --}}
            {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
            Printed By : Mengwi SmartGov
            {{-- @END OF FOOTER AREA --}}
            {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
        </div>
    </footer>

    <table class="w-full">
        <thead>
            <tr>
                <td>
                    <div class="h-48 mb-6"></div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
                    {{-- @CONTENT AREA ------ content goes here --}}

                    <div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    @php
                                        $tableHeaders = [
                                            '#',
                                            'Barang',
                                            'Tanggal',
                                            'Pergerakan',
                                            'Jumlah',
                                            'Satuan',
                                            'Unit Kerja',
                                        ];
                                        $indexNum = 1;
                                    @endphp
                                    <tr class="text-sm bg-[#006769] text-white">
                                        @foreach ($tableHeaders as $header)
                                            <th class="px-1 py-3 border border-gray-300">{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stockLogs as $stockLog)
                                        <tr class="text-sm {{ $indexNum % 2 == 0 ? 'bg-gray-200' : 'bg-white' }}">
                                            <td class="px-1 py-1 text-center border border-gray-300">{{ $indexNum++ }}
                                            </td>
                                            <td class="px-1 py-1 truncate border border-gray-300">
                                                {{ $stockLog->product->name ?? 'No product' }}
                                            </td>
                                            <td class="px-1 py-1 text-center border border-gray-300 text-nowrap">
                                                {{ \Carbon\Carbon::parse($stockLog->date)->locale('id')->isoFormat('DD MMMM Y') }}
                                            </td>
                                            <td
                                                class="px-1 py-1 text-center {{ $stockLog->type === 'in' ? 'text-green-600' : 'text-red-600' }} border   border-gray-300">
                                                {{ $stockLog->type === 'in' ? 'Stok Masuk' : 'Stok Keluar' }}
                                            </td>
                                            <td class="px-1 py-1 text-center border border-gray-300">
                                                {{ $stockLog->quantity }}</td>
                                            <td class="px-1 py-1 text-center border border-gray-300">
                                                {{ $stockLog->product->unit->name ?? '-' }}</td>
                                            <td class="px-1 py-1 text-center truncate border border-gray-300">
                                                {{ $stockLog->unit->name ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- @END OF CONTENT AREA --}}
                    {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div class="h-16 mt-6"></div>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
