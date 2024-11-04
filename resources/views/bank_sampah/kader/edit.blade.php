<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row gap-x-2 ">
            <a href="{{ route('bank_sampah.kader.index') }}">
                <h2 class="font-medium text-l text-gray-800 leading-tight">
                    {{ __('Kader Bank Sampah') }}
                </h2>
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>

            <h2 class="font-semibold text-l text-gray-800 leading-tight" :active="request()->routeIs('bank_sampah.kader.edit')">
                {{ __('Edit') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-6 text-gray-900">
                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Link Form -->
                    <form action="{{ route('bank_sampah.kader.update', $kader->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="kader_nama" class="block text-gray-700 font-medium">Nama</label>
                            <input type="text" name="nama" id="kader_nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $kader->nama }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="kader_jabatan" class="block text-gray-700 font-medium">Jabatan</label>
                            <select name="jabatan_id" id="kader_jabatan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($jabatan as $jabatans)
                                    <option value="{{ $jabatans->id }}" {{ $kader->jabatan_id == $jabatans->id ? 'selected' : '' }}>
                                        {{ $jabatans->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="kader_alamat" class="block text-gray-700 font-medium">Alamat</label>
                            <select name="banjar_id" id="kader_alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($banjar as $banjars)
                                    <option value="{{ $banjars->id }}" {{ $kader->banjar_id == $banjars->id ? 'selected' : '' }}>
                                        {{ $banjars->nama_banjar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-start space-x-3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Edit
                            </button>
                            <a href="{{ route('bank_sampah.kader.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
