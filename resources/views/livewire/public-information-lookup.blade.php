<div class="bg-mengwi-jadoel0 min-h-screen space-y-6 p-4 sm:p-6">
    {{-- PPID Header --}}
    <div class="mx-auto max-w-4xl rounded-lg">
        <livewire:ppid-header />
    </div>

    <div class="mx-auto max-w-full rounded-lg bg-gray-50 p-4 shadow-lg sm:max-w-4xl sm:p-6">
        <form wire:submit.prevent="search">
            <label for="regNum" class="mb-2 block text-sm font-semibold text-gray-800 sm:text-base">
                Nomor Registrasi
            </label>
            <div class="flex w-full items-center gap-2">
                <input id="regNum" type="text" wire:model.defer="regNum"
                    placeholder="Contoh: 5103022009/PPID/REG/20250124/001"
                    class="flex-1 rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm placeholder:text-[11px] focus:border-blue-600 focus:ring focus:ring-blue-300 focus:ring-opacity-50 sm:py-3 sm:text-base sm:placeholder:text-sm"
                    autocomplete="off" />

                {{-- Submit Button --}}
                <button type="submit"
                    class="inline-flex flex-shrink-0 items-center justify-center gap-2 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white transition-colors duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:px-5 sm:py-3 sm:text-base">
                    <x-heroicon-o-magnifying-glass class="h-5 w-5 sm:h-6 sm:w-6" />
                    <span class="hidden sm:inline">Lacak</span>
                </button>
            </div>

        </form>
    </div>
    @if ($application)
        <div class="mx-auto max-w-full rounded-lg bg-gray-50 p-4 shadow-lg sm:max-w-4xl sm:p-6">
            <div class="space-y-6">
                {{-- Status --}}
                <section class="rounded-md border border-gray-200 bg-gray-50 p-4 sm:p-6">
                    <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-gray-900 sm:text-xl">
                        <x-heroicon-o-arrow-path class="h-5 w-5 sm:h-6 sm:w-6" /><span>Status Permohonan</span>
                    </h2>
                    <div
                        class="{{ $application->latest_status_color }} inline-block rounded px-3 py-1 text-sm font-semibold">
                        {{ $application->latest_status_label }}
                    </div>
                </section>

                {{-- Info Pemohon --}}
                <section class="rounded-md border border-gray-200 bg-gray-50 p-4 sm:p-6">
                    <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-gray-900 sm:text-xl">
                        <x-heroicon-o-user class="h-5 w-5 sm:h-6 sm:w-6" /><span>Informasi Pemohon</span>
                    </h2>
                    <div class="space-y-2 text-sm text-gray-700 sm:text-base">
                        <div><strong>Nama:</strong> {{ $application->applicant->name }}</div>
                        <div><strong>Alamat:</strong> {{ $application->applicant->address }}</div>
                        <div><strong>Telepon:</strong> {{ $application->applicant->phone }}</div>
                        <div><strong>Email:</strong> {{ $application->applicant->email }}</div>
                        <div>
                            <strong>Identitas:</strong>
                            {{ $application->applicant->identifierMethod->name }} -
                            {{ $application->applicant->applicant_identifier_value }}
                        </div>
                        <div>
                            <a href="{{ asset('storage/' . $application->applicant->applicant_identifier_attachment) }}"
                                target="_blank"
                                class="inline-block rounded bg-blue-600 px-4 py-2 text-white shadow transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                rel="noopener noreferrer">
                                Unduh Lampiran Identitas
                            </a>
                        </div>
                    </div>
                </section>

                {{-- Info Aplikasi --}}
                <section class="rounded-md border border-gray-200 bg-gray-50 p-4 sm:p-6">
                    <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-gray-900 sm:text-xl">
                        <x-heroicon-o-document-duplicate class="h-5 w-5 sm:h-6 sm:w-6" /><span>Data Informasi</span>
                    </h2>
                    <div class="space-y-2 text-sm text-gray-700 sm:text-base">
                        <div><strong>Informasi yang Diminta:</strong> {{ $application->information_requested }}</div>
                        <div><strong>Tujuan Informasi:</strong> {{ $application->information_purposes }}</div>
                        <div><strong>Catatan Pemohon:</strong> {{ $application->note ?? '-' }}</div>
                    </div>
                </section>

                {{-- Riwayat Status --}}
                <section class="rounded-md border border-gray-200 bg-gray-50 p-4 sm:p-6">
                    <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-gray-900 sm:text-xl">
                        <x-heroicon-o-clock class="h-5 w-5 sm:h-6 sm:w-6" /><span>Riwayat Status Permohonan</span>
                    </h2>

                    <ol class="relative border-s border-gray-300">
                        @foreach ($application->applicationHistory->sortBy('updated_at') as $history)
                            <li class="mb-10 ms-4">
                                @php
                                    $dotColor = is_array($history->status_color)
                                        ? implode(' ', $history->status_color)
                                        : $history->status_color;
                                @endphp

                                <div class="{{ $dotColor }} absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full"></div>
                                <time class="mb-1 text-xs font-normal leading-none text-gray-500 sm:text-sm">
                                    {{ $history->updated_at->locale('id')->translatedFormat('d F Y H:i') }}
                                </time>
                                <h3 class="text-sm font-semibold text-gray-800 sm:text-base">
                                    {{ $history->applicationStatus->name }}
                                </h3>
                                <p class="text-xs text-gray-700 sm:text-sm">
                                    {{ $history->note ?? '-' }}
                                </p>
                            </li>
                        @endforeach
                    </ol>
                </section>
            </div>
        @elseif ($regNum)
            <div class="mx-auto mt-6 flex max-w-xl items-center justify-center gap-4 rounded-md bg-red-50 p-4 text-red-700 shadow-sm sm:text-base"
                role="alert">
                <x-heroicon-o-exclamation-triangle class="h-12 w-12" />
                Tidak ditemukan permohonan dengan nomor registrasi tersebut.
            </div>
        </div>
    @endif
</div>
