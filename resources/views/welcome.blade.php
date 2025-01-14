<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mengwi SmartGov || Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url({{ asset('assets/bg-mengwi-jadoel-1.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="font-inter p-4 w-screen h-screen">
    <div class="w-full h-full flex  justify-center items-center ">


        <div class="max-w-3xl p-8 space-y-9 bg-white  rounded-lg dark:bg-gray-800 shadow-lg animate-zoomIn">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mengwi SmartGov App
                </h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Platform
                satu pintu untuk mengakses layanan pemerintahan desa. Sederhanakan interaksi Anda dengan pemerintah,
                akses informasi penting, dan tetap terhubung dengan komunitas Anda.</p>
            <a href="{{ url(env('APP_URL') . '/admin/login') }}"
                class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white text-center bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                Masuk
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        <div
            class="flex row items-center space-x-3 bg-white px-3 py-2 rounded-full absolute bottom-5 left-5 animate-zoomIn">
            <div class="flex row items-center space-x-2">
                <img src="{{ asset('assets/mengwidev-bk.png') }}" alt="mengwidev_logo" class="w-6">
                <span class="font-bold text-md">mengwidev Team</span>
            </div>
            <div><span class="font-bold text-lg">//</span></div>
            <a href="https://github.com/mengwidev" target="_blank">
                <div class="flex row items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="text-md">@mengwidev</span>
                </div>
            </a>
        </div>

    </div>
</body>

</html>
