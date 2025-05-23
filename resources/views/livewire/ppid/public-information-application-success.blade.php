<div class="flex min-h-screen items-center justify-center bg-indigo-50 px-4 py-6 sm:px-6 sm:py-10">
    <div class="w-full max-w-4xl overflow-hidden rounded-lg bg-white shadow-xl">

        {{-- Header: Logo + Identitas --}}
        <div class="flex flex-col items-center justify-center border-b border-gray-100 px-6 py-8 sm:px-12 sm:py-10">
            <div class="mb-4 w-24 sm:w-32">
                <img src="{{ asset('assets/logo-ppid-2009.png') }}" alt="Logo PPID"
                    class="mx-auto h-auto w-full object-contain">
            </div>
            <h1 class="text-center text-lg font-bold text-gray-700 sm:text-xl">
                Pejabat Pengelola Informasi dan Dokumentasi
            </h1>
            <h2 class="text-center text-sm text-gray-500 sm:text-base">
                Pemerintah Desa Mengwi
            </h2>
        </div>

        {{-- Content --}}
        <div class="space-y-10 px-6 py-8 sm:px-12 sm:py-10">

            {{-- Status Notifikasi --}}
            <div class="space-y-4 text-center">
                <div class="flex justify-center">
                    <x-heroicon-o-check-circle class="h-12 w-12 text-green-600" />
                </div>
                <h2 class="text-xl font-bold text-green-700 sm:text-2xl">
                    Permohonan Informasi Telah Terkirim
                </h2>
                <p class="mx-auto max-w-md text-sm text-gray-600 sm:text-base">
                    Terima kasih. Permohonan informasi publik Anda telah berhasil kami terima.
                </p>
            </div>

            {{-- Nomor Registrasi --}}
            <div class="space-y-2 rounded-lg border border-gray-200 bg-gray-50 px-6 py-4 text-center">
                <p class="text-sm font-semibold text-gray-700">
                    Nomor registrasi permohonan Anda:
                </p>
                <p>
                    <span class="inline-block rounded bg-blue-100 px-2 py-2 text-sm font-semibold text-blue-900">
                        {{ $application->reg_num }}
                    </span>
                </p>
                <p class="text-sm text-gray-600">
                    Harap simpan nomor registrasi ini untuk tindak lanjut permohonan Anda.
                </p>
            </div>

            {{-- Bagian: Unduh Dokumen --}}
            {{-- <section>
                <div class="mb-2 flex items-center gap-2 text-gray-800">
                    <x-heroicon-o-document-text class="h-5 w-5" />
                    <h3 class="text-base font-semibold sm:text-lg">Unduh Dokumen Permohonan</h3>
                </div>
                <p class="mb-4 text-sm text-gray-600">
                    Simpan salinan dokumen untuk arsip Anda.
                </p>
                <div class="flex flex-col gap-2 sm:flex-row sm:gap-4">
                    <x-icon-split-button text="Formulir Permohonan" icon="heroicon-o-document" color="indigo"
                        href="#" />
                    <x-icon-split-button text="Tanda Bukti Penerimaan" icon="heroicon-o-check-badge" color="indigo"
                        href="#" />
                </div>
            </section> --}}

            {{-- Bagian: Aksi Lanjutan --}}
            <section>
                <div class="mb-2 flex items-center gap-2 text-gray-800">
                    <x-heroicon-o-arrow-path class="h-5 w-5" />
                    <h3 class="text-base font-semibold sm:text-lg">Lanjutkan Tindakan Anda</h3>
                </div>
                <p class="mb-4 text-sm text-gray-600">
                    Pilih tindakan selanjutnya sesuai kebutuhan Anda.
                </p>
                <div class="flex flex-col gap-2 sm:flex-row sm:gap-4">
                    <a href="{{ route('applications.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded bg-zinc-100 px-6 py-2 text-sm font-medium text-gray-800 transition hover:bg-zinc-200">
                        <x-heroicon-o-plus-circle class="h-5 w-5" />
                        Buat Permohonan Baru
                    </a>
                    <a href="{{ route('ppid.track') }}"
                        class="inline-flex items-center justify-center gap-2 rounded bg-green-600 px-6 py-2 text-sm font-medium text-white transition hover:bg-green-700">
                        <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                        Lacak Permohonan
                    </a>
                </div>
            </section>

        </div>

    </div>
</div>
