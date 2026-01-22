<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $micrositePage->title }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-mengwi-jadoel0 relative flex min-h-screen flex-col bg-cover bg-no-repeat font-figtree text-gray-800 antialiased">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 min-h-screen bg-black opacity-5"></div>

    <!-- Main Container -->
    <div class="flex flex-grow items-start justify-center p-3">
        <div
            class="mobile-sm:p-4 max-w-xl rounded-lg border-2 border-white bg-slate-100 bg-opacity-60 p-8 shadow-lg backdrop-blur-sm">
            <!-- Page Logo and Title -->
            <div class="mobile-sm:space-x-0 flex flex-col items-center gap-2">
                @if ($micrositePage->logo)
                    <div class="aspect-square rounded-lg p-4">
                        <img src="{{ asset('storage/' . $micrositePage->logo) }}" alt="Logo"
                            class="mx-auto h-auto w-16 object-contain" loading="lazy">
                    </div>
                @endif
                <h1 class="mobile-sm:text-lg text-center text-2xl font-bold text-slate-600">{{ $micrositePage->title }}
                </h1>
            </div>

            <!-- Page Description -->
            {{-- <p
                class="mobile-sm:text-xs mobile-sm:text-left mobile-sm:px-5 mt-4 text-justify text-sm leading-relaxed text-gray-700">
                {{ $micrositePage->description }}
            </p> --}}

            <!-- Divider Line -->
            <hr class="border-t-1 mx-auto my-4 border-gray-300">

            <!-- Associated Links Section -->
            @if ($micrositePage->link->count())
                <div>
                    <ul class="space-y-4">
                        @foreach ($micrositePage->link as $link)
                            <div class="space-x-4">
                                <a href="{{ $link->destination_link }}">
                                    <li
                                        class="mx-auto flex max-w-lg items-center space-x-2 rounded-lg bg-slate-700 px-4 py-2 shadow-lg transition hover:bg-slate-600">
                                        @if ($link->logo)
                                            <img src="{{ asset('storage/' . $link->logo) }}" alt="{{ $link->title }}"
                                                class="me-2 w-10 rounded-md object-cover" loading="lazy">
                                        @else
                                            <svg class="m-2 h-8 w-8 text-slate-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        <div class="flex-1">
                                            <p class="mobile-sm:text-sm font-medium text-white">
                                                {{ $link->title }}</p>
                                        </div>
                                    </li>
                                </a>
                            </div>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="flex items-center justify-center space-x-2 text-center text-gray-500">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Silahkan tambahkan link pada site ini.</span>
                </p>
            @endif
        </div>
    </div>
    <div class="px-4 pt-4">
        <div class="m-4 mx-auto max-w-md rounded-lg bg-white shadow-sm">
            <div class="mx-auto w-full max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="text-xs text-gray-500 sm:text-center">© 2025 <a href="https://mengwi-badung.desa.id/"
                        class="hover:underline">{{ config('app.author_org') }}</a>. All Rights Reserved.
                </span>
            </div>
        </div>
    </div>
</body>

</html>
