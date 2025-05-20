<div class="m-4 mx-auto max-w-3xl space-y-6 rounded-lg bg-white p-6 shadow-lg">
    <h2 class="text-2xl font-bold">Public Info Request</h2>

    @if (session()->has('message'))
        <div class="rounded bg-green-100 p-2 text-green-800">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        {{-- === APPLICANT INFO === --}}
        <div class="space-y-2 rounded p-4 shadow-sm">
            <h3 class="mb-2 font-semibold">Applicant Information</h3>

            <input type="text" wire:model="applicant_name" placeholder="Full Name"
                class="w-full rounded border border-gray-200 px-3 py-2">
            <input type="text" wire:model="applicant_address" placeholder="Address"
                class="w-full rounded border border-gray-200 px-3 py-2">
            <input type="text" wire:model="applicant_phone" placeholder="Phone"
                class="w-full rounded border border-gray-200 px-3 py-2">
            <input type="email" wire:model="applicant_email" placeholder="Email"
                class="w-full rounded border border-gray-200 px-3 py-2">

            <select wire:model="applicant_identifier_method_id" class="w-full rounded border border-gray-200 px-3 py-2">
                <option value="">-- Select Identifier Type --</option>
                @foreach ($identifierMethods as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

            <input type="text" wire:model="applicant_identifier_value" placeholder="Identifier Value (e.g., NIK)"
                class="w-full rounded border border-gray-200 px-3 py-2">
            <input type="file" wire:model="applicant_identifier_attachment" accept=".jpg,.jpeg,.png,.pdf"
                class="rounded-lg border border-gray-200">
            @error('applicant_identifier_attachment')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        {{-- === APPLICATION INFO === --}}
        <div class="space-y-2 rounded p-4 shadow-sm">
            <h3 class="mb-2 font-semibold">Application Information</h3>

            <textarea wire:model="information_requested" class="w-full rounded border border-gray-200 px-3 py-2"
                placeholder="What info is being requested?"></textarea>
            <textarea wire:model="information_purposes" class="w-full rounded border border-gray-200 px-3 py-2"
                placeholder="What is the purpose of this info?"></textarea>

            <select wire:model="information_receival_id" class="w-full rounded border border-gray-200 px-3 py-2">
                <option value="">-- Select Receival Method --</option>
                @foreach ($receivals as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

            <label class="mt-2 flex items-center space-x-2">
                <input type="checkbox" wire:model="is_get_copy">
                <span>Request Copy?</span>
            </label>

            <input type="text" wire:model="get_copy_method" class="w-full rounded border border-gray-200 px-3 py-2"
                placeholder="Copy Delivery Method">
            <textarea wire:model="note" class="w-full rounded border border-gray-200 px-3 py-2" placeholder="Note (Optional)"></textarea>
        </div>

        <button class="rounded bg-green-600 px-4 py-2 text-white" type="submit">
            Send Application
        </button>
    </form>
</div>
