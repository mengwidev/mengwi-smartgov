<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $micrositePage->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <!-- Main Container -->
    <div class="max-w-xl mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">

        <!-- Page Logo and Title -->
        <div class="flex flex-col items-center space-x-4 mb-6">
            @if($micrositePage->logo)
                <img src="{{ asset('storage/' . $micrositePage->logo) }}" alt="Logo" class="w-16 mb-5 object-cover">
            @endif
            <h1 class="text-3xl font-bold text-gray-900">{{ $micrositePage->title }}</h1>
        </div>

        <!-- Page Description -->
        <p class="text-lg text-gray-700 leading-relaxed mb-6 text-center">
            {{ $micrositePage->description }}
        </p>

        <!-- Associated Links Section -->
        @if($micrositePage->link->count())
            <div>
                <ul class="space-y-4">
                    @foreach($micrositePage->link as $link)
                        <div class="space-x-4">
                            <a href="{{ $link->destination_link }}">
                                <li class="max-w-lg mx-auto flex items-center  p-4 bg-slate-200 rounded-md shadow-sm hover:bg-slate-300 transition">
                                    @if($link->logo)
                                        <img src="{{ asset('storage/' . $link->logo) }}" alt="{{ $link->title }}" class="w-10 object-cover rounded-md me-2">
                                    @endif
                                    <div class="flex-1">
                                        <p class="text-lg font-medium text-gray-700">{{ $link->title }}</p>
                                        {{-- <p>Link : {{ $link->destination_link }}</p> --}}
                                    </div>
                                </li>
                            </a>
                        </div>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-gray-500 text-center">No links available for this Microsite Page.</p>
        @endif

    </div>
</body>
</html>