@extends('layouts.idcard')

@section('title', $employee->name)

@section('content')
    <div class="max-w-md mx-auto p-4">
        @if ($employee->photo)
            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}"
                class="w-32 h-32 object-cover mx-auto rounded-lg border border-gray-200 shadow mb-4">
        @endif

        <h1 class="text-xl font-bold text-center mb-2">
            {{ $employee->prefix_title ? $employee->prefix_title . '.' : '' }}
            {{ $employee->name }}
            {{ $employee->suffix_title ?? '' }}
        </h1>

        <div class="flex flex-col gap-4 mt-4">
            {{-- INFORMASI KEPEGAWAIAN --}}
            <x-info-section title="Informasi Kepegawaian" headerColor="bg-slate-600 text-white">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Instansi</h3>
                    <p class="text-sm text-gray-600">Pemerintah Desa Mengwi</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Jabatan</h3>
                    @if ($employee->employeeLevel->name === 'Perbekel' || $employee->employeeLevel->name === 'Sekretaris Desa')
                        <p class="text-sm text-gray-600">{{ $employee->employeeLevel->name }} Desa Mengwi</p>
                    @else
                        <p class="text-sm text-gray-600">{{ $employee->employeeLevel->name }}</p>
                    @endif
                </div>

                @if ($employee->employeeLevel->name !== 'Perbekel' && $employee->employeeLevel->name !== 'Sekretaris Desa')
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700">Unit Kerja</h3>
                        <p class="text-sm text-gray-600">{{ $employee->employmentUnit->name }}</p>
                    </div>
                @endif
            </x-info-section>

            {{-- INFORMASI KONTAK --}}
            @php
                use Illuminate\Support\Str;

                $whatsapp = null;
                $email = null;
                $website = null;
            @endphp

            <x-info-section title="Informasi Kontak" description="Informasi kontak dan sosial media pegawai"
                headerColor="bg-slate-600 text-white">

                {{-- LOST AND FOUND WARNING --}}
                <div class="w-full p-4 rounded-lg border border-red-300 bg-red-50 text-red-800 text-sm">
                    <h4 class="text-center font-bold text-red-700 mb-2">⚠️ PERHATIAN ⚠️</h4>
                    <p class="text-justify leading-relaxed">
                        Jika Anda menemukan kartu pegawai ini, mohon segera hubungi kontak yang tertera di bawah.
                        Kartu ini merupakan identitas resmi Pemerintah Desa Mengwi.
                    </p>
                </div>

                {{-- Loop through contacts and extract types --}}
                @foreach ($employee->contacts as $contact)
                    @php
                        $type = Str::lower(trim($contact->contactType->name));
                        $value = trim($contact->value);
                    @endphp

                    {{-- Show each contact item --}}
                    <div class="mb-3">
                        <h3 class="text-sm font-semibold text-gray-700">{{ $contact->contactType->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $value }}</p>
                    </div>

                    {{-- Extract to specific variable only if value is not empty --}}
                    @if ($type === 'whatsapp' && !empty($value))
                        @php $whatsapp = preg_replace('/[^0-9]/', '', $value); @endphp
                    @elseif ($type === 'email' && filter_var($value, FILTER_VALIDATE_EMAIL))
                        @php $email = $value; @endphp
                    @elseif ($type === 'website' && filter_var($value, FILTER_VALIDATE_URL))
                        @php $website = $value; @endphp
                    @endif
                @endforeach

                {{-- Only show if at least one valid contact method is available --}}
                @if ($whatsapp || $email || $website)
                    <div class="flex flex-col gap-2 w-full items-center justify-center text-sm font-bold mt-4">
                        @if ($whatsapp)
                            <a href="https://wa.me/62{{ $whatsapp }}" target="_blank"
                                class="flex justify-between items-center px-4 py-2 w-full bg-green-600 rounded-lg text-white hover:bg-green-700 transition">
                                <span>Kirim WhatsApp</span>
                                <div class="p-1 aspect-square rounded-full">
                                    <x-heroicon-o-arrow-right class="size-6" />
                                </div>
                            </a>
                        @endif

                        @if ($email)
                            <a href="mailto:{{ $email }}"
                                class="flex justify-between items-center px-4 py-2 w-full bg-amber-500 rounded-lg text-white hover:bg-amber-600 transition">
                                <span>Kirim Email</span>
                                <div class="p-1 aspect-square rounded-full">
                                    <x-heroicon-o-arrow-right class="size-6" />
                                </div>
                            </a>
                        @endif

                        @if ($website)
                            <a href="{{ $website }}" target="_blank"
                                class="flex justify-between items-center px-4 py-2 w-full bg-indigo-500 rounded-lg text-white hover:bg-indigo-600 transition">
                                <span>Kunjungi Website</span>
                                <div class="p-1 aspect-square rounded-full">
                                    <x-heroicon-o-arrow-right class="size-6" />
                                </div>
                            </a>
                        @endif
                    </div>
                @endif

            </x-info-section>

            {{-- INFORMASI PRIBADI --}}
            <x-info-section title="Informasi Pribadi" headerColor="bg-slate-600 text-white">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Alamat</h3>
                    <p class="text-sm text-gray-600">Br. {{ $employee->banjar->name }}, Mengwi, Badung</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Jenis Kelamin</h3>
                    <p class="text-sm text-gray-600">{{ $employee->gender->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Tempat/Tgl. Lahir</h3>
                    <p class="text-sm text-gray-600">{{ $employee->birthplace }},
                        {{ \Carbon\Carbon::parse($employee->birthdate)->translatedFormat('d F Y') }}</p>
                </div>
            </x-info-section>

            {{-- INFORMASI LAINNYA --}}
            <x-info-section title="Informasi Keputusan Pengangkatan" headerColor="bg-slate-600 text-white">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">SK Pengangkatan</h3>
                    <p class="text-sm text-gray-600">Surat Keputusan {{ $employee->tipe_sk }}</p>
                    <p class="text-sm text-gray-600">Nomor {{ $employee->nomor_sk }}</p>
                    <p class="text-sm text-gray-600">Tahun {{ $employee->tahun_sk }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">SK Ditetapkan Pada Tanggal</h3>
                    <p class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($employee->sk_ditetapkan_pada)->translatedFormat('d F Y') }}</p>
                </div>
                @if ($employee->employeeLevel->name == 'Perbekel')
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700">Mulai Masa Jabatan</h3>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($employee->mulai_menjabat)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700">Akhir Masa Jabatan</h3>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($employee->akhir_menjabat)->translatedFormat('d F Y') }}</p>
                    </div>
                @endif
            </x-info-section>
        </div>
    </div>
@endsection
