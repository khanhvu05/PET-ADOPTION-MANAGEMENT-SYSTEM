<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PETJAM - Animal Adoption & Rescue</title>

    <!-- Google Fonts: Nunito mang lại cảm giác thân thiện, bo tròn giống chữ trong ảnh -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Tạo hình dạng khối nền ngẫu nhiên (Blob) giống trong ảnh */
        .blob-shape {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white text-slate-800 font-['Nunito',sans-serif] antialiased min-h-screen flex flex-col overflow-x-hidden">
    
    <!-- Navigation (Header) -->
    <header class="w-full px-6 py-6 lg:px-16 flex justify-between items-center z-20 bg-white">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-[52px] h-[52px] relative flex items-center justify-center text-[#f48c46]">
                <svg viewBox="0 0 100 100" class="w-full h-full" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <!-- Heart Background -->
                    <path d="M50 90 C 20 65, 5 40, 5 25 C 5 10, 30 5, 50 25 C 70 5, 95 10, 95 25 C 95 40, 80 65, 50 90 Z" />
                    <!-- Dog Face (Left) -->
                    <path d="M45 40 C 45 25, 20 25, 20 40 C 20 55, 45 55, 45 40 Z" fill="white" />
                    <circle cx="28" cy="38" r="2" fill="#3b2c28" />
                    <path d="M35 43 Q 32 45 29 43" stroke="#3b2c28" stroke-width="1.5" fill="none" />
                    <path d="M20 25 Q 15 20 25 30" stroke="white" stroke-width="4" fill="none" stroke-linecap="round"/>
                    <path d="M45 25 Q 50 20 40 30" stroke="white" stroke-width="4" fill="none" stroke-linecap="round"/>
                    <!-- Cat Face (Right) -->
                    <path d="M80 55 C 80 40, 55 40, 55 55 C 55 70, 80 70, 80 55 Z" fill="#d4b49c" />
                    <circle cx="63" cy="53" r="2" fill="#3b2c28" />
                    <circle cx="73" cy="53" r="2" fill="#3b2c28" />
                    <path d="M55 40 L 60 50 L 65 40 Z" fill="#d4b49c" />
                    <path d="M80 40 L 75 50 L 70 40 Z" fill="#d4b49c" />
                    <!-- Paw print hint -->
                    <path d="M85 20 C 85 20 95 15 90 25 Z" fill="#3b2c28" opacity="0.8"/>
                    <circle cx="82" cy="18" r="3" fill="#3b2c28" opacity="0.8" />
                    <circle cx="88" cy="15" r="3" fill="#3b2c28" opacity="0.8" />
                    <circle cx="94" cy="18" r="3" fill="#3b2c28" opacity="0.8" />
                </svg>
            </div>
            <div class="flex flex-col justify-center">
                <span class="font-black text-[28px] tracking-tight leading-none flex items-center">
                    <span class="text-[#3b2c28]">PET</span><span class="text-[#0489a9]">JAM</span>
                </span>
                <span class="text-[9px] text-gray-400 tracking-widest font-bold mt-1 uppercase">Animal Adoption & Rescue</span>
            </div>
        </div>
        
        <!-- Desktop Nav -->
        <nav class="hidden lg:flex items-center gap-8 text-[15px] font-bold text-slate-600">
            <a href="#" class="px-5 py-2 bg-[#f48c46] text-white rounded-md shadow-sm hover:bg-[#e07b35] transition">Trang Chủ</a>
            <a href="#" class="hover:text-[#f48c46] transition">Giới Thiệu</a>
            <a href="#" class="hover:text-[#f48c46] transition">Nhận Nuôi</a>
            <a href="#" class="hover:text-[#f48c46] transition">Ủng Hộ</a>
            <a href="#" class="hover:text-[#f48c46] transition">Tình Nguyện</a>
            <a href="#" class="hover:text-[#f48c46] transition">Tin Tức</a>
        </nav>

        <!-- Auth Actions -->
        @if (Route::has('login'))
            <div class="hidden md:flex items-center gap-4 text-[14px] font-bold">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 border border-[#f48c46] text-[#f48c46] rounded-md hover:bg-[#f48c46] hover:text-white transition">
                        Bảng điều khiển
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 border border-[#f48c46] text-slate-700 rounded-md hover:bg-[#f48c46] hover:text-white transition">
                        Đăng Nhập
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-[#f48c46] text-white rounded-md hover:bg-[#e07b35] shadow-md shadow-orange-500/20 transition">
                            Đăng ký
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </header>

    <!-- Main Hero Section -->
    <main class="flex-grow flex items-center justify-center relative px-6 lg:px-16 py-12 lg:py-0">
        <div class="w-full max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            
            <!-- Left: Text Content -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <h1 class="text-6xl lg:text-[76px] font-black leading-[1.1] tracking-tight">
                    <span class="text-slate-800">Looking for a</span><br />
                    <span class="text-[#f48c46]">Best friend ?</span>
                </h1>
                
                <p class="text-[17px] text-slate-500 font-semibold mt-2">
                    Our best beauties are waiting for a home
                </p>

                <div class="mt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex px-8 py-3.5 bg-[#f48c46] text-white rounded-[10px] text-[17px] font-bold hover:bg-[#e07b35] shadow-lg shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                            Truy cập hệ thống
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex px-8 py-3.5 bg-[#f48c46] text-white rounded-[10px] text-[17px] font-bold hover:bg-[#e07b35] shadow-lg shadow-orange-500/30 transition transform hover:-translate-y-0.5">
                            Adopt a pet
                        </a>
                    @endauth
                </div>

                <!-- Stats Section -->
                <div class="flex items-center gap-8 lg:gap-12 pt-10 mt-8">
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[22px] font-black text-slate-800">Pets</span>
                        <span class="text-[34px] font-black text-[#f48c46] mt-1 leading-none">2,300<span class="text-[#0489a9]">+</span></span>
                    </div>
                    <div class="w-[2px] h-14 bg-slate-200"></div>
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[22px] font-black text-slate-800">Adopted pets</span>
                        <span class="text-[34px] font-black text-[#f48c46] mt-1 leading-none">3452<span class="text-[#0489a9]">+</span></span>
                    </div>
                    <div class="w-[2px] h-14 bg-slate-200"></div>
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[22px] font-black text-slate-800">Clients</span>
                        <span class="text-[34px] font-black text-[#f48c46] mt-1 leading-none">1980<span class="text-[#0489a9]">+</span></span>
                    </div>
                </div>
            </div>

            <!-- Right: Illustration Area -->
            <div class="lg:col-span-7 relative w-full h-[500px] lg:h-[700px] flex items-end justify-center mt-12 lg:mt-0">
                
                <!-- Orange Background Blob -->
                <div class="absolute w-[85%] h-[85%] bg-[#f48c46] blob-shape -z-10 right-4 top-10"></div>
                
                <!-- Teal Decorative Blobs -->
                <div class="absolute top-10 left-12 w-8 h-12 bg-[#0489a9] rounded-full rotate-[-20deg] -z-10"></div>
                <div class="absolute top-14 left-[20%] w-10 h-10 bg-[#0489a9] rounded-[40%_60%_70%_30%/40%_50%_60%_50%] -z-10"></div>
                <div class="absolute top-20 right-10 w-16 h-16 bg-[#0489a9] rounded-[30%_70%_70%_30%/30%_30%_70%_70%] -z-10"></div>

                <!-- Pet Images Placeholder (Giả lập khoảng trống chứa đàn chó mèo) -->
                <div class="relative z-10 w-[95%] h-[80%] mb-10 flex items-end justify-center">
                    <div class="w-full h-full bg-white/30 backdrop-blur-sm border-4 border-dashed border-white rounded-[40px] flex flex-col items-center justify-center p-8 shadow-2xl">
                        <div class="flex gap-4 text-7xl mb-6">
                            <span>🐈</span>
                            <span>🐶</span>
                            <span>🐕</span>
                            <span>🐩</span>
                        </div>
                        <span class="text-slate-800 font-bold text-2xl text-center">
                            [ Khu Vực Chứa Hình Ảnh ]
                        </span>
                        <span class="text-slate-700 font-semibold text-[15px] mt-2 text-center max-w-sm">
                            Hãy xóa thẻ &lt;div&gt; chứa viền đứt nét này và thay bằng thẻ &lt;img src="..."&gt; chứa ảnh bầy chó mèo đã xóa phông nền (PNG).
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
