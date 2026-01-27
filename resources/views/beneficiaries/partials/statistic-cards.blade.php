{{-- STAT CARD AREA --}}
<div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

    {{-- ASSISTANCE GRID --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-2 lg:grid-rows-2">
        @foreach ($socialAssistanceStats as $assistance)
            @php
                // Define icons for each assistance type
                $icons = [
                    'BLT-DD' => 'blt-dd',
                    'BPNT' => 'bpnt',
                    'PKH' => 'pkh',
                    'Ketahanan Pangan' => 'ketahanan-pangan',
                    'BUHR' => 'buhr',
                    'BRLH/Bedah Rumah' => 'brlh',
                    'Rehab Rumah' => 'rehab-rumah',
                    'UEP' => 'uep',
                ];

                $iconType = $icons[$assistance->name] ?? 'check';
            @endphp

            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-md transition-all hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            {{ $assistance->name }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            {{ $assistance->beneficiaries_count }}
                        </p>
                    </div>

                    <div class="rounded-xl p-3" style="background-color: {{ $assistance->color }}20;">
                        {{-- Different icon per assistance type --}}
                        @if ($iconType === 'blt-dd')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="{{ $assistance->color }}" class="bi bi-cash" viewBox="0 0 16 16">
                                <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                            </svg>
                        @elseif($iconType === 'bpnt')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="{{ $assistance->color }}" class="bi bi-basket2" viewBox="0 0 16 16">
                                <path
                                    d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0z" />
                                <path
                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6z" />
                            </svg>
                        @elseif($iconType === 'pkh')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="{{ $assistance->color }}" class="bi bi-people" viewBox="0 0 16 16">
                                <path
                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                            </svg>
                        @elseif($iconType === 'ketahanan-pangan')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="{{ $assistance->color }}" class="bi bi-fork-knife" viewBox="0 0 16 16">
                                <path
                                    d="M13 .5c0-.276-.226-.506-.498-.465-1.703.257-2.94 2.012-3 8.462a.5.5 0 0 0 .498.5c.56.01 1 .13 1 1.003v5.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5zM4.25 0a.25.25 0 0 1 .25.25v5.122a.128.128 0 0 0 .256.006l.233-5.14A.25.25 0 0 1 5.24 0h.522a.25.25 0 0 1 .25.238l.233 5.14a.128.128 0 0 0 .256-.006V.25A.25.25 0 0 1 6.75 0h.29a.5.5 0 0 1 .498.458l.423 5.07a1.69 1.69 0 0 1-1.059 1.711l-.053.022a.92.92 0 0 0-.58.884L6.47 15a.971.971 0 1 1-1.942 0l.202-6.855a.92.92 0 0 0-.58-.884l-.053-.022a1.69 1.69 0 0 1-1.059-1.712L3.462.458A.5.5 0 0 1 3.96 0z" />
                            </svg>
                        @elseif($iconType === 'buhr')
                            <svg class="h-8 w-8" style="color: {{ $assistance->color }};"
                                fill="{{ $assistance->color }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        @elseif($iconType === 'brlh')
                            <svg class="h-8 w-8" style="color: {{ $assistance->color }};"
                                fill="{{ $assistance->color }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        @elseif($iconType === 'rehab-rumah')
                            <svg class="h-8 w-8" style="color: {{ $assistance->color }};"
                                fill="{{ $assistance->color }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        @elseif($iconType === 'uep')
                            <svg class="h-8 w-8" style="color: {{ $assistance->color }};"
                                fill="{{ $assistance->color }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        @else
                            {{-- Default check icon --}}
                            <svg class="h-8 w-8" style="color: {{ $assistance->color }};"
                                fill="{{ $assistance->color }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    {{ round(($assistance->beneficiaries_count / max($totalBeneficiaries, 1)) * 100, 1) }}%
                    dari total
                </div>
            </div>
        @endforeach
    </div>
    {{-- ASSISTANCE GRID END --}}

    {{-- TOTAL CARD --}}
    <div
        class="transform rounded-2xl bg-gradient-to-br from-cyan-500 to-emerald-600 p-6 text-white shadow-lg transition-transform hover:scale-105 lg:col-span-1">
        <div class="flex h-full flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lg font-medium text-blue-100">Total Penerima</p>
                    <p class="mt-2 text-2xl font-extrabold md:text-5xl" id="total-recipients">
                        {{ $totalBeneficiaries }} KPM
                    </p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/20 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
            </div>

            <div class="mt-6 text-sm text-blue-100">
                Semua jenis bantuan terdaftar dalam sistem
            </div>
        </div>
    </div>
    {{-- END TOTAL CARD --}}

</div>
{{-- END STAT CARD AREA --}}
