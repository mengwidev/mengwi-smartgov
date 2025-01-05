<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
        * {
            font-family: "Source Code Pro", serif;
        }
    </style>
</head>
<body class="font-sans bg-gray-100 print:bg-transparent">

    <div x-data="{ showTitle: true }" id="reportToBeDownloaded">
        <div class="form-container print:hidden bg-white shadow-lg rounded-lg p-6">
            <form method="GET" action="{{ route('attendance.index') }}" class="flex space-x-4 justify-center items-center">
                <div class="flex items-center space-x-3">
                    <label for="from_date" class="text-sm font-medium text-gray-700">From:</label>
                    <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex items-center space-x-3">
                    <label for="to_date" class="text-sm font-medium text-gray-700">To:</label>
                    <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors focus:outline-none">Filter</button>
                <button type="button" onclick="window.print()" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition-colors focus:outline-none">Print</button>

                <div class="flex justify-center items-center space-x-2">
                    <label for="hideTitle" class="text-sm text-gray-700">Show Title</label>
                    <input type="checkbox" id="hideTitle" x-model="showTitle" class="text-blue-500 focus:ring-2 focus:ring-blue-500">
                </div>
            </form>
        </div>

        <div x-show="showTitle" class="my-6">
            <h1 class="text-2xl font-bold text-gray-800">Report Absensi Mingguan</h1>
            <table class="mt-2 text-sm text-gray-700">
                <tr>
                    <td>Instansi</td>
                    <td class="w-8 text-center">:</td>
                    <td>Pemerintah Desa Mengwi</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td class="w-8 text-center">:</td>
                    <td>{{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->locale('id')->isoFormat('MMMM') : 'All' }}</td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td class="w-8 text-center">:</td>
                    <td>{{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->year : 'All' }}</td>
                </tr>
                <tr>
                    <td>Periode</td>
                    <td class="w-8 text-center">:</td>
                    <td>
                        @if (request('from_date') && request('to_date'))
                            {{ \Carbon\Carbon::parse(request('from_date'))->locale('id')->isoFormat('DD MMMM Y') }}
                            -
                            {{ \Carbon\Carbon::parse(request('to_date'))->locale('id')->isoFormat('DD MMMM Y') }}
                        @else
                            {{ 'Periode tidak valid' }}
                        @endif
                    </td>
                </tr>
            </table>

            <hr class="border-3 border-black mt-5">
        </div>
    </div>

    <div class="overflow-x-auto content mt-6 max-w-[16in]" id="attendanceTable">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
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
                        <th colspan="2" class="border border-gray-300 px-2 text-center">{{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('DD MMMM Y') }}</th>
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
                        <td class="border border-gray-300 employee-name text-nowrap px-2">{{ $data['employee_name'] }}</td>
                        @foreach ($dates as $date)
                            @if ($data['attendances'][$date][1] === 'Libur')
                                <td class="border border-gray-300 max-w-12 text-red-600 font-bold text-center">{{ $data['attendances'][$date][1] }}</td>
                            @else
                                <td class="border border-gray-300 max-w-12 text-center">{{ $data['attendances'][$date][1] }}</td>
                            @endif
                            @if ($data['attendances'][$date][2] === 'Libur')
                                <td class="border border-gray-300 text-red-600 max-w-12 font-bold text-center">{{ $data['attendances'][$date][2] }}</td>
                            @else
                                <td class="border border-gray-300 max-w-12 text-center">{{ $data['attendances'][$date][2] }}</td>
                            @endif
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
            <div>
                <p class="text-sm py-1">Device Name : Presensi Kantor Desa Mengwi | Device SN : 66206023301349</p>
            </div>
        </div>
    </div>

    <script type="module">
        const fromDate = document.querySelector('#from_date');
        const toDate = document.querySelector('#to_date');
        const result = document.querySelector('#result');

        function updatePeriod() {
            const fromDateValue = fromDate.value;
            const toDateValue = toDate.value;
            if (fromDateValue && toDateValue) {
                result.innerText = `From: ${fromDateValue} To: ${toDateValue}`;
            } else if (fromDateValue) {
                result.innerText = `From: ${fromDateValue}`;
            } else if (toDateValue) {
                result.innerText = `To: ${toDateValue}`;
            } else {
                result.innerText = '';
            }
        }

        fromDate.addEventListener('input', updatePeriod);
        toDate.addEventListener('input', updatePeriod);
    </script>
</body>
</html>