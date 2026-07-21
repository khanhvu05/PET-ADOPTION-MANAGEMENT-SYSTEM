@php
    $isHome = request()->is('/');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="color-scheme: light;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PetJam') }} - @yield('title', $autoPageTitle ?? 'Trang chủ')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Custom Fonts & Base styling */
        body {
            font-family: 'Be Vietnam Pro', 'Inter';
            background-color: #FAFAFA;
            color: #1D2B53;
            /* Subtle paw background pattern */
            background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 100 100' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath opacity='0.02' d='M46.7 27.6C44.9 24.6 46.1 19.8 49.6 16.9C53 14 57.5 14 59.3 17C61.1 20 59.9 24.8 56.4 27.7C52.9 30.6 48.5 30.6 46.7 27.6ZM31.1 40.5C28.2 38.6 27.5 34.3 29.5 31.1C31.5 27.9 35.4 26.9 38.3 28.8C41.2 30.7 41.9 35 39.9 38.2C37.9 41.4 34 42.4 31.1 40.5ZM71.2 26.5C73.6 24.3 74 20.3 72.1 17.5C70.2 14.7 66.8 14.1 64.4 16.3C62 18.5 61.6 22.5 63.5 25.3C65.4 28.1 68.8 28.7 71.2 26.5ZM80.6 40.4C83.5 38.3 84 33.9 81.8 30.7C79.6 27.5 75.6 26.6 72.7 28.7C69.8 30.8 69.3 35.2 71.5 38.4C73.7 41.6 77.7 42.5 80.6 40.4ZM64.5 44.4C60.5 40.2 53.6 39.3 49 41.8C45.3 43.8 41.7 47.9 41.2 53C40.6 59 44.4 64.6 49.8 67C55.2 69.4 62.5 68.2 66.8 63.5C71 58.8 71.3 51.5 64.5 44.4Z' fill='%23F58A3C'/%3E%3C/svg%3E");
        }

        /* Colors */
        .text-primary { color: #F58A3C; }
        .text-secondary { color: #0AA5C0; }
        .text-dark { color: #1D2B53; }
        .text-muted { color: #5A6474; }
        .bg-primary { background-color: #F58A3C; }
        .bg-secondary { background-color: #0AA5C0; }
        .bg-beige { background-color: #FFF5EF; }

        /* Buttons & Badges */
        .btn-primary {
            background-color: #F58A3C; color: white; border-radius: 8px;
            padding: 10px 24px; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 0 4px 14px rgba(245, 138, 60, 0.4); transition: transform 0.2s;
        }
        .btn-primary:hover { transform: translateY(-2px); }
        .btn-outline-teal {
            border: 2px solid #0AA5C0; color: #0AA5C0; border-radius: 8px;
            padding: 8px 24px; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s;
        }
        .btn-outline-teal:hover { background-color: #0AA5C0; color: white; }
        
        .badge-orange { background-color: #F58A3C; color: white; border-radius: 999px; padding: 4px 16px; font-size: 12px; font-weight: 800; }
        .badge-teal { background-color: #0AA5C0; color: white; border-radius: 999px; padding: 4px 16px; font-size: 12px; font-weight: 800; }
        
        /* Layouts */
        .pet-card {
            background: white; border-radius: 24px; padding: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.02); transition: transform 0.3s ease;
        }
        .pet-card:hover { transform: translateY(-5px); }
        .pet-card-img { border-radius: 16px; width: 100%; height: 200px; object-fit: cover; }

        /* Shapes */
        .blob-orange {
            border-radius: 41% 59% 41% 59% / 46% 38% 62% 54%;
            background-color: #F58A3C;
        }

        /* Alternating Background Pattern */
        .bg-cute-pattern {
            position: relative;
            z-index: 1;
        }
        .bg-cute-pattern::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100vw;
            background-image: url('{{ asset('images/bg-pattern.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.8;
            z-index: -1;
            pointer-events: none;
        }

        /* Navigation */
        .nav-link { font-weight: 700; color: #1D2B53; font-size: 15px; position: relative; }
        .nav-link.active { color: #F58A3C; }
        .nav-link.active::after { content: ''; position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 24px; height: 3px; background-color: #F58A3C; border-radius: 2px; }
        .nav-link:hover { color: #F58A3C; }

        /* Donation Section Wavy background simulated with borders */
        .donation-section { background-color: #FFF6EF; border-radius: 0; position: relative; }
        
        .arrow-button {
            width: 40px; height: 40px; border-radius: 50%; background: white; border: 1px solid #eee; display: flex; align-items: center; justify-content: center; color: #0AA5C0; box-shadow: 0 4px 10px rgba(0,0,0,0.05); cursor: pointer;
        }
        @yield('styles')
    </style>
</head>
<body class="overflow-x-hidden relative pb-24 lg:pb-0" x-data="{ scrolled: false, accountMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 20)" :class="accountMenuOpen ? 'overflow-hidden' : ''">

<!-- Header -->
<header 
    :class="{ 
        'bg-transparent border-transparent': !scrolled, 
        'bg-[#FAFAFA]/90 backdrop-blur-md border-gray-100 shadow-sm': scrolled 
    }"
    class="w-full px-4 md:px-6 py-3 lg:px-10 flex justify-between items-center z-50 fixed top-0 left-0 transition-all duration-300 border-b border-transparent">
    
    <!-- Logo -->
    <div class="flex-1 flex justify-center md:justify-start">
        <a href="/" class="flex items-center gap-2.5">
            <img src="{{ asset('favicon.ico') }}" class="w-[40px] h-[40px] object-contain" alt="PETJAM">
            <div class="flex flex-col justify-center mt-0.5">
                <span class="font-black text-xl tracking-tighter leading-none flex items-center">
                    <span class="text-primary">PET</span><span class="text-dark">JAM</span>
                </span>
                <span class="text-[7px] text-muted tracking-widest font-black mt-0.5 uppercase">Animal Adoption & Rescue</span>
            </div>
        </a>
    </div>
    
    <!-- Desktop Nav -->
    <nav class="hidden lg:flex items-center gap-10 justify-center">
        <a href="/" class="nav-link {{ $isHome ? 'active' : '' }}">Trang Chủ</a>
        <a href="{{ route('frontend.about.index') }}" class="nav-link {{ request()->routeIs('frontend.about.index') ? 'active' : '' }}">Giới Thiệu</a>
        <a href="{{ route('frontend.adoptions.index') }}" class="nav-link {{ request()->routeIs('frontend.adoptions.*') ? 'active' : '' }}">Nhận Nuôi</a>
        {{-- <a href="{{ route('frontend.donations.index') }}" class="nav-link {{ request()->routeIs('frontend.donations.*') ? 'active' : '' }}">Ủng Hộ</a> --}}
        <a href="#" class="nav-link">Tin Tức</a>
    </nav>

    <!-- Auth Actions -->
    <div class="flex-1 hidden md:flex items-center justify-end gap-5">
        @auth
            <!-- Notification Bell -->
            <button class="relative p-2 text-gray-400 hover:text-primary transition-colors mt-1">
                <i data-lucide="bell" class="w-6 h-6"></i>
                <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
            </button>
            
            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="flex items-center gap-2 focus:outline-none group">
                    <img src="{{ auth()->user()->Anh_dai_dien ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->Ho_ten) . '&background=F58A3C&color=fff' }}" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm group-hover:border-orange-200 transition-colors" alt="Avatar">
                    <div class="hidden xl:block text-left">
                        <p class="text-[13px] font-bold text-dark leading-tight group-hover:text-primary transition-colors">{{ auth()->user()->Ho_ten }}</p>
                    </div>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 group-hover:text-primary transition-colors"></i>
                </button>
                
                <div x-show="open" x-transition.opacity.duration.200ms x-cloak class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                    <div class="px-4 py-2 border-b border-gray-50 mb-2">
                        <p class="text-[13px] font-bold text-dark">{{ auth()->user()->Ho_ten }}</p>
                        <p class="text-[11px] text-gray-500 truncate">{{ auth()->user()->Email }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-[13px] font-medium text-gray-600 hover:bg-orange-50 hover:text-primary transition-colors">
                        <i data-lucide="user" class="w-4 h-4"></i> Hồ sơ cá nhân
                    </a>
                    @if(!auth()->user()->hasAnyRole(['admin', 'staff']))
                    <a href="{{ route('frontend.user.adoptions.index') }}" class="flex items-center gap-2 px-4 py-2 text-[13px] font-medium text-gray-600 hover:bg-orange-50 hover:text-primary transition-colors">
                        <i data-lucide="history" class="w-4 h-4"></i> Lịch sử nhận nuôi
                    </a>
                    @endif
                    @if(auth()->user()->isStaff())
                    <a href="{{ route('admin.pets.index') }}" class="flex items-center gap-2 px-4 py-2 text-[13px] font-medium text-teal-600 hover:bg-teal-50 transition-colors border-t border-gray-50 mt-1 pt-2">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Trang quản trị
                    </a>
                    @endif
                    <div class="border-t border-gray-50 mt-2 pt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-[13px] font-medium text-red-600 hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn-outline-teal text-sm">Đăng Nhập</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-primary text-sm">Đăng Ký</a>
            @endif
        @endauth
    </div>
</header>

@yield('content')

<!-- Footer -->
<footer class="bg-[#0AA5C0] text-white pt-16 pb-8 px-6 lg:px-16 mt-10 relative z-10">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 border-b border-white/20 pb-12 mb-8">
        <!-- Col 1 -->
        <div class="lg:col-span-1 flex flex-col items-center md:items-start text-center md:text-left">
            <a href="/" class="flex items-center justify-center md:justify-start gap-3 mb-6">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1.5 shadow-sm">
                    <img src="{{ asset('favicon.ico') }}" class="w-full h-full object-contain" alt="PETJAM Logo">
                </div>
                <span class="font-black text-xl tracking-tight leading-none text-white">
                    PETJAM
                </span>
            </a>
            <p class="text-xs font-bold text-white/90 mb-6 leading-relaxed">Chung tay vì một thế giới tốt đẹp hơn cho thú cưng.</p>
            <div class="flex justify-center md:justify-start gap-2">
                <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-secondary transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-secondary transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
            </div>
        </div>

        <!-- Col 2 -->
        <div class="lg:col-span-1 flex flex-col items-center md:items-start text-center md:text-left">
            <h4 class="font-black mb-6 text-xs tracking-widest uppercase text-white">Về chúng tôi</h4>
            <ul class="space-y-3 text-xs font-bold text-white/90">
                <li><a href="{{ route('frontend.about.index') }}" class="hover:text-white transition-colors">Giới thiệu</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Sứ mệnh</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Đội ngũ</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Đối tác</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Liên hệ</a></li>
            </ul>
        </div>

        <!-- Col 3 -->
        <div class="lg:col-span-1 flex flex-col items-center md:items-start text-center md:text-left">
            <h4 class="font-black mb-6 text-xs tracking-widest uppercase text-white">Dịch vụ</h4>
            <ul class="space-y-3 text-xs font-bold text-white/90">
                <li><a href="{{ route('frontend.adoptions.index') }}" class="hover:text-white transition-colors">Nhận nuôi</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Cứu hộ</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Chăm sóc thú cưng</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Tư vấn</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Tin tức</a></li>
            </ul>
        </div>

        <!-- Col 4 -->
        <div class="lg:col-span-1 flex flex-col items-center md:items-start text-center md:text-left">
            <h4 class="font-black mb-6 text-xs tracking-widest uppercase text-white">Hỗ trợ</h4>
            <ul class="space-y-3 text-xs font-bold text-white/90">
                <li><a href="#" class="hover:text-white transition-colors">Câu hỏi thường gặp</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Chính sách bảo mật</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Điều khoản sử dụng</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Hướng dẫn</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Liên hệ</a></li>
            </ul>
        </div>

        <!-- Col 5 -->
        <div class="lg:col-span-1 flex flex-col items-center md:items-start text-center md:text-left">
            <h4 class="font-black mb-6 text-xs tracking-widest uppercase text-white">Đăng ký nhận tin</h4>
            <p class="text-xs font-bold text-white/90 mb-4 leading-relaxed">Nhận những thông tin mới nhất về các hoạt động.</p>
            <form class="flex w-full relative">
                <input type="email" placeholder="Nhập email của bạn" class="w-full px-4 py-3 bg-white rounded-full text-dark text-xs font-bold focus:outline-none pr-24 shadow-sm">
                <button type="submit" class="absolute right-1 top-1 bottom-1 px-4 bg-primary text-white font-black rounded-full text-xs transition-colors shadow-sm">
                    Đăng ký <svg class="inline-block w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>
    </div>
    
    <div class="text-center text-[10px] font-bold text-white/70 uppercase tracking-widest">
        &copy; {{ date('Y') }} PETJAM. All rights reserved.
    </div>
</footer>

<!-- Mobile Bottom Navigation -->
<nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 flex justify-around items-end h-[68px] shadow-[0_-5px_20px_rgba(0,0,0,0.05)] pb-2 pt-1 px-2 pb-safe" style="z-index: 10000;">
    <a href="/" class="flex flex-col items-center justify-center gap-1 w-1/5 text-gray-400 hover:text-primary transition-colors">
        <svg class="w-5 h-5 {{ $isHome ? 'text-primary' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <span class="text-[9px] font-bold {{ $isHome ? 'text-primary' : '' }}">Trang chủ</span>
    </a>
    
    <a href="{{ route('frontend.about.index') }}" class="flex flex-col items-center justify-center gap-1 w-1/5 text-gray-400 hover:text-primary transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="text-[9px] font-bold">Giới thiệu</span>
    </a>
    
    @php
        $isAdoption = request()->routeIs('frontend.adoptions.*');
    @endphp
    <div class="relative w-1/5 flex justify-center">
        <a href="{{ route('frontend.adoptions.index') }}" class="absolute bottom-1 flex flex-col items-center justify-center gap-1 hover:text-primary transition-colors group">
            <div class="w-[50px] h-[50px] rounded-full {{ $isAdoption ? 'bg-primary' : 'bg-[#F58A3C]' }} flex items-center justify-center text-white shadow-[0_8px_20px_rgba(245,138,60,0.3)] border-[4px] border-white transform transition-transform group-hover:-translate-y-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
            </div>
            <span class="text-[9px] font-black text-primary whitespace-nowrap mt-0.5">Nhận nuôi</span>
        </a>
    </div>

    <a href="#" class="flex flex-col items-center justify-center gap-1 w-1/5 text-gray-400 hover:text-primary transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path></svg>
        <span class="text-[9px] font-bold">Tin tức</span>
    </a>
    
    <button @click="accountMenuOpen = true" class="flex flex-col items-center justify-center gap-1 w-1/5 text-gray-400 hover:text-primary transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        <span class="text-[9px] font-bold">Tài khoản</span>
    </button>
</nav>

<!-- Mobile Bottom Sheet cho Tài khoản -->
<div class="lg:hidden" x-show="accountMenuOpen" style="display: none;">
    <!-- Overlay mờ kính -->
    <div x-show="accountMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="accountMenuOpen = false"
         class="fixed inset-0 bg-slate-900/40 z-[10000] backdrop-blur-sm"></div>

    <!-- Panel trắng trượt từ dưới lên, bo góc tròn -->
    <div x-show="accountMenuOpen" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed bottom-0 left-0 right-0 z-[10001] bg-white rounded-t-[2rem] shadow-[0_-10px_40px_rgba(0,0,0,0.1)] p-6 pb-10 flex flex-col gap-4">
        
        <!-- Thanh gạt để đóng -->
        <div class="w-14 h-1.5 bg-gray-200 rounded-full mx-auto mb-2 cursor-pointer" @click="accountMenuOpen = false"></div>
        
        <h3 class="text-xl font-bold text-slate-800 text-center mb-2">Tài khoản</h3>
        
        @if (auth()->check())
            <!-- User Profile Card (Simplified & Modern) -->
            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl mb-4">
                <!-- Avatar -->
                <div class="w-14 h-14 rounded-full flex-shrink-0 bg-gradient-to-br from-[#0AA5C0] to-[#088d9c] shadow-inner text-white flex items-center justify-center text-xl font-bold">
                    @if(auth()->user()->Anh_dai_dien)
                        <img src="{{ asset('storage/'.auth()->user()->Anh_dai_dien) }}" class="w-full h-full rounded-full object-cover" alt="{{ auth()->user()->Ho_ten ?: auth()->user()->Email }}">
                    @else
                        {{ mb_strtoupper(mb_substr(auth()->user()->Ho_ten ?: auth()->user()->Email, 0, 1)) }}
                    @endif
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-[17px] truncate">{{ auth()->user()->Ho_ten ?: explode('@', auth()->user()->Email)[0] }}</div>
                    <div class="text-[13px] text-slate-500 truncate">{{ auth()->user()->Email }}</div>
                </div>
            </div>
            
            <!-- Menu Items -->
            <div class="flex flex-col mb-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-between py-3.5 px-2 border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <i data-lucide="user" class="w-5 h-5 text-slate-500"></i>
                        <span class="text-[15px] font-medium text-slate-700">Thông tin cá nhân</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </a>
                
                @if(auth()->user()->isStaff())
                    <a href="{{ route('admin.pets.index') }}" class="flex items-center justify-between py-3.5 px-2 border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 text-[#0AA5C0]"></i>
                            <span class="text-[15px] font-medium text-slate-700">Trang quản trị</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    </a>
                @else
                    <a href="{{ route('frontend.user.adoptions.index') }}" class="flex items-center justify-between py-3.5 px-2 border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <i data-lucide="history" class="w-5 h-5 text-[#F58A3C]"></i>
                            <span class="text-[15px] font-medium text-slate-700">Lịch sử nhận nuôi</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    </a>
                @endif
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 p-3.5 rounded-xl bg-[#e75e5b] text-white font-semibold hover:bg-red-500 transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    Đăng xuất
                </button>
            </form>
        @else
            <!-- Guest Profile Card -->
            <div class="flex flex-col items-center justify-center p-6 bg-slate-50 rounded-2xl mb-4">
                <div class="w-16 h-16 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 mb-3">
                    <i data-lucide="user" class="w-8 h-8"></i>
                </div>
                <h4 class="font-bold text-slate-800 text-lg mb-1">Chào mừng bạn</h4>
                <p class="text-center text-[13px] text-slate-500 px-2">Vui lòng đăng nhập để sử dụng đầy đủ tính năng.</p>
            </div>
            
            <div class="flex flex-col gap-3 w-full">
                <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 p-3.5 rounded-xl bg-[#0AA5C0] text-white font-semibold hover:bg-[#088d9c] transition-colors">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    Đăng nhập
                </a>
                <a href="{{ route('register') }}" class="w-full flex items-center justify-center gap-2 p-3.5 rounded-xl bg-white text-[#F58A3C] font-semibold hover:bg-orange-50 transition-colors border border-[#F58A3C]/30">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                    Tạo tài khoản mới
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Global Toast Notification System -->
<div x-data="toastComponent()" 
     x-on:notify.window="add($event.detail)"
     class="fixed flex flex-col gap-3 pointer-events-none w-full"
     style="bottom: 24px; right: 24px; max-width: 350px; z-index: 9999;">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.visible"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             class="pointer-events-auto relative overflow-hidden border shadow-lg p-4 flex items-start gap-3"
             :class="{
                 'bg-emerald-600 border-emerald-700 text-white': toast.type === 'success',
                 'bg-red-600 border-red-700 text-white': toast.type === 'error',
                 'bg-amber-500 border-amber-600 text-white': toast.type === 'warning',
                 'bg-blue-600 border-blue-700 text-white': toast.type === 'info',
             }"
             style="border-radius: 12px;">
            
            <!-- Icon -->
            <div class="shrink-0 rounded-full p-1"
                 :class="{
                     'bg-emerald-700 text-white': toast.type === 'success',
                     'bg-red-700 text-white': toast.type === 'error',
                     'bg-amber-600 text-white': toast.type === 'warning',
                     'bg-blue-700 text-white': toast.type === 'info',
                 }">
                <svg x-show="toast.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <svg x-show="toast.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <svg x-show="toast.type === 'warning'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <svg x-show="toast.type === 'info'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>

            <!-- Message -->
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-medium leading-snug" x-text="toast.message"></p>
            </div>

            <!-- Close Button -->
            <button type="button" @click="remove(toast.id)" class="shrink-0 opacity-70 hover:opacity-100 transition-opacity p-1 -m-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Progress Bar -->
            <div class="absolute bottom-0 left-0 h-1 bg-black/20 w-full">
                <div class="h-full transition-all duration-75 ease-linear bg-white/80"
                     :style="`width: ${toast.progress}%`"></div>
            </div>
        </div>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toastComponent', () => ({
            toasts: [],
            add(toast) {
                const id = Date.now();
                const newToast = {
                    id,
                    type: toast.type || 'info',
                    message: toast.message,
                    visible: true,
                    progress: 100,
                };
                this.toasts.push(newToast);

                const duration = 3000;
                const interval = 20;
                const step = (100 / (duration / interval));
                
                const timer = setInterval(() => {
                    const t = this.toasts.find(t => t.id === id);
                    if (t && t.progress > 0) {
                        t.progress -= step;
                    } else {
                        clearInterval(timer);
                    }
                }, interval);

                setTimeout(() => {
                    this.remove(id);
                }, duration);
            },
            remove(id) {
                const toast = this.toasts.find(t => t.id === id);
                if (toast) {
                    toast.visible = false;
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 300);
                }
            }
        }));
    });
</script>

<script>
    lucide.createIcons();
</script>
@if (!request()->routeIs('login', 'register'))
    @include('components.chatbox-widget')
@endif
@yield('scripts')
</body>
</html>
