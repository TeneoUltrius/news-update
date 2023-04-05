<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News Update</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @livewireStyles
    </head>

    <body class="bg-white">
    <header class="bg-gray-100 text-white py-6">
        <div class="container mx-auto">
{{--            <svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg" class="w-96 mx-auto">--}}
{{--                <rect x="0" y="0" width="200" height="50" fill="none"/>--}}
{{--                <text x="50%" y="30%" dominant-baseline="middle" text-anchor="middle" font-size="30" font-weight="bold" fill="rgb(14 116 144)" font-family="Arial, sans-serif" letter-spacing="-0.05em">News</text>--}}
{{--                <text x="50%" y="70%" dominant-baseline="middle" text-anchor="middle" font-size="30" font-weight="bold" fill="#212529" font-family="Arial, sans-serif" letter-spacing="-0.05em">Update</text>--}}
{{--            </svg>--}}
            <svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg" class="w-96 mx-auto">
                <rect x="0" y="0" width="200" height="50" fill="none" />
                <text x="50%" y="30%" dominant-baseline="middle" text-anchor="middle" font-size="30" font-weight="bold" fill="rgb(14 116 144)" font-family="Arial, sans-serif" letter-spacing="-0.05em">News</text>
                <text x="50%" y="70%" dominant-baseline="middle" text-anchor="middle" font-size="30" font-weight="bold" fill="#212529" font-family="Arial, sans-serif" letter-spacing="-0.05em">Update</text>
                <path d="M 30 10 L 50 10 L 50 40 L 30 40 Z" fill="#212529" />
                <path d="M 150 10 L 170 10 L 170 40 L 150 40 Z" fill="rgb(14 116 144)" />
            </svg>
        </div>
    </header>
    <main class="container mx-auto">

        <livewire:news-controller />

{{--    <livewire:steps-controller />--}}
{{--    <livewire:raw-news />--}}

    </main>
    @livewireScripts
    </body>
</html>
