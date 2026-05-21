<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl tracking-tight text-[#18181B] dark:text-zinc-100">
            Tổng quan hệ thống
        </h2>
    </x-slot>

    <!-- Main Content Area -->
    <div class="space-y-6">
        
        <!-- Welcome Card -->
        <div class="bg-white dark:bg-zinc-900 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px] overflow-hidden">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-[#EDF3EC] dark:bg-emerald-950/30 flex items-center justify-center text-[#346538] dark:text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-lg text-[#18181B] dark:text-zinc-100">Xin chào, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Bạn đã đăng nhập thành công vào hệ thống quản lý PetAdoption.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Cards (Dummy Layout for structure) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-zinc-900 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px] p-6 flex flex-col justify-between h-32">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-400">Tổng số hồ sơ</span>
                <div class="flex items-end justify-between">
                    <span class="font-serif text-4xl leading-none text-[#18181B] dark:text-zinc-100">12</span>
                    <span class="text-xs text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 px-2 py-1 rounded-[4px]">+2 hôm nay</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-zinc-900 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px] p-6 flex flex-col justify-between h-32">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-400">Đơn nhận nuôi</span>
                <div class="flex items-end justify-between">
                    <span class="font-serif text-4xl leading-none text-[#18181B] dark:text-zinc-100">5</span>
                    <span class="text-xs text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 px-2 py-1 rounded-[4px]">Chờ duyệt</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-zinc-900 border border-[#EAEAEA] dark:border-zinc-800 rounded-[6px] p-6 flex flex-col justify-between h-32">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-400">Người dùng mới</span>
                <div class="flex items-end justify-between">
                    <span class="font-serif text-4xl leading-none text-[#18181B] dark:text-zinc-100">8</span>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400 px-2 py-1">Tuần này</span>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
