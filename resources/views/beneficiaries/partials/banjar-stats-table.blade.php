{{-- BANJAR STAT TABLE --}}
<div class="mb-8 rounded-2xl bg-white p-6 shadow-lg">
    <div class="mb-6 space-y-2">
        <h2 class="flex gap-2 text-lg font-semibold text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
            </svg>

            Statistik Detail per Banjar
        </h2>

        <p class="mb-4 text-xs italic text-gray-500 lg:hidden">Geser tabel ke kanan untuk melihat semua kolom</p>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full table-fixed divide-y divide-gray-200">
            {{-- Force equal column widths --}}
            <colgroup>
                {{-- Banjar column --}}
                <col class="w-48">

                {{-- Bantuan columns (equal width) --}}
                @foreach ($socialAssistances as $assistance)
                    <col class="w-40">
                @endforeach

                {{-- Total column --}}
                <col class="w-24">
            </colgroup>

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Banjar
                    </th>

                    @foreach ($socialAssistances as $assistance)
                        <th class="truncate px-6 py-3 text-center text-xs font-medium uppercase tracking-wider"
                            style="color: {{ $assistance->color }};">
                            {{ $assistance->name }}
                        </th>
                    @endforeach

                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                        Total
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($banjarDetails as $banjar)
                    <tr class="transition-colors hover:bg-gray-50">
                        {{-- Banjar name --}}
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $banjar->name }}
                        </td>

                        {{-- Bantuan columns --}}
                        @foreach ($socialAssistances as $assistance)
                            @php
                                $count = $banjar->assistance_counts[$assistance->id] ?? 0;

                                // Max value PER bantuan (not total banjar)
                                $max = $banjarDetails->pluck('assistance_counts.' . $assistance->id)->max();

                                $percentage = $max > 0 ? ($count / $max) * 100 : 0;
                            @endphp

                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="text-center text-sm font-medium text-gray-900">
                                        {{ $count }}
                                    </div>

                                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
                                        <div class="h-full rounded-full transition-all"
                                            style="
                                                width: {{ $percentage }}%;
                                                background-color: {{ $assistance->color }};
                                            ">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endforeach

                        {{-- Total --}}
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">
                                {{ $banjar->total }}
                            </span>
                        </td>
                    </tr>
                @endforeach

                {{-- TOTAL ROW --}}
                <tr class="bg-gray-100 font-bold">
                    <td class="px-6 py-4 text-gray-900">
                        Jumlah
                    </td>

                    @foreach ($socialAssistances as $assistance)
                        <td class="px-6 py-4 text-center text-gray-900">
                            {{ $assistance->total_count }}
                        </td>
                    @endforeach

                    <td class="px-6 py-4 text-center text-gray-900">
                        {{ $totalBeneficiaries }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
{{-- END BANJAR STAT TABLE --}}
