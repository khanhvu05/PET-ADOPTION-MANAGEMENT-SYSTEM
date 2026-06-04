<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Quyên Góp</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Quản Lý Quyên Góp</h2>
                <p class="text-sm text-slate-500">Theo dõi và quản lý các khoản quyên góp ủng hộ cho thú cưng.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </button>
                <button class="bg-teal-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Quyên Góp
                </button>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            
            <!-- Card 1: Tổng Quyên Góp -->
            <x-admin.kpi-card 
                title="Tổng Quyên Góp" 
                value="32,450" 
                percent="15.7" 
            />

            <!-- Card 2: Số Giao Dịch -->
            <x-admin.kpi-card 
                title="Số Giao Dịch" 
                value="256" 
                percent="8.2" 
            />

            <!-- Card 3: Đã Xác Nhận -->
            <x-admin.kpi-card 
                title="Đã Xác Nhận" 
                value="220" 
                percent="9.1" 
            />

            <!-- Card 4: Chờ Xác Nhận -->
            <x-admin.kpi-card 
                title="Chờ Xác Nhận" 
                value="24" 
                percent="-4.0" 
            />

            <!-- Card 5: Hoàn/Đã Hủy -->
            <x-admin.kpi-card 
                title="Hoàn/Đã Hủy" 
                value="12" 
                percent="-2.3" 
            />

        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <!-- Filters Section -->
            <div class="p-6 pb-4 border-b border-slate-100 overflow-x-auto custom-scrollbar">
                <div class="flex gap-4 min-w-max items-end">
                    <!-- Search -->
                    <div class="w-64">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" placeholder="Tìm kiếm giao dịch, người ủng hộ..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm">
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="w-40">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Trạng thái</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Đã xác nhận</option>
                            <option>Chờ xác nhận</option>
                            <option>Đã hủy</option>
                        </select>
                    </div>

                    <div class="w-40">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Phương thức</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Chuyển khoản</option>
                            <option>MoMo</option>
                            <option>VNPay</option>
                        </select>
                    </div>

                    <div class="w-44">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Khoảng thời gian</label>
                        <div class="relative">
                            <input type="text" placeholder="Chọn thời gian" class="w-full pl-3 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-700">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 ml-auto">

                        <button class="px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 hover:shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Làm mới
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-[#f8fafc]">
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Mã GD</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Người Ủng Hộ</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Số Tiền</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Phương Thức</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Mục Đích</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Thời Gian</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Trạng Thái</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100 text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        <!-- Row 1 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900">#DON-0001</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900">Nguyễn Minh Anh</span>
                                    <span class="text-xs text-slate-500 mt-0.5">minhanh@gmail.com</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">$500.00</td>
                            <td class="py-4 px-6 text-slate-600">Chuyển khoản</td>
                            <td class="py-4 px-6 text-slate-600">Hỗ trợ điều trị</td>
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex flex-col">
                                    <span>15/06/2024</span>
                                    <span class="text-xs text-slate-400 mt-0.5">10:30</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã xác nhận
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.donations.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Xem chi tiết
                                        </a>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-orange-50 hover:text-orange-700 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Chỉnh sửa
                                        </button>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900">#DON-0002</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900">Trần Quang Huy</span>
                                    <span class="text-xs text-slate-500 mt-0.5">quanghuy@gmail.com</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">$300.00</td>
                            <td class="py-4 px-6 text-slate-600">MoMo</td>
                            <td class="py-4 px-6 text-slate-600">Mua thức ăn</td>
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex flex-col">
                                    <span>14/06/2024</span>
                                    <span class="text-xs text-slate-400 mt-0.5">15:45</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã xác nhận
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.donations.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Xem chi tiết
                                        </a>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-orange-50 hover:text-orange-700 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Chỉnh sửa
                                        </button>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900">#DON-0003</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900">Lê Hoàng Nam</span>
                                    <span class="text-xs text-slate-500 mt-0.5">hoangnam@gmail.com</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">$200.00</td>
                            <td class="py-4 px-6 text-slate-600">VNPay</td>
                            <td class="py-4 px-6 text-slate-600">Xây dựng chuồng</td>
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex flex-col">
                                    <span>14/06/2024</span>
                                    <span class="text-xs text-slate-400 mt-0.5">08:15</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Chờ xác nhận
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.donations.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Xem chi tiết
                                        </a>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-orange-50 hover:text-orange-700 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Chỉnh sửa
                                        </button>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900">#DON-0004</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900">Phạm Thảo Vy</span>
                                    <span class="text-xs text-slate-500 mt-0.5">thaovy@gmail.com</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">$150.00</td>
                            <td class="py-4 px-6 text-slate-600">Chuyển khoản</td>
                            <td class="py-4 px-6 text-slate-600">Hỗ trợ điều trị</td>
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex flex-col">
                                    <span>13/06/2024</span>
                                    <span class="text-xs text-slate-400 mt-0.5">14:20</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã xác nhận
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.donations.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Xem chi tiết
                                        </a>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-orange-50 hover:text-orange-700 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Chỉnh sửa
                                        </button>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-900">#DON-0005</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900">Vũ Đức Mạnh</span>
                                    <span class="text-xs text-slate-500 mt-0.5">ducmanh@gmail.com</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">$100.00</td>
                            <td class="py-4 px-6 text-slate-600">MoMo</td>
                            <td class="py-4 px-6 text-slate-600">Mua thức ăn</td>
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex flex-col">
                                    <span>12/06/2024</span>
                                    <span class="text-xs text-slate-400 mt-0.5">11:30</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Đã hủy
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.donations.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Xem chi tiết
                                        </a>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-orange-50 hover:text-orange-700 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Chỉnh sửa
                                        </button>
                                        <button class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-red-600 hover:bg-red-50 transition-colors border-t border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination (Mock) -->
            <div class="p-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-sm text-slate-500">Hiển thị 1 đến 5 của 256 kết quả</span>
                
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-500">Hiển thị</span>
                        <select class="px-2 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-700 focus:outline-none focus:border-teal-500">
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-1">
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:bg-slate-50 hover:text-slate-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-teal-700 text-white font-medium shadow-sm transition-all hover:bg-teal-800">1</button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors font-medium">2</button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors font-medium">3</button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors font-medium">4</button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors font-medium">5</button>
                        <span class="px-1 text-slate-400">...</span>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors font-medium">26</button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:bg-slate-50 hover:text-slate-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
