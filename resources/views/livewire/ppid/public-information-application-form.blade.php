@section('title', $pageTitle)

<div class="bg-mengwi-jadoel0 bg-cover bg-no-repeat px-4 py-6 sm:px-6 md:px-10">
    <div class="mx-auto mb-6 max-w-3xl">
        <livewire:ppid-header />
    </div>

    <div class="mx-auto max-w-3xl overflow-hidden rounded-lg bg-white shadow-lg">
        <div class="space-y-4 bg-gray-200 px-4 py-6 sm:px-6 sm:py-8">
            <h2 class="text-2xl font-semibold text-gray-700">Formulir Permohonan Informasi Publik</h2>
            <p class="text-gray-600">
                Silakan lengkapi formulir berikut untuk mengajukan permohonan informasi publik kepada PPID Desa Mengwi.
                Data yang Anda berikan akan digunakan sebagai dasar untuk menindaklanjuti permohonan sesuai dengan
                peraturan yang berlaku.
            </p>
        </div>

        <div class="h-1 w-full bg-slate-300"></div>

        @if (session()->has('message'))
            <div class="px-4 py-4 sm:px-6">
                <div class="rounded bg-green-100 p-2 text-green-800">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <div class="overflow-y-auto px-4 py-6 sm:px-6 md:px-10">
            <form wire:submit.prevent="save" class="space-y-6">

                {{-- === INFORMASI PEMOHON === --}}
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">Informasi Pemohon</h3>
                    <p class="text-gray-600">
                        Informasi ini dibutuhkan untuk mengidentifikasi pemohon secara sah. Mohon isi data dengan benar
                        dan sesuai dengan dokumen identitas Anda.
                    </p>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" wire:model="applicant_name" placeholder="Nama Lengkap Sesuai KTP"
                            class="w-full rounded border border-gray-300 px-3 py-2" />
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">Alamat Tempat Tinggal</label>
                        <input type="text" wire:model="applicant_address" placeholder="Alamat Domisili"
                            class="w-full rounded border border-gray-300 px-3 py-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                            <input type="text" wire:model="applicant_phone" placeholder="Nomor WhatsApp/HP aktif"
                                class="w-full rounded border border-gray-300 px-3 py-2" />
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">Email Aktif</label>
                            <input type="email" wire:model="applicant_email" placeholder="Alamat Email"
                                class="w-full rounded border border-gray-300 px-3 py-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">Jenis Identitas</label>
                            <select wire:model="applicant_identifier_method_id"
                                class="w-full rounded border border-gray-300 px-3 py-2">
                                <option value="">-- Pilih Jenis Identitas --</option>
                                @foreach ($identifierMethods as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">Nomor Identitas</label>
                            <input type="text" wire:model="applicant_identifier_value"
                                placeholder="NIK / No. Identitas"
                                class="w-full rounded border border-gray-300 px-3 py-2" />
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">
                            Lampiran Salinan Identitas
                        </label>

                        <input type="file" wire:model="applicant_identifier_attachment" accept=".jpg,.jpeg,.png,.pdf"
                            class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-gray-200 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-300" />

                        @error('applicant_identifier_attachment')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror

                        <p class="mt-1 text-xs text-gray-500">
                            Format yang didukung: .jpg, .jpeg, .png, .pdf
                        </p>

                        @if ($applicant_identifier_attachment)
                            <p class="mt-1 text-sm text-gray-700">
                                File dipilih: {{ $applicant_identifier_attachment->getClientOriginalName() }}
                            </p>
                        @endif
                    </div>

                </div>

                <hr class="my-6 border-t border-gray-400" />

                {{-- === INFORMASI PERMOHONAN === --}}
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">Informasi yang Dimohonkan</h3>
                    <p class="text-gray-600">
                        Silakan uraikan jenis informasi yang dibutuhkan dan tujuan penggunaannya agar permohonan dapat
                        diproses sesuai ketentuan.
                    </p>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">Jenis Informasi yang
                            Dibutuhkan</label>
                        <textarea wire:model="information_requested" class="w-full rounded border border-gray-300 px-3 py-2" rows="3"
                            placeholder="Jelaskan secara spesifik informasi apa yang Anda perlukan..."></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">Tujuan Penggunaan
                            Informasi</label>
                        <textarea wire:model="information_purposes" class="w-full rounded border border-gray-300 px-3 py-2" rows="3"
                            placeholder="Sebutkan secara ringkas tujuan penggunaan informasi tersebut..."></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">Cara Mendapatkan Informasi</label>
                        <select wire:model.live="information_receival_id"
                            class="w-full rounded border border-gray-300 px-3 py-2">
                            <option value="">-- Pilih Cara Mendapatkan Informasi --</option>
                            @foreach ($receivals as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($this->shouldShowCopyMethod())
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">Metode Penerimaan Salinan
                                Informasi</label>
                            <select wire:model="get_copy_method"
                                class="w-full rounded border border-gray-300 px-3 py-2">
                                <option value="">-- Pilih Metode Salinan --</option>
                                <option value="Hardcopy">Salinan Fisik (Hardcopy)</option>
                                <option value="Softcopy">Salinan Elektronik (Softcopy)</option>
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">Catatan Tambahan
                            (Opsional)</label>
                        <textarea wire:model="note" class="w-full rounded border border-gray-300 px-3 py-2" rows="2"
                            placeholder="Jika ada informasi tambahan, silakan tuliskan di sini..."></textarea>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="mb-6 w-full rounded bg-blue-600 px-4 py-2 font-semibold text-white transition hover:bg-blue-700">
                        Kirim Permohonan Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mx-auto mt-6 max-w-3xl rounded-lg bg-white px-4 py-6 text-center shadow-lg sm:px-6">
        <livewire:ppid-footer />
    </div>
</div>
