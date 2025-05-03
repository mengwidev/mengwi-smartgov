@props([
    'title' => null,
    'description' => null,
    'headerColor' => 'bg-slate-800 text-white', // tailwind utility classes
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-lg shadow-md']) }}>
    @if ($title || $description)
        <div class="px-4 py-3 {{ $headerColor }}">
            @if ($title)
                <h2 class="text-sm font-semibold leading-tight">{{ $title }}</h2>
            @endif
            @if ($description)
                <p class="text-xs opacity-80 leading-snug">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="bg-white px-4 py-4 space-y-3">
        {{ $slot }}
    </div>
</div>
