{{-- FOOTER AREA --}}
<footer class="border-t border-gray-200 bg-gradient-to-b from-white to-gray-50">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3 lg:gap-16">
            <!-- Brand & Description -->
            <div class="space-y-6">

                <a class="flex items-center gap-3" href="{{ url('/') }}">
                    <div class="h-12 w-12 items-center justify-center rounded-xl">
                        <img src="{{ asset('assets/desa-mengwi.png') }}" alt="logo desa mengwi" class="w-12" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Mengwi <span
                                class="text-emerald-600">Smart</span>Gov</h2>
                        <p class="text-sm text-gray-600">Pemerintah Desa Mengwi</p>
                    </div>
                </a>

                {{-- <p class="text-sm text-gray-600">
                    Aplikasi sistem informasi Pemerintahan terintegrasi digital.
                </p> --}}

                <!-- Social Media -->
                <div class="flex gap-3">
                    <a href="#"
                        class="group rounded-lg bg-white p-2.5 shadow-sm ring-1 ring-gray-200 transition-all hover:bg-blue-50 hover:ring-blue-200">
                        <svg class="h-5 w-5 text-gray-600 transition-colors group-hover:text-blue-600"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="group rounded-lg bg-white p-2.5 shadow-sm ring-1 ring-gray-200 transition-all hover:bg-pink-50 hover:ring-pink-200">
                        <svg class="h-5 w-5 text-gray-600 transition-colors group-hover:text-pink-600"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="group rounded-lg bg-white p-2.5 shadow-sm ring-1 ring-gray-200 transition-all hover:bg-blue-50 hover:ring-blue-200">
                        <svg class="h-5 w-5 text-gray-600 transition-colors group-hover:text-blue-500"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            {{-- <div>
                <h3 class="mb-6 text-sm font-semibold uppercase tracking-wider text-gray-900">Menu Cepat</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ url('/') }}"
                            class="group flex items-center gap-2 text-sm text-gray-600 transition-colors hover:text-blue-600">
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                            Dashboard Utama
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/beneficiaries') }}"
                            class="group flex items-center gap-2 text-sm text-gray-600 transition-colors hover:text-blue-600">
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                            Data Penerima
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/reports') }}"
                            class="group flex items-center gap-2 text-sm text-gray-600 transition-colors hover:text-blue-600">
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                            Laporan & Analisis
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/help') }}"
                            class="group flex items-center gap-2 text-sm text-gray-600 transition-colors hover:text-blue-600">
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                            Bantuan & Panduan
                        </a>
                    </li>
                </ul>
            </div> --}}

            <!-- Contact Info -->
            <div>
                <h3 class="mb-6 text-sm font-semibold uppercase tracking-wider text-gray-900">Kontak</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="mt-0.5 rounded-lg bg-blue-100 p-1.5">
                            <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Telepon</p>
                            <p class="text-sm text-gray-600">+62361 880496</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-0.5 rounded-lg bg-green-100 p-1.5">
                            <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Email</p>
                            <p class="text-sm text-gray-600">desamengwi1@gmail.com</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-0.5 rounded-lg bg-purple-100 p-1.5">
                            <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Alamat</p>
                            <p class="text-sm text-gray-600">Jl. Rama No. 6, Mengwi, Badung</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Stats & Newsletter -->
            <div>
                <h3 class="mb-6 text-sm font-semibold uppercase tracking-wider text-gray-900">Statistik</h3>
                <div class="rounded-xl bg-gradient-to-br from-cyan-500 to-emerald-600 p-5">
                    <div class="mb-4 flex items-center justify-between">
                        <h4 class="text-sm font-semibold text-white">Penerima Aktif</h4>
                        <span class="rounded-full bg-blue-600 px-2.5 py-1 text-xs font-bold text-white">
                            {{ $totalBeneficiaries }}
                        </span>
                    </div>
                    <p class="text-xs text-white">
                        Data terbaru {{ now()->format('d M Y') }}
                    </p>

                    <!-- Newsletter -->
                    <div class="mt-6">
                        <p class="mb-3 text-sm font-medium text-white">Update Terbaru</p>
                        <form class="flex gap-2">
                            <input type="email" placeholder="Email anda..."
                                class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                            <button type="submit"
                                class="rounded-lg bg-emerald-300 px-4 py-2 text-sm font-medium text-emerald-800 shadow-md transition-all hover:from-blue-600 hover:to-blue-700 hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 border-t border-gray-200 pt-8">
            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                <div class="text-center md:text-left">
                    <p class="text-sm text-gray-600">
                        © {{ date('Y') }} Mengwi SmartGov. Hak Cipta Dilindungi.
                    </p>
                    <p class="mt-1 text-xs text-gray-500">
                        Sistem ini dikembangkan untuk mendukung keterbukaan informasi secara digital.
                    </p>
                </div>

                <div class="flex items-center gap-6">
                    <a href="https://mengwi-badung.desa.id"
                        class="text-xs text-gray-500 hover:text-gray-900 hover:underline">
                        Website Desa Mengwi
                    </a>
                    <a href="https://badungkab.go.id" class="text-xs text-gray-500 hover:text-gray-900 hover:underline">
                        Pemerintah Kabupaten Badung
                    </a>
                    <a href="https://ppid.mengwi-badung.desa.id"
                        class="text-xs text-gray-500 hover:text-gray-900 hover:underline">
                        PPID
                    </a>
                    <a href="#" class="text-xs text-gray-500 hover:text-gray-900 hover:underline">
                        Peta Situs
                    </a>
                    <a href="{{ url('/admin/login') }}"
                        class="text-xs text-gray-500 hover:text-gray-900 hover:underline">
                        Admin Login
                    </a>
                </div>
            </div>

            <!-- Back to top button -->
            <div class="mt-6 flex justify-center">
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="group flex items-center gap-2 rounded-full bg-gradient-to-r from-gray-100 to-gray-200 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:from-gray-200 hover:to-gray-300 hover:shadow-md">
                    <svg class="h-4 w-4 transition-transform group-hover:-translate-y-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                    Kembali ke Atas
                </button>
            </div>
        </div>
    </div>
</footer>
{{-- END FOOTER AREA --}}
