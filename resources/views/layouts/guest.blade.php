<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PetAdoption') }} - Xác thực</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600&family=Geist+Mono:wght@400;500;600&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-[#18181B] dark:text-zinc-100 antialiased bg-[#FBFBFA] dark:bg-zinc-950">
    <!-- Subtle Top Navbar just to match landing -->
    <div class="absolute top-0 w-full px-6 py-6 lg:px-12 flex justify-start items-center">
        <a href="/" class="flex items-center gap-3 hover:opacity-80 transition duration-150">
            <div class="w-8 h-8 rounded-full bg-[#18181B] dark:bg-zinc-100 flex items-center justify-center">
                <div class="w-3 h-3 rounded-full bg-[#FBFBFA] dark:bg-zinc-950"></div>
            </div>
            <span class="font-serif text-2xl tracking-tight leading-none pt-1">PetAdoption</span>
        </a>
    </div>

    <!-- Main Authentication Container (Shadcn/Minimalist UI style) -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-24 sm:pt-0">
        <!-- Auth Card Container -->
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white dark:bg-zinc-900 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px]">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
