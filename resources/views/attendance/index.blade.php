<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="print:bg-transparent bg-gray-200">
    <div x-data="{ showTitle: true }" class="grid grid-cols-[minmax(200px, 1fr), 3fr]">
        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- CONFIGURATION --}}
        {{-- ----------------------------------------------------------------------------------------- --}}
        <div class="p-4 rounded-2xl sticky top-0">
            <div class="form-container print:hidden bg-white shadow-xl h-full font-sans flex rounded-2xl overflow-hidden"
                id="config">
                <div class="w-20 bg-green-600 flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div class="flex justify-between w-full h-full">
                    <form method="GET" action="{{ route('attendance.index') }}"
                        class="flex space-x-4 justify-center items-center p-2">

                        <div class="flex items-center space-x-3">
                            <label for="from_date" class="text-sm font-medium text-gray-700">From:</label>
                            <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div class="flex items-center space-x-3">
                            <label for="to_date" class="text-sm font-medium text-gray-700">To:</label>
                            <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div class="inline-block">
                            <button type="submit"
                                class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                                <span
                                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Filter
                                </span>
                            </button>
                        </div>

                        <div class="flex justify-center items-center space-x-2">
                            <label class="inline-flex items-center cursor-pointer" for="hideTitle">
                                <input type="checkbox" id="hideTitle" class="sr-only peer" x-model="showTitle">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Show
                                    Title</span>
                            </label>
                        </div>
                    </form>
                    <div class="p-2 flex items-center">
                        <div class="p-2">
                            <button type="button" id="printButton"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                </svg>
                                <span class="sr-only">Icon description</span>
                            </button>
                        </div>
                        <div class="h-2/3 w-2 rounded-full bg-gray-100 me-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-3 border-dashed border-black">
        {{-- ----------------------------------------------------------------------------------------- --}}
        {{-- CONFIGURATION END --}}
        {{-- ----------------------------------------------------------------------------------------- --}}

        <div id="report" class="p-8 bg-gray-200 font-sourceCode">
            <div class="p-10 bg-white rounded-xl shadow-lg">

                {{-- ----------------------------------------------------------------------------------------- --}}
                {{-- TITLE SECTION --}}
                {{-- ----------------------------------------------------------------------------------------- --}}
                <div id="print">

                    <div x-show="showTitle">
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
                                <td>{{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->locale('id')->isoFormat('MMMM') : 'All' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td class="w-8 text-center">:</td>
                                <td>{{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->year : 'All' }}
                                </td>
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
                        <hr class="border-3 border-black my-6">
                    </div>
                    {{-- ----------------------------------------------------------------------------------------- --}}
                    {{-- TITLE SECTION END --}}
                    {{-- ----------------------------------------------------------------------------------------- --}}


                    {{-- ----------------------------------------------------------------------------------------- --}}
                    {{-- DATA TABLE --}}
                    {{-- ----------------------------------------------------------------------------------------- --}}
                    <div class="overflow-x-auto content w-full font-sourceCode" id="attendanceTable">
                        <table class="min-w-full table-auto border-collapse border border-gray-300">
                            <thead class="bg-slate-200 text-sm">
                                <tr>
                                    <th rowspan="3" class="border border-gray-300 px-2">#</th>
                                    <th rowspan="3" class="border border-gray-300 px-2">PEGAWAI</th>
                                    @foreach ($dates as $date)
                                        <th colspan="2" class="border border-gray-300 px-2 text-center">
                                            {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd') }}</th>
                                    @endforeach
                                </tr>
                                <tr class="bg-slate-200">
                                    @foreach ($dates as $date)
                                        <th colspan="2" class="border border-gray-300 px-2 text-center">
                                            {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('DD MMMM Y') }}
                                        </th>
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
                                        <td class="border border-gray-300 text-center px-2">{{ $loop->iteration }}
                                        </td>
                                        <td class="border border-gray-300 employee-name text-nowrap px-2">
                                            {{ $data['employee_name'] }}
                                        </td>
                                        @foreach ($dates as $date)
                                            @if ($data['attendances'][$date][1] === 'Libur')
                                                <td
                                                    class="border border-gray-300 max-w-12 text-red-600 font-bold text-center">
                                                    {{ $data['attendances'][$date][1] }}</td>
                                            @else
                                                <td class="border border-gray-300 max-w-12 text-center">
                                                    {{ $data['attendances'][$date][1] }}</td>
                                            @endif
                                            @if ($data['attendances'][$date][2] === 'Libur')
                                                <td
                                                    class="border border-gray-300 text-red-600 max-w-12 font-bold text-center">
                                                    {{ $data['attendances'][$date][2] }}</td>
                                            @else
                                                <td class="border border-gray-300 max-w-12 text-center">
                                                    {{ $data['attendances'][$date][2] }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- ----------------------------------------------------------------------------------------- --}}
                    {{-- DATA TABLE END --}}
                    {{-- ----------------------------------------------------------------------------------------- --}}

                    {{-- ----------------------------------------------------------------------------------------- --}}
                    {{-- FOOTER SECTION --}}
                    {{-- ----------------------------------------------------------------------------------------- --}}
                    <div class="w-full">
                        @php
                            $printedDate = now();
                        @endphp
                        <hr class="page:absolute page:bottom-0 border-3 border-black mt-5">
                        <div class="flex justify-between">
                            <div class="bg-black text-white px-2 w-2/7">
                                <p class="text-sm py-1">Tanggal Cetak : {{ $printedDate }}</p>
                            </div>
                            <div>
                                <p class="text-sm py-1">Device Name : Presensi Kantor Desa Mengwi | Device SN :
                                    66206023301349
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- ----------------------------------------------------------------------------------------- --}}
                    {{-- FOOTER SECTION END --}}
                    {{-- ----------------------------------------------------------------------------------------- --}}
                </div>
            </div>
        </div>

    </div>

    <script type="module">
        // ---------------------------------------------------------------------------------------------
        //  PPERIOD INNER TEXT
        // ---------------------------------------------------------------------------------------------
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
        // ---------------------------------------------------------------------------------------------
        //  PERIOD INNER TEXT LOGIC
        // ---------------------------------------------------------------------------------------------

        // ---------------------------------------------------------------------------------------------
        //  PRINT BUTTON LOGIC
        // ---------------------------------------------------------------------------------------------

        const printButton = document.querySelector('#printButton');

        printButton.addEventListener('click', reportPrint);

        function reportPrint() {
            var printContents = document.querySelector('#print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        // ---------------------------------------------------------------------------------------------
        //  PRINT BUTTON LOGIC END
        // ---------------------------------------------------------------------------------------------
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.js"></script>

</body>

</html>
