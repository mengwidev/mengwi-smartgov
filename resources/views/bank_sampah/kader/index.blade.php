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
                <select name="banjar_id" id="banjar" class="border rounded-md px-3 py-1">
                    <option value="">Semua</option>
                    @foreach($banjars as $banjar)
                        <option value="{{ $banjar->id }}" {{ request('banjar_id') == $banjar->id ? 'selected' : '' }}>
                            {{ $banjar->nama_banjar }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
            </form>
        </div>
        {{-- FILTER BANJAR END --}}
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
                            No data available
                        </td>
                    </tr>
                @else
                    @foreach ($kader as $kaders)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-3 py-3 flex justify-center space-x-2">
                                <a href="{{ route('bank_sampah.kader.edit', $kaders->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-2 py-1 rounded">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                {{-- <button type="button" class="bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $kaders->id }}">
                                    <i class="bi bi-trash"></i>
                                </button> --}}
                            </td>
                            <td class="px-3 py-3">
                                {{ $kaders->nama }}
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
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this link? This action cannot be undone.
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
    <!-- Delete Confirmation Modal End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#deleteModal"]').forEach(button => {
            button.addEventListener('click', function () {
                var kaderId = button.getAttribute('data-id');
                var deleteForm = document.getElementById('deleteForm');
                deleteForm.action = '/bank_sampah/kader/' + kaderId;
                deleteModal.show();
            });
        });
    </script>
</x-app-layout>