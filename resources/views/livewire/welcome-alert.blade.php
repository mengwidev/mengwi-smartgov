<div class="rounded-lg overflow-hidden shadow-lg max-w-4xl">
    <!-- top bar -->
    <div class="bg-slate-800 p-2">
        <!-- button wrapper -->
        <div class="flex space-x-3 ms-4">
            <!-- buttons -->
             <a href="https://mengwi-badung.desa.id">
                 <div class="w-3 h-3 rounded-full bg-red-600"></div>
             </a>
            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
            <div class="w-3 h-3 rounded-full bg-green-400"></div>
        </div>
    </div>
    <!-- message wrapper -->
    <div class="bg-white px-10 py-6 space-y-12 opacity-80">
        <div>
            <!-- brand -->
            <div class="flex items-center space-x-2">
                <!-- logo -->
                <img
                    src="{{ asset('assets/desa-mengwi.png') }}"
                    alt="logo desa mengwi"
                    class="w-14"
                />
                <!-- brand name -->
                <div>
                    <h1 class="text-xl font-semibold">Mengwi SmartGov App</h1>
                    <h2>Pemerintah Desa Mengwi</h2>
                </div>
            </div>
            <!-- message -->
            <div>
                <p class="mt-8">
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
                <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-12 py-2 text-center me-2 mb-2">Mulai</button>
            </a>
        </div>
    </div>
</div>
