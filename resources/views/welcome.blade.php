<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mengwi SmartGov || Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
</head>

<body class="w-screen h-screen p-4 font-figtree bg-mengwi-jadoel0 bg-cover bg-no-repeat">
    <div class="flex items-center justify-center w-full h-full ">
        <livewire:welcome-alert />
        <livewire:author-footer />
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
