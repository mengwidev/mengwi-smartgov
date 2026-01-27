{{-- KPM DATA TABLE --}}
<div class="rounded-2xl bg-white p-6 shadow-lg">
    <div class="mb-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <h2 class="flex w-full gap-2 text-lg font-semibold text-gray-900 lg:w-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>

            Data Penerima Bantuan
        </h2>
        <div class="flex w-full flex-col justify-end gap-3 sm:flex-row sm:items-center sm:gap-4">

            <!-- Search -->
            <div class="relative w-full lg:w-1/2">
                <input type="text" id="search-input" placeholder="Cari nama atau NIK..."
                    class="w-full rounded-lg border border-gray-300 py-2 pl-10 pr-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Filters -->
            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                <select id="banjar-filter"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Banjar</option>
                    @foreach ($banjars as $banjar)
                        <option value="{{ $banjar->id }}">{{ $banjar->name }}</option>
                    @endforeach
                </select>

                <select id="assistance-filter"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Bantuan</option>
                    @foreach ($socialAssistances as $assistance)
                        <option value="{{ $assistance->id }}">{{ $assistance->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>

    </div>

    <p class="mb-4 text-xs italic text-gray-500 lg:hidden">Geser tabel ke kanan untuk melihat semua kolom</p>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        No.
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Nama Lengkap
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Banjar
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        NIK
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Jenis Kelamin
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Bantuan Diterima
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white" id="beneficiaries-table-body">
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div id="pagination-container"
        class="mt-4 flex w-full flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <!-- Info text (left) -->
        <div id="pagination-info" class="text-xs text-gray-600">
            <!-- Filled via AJAX -->
            Menampilkan 0-0 dari 0 data
        </div>

        <!-- Pagination links (right) -->
        <div id="pagination-links" class="flex w-full flex-wrap items-center justify-center gap-1 text-xs sm:text-sm">
            <!-- Filled via AJAX -->
        </div>
    </div>
</div>
{{-- END KPM DATA TABLE --}}
