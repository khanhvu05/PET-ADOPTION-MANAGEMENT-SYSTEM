<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PETJAM') }} - @yield('title', 'Xác thực')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-bg-dark text-white min-h-screen relative flex flex-col items-center justify-center p-2">

    <!-- Back Button (Top Left) -->
    <a href="/" class="absolute top-6 left-6 z-20 flex items-center gap-2 px-4 py-2 bg-black/40 hover:bg-black/60 rounded-sm text-white text-sm font-bold transition-all duration-200 backdrop-blur-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Về trang chủ
    </a>

    <!-- Main Content Wrapper -->
    <div class="relative z-10 w-full max-w-[460px] flex flex-col items-center">
        <!-- Logo Area (Outside Card) -->
        <div class="mb-6 text-center flex flex-col items-center">
            <div class="flex items-center gap-2">
                <!-- Favicon Logo Icon -->
                <img src="{{ asset('favicon.ico') }}" alt="Logo" class="w-7 h-7">
                <h1 class="text-3xl font-black tracking-tight text-white leading-none">
                    Pet<span class="text-orange-brand">Jam</span>
                </h1>
            </div>
            <p class="mt-2 text-text-muted text-[11px] font-bold tracking-wide">Cùng hàng ngàn người yêu thú cưng tạo nên sự khác biệt</p>
        </div>

        <!-- Dark Solid Card -->
        <div class="w-full bg-card-dark rounded-[24px] px-8 py-8 border border-white/5 shadow-2xl">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
