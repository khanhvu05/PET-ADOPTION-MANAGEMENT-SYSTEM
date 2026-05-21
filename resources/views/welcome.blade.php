<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PetAdoption - Mái ấm cho thú cưng</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600&family=Geist+Mono:wght@400;500;600&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#FBFBFA] dark:bg-zinc-950 text-[#18181B] dark:text-zinc-100 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navigation -->
    <header class="w-full px-6 py-6 lg:px-12 flex justify-between items-center border-b border-[#EAEAEA] dark:border-zinc-900/60 relative z-20">
        <div class="flex items-center gap-3">
            <!-- Simple clean logo shape -->
            <div class="w-8 h-8 rounded-full bg-[#18181B] dark:bg-zinc-100 flex items-center justify-center">
                <div class="w-3 h-3 rounded-full bg-[#FBFBFA] dark:bg-zinc-950"></div>
            </div>
            <span class="font-serif text-2xl tracking-tight leading-none pt-1">PetAdoption</span>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center gap-6 font-mono text-[10px] sm:text-[11px] uppercase tracking-widest font-medium">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-zinc-500 hover:text-[#18181B] dark:text-zinc-400 dark:hover:text-zinc-100 transition duration-150">Bảng điều khiển</a>
                @else
                    <a href="{{ route('login') }}" class="text-zinc-500 hover:text-[#18181B] dark:text-zinc-400 dark:hover:text-zinc-100 transition duration-150 hidden sm:inline-block">Đăng nhập</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px] hover:bg-[#18181B] hover:text-[#FBFBFA] dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition duration-150">Tạo tài khoản</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Main Hero Section -->
    <main class="flex-grow flex items-center justify-center relative overflow-hidden px-6 lg:px-12 py-20 lg:py-0">
        
        <!-- Decorative subtle spot color element -->
        <div class="absolute top-1/2 right-0 -translate-y-1/2 translate-x-1/3 w-[600px] h-[600px] lg:w-[800px] lg:h-[800px] bg-[#EDF3EC] dark:bg-emerald-950/20 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-6xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8 items-center relative z-10">
            <!-- Text Content -->
            <div class="space-y-8">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-400 block border-l-2 border-[#18181B] dark:border-zinc-100 pl-3">
                    Hệ thống nhận nuôi thú cưng
                </span>
                
                <h1 class="font-serif text-6xl lg:text-7xl xl:text-8xl tracking-tight text-[#18181B] dark:text-zinc-100 leading-[0.95]">
                    Tìm kiếm một người bạn đồng hành.
                </h1>
                
                <p class="text-sm text-zinc-500 dark:text-zinc-400 font-sans font-light leading-relaxed max-w-md">
                    Kết nối những trái tim ấm áp với những sinh mệnh bé nhỏ đang cần một mái nhà. Khám phá, nhận nuôi và trao yêu thương ngay hôm nay.
                </p>

                <div class="pt-4 flex flex-wrap items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#18181B] dark:bg-zinc-100 text-white dark:text-zinc-950 rounded-[6px] font-sans text-[11px] font-medium uppercase tracking-widest hover:bg-zinc-800 dark:hover:bg-zinc-200 active:scale-[0.98] transition duration-150">
                            Truy cập hệ thống
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#18181B] dark:bg-zinc-100 text-white dark:text-zinc-950 rounded-[6px] font-sans text-[11px] font-medium uppercase tracking-widest hover:bg-zinc-800 dark:hover:bg-zinc-200 active:scale-[0.98] transition duration-150">
                            Bắt đầu ngay
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 bg-transparent border border-[#EAEAEA] dark:border-zinc-800 text-[#18181B] dark:text-zinc-100 rounded-[6px] font-sans text-[11px] font-medium uppercase tracking-widest hover:bg-zinc-50 dark:hover:bg-zinc-900 active:scale-[0.98] transition duration-150">
                            Đăng nhập
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Hero Illustration (Minimalist SVG) -->
            <div class="relative w-full h-full min-h-[400px] flex items-center justify-center lg:justify-end">
                <div class="relative w-full max-w-[350px] lg:max-w-[450px] aspect-square">
                    <!-- Concentric structural circles -->
                    <div class="absolute inset-0 rounded-full border border-[#EAEAEA] dark:border-zinc-800/60 flex items-center justify-center">
                        <div class="w-[70%] h-[70%] rounded-full border border-[#EAEAEA] dark:border-zinc-800/60 flex items-center justify-center">
                            <!-- Spot pastel accent core -->
                            <div class="w-1/2 h-1/2 rounded-full bg-[#FDF6E2] dark:bg-yellow-950/20"></div>
                        </div>
                    </div>
                    
                    <!-- Line art pet -->
                    <svg class="absolute inset-0 w-full h-full text-[#18181B] dark:text-zinc-200 opacity-90 p-12 lg:p-16" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30 85 C30 55, 45 35, 55 35 C65 35, 75 55, 75 85" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M42 35 C38 20, 32 15, 25 18 C20 22, 33 33, 42 35 Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M68 35 C72 20, 78 15, 85 18 C90 22, 77 33, 68 35 Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="45" cy="50" r="1.5" fill="currentColor" />
                        <circle cx="65" cy="50" r="1.5" fill="currentColor" />
                        <path d="M50 58 Q55 62 60 58" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <!-- Ground line -->
                        <path d="M10 85 L90 85" stroke="currentColor" stroke-width="1" stroke-dasharray="2 4" />
                    </svg>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="w-full px-6 py-8 lg:px-12 border-t border-[#EAEAEA] dark:border-zinc-900/60 flex flex-col md:flex-row items-center justify-between gap-4 font-mono text-[10px] text-zinc-400 uppercase tracking-widest relative z-20">
        <div>&copy; {{ date('Y') }} PetAdoption System.</div>
        <div class="flex gap-4">
            <a href="#" class="hover:text-[#18181B] dark:hover:text-zinc-100 transition duration-150">Quy định</a>
            <a href="#" class="hover:text-[#18181B] dark:hover:text-zinc-100 transition duration-150">Bảo mật</a>
            <a href="#" class="hover:text-[#18181B] dark:hover:text-zinc-100 transition duration-150">Liên hệ</a>
        </div>
    </footer>
</body>
</html>
