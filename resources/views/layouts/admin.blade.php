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
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="font-sans antialiased text-slate-900 bg-[#F4F7F6] overflow-hidden">
        
        <!-- Alpine State wrapper for layout -->
        <div x-data="{ expanded: true }" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            @include('layouts.partials.admin-sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
                <!-- Mobile Header Overlay (if needed in future) -->
                
                <!-- Top Header -->
                <header class="h-14 border-b border-slate-200 bg-white sticky top-0 z-10 shrink-0 flex items-center justify-between px-6 lg:px-8">
                    <!-- Left side: Breadcrumb -->
                    <div class="flex items-center text-sm font-medium">
                        @if (isset($header))
                            {{ $header }}
                        @else
                            <span class="text-slate-500">Tổng Quan</span>
                            <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="text-orange-brand">Dashboard</span>
                        @endif
                    </div>

                    <!-- Right side: Search & Profile -->
                    <div class="flex items-center gap-5">
                        <!-- Search Bar -->
                        <div class="relative hidden md:block">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" placeholder="Search..." class="w-64 h-9 pl-10 pr-12 bg-slate-50/50 border border-slate-200/80 rounded-full text-sm focus:outline-none focus:border-orange-brand focus:ring-2 focus:ring-orange-brand/20 text-slate-700 placeholder-slate-400 transition-all shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none">
                                <span class="text-[10px] text-slate-400 font-medium border border-slate-200/80 bg-white rounded-full px-1.5 py-0.5 shadow-sm">⌘K</span>
                            </div>
                        </div>

                        <!-- Notification Icon -->
                        <button class="relative w-10 h-10 rounded-full bg-slate-50/50 border border-slate-200/80 flex items-center justify-center text-slate-500 hover:text-orange-brand hover:bg-slate-100 transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-2 right-2.5 w-2 h-2 rounded-full bg-red-500 border-2 border-white"></span>
                        </button>

                        <!-- User Avatar -->
                        <button class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200/80 ring-2 ring-transparent hover:ring-orange-brand/20 flex items-center justify-center overflow-hidden shrink-0 transition-all shadow-sm cursor-pointer relative group">
                            <!-- Placeholder image or initial -->
                            <span class="text-sm font-bold text-slate-600 group-hover:text-orange-brand transition-colors">AD</span>
                            <div class="absolute inset-0 rounded-full ring-1 ring-inset ring-black/5"></div>
                        </button>
                    </div>
                </header>

                <!-- Main Scrollable Area -->
                <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
