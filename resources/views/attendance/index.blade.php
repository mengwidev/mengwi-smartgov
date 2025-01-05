<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
        * {
            font-family: "Source Code Pro", serif;
        }
    </style>
</head>
<body class="font-sans bg-gray-100 print:bg-transparent">

    @php
        use Carbon\Carbon;
        // Set locale for Carbon (Indonesian)
        Carbon::setLocale('id'); // 'id' is the locale for Indonesian

        // Set locale for PHP
        setlocale(LC_TIME, 'id_ID.UTF-8'); // For date/time functions in PHP

    @endphp

    <!-- Filter Form for Date Range -->
    <div class="form-container mt-6 mb-10 print:hidden">
        <form method="GET" action="{{ route('attendance.index') }}" class="flex space-x-6 justify-center items-center bg-gray-50 p-6 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <label for="from_date" class="text-sm font-medium text-gray-700">From:</label>
                <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex items-center space-x-3">
                <label for="to_date" class="text-sm font-medium text-gray-700">To:</label>
                <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">Filter</button>
        </form>
    </div>

    <!-- Alpine.js Data Binding -->
    <div x-data="{ 
        showTitle: true, 
        selectedMonth: 'November', 
        selectedYear: '2024' 
    }" class="px-4">

        <!-- Select Month and Year Section -->
        <div class="flex space-x-6 justify-center items-center mb-6 print:hidden">
            @php
                use Illuminate\Support\Facades\DB;

                // Fetch months from the ref_month table
                $months = DB::table('ref_month')->get();
            @endphp

            <!-- Month Selection Dropdown -->
            <div class="flex items-center space-x-3">
                <label for="month" class="text-sm font-medium text-gray-700">Select Month:</label>
                <select id="month" x-model="selectedMonth" class="border border-gray-300 rounded-md p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($months as $month)
                        <option value="{{ $month->name }}">{{ $month->name }}</option> <!-- Assuming 'name' is the column containing the month names -->
                    @endforeach
                </select>
            </div>

            <!-- Year Selection -->
            <div class="flex items-center space-x-3">
                <label for="year" class="text-sm font-medium text-gray-700">Select Year:</label>
                <select id="year" x-model="selectedYear" class="border border-gray-300 rounded-md p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>
        </div>

        <!-- Title Visibility Toggle -->
        <div class="flex justify-center items-center mb-4 print:hidden">
            <label for="hideTitle" class="mr-3 text-sm text-gray-700">Show Title</label>
            <input type="checkbox" id="hideTitle" x-model="showTitle" class="text-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Title Section -->
        <div x-show="showTitle" class="my-6">
            <h1 class="text-2xl font-extrabold text-gray-800">Report Absensi Mingguan</h1>
            <table class="mt-4">
                <tr>
                    <td>Instansi</td>
                    <td>:</td>
                    <td>Pemerintah Desa Mengwi</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>:</td>
                    <td x-text="selectedMonth"></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td x-text="selectedYear"></td>
                </tr>
            </table>
            
            <div class="max-w-[16in]">
                @php
                    $printedDate = now();
                @endphp
                <hr class="border-3 border-black mt-5">
                
            </div>
            
        </div>
    </div>

    <!-- Table with improved style -->
    <div class="overflow-x-auto content mt-6 max-w-[16in]" id="attendanceTable">
        <table id="attendanceTable" class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-slate-200 text-sm">
                <tr>
                    <th rowspan="3" class="border border-gray-300 px-2">#</th>
                    <th rowspan="3" class="border border-gray-300 px-2">PEGAWAI</th>
                    @foreach ($dates as $date)
                        <th colspan="2" class="border border-gray-300 px-2 text-center">{{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd') }}</th>
                    @endforeach
                </tr>
                <tr class="bg-slate-200">
                    @foreach ($dates as $date)
                        <th colspan="2" class="border border-gray-300 px-2 text-center">{{ \Carbon\Carbon::parse($date)->locale('id')->format('d-m-Y') }}</th>
                    @endforeach
                </tr>
                <tr class="bg-slate-200">
                    @foreach ($dates as $date)
                        <th class="border border-gray-300 px-2 text-center">MASUK</th>
                        <th class="border border-gray-300 px-2 text-center">PULANG</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($attendanceData as $employeeId => $data)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="border border-gray-300 text-center px-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 employee-name text-nowrap px-2 max-w-72">{{ $data['employee_name'] }}</td>
                        @foreach ($dates as $date)
                            @php
                                $dayOfWeek = Carbon::parse($date)->format('l'); // Get the day of the week (e.g., "Sunday", "Monday", etc.)
                            @endphp
            
                            <td class="border border-gray-300 max-w-12 text-center">
                                @if ($dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday')
                                    Libur
                                @else
                                    @isset($data['attendances'][$date][1])
                                        @php
                                            $attendanceTime = $data['attendances'][$date][1];
                                        @endphp
                                        {{ $attendanceTime }}
                                    @else
                                        --
                                    @endisset
                                @endif
                            </td>
                            
                            <td class="border border-gray-300 text-center px-2">
                                @if ($dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday')
                                    Libur
                                @else
                                    @isset($data['attendances'][$date][2])
                                        {{ $data['attendances'][$date][2] }}
                                    @else
                                        --
                                    @endisset
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
    <div class="max-w-[16in]">
        @php
            $printedDate = now();
        @endphp
        <hr class="page:absolute page:bottom-0 border-3 border-black mt-5">
        <div class="flex justify-between">
            <div class="bg-black text-white px-2 w-2/7">
                <p class="text-sm py-1">Tanggal Cetak : {{ $printedDate }}</p>
            </div>
            <div >
                <p class="text-sm py-1">Device Name : Presensi Kantor Desa Mengwi | Device SN : 66206023301349</p>
            </div>
        </div>
    </div>
</body>
</html>
