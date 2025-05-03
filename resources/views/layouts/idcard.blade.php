<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Employee Detail') | Pemerintah Desa Mengwi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-800 font-figtree bg-mengwi-jadoel0 bg-cover bg-no-repeat">

    <div class="min-h-screen flex flex-col justify-center p-4 gap-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-slate-800 text-white text-center py-4">
                <h1 class="text-xl font-bold tracking-wide">Detail Pegawai</h1>
            </div>

            <div class="p-3 space-y-4">
                @yield('content')
            </div>
        </div>

        <footer
            class="w-full max-w-md rounded-xl shadow-lg overflow-hidden p-4 bg-slate-500 text-white text-sm text-center">
            <p>&copy; 2025, Pemerintah Desa Mengwi</p>
            <a href="https://github.com/mengwidev" target="_blank">
                Mengwi Dev Team
            </a>
        </footer>
    </div>

</body>

</html>
