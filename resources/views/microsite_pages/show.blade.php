<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $micrositePage->title }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="flex flex-col min-h-screen relative bg-mengwi-jadoel0 bg-cover bg-no-repeat text-gray-800 antialiased font-figtree">

    <!-- Dark Overlay -->
    <div class="absolute min-h-screen inset-0 bg-black opacity-5"></div>

    <!-- Main Container -->
    <div class="flex-grow flex justify-center items-start p-3">
        <div
            class="max-w-xl bg-slate-100 shadow-lg rounded-lg bg-opacity-60 border-2 backdrop-blur-sm border-white mobile-sm:p-5">
            <!-- Page Logo and Title -->
            <div class="flex flex-col items-center gap-2 mobile-sm:space-x-0">
                @if ($micrositePage->logo)
                    <img src="{{ asset('storage/' . $micrositePage->logo) }}" alt="Logo"
                        class="w-16 h-auto object-contain mx-auto" loading="lazy">
                @endif
                <h1 class="text-3xl font-bold text-gray-900 mobile-sm:text-lg">{{ $micrositePage->title }}</h1>
            </div>

            <!-- Page Description -->
            {{-- <p
                class="text-lg text-gray-700 leading-relaxed text-center mobile-sm:text-sm mobile-sm:text-left mobile-sm:px-5">
                {{ $micrositePage->description }}
            </p> --}}

            <!-- Divider Line -->
            <hr class="border-t-1 border-gray-300 w-2/3 my-4 mx-auto">

            <!-- Associated Links Section -->
            @if ($micrositePage->link->count())
                <div>
                    <ul class="space-y-4">
                        @foreach ($micrositePage->link as $link)
                            <div class="space-x-4">
                                <a href="{{ $link->destination_link }}">
                                    <li
                                        class="max-w-lg mx-auto flex items-center py-4 px-6 bg-white rounded-full shadow-lg border-2 border-white hover:bg-slate-200 transition space-x-2">
                                        @if ($link->logo)
                                            <img src="{{ asset('storage/' . $link->logo) }}" alt="{{ $link->title }}"
                                                class="w-10 object-cover rounded-md me-2" loading="lazy">
                                        @else
                                            <svg class="w-6 h-6 text-slate-400" aria-hidden="true"
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
                                            <p class="text-lg font-medium text-gray-700 mobile-sm:text-sm">
                                                {{ $link->title }}</p>
                                        </div>
                                    </li>
                                </a>
                            </div>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-gray-500 text-center flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>No links available for this site.</span>
                </p>
            @endif
        </div>
    </div>
    <footer class="relative max-w-md mx-auto bg-white rounded-lg shadow-sm m-4">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center ">© 2025 <a href="https://mengwi-badung.desa.id/"
                    class="hover:underline">{{ config('app.author_org') }}</a>. All Rights Reserved.
            </span>
        </div>
    </footer>
</body>

</html>
