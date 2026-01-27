{{-- CHART AREA --}}
<!-- Charts Section - New Layout -->
<div class="mb-8 grid grid-cols-1 gap-8 lg:grid-cols-3">
    <!-- Left Column - 2/3 width -->
    <div class="space-y-8 lg:col-span-2">
        <!-- Row 1: Distribution Chart -->
        <div class="rounded-2xl bg-white p-6 shadow-lg">
            <div class="mb-4 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <h2 class="flex gap-2 text-lg font-semibold text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>
                    Distribusi Penerima per Banjar
                </h2>
                <div
                    class="inline-flex items-center rounded-full bg-gradient-to-r from-gray-50 to-gray-100 p-1 shadow-inner ring-1 ring-gray-200 ring-opacity-50">
                    <button type="button" id="grouped-chart-btn"
                        class="rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 hover:text-gray-900 hover:shadow">
                        Spread
                    </button>
                    <button type="button" id="stacked-chart-btn"
                        class="rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 hover:text-gray-900 hover:shadow">
                        Stacked
                    </button>
                </div>
            </div>
            <div class="relative h-80 sm:h-72">
                <canvas id="banjarDistributionChart"></canvas>
            </div>
        </div>

        <!-- Row 2: Two Pie Charts -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <!-- Pie Chart 1: Per Jenis Kelamin -->
            <div class="rounded-2xl bg-white p-6 shadow-lg">
                <h2 class="flex gap-2 text-lg font-semibold text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z" />
                    </svg>

                    Penerima Berdasarkan Jenis Kelamin
                </h2>
                <div class="flex justify-center">
                    <div class="relative aspect-square w-full max-w-xs">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pie Chart 2: Per Banjar -->
            <div class="rounded-2xl bg-white p-6 shadow-lg">
                <h2 class="flex gap-2 text-lg font-semibold text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-compass" viewBox="0 0 16 16">
                        <path
                            d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016m6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0" />
                        <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z" />
                    </svg>

                    Distribusi Penerima per Banjar
                </h2>
                <div class="flex justify-center">
                    <div class="relative aspect-square w-full max-w-xs">
                        <canvas id="banjarPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - 1/3 width -->
    <div class="space-y-8">
        <!-- Pie Chart: Per Bantuan -->
        <div class="rounded-2xl bg-white p-6 shadow-lg">
            <h2 class="flex gap-2 text-lg font-semibold text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>

                Distribusi Penerima per Bantuan
            </h2>
            <div class="flex justify-center">
                <div class="relative aspect-square w-full max-w-xs">
                    <canvas id="assistanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Banjar Stats Cards -->
        <div class="rounded-2xl bg-white p-6 shadow-lg">
            <h2 class="mb-3 flex gap-2 text-lg font-semibold text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                </svg>

                Sebaran Bantuan per Banjar
            </h2>
            <p class="mb-4 text-xs italic text-gray-600">Scroll kebawah</p>
            <div class="max-h-[280px] space-y-4 overflow-y-auto pr-2" id="banjar-cards-container">
                @foreach ($banjarStats as $banjar)
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-5 shadow-lg transition-shadow hover:shadow-lg">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">{{ $banjar->name }}</h3>
                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">
                                {{ $banjar->total }} penerima
                            </span>
                        </div>
                        <div class="">
                            @foreach ($banjar->assistance_stats as $stat)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="mr-2 h-3 w-3 rounded-full"
                                            style="background-color: {{ $stat->color }};"></div>
                                        <span class="text-sm text-gray-600">{{ $stat->name }}</span>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $stat->count }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Total Penerima</span>
                                <span class="font-bold text-gray-900">{{ $banjar->total }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- END CHART AREA --}}
