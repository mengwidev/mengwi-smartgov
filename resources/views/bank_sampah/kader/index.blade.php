<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            {{ __('Kader Bank Sampah') }}
        </h2>
    </x-slot>
    
    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6 mt-4 bg-white py-4 rounded-lg">
        
        {{-- FILTER BANJAR --}}
        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('bank_sampah.kader.index') }}" class="flex items-center">
                <label for="banjar" class="mr-2">Filter by Banjar:</label>
                <select name="banjar_id" id="banjar" class="border rounded-md px-xl py-1">
                    <option value="">Semua</option>
                    @foreach($banjars as $banjar)
                        <option value="{{ $banjar->id }}" {{ request('banjar_id') == $banjar->id ? 'selected' : '' }}>
                            {{ $banjar->nama_banjar }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">Filter</button>
            </form>
        </div>
        
        {{-- Add Print Button --}}
        <div class="p-4 bg-gray-200 mb-4 flex flex-col rounded">
            <h1 class="mb-3 font-extrabold">Cetak Daftar</h1>
            <div>
                <button id="printList" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded me-2">Daftar Nama</button>
                <button id="printWages" class="bg-lime-600 hover:bg-lime-700 text-white px-3 py-1 rounded me-2" data-bs-toggle="modal" data-bs-target="#monthSelectModal">
                    Daftar Penerimaan
                </button>
                <button id="printPresence" class="bg-pink-600 hover:bg-pink-700 text-white px-3 py-1 rounded me-2">Daftar Hadir Kegiatan</button>
            </div>
        </div>

        {{-- DATA TABLE --}}
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-slate-400 text-white">
                    <th class="px-6 py-3 text-center">Aksi</th>
                    <th class="px-6 py-3 text-center">Nama</th>
                    <th class="px-6 py-3 text-center">Jabatan</th>
                    <th class="px-6 py-3 text-center">Alamat</th>
                </tr>
            </thead>
            <tbody>
                @if($kader->isEmpty())
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No data available for the selected filter.
                        </td>
                    </tr>
                @else
                    @foreach ($kader as $kaders)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-3 py-3 flex justify-center space-x-2">
                                <a href="{{ route('bank_sampah.kader.edit', $kaders->id) }}" class="bg-emerald-700 hover:bg-emerald-600 text-white px-2 py-1 rounded">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                            <td class="px-3 py-3">
                                {{ Str::title($kaders->nama) }}
                            </td>
                            <td class="px-3 py-3">
                                {{ $kaders->jabatan->nama_jabatan ?? 'N/A' }}
                            </td>
                            <td class="px-3 py-3">
                                {{ "Br. " . $kaders->banjar->nama_banjar ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{-- DATA TABLE END --}}
    </div>
    {{-- CONTENT END --}}

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Confirmation Modal END --}}
    
    {{-- Month Selection Confirmation Modal --}}
    <div class="modal fade" id="monthSelectModal" tabindex="-1" aria-labelledby="monthSelectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-m">
            <div class="flex flex-col modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="monthSelectModalLabel">Cetak Daftar Penerimaan Honor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{ route('bank_sampah.kader.print.wage') }}" class="space-y-4">
                        <div class="flex flex-col">
                            <label for="month" class="mb-2">Bulan :</label>
                            <select name="month_id" id="month" class="border rounded-md px-xl py-1">
                                <option value="">-Pilih Bulan-</option>
                                @foreach($months as $month)
                                    <option value="{{ $month->id }}" {{ request('month_id') == $month->id ? 'selected' : '' }}>
                                        {{ $month->nama_bulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex flex-col">
                            <label for="banjar" class="mb-2">Banjar :</label>
                            <select name="banjar_id" id="banjar" class="border rounded-md px-xl py-1">
                                <option value="">- Pilih Banjar -</option>
                                @foreach($banjars as $banjar)
                                    <option value="{{ $banjar->id }}" {{ request('banjar_id') == $banjar->id ? 'selected' : '' }}>
                                        {{ $banjar->nama_banjar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded mt-4">Print</button>
                    </form>
                </div>
            </div>            
        </div>
    </div>    
    {{-- Month Selection Confirmation Modal END --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Deletion script
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#deleteModal"]').forEach(button => {
            button.addEventListener('click', function () {
                var kaderId = button.getAttribute('data-id');
                var deleteForm = document.getElementById('deleteForm');
                deleteForm.action = '/bank_sampah/kader/' + kaderId;
                deleteModal.show();
            });
        });
        // Deletion script end

        // Print List Button (Daftar Nama)
        document.getElementById('printList').addEventListener('click', function() {
            const banjarId = '{{ request('banjar_id') }}';
            const url = '/bank_sampah/kader/print/list?banjar_id=' + banjarId;
            window.open(url, '_blank'); // Open the print view in a new tab
        });
    
        // Print Wage Button (Daftar Penerimaan)
        document.querySelector('#monthSelectModal button[type="submit"]').addEventListener('click', function(e) {
            e.preventDefault();
            const monthId = document.querySelector('#monthSelectModal #month').value;
            const banjarId = document.querySelector('#monthSelectModal #banjar').value;
            let url = '/bank_sampah/kader/print/wage?month_id=' + monthId + '&banjar_id=' + banjarId;
            window.open(url, '_blank');
        });
    </script>
</x-app-layout>
