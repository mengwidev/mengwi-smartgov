@props([
    'text' => 'Button Text',
    'icon' => 'heroicon-o-arrow-down-tray',
    'color' => 'indigo',
    'href' => null,
])

@php
    $baseColor = $color . '-600';
    $hoverColor = $color . '-700';
    $iconColor = $color . '-500';

    $buttonClasses =
        'flex items-stretch overflow-hidden text-sm font-medium text-white transition duration-150 focus:outline-none sm:text-base';
    $iconClasses = "flex items-center justify-center bg-$iconColor px-3 rounded-l";
    $textClasses = "bg-$baseColor px-4 py-2 hover:bg-$hoverColor rounded-r";
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $buttonClasses }}">
        <span class="{{ $iconClasses }}">
            <x-dynamic-component :component="$icon" class="h-5 w-5" />
        </span>
        <span class="{{ $textClasses }}">
            {{ $text }}
        </span>
    </a>
@else
    <button type="button" class="{{ $buttonClasses }}">
        <span class="{{ $iconClasses }}">
            <x-dynamic-component :component="$icon" class="h-5 w-5" />
        </span>
        <span class="{{ $textClasses }}">
            {{ $text }}
        </span>
    </button>
@endif
