<aside 
    class="flex flex-col bg-sidebar-blue shadow-lg transition-all duration-300 ease-in-out shrink-0 h-full relative z-20 text-white"
    :class="expanded ? 'w-64' : 'w-20'"
>
    <!-- Sidebar Header (Logo + Toggle) -->
    <div class="h-20 flex items-center px-4 shrink-0 transition-all duration-300" :class="expanded ? 'justify-between' : 'justify-center'">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 overflow-hidden">
            <!-- White Squircle -->
            <div class="w-[38px] h-[38px] bg-white rounded-[12px] flex items-center justify-center shrink-0 shadow-sm">
                <!-- Authentic Paw Icon -->
                <svg class="w-6 h-6 text-sidebar-blue" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.88 12.7c-1.3-.92-3.48-.6-5.23.09-1.28.5-2.52.5-3.77-.01-1.74-.7-3.9-.99-5.18-.08-1.5 1.05-1.65 3.14-.38 4.73 1.34 1.67 3.38 2.57 5.56 2.57h.44c2.18 0 4.22-.9 5.56-2.57 1.27-1.59 1.12-3.68-.38-4.73z"/>
                    <circle cx="6.5" cy="9.5" r="2.2"/>
                    <circle cx="10" cy="5.5" r="2.2"/>
                    <circle cx="15.5" cy="6" r="2.2"/>
                    <circle cx="18.5" cy="10" r="2.2"/>
                </svg>
            </div>
            <div class="flex flex-col" x-show="expanded">
                <span class="text-[20px] font-black tracking-tight text-white leading-none">PetAdoption</span>
                <span class="text-[10.5px] font-bold text-white/70 tracking-[0.22em] uppercase mt-1">Admin Panel</span>
            </div>
        </a>

        <!-- Toggle Button -->
        <button 
            @click="expanded = !expanded" 
            class="absolute -right-3.5 top-7 bg-sidebar-blue border border-white/20 rounded-full p-1 text-white/70 hover:text-white hover:bg-white/10 transition-colors shadow-sm"
        >
            <svg class="w-4 h-4 transition-transform duration-300" :class="expanded ? 'rotate-0' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto px-3 pb-4 custom-scrollbar">
        
        <!-- SECTION: TỔNG QUAN -->
        <div class="mt-4 mb-2">
            <h3 x-show="expanded" class="px-3 text-[10px] font-bold text-white/50 uppercase tracking-widest">Tổng Quan</h3>
            <div x-show="!expanded" class="h-4 border-b border-white/10 mx-4 mb-4"></div>
        </div>
        
        <div class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white font-medium' }}"
               :class="!expanded && 'justify-center px-0'"
            >
                <svg class="w-[22px] h-[22px] shrink-0 {{ request()->routeIs('dashboard') ? 'text-orange-brand' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="text-[13px] truncate" x-show="expanded">Dashboard</span>
            </a>

            <!-- Thú Cưng -->
            <a href="#" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-white/80 hover:bg-white/10 hover:text-white font-medium group"
               :class="!expanded && 'justify-center px-0'"
            >
                <svg class="w-[22px] h-[22px] shrink-0 text-white/80 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 5h2a6 6 0 0 1 6 6v2a6 6 0 0 1 -6 6h-2a6 6 0 0 1 -6 -6v-2a6 6 0 0 1 6 -6z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 15h2M10 11h.01M14 11h.01"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5 13c-1.657 0 -3 -1.343 -3 -3c0 -1.657 1.343 -3 3 -3"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 13c1.657 0 3 -1.343 3 -3c0 -1.657 -1.343 -3 -3 -3"></path>
                </svg>
                <span class="text-[13px] truncate" x-show="expanded">Thú Cưng</span>
            </a>

            <!-- Đơn Nhận Nuôi -->
            <a href="#" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-white/80 hover:bg-white/10 hover:text-white font-medium group"
               :class="!expanded && 'justify-center px-0'"
            >
                <svg class="w-[22px] h-[22px] shrink-0 text-white/80 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-[13px] truncate" x-show="expanded">Đơn Nhận Nuôi</span>
            </a>
        </div>

        <!-- SECTION: QUẢN LÝ -->
        <div class="mt-6 mb-2">
            <h3 x-show="expanded" class="px-3 text-[10px] font-bold text-white/50 uppercase tracking-widest">Quản Lý</h3>
            <div x-show="!expanded" class="h-4 border-b border-white/10 mx-4 mb-4"></div>
        </div>

        <div class="space-y-1">


            <!-- Quyên Góp -->
            <a href="#" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-white/80 hover:bg-white/10 hover:text-white font-medium group"
               :class="!expanded && 'justify-center px-0'"
            >
                <svg class="w-[22px] h-[22px] shrink-0 text-white/80 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="text-[13px] truncate" x-show="expanded">Quyên Góp</span>
            </a>

            <!-- Bài Viết -->
            <a href="#" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-white/80 hover:bg-white/10 hover:text-white font-medium group"
               :class="!expanded && 'justify-center px-0'"
            >
                <svg class="w-[22px] h-[22px] shrink-0 text-white/80 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="text-[13px] truncate" x-show="expanded">Bài Viết</span>
            </a>

            <!-- Người Dùng (formerly Profile, but matching image labels) -->
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('profile.edit') ? 'bg-white/15 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white font-medium' }}"
               :class="!expanded && 'justify-center px-0'"
            >
                <svg class="w-[22px] h-[22px] shrink-0 {{ request()->routeIs('profile.edit') ? 'text-orange-brand' : 'text-white/80 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-[13px] truncate" x-show="expanded">Người Dùng</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 shrink-0 mt-auto">
        <!-- Back to Website Button matching the image style -->
        <a href="/" 
           class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl border border-white/20 bg-white/5 hover:bg-white/15 text-white font-bold transition-colors group"
           :class="!expanded && 'px-0'"
           title="Quay về trang web"
        >
            <svg class="w-[22px] h-[22px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-[13px]" x-show="expanded">Quay về trang web</span>
        </a>
    </div>
</aside>

<style>
/* Hide scrollbar for sidebar but allow scroll */
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 4px;
}
.custom-scrollbar:hover::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3);
}
</style>
