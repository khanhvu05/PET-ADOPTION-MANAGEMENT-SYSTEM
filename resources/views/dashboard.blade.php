<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl tracking-tight text-slate-900">
            Tổng quan hệ thống
        </h2>
    </x-slot>

    <!-- Main Content Area -->
    <div class="space-y-6">
        
        <!-- Welcome Card -->
        <div class="bg-white border border-slate-200 rounded-[6px] shadow-sm overflow-hidden">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-sidebar-blue/10 flex items-center justify-center text-sidebar-blue">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-lg text-slate-900">Xin chào, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm text-slate-500">Bạn đã đăng nhập thành công vào hệ thống quản lý PetAdoption.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Cards (Dummy Layout for structure) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white border border-slate-200 rounded-[6px] shadow-sm p-6 flex flex-col justify-between h-32">
                <span class="font-mono text-[10px] uppercase tracking-widest text-slate-400">Tổng số hồ sơ</span>
                <div class="flex items-end justify-between">
                    <span class="font-serif text-4xl leading-none text-slate-900">12</span>
                    <span class="text-xs text-sidebar-blue bg-sidebar-blue/10 px-2 py-1 rounded-[4px] font-medium">+2 hôm nay</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white border border-slate-200 rounded-[6px] shadow-sm p-6 flex flex-col justify-between h-32">
                <span class="font-mono text-[10px] uppercase tracking-widest text-slate-400">Đơn nhận nuôi</span>
                <div class="flex items-end justify-between">
                    <span class="font-serif text-4xl leading-none text-slate-900">5</span>
                    <span class="text-xs text-orange-brand bg-orange-50 px-2 py-1 rounded-[4px] font-medium">Chờ duyệt</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border border-slate-200 rounded-[6px] shadow-sm p-6 flex flex-col justify-between h-32">
                <span class="font-mono text-[10px] uppercase tracking-widest text-slate-400">Người dùng mới</span>
                <div class="flex items-end justify-between">
                    <span class="font-serif text-4xl leading-none text-slate-900">8</span>
                    <span class="text-xs text-slate-500 bg-slate-50 px-2 py-1 rounded-[4px] font-medium">Tuần này</span>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
