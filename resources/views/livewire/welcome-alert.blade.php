<div class="max-w-3xl overflow-hidden rounded-lg shadow-lg border border-white">
    <!-- top bar -->
    {{-- <div class="py-2 bg-slate-800">
        <!-- button wrapper -->
        <div class="flex space-x-2 ms-4">
            <!-- buttons -->
             <a href="https://mengwi-badung.desa.id">
                 <div class="w-3 h-3 bg-red-600 rounded-full"></div>
             </a>
            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
        </div>
    </div> --}}
    <!-- message wrapper -->
    <div class="p-10 space-y-8 bg-white opacity-80">
        <div>
            <!-- brand -->
            <div class="flex items-center space-x-2">
                <!-- logo -->
                <img src="{{ asset('assets/desa-mengwi.png') }}" alt="logo desa mengwi" class="w-12" />
                <!-- brand name -->
                <div>
                    <h1 class="text-xl font-semibold">Mengwi SmartGov App</h1>
                    <h2>Pemerintah Desa Mengwi</h2>
                </div>
            </div>
            <!-- message -->
            <div>
                <p class="mt-8 text-justify">
                    Selamat datang di Mengwi SmartGov, platform satu pintu untuk
                    mengakses layanan pemerintahan desa. Sederhanakan interaksi
                    Anda dengan pemerintah, akses informasi penting, dan tetap
                    terhubung dengan komunitas Anda.
                </p>
            </div>
        </div>
        <!-- cta button -->
        <div class="text-center">
            <a href="{{ url('/admin/login') }}">
                <button type="button"
                    class="px-8 py-2 text-sm font-medium text-center text-white rounded-lg bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300">Login
                    Admin</button>
            </a>
        </div>
    </div>
</div>
