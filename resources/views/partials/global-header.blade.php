<!-- Global Header -->
<header
    class="sticky top-0 z-50 w-full border-b border-white bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!-- Left: Logo & Navigation -->
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a class="flex items-center gap-3" href="{{ url('/') }}">
                    <div class="flex h-10 w-10 items-center justify-center">
                        <img src="{{ asset('assets/desa-mengwi.png') }}" alt="logo desa mengwi" class="w-12" />
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Mengwi <span
                                class="text-emerald-600">Smart</span>Gov
                        </h1>
                        <p class="text-xs text-gray-500">Pemerintah Desa Mengwi</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                {{-- <nav class="hidden items-center gap-6 md:flex">
                    <a href="{{ url('/') }}"
                        class="text-sm font-medium text-blue-600 transition-colors hover:text-blue-800">
                        <div class="flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </div>
                    </a>

                    <a href="{{ url('/beneficiaries') }}"
                        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Penerima
                    </a>

                    <a href="{{ url('/reports') }}"
                        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan
                    </a>
                </nav> --}}
            </div>

            <!-- Right: User & Actions -->
            <div class="flex items-center gap-4">

                <!-- Search (Desktop) -->
                {{-- <div class="relative hidden lg:block">
                    <div class="relative">
                        <input type="text" placeholder="Cari penerima, banjar, NIK..."
                            class="w-64 rounded-lg border border-gray-300 py-2 pl-10 pr-4 text-sm transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div> --}}

                <!-- Notifications -->
                {{-- <div class="relative">
                    <button type="button"
                        class="relative rounded-lg p-2 text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900"
                        id="notifications-button">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span
                            class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-medium text-white">
                            3
                        </span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div class="absolute right-0 mt-2 hidden w-80 origin-top-right rounded-xl border border-gray-200 bg-white p-4 shadow-xl"
                        id="notifications-dropdown">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                            <button class="text-sm text-blue-600 hover:text-blue-800">Tandai semua terbaca</button>
                        </div>

                        <div class="space-y-3">
                            <!-- Notification Item -->
                            <div class="rounded-lg bg-blue-50 p-3">
                                <div class="flex items-start gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                        <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Data baru ditambahkan</p>
                                        <p class="text-xs text-gray-600">5 penerima baru dari Banjar Bungkulan</p>
                                        <p class="mt-1 text-xs text-gray-500">2 menit yang lalu</p>
                                    </div>
                                </div>
                            </div>

                            <!-- More notifications... -->
                        </div>

                        <a href="{{ url('/notifications') }}"
                            class="mt-4 block text-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div> --}}

                <!-- User Menu -->
                <div class="relative">
                    @auth
                        {{-- <!-- Authenticated User -->
                        <button type="button"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors hover:bg-gray-100"
                            id="user-menu-button">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-blue-600">
                                <span class="text-sm font-medium text-white">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="hidden text-left lg:block">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->role->name ?? 'Administrator' }}</p>
                            </div>
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- User Dropdown Menu -->
                        <div class="absolute right-0 mt-2 hidden w-56 origin-top-right rounded-xl border border-gray-200 bg-white p-2 shadow-xl"
                            id="user-dropdown">
                            <div class="px-3 py-2">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            <a href="{{ url('/profile') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil Saya
                            </a>

                            <a href="{{ url('/settings') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Pengaturan
                            </a>

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div> --}}
                        <!-- Login Button - VISIBLE AND PROMINENT -->
                        <div class="flex hidden items-center gap-3 lg:block">
                            <a href="{{ url('/admin/beneficiaries') }}"
                                class="group relative inline-flex items-center gap-2 overflow-hidden rounded-lg bg-lime-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl active:scale-95">
                                {{-- reserved for icon --}}
                                <span class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </span>

                                <span>Edit Data</span>
                                <div
                                    class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                                    <div class="relative h-full w-8 bg-white/20"></div>
                                </div>
                            </a>

                        </div>
                    @else
                        <!-- Login Button - VISIBLE AND PROMINENT XX -->
                        <div class="flex hidden items-center gap-3 md:block">
                            <a href="{{ url('/admin/login') }}"
                                class="group relative inline-flex items-center gap-2 overflow-hidden rounded-lg bg-lime-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl active:scale-95">
                                <span class="relative">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                </span>
                                <span>Masuk</span>
                                <div
                                    class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                                    <div class="relative h-full w-8 bg-white/20"></div>
                                </div>
                            </a>

                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <button type="button"
                    class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 md:hidden"
                    id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="hidden border-t border-gray-200 py-4 md:hidden" id="mobile-menu">
            <div class="space-y-1">
                {{-- <a href="{{ url('/') }}"
                    class="flex items-center gap-3 rounded-lg bg-blue-50 px-4 py-3 text-sm font-medium text-blue-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ url('/beneficiaries') }}"
                    class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Penerima Bantuan
                </a>

                <a href="{{ url('/reports') }}"
                    class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Laporan
                </a> --}}
                @auth
                    <!-- Login Button - VISIBLE AND PROMINENT -->
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/admin/beneficiaries') }}"
                            class="group relative inline-flex w-full items-center justify-center gap-2 overflow-hidden rounded-lg bg-lime-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl active:scale-95">
                            {{-- reserved for icon --}}
                            <span class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </span>

                            <span>Edit Data</span>
                            <div
                                class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                                <div class="relative h-full w-8 bg-white/20"></div>
                            </div>
                        </a>

                    </div>
                @endauth

                @guest
                    <div class="pt-4">
                        <a href="{{ url('/admin/login') }}"
                            class="block w-full rounded-lg bg-lime-600 px-4 py-3 text-center text-sm font-semibold text-white shadow-lg">
                            Masuk ke Akun
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>
