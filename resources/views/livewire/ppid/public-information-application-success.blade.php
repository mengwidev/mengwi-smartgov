<div class="flex min-h-screen items-center justify-center bg-indigo-50 px-4 py-6 sm:px-6 sm:py-8">
    <div class="max-w-5xl rounded-lg bg-white shadow-lg">
        {{-- PPID Header --}}
        <div class="mx-auto mb-6 max-w-3xl">
            <div class="flex flex-col items-center justify-center overflow-hidden p-4 sm:p-6">

                <div class="z-10 mb-4 w-24 sm:w-32">
                    <img src="{{ asset('assets/logo-ppid-2009.png') }}" alt="Logo PPID"
                        class="mx-auto h-auto w-full object-contain">
                </div>

                <h1 class="z-10 text-center text-lg font-bold text-gray-700 sm:text-xl">
                    Pejabat Pengelola Informasi dan Dokumentasi
                </h1>
                <h2 class="z-10 text-center text-sm text-gray-500 sm:text-base">
                    Desa Mengwi, Kecamatan Mengwi, Kabupaten Badung
                </h2>
            </div>
            <hr class="border-top border-2 border-dashed border-gray-100">
        </div>

        {{-- Success Content --}}
        <div class="mx-auto flex max-w-3xl flex-col items-center justify-center space-y-6 p-6">
            <h1 class="text-center text-2xl font-bold text-green-700 sm:text-xl">
                ✅ Permohonan Informasi Telah Terkirim
            </h1>

            <div class="w-full space-y-4 rounded-lg">
                <p class="text-sm text-gray-700 sm:text-base">
                    Terima kasih. Permohonan informasi publik Anda telah berhasil kami terima.
                </p>
                <div class="flex flex-col items-center gap-2 rounded-lg border border-gray-300 px-2 py-4">
                    <p class="text-sm font-semibold text-gray-700 sm:text-base">
                        Nomor registrasi permohonan anda:
                    </p>
                    <p>
                        <strong
                            class="inline-block rounded bg-blue-100 px-2 py-2 text-xs font-semibold text-blue-900 sm:text-lg">
                            {{ $application->reg_num }}
                        </strong>
                    </p>
                </div>
                <p class="text-sm text-gray-600 sm:text-base">
                    Harap simpan nomor registrasi tersebut untuk keperluan tindak lanjut permohonan Anda.
                </p>
            </div>

            {{-- CTA Buttons --}}
            <div class="mt-4 flex w-full max-w-sm flex-col gap-3">
                {{-- Uncomment if downloadable links needed in future --}}

                {{-- <a href="#"
                    class="block rounded bg-green-600 px-6 py-2 text-center text-sm font-medium text-white transition hover:bg-green-700 sm:text-base">
                    Unduh Formulir Permohonan (PDF)
                </a>
                <a href="#"
                    class="block rounded bg-teal-600 px-6 py-2 text-center text-sm font-medium text-white transition hover:bg-teal-700 sm:text-base">
                    Unduh Tanda Bukti Permintaan Informasi
                </a> --}}

                <a href="{{ route('applications.create') }}"
                    class="block rounded bg-blue-600 px-6 py-2 text-center text-sm font-medium text-white transition hover:bg-blue-700 sm:text-base">
                    Kembali ke Portal PPID Desa Mengwi
                </a>
            </div>
        </div>
    </div>
</div>
