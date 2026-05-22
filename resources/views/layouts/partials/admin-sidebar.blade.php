<aside 
    class="flex flex-col bg-sidebar-blue shadow-lg transition-all duration-300 ease-in-out shrink-0 h-full relative z-20 text-white"
    :class="expanded ? 'w-64' : 'w-20'"
>
    <!-- Sidebar Header (Logo + Toggle) -->
    <div class="h-16 flex items-center justify-between px-4 border-b border-white/10 shrink-0">
        <!-- Logo Area -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden" x-show="expanded" x-transition.opacity.duration.300ms>
            <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center shrink-0">
                <div class="w-3 h-3 rounded-full bg-white"></div>
            </div>
            <span class="font-serif text-xl tracking-tight leading-none pt-1 truncate">PetAdoption</span>
        </a>
        
        <!-- Collapsed Icon only -->
        <div class="w-full flex justify-center" x-show="!expanded" x-transition.opacity.duration.300ms style="display: none;">
            <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center shrink-0">
                <div class="w-3 h-3 rounded-full bg-white"></div>
            </div>
        </div>

        <!-- Toggle Button (Absolute to hover right edge, or simple inline) -->
        <button 
            @click="expanded = !expanded" 
            class="absolute -right-3.5 top-5 bg-sidebar-blue border border-white/20 rounded-full p-1 text-white/70 hover:text-white hover:bg-white/10 transition-colors shadow-sm"
        >
            <svg class="w-4 h-4 transition-transform duration-300" :class="expanded ? 'rotate-0' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 custom-scrollbar">
        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] transition-colors group {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white border-l-4 border-orange-brand shadow-sm font-bold' : 'text-white/70 hover:bg-white/10 hover:text-white' }}"
           :class="!expanded && 'justify-center px-0'"
           title="Bảng điều khiển"
        >
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span class="font-medium text-[13px] truncate" x-show="expanded">Bảng điều khiển</span>
        </a>

        <!-- Users Dummy Link -->
        <a href="#" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] transition-colors text-white/70 hover:bg-white/10 hover:text-white group"
           :class="!expanded && 'justify-center px-0'"
           title="Quản lý người dùng"
        >
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="font-medium text-[13px] truncate" x-show="expanded">Người dùng</span>
        </a>

        <!-- Pets Dummy Link -->
        <a href="#" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] transition-colors text-white/70 hover:bg-white/10 hover:text-white group"
           :class="!expanded && 'justify-center px-0'"
           title="Danh sách thú cưng"
        >
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium text-[13px] truncate" x-show="expanded">Hồ sơ thú cưng</span>
        </a>

        <!-- Profile Link -->
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] transition-colors group {{ request()->routeIs('profile.edit') ? 'bg-white/15 text-white border-l-4 border-orange-brand shadow-sm font-bold' : 'text-white/70 hover:bg-white/10 hover:text-white' }}"
           :class="!expanded && 'justify-center px-0'"
           title="Hồ sơ cá nhân"
        >
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium text-[13px] truncate" x-show="expanded">Hồ sơ cá nhân</span>
        </a>
    </nav>

    <!-- Sidebar Footer (Actions) -->
    <div class="p-3 border-t border-white/10 space-y-1 shrink-0">
        
        <!-- Back to main site -->
        <a href="/" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] transition-colors text-white/70 hover:bg-white/10 hover:text-white group"
           :class="!expanded && 'justify-center px-0'"
           title="Trang chủ"
        >
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium text-[13px] truncate" x-show="expanded">Quay lại website</span>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" 
               class="w-full flex items-center gap-3 px-3 py-2.5 rounded-[6px] transition-colors text-red-300 hover:bg-red-500/20 hover:text-red-200 group"
               :class="!expanded && 'justify-center px-0'"
               title="Đăng xuất"
            >
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium text-[13px] truncate" x-show="expanded">Đăng xuất</span>
            </button>
        </form>
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
