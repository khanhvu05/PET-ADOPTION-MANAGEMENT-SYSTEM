<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PetAdoption') }} - Bảng Điều Khiển</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#18181B] dark:text-zinc-100 bg-[#FBFBFA] dark:bg-zinc-950 overflow-hidden">
        
        <!-- Alpine State wrapper for layout -->
        <div x-data="{ expanded: true }" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            @include('layouts.partials.admin-sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
                <!-- Mobile Header Overlay (if needed in future) -->
                
                <!-- Page Heading (Optional) -->
                @isset($header)
                    <header class="border-b border-[#EAEAEA] dark:border-zinc-800 bg-white dark:bg-zinc-950/50 backdrop-blur-md sticky top-0 z-10">
                        <div class="px-6 py-4 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Main Scrollable Area -->
                <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

    </body>
</html>
