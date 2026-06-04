<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Thú Cưng</span>
    </x-slot>

    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Quản Lý Thú Cưng</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Quản lý thông tin và hồ sơ của tất cả thú cưng trong hệ thống</p>
            </div>
            
            <div class="flex items-center gap-3">
                <!-- Export Button -->
                <button class="flex items-center justify-center gap-2 h-10 px-4 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-700 shadow-sm hover:bg-slate-50 transition-all shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </button>
                
                <!-- Add New Button -->
                <a href="#" class="flex items-center justify-center gap-2 h-10 px-5 bg-teal-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-teal-700 transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Thú Cưng
                </a>
            </div>
        </div>

        <!-- Metrics Cards Grid -->
        <!-- Forced to 5 columns on large screens to match mockup -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            
            <!-- Card 1 -->
            <x-admin.kpi-card 
                title="Tổng Thú Cưng" 
                value="128" 
                percent="12.5" 
            />

            <!-- Card 2 -->
            <x-admin.kpi-card 
                title="Đang Chờ Duyệt" 
                value="18" 
                percent="-4.2" 
            />

            <!-- Card 3 -->
            <x-admin.kpi-card 
                title="Đã Nhận Nuôi" 
                value="76" 
                percent="8.1" 
            />

            <!-- Card 4 -->
            <x-admin.kpi-card 
                title="Tạm Ngừng" 
                value="8" 
                percent="-2.1" 
            />

            <!-- Card 5 -->
            <x-admin.kpi-card 
                title="Không Khả Dụng" 
                value="26" 
                percent="5.3" 
            />

        </div>

        <!-- Filter & Table Card -->
        <!-- Made sure this container doesn't overflow horizontally on its own -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <!-- Filters Section (Forced into one row on large screens) -->
            <div class="p-6 pb-4 border-b border-slate-100 overflow-x-auto custom-scrollbar">
                <div class="flex items-end gap-4 min-w-[900px]">
                    <!-- Search Input -->
                    <div class="w-[260px] shrink-0">
                        <div class="relative w-full">
                            <input type="text" placeholder="Tìm kiếm thú cưng..." class="w-full h-11 pl-4 pr-10 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-900 placeholder-slate-400 transition-all shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="flex items-end gap-3 flex-1">
                        <!-- Dropdown 1 -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Loại thú cưng</label>
                            <div class="relative">
                                <select class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm appearance-none cursor-pointer">
                                    <option>Tất cả loại</option>
                                    <option>Chó</option>
                                    <option>Mèo</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown 2 -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Giống loài</label>
                            <div class="relative">
                                <select class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm appearance-none cursor-pointer">
                                    <option>Tất cả giống</option>
                                    <option>Golden Retriever</option>
                                    <option>British Shorthair</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown 3 -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Trạng thái</label>
                            <div class="relative">
                                <select class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm appearance-none cursor-pointer">
                                    <option>Tất cả trạng thái</option>
                                    <option>Có sẵn</option>
                                    <option>Đang chờ duyệt</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown 4 -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Giới tính</label>
                            <div class="relative">
                                <select class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm appearance-none cursor-pointer">
                                    <option>Tất cả giới tính</option>
                                    <option>Đực</option>
                                    <option>Cái</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="flex items-center gap-2 shrink-0">

                            <button class="flex items-center justify-center w-11 h-11 bg-white border border-slate-200 rounded-xl text-slate-500 shadow-sm hover:bg-slate-50 transition-all" title="Đặt lại">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <!-- Changed background to plain Tailwind class to ensure it compiles -->
            <!-- Using standard border-b instead of divide-y to prevent thick black lines -->
            <div class="p-4 overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[1000px] whitespace-nowrap">
                    <thead>
                        <tr class="bg-teal-50">
                            <th class="py-3 px-4 w-12 text-center rounded-l-xl">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Thú Cưng</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Loại & Giống</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Tuổi</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Cân Nặng</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Giới Tính</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Vị Trí</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 text-center">Trạng Thái</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Ngày Tạo</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 text-center rounded-r-xl">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Lucky">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">Lucky</span>
                                        <span class="text-[11px] text-slate-500">#PET-001</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">Chó</span>
                                    <span class="text-[12px] text-slate-500">Golden Retriever</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">2 tuổi 3 tháng</td>
                            <td class="py-3 px-4 text-slate-600">25 kg</td>
                            <td class="py-3 px-4 font-bold text-blue-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> 
                                    Đực
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[12px]">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Hà Nội
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold text-green-700 bg-green-50 border border-green-200">
                                    Có sẵn
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">15/06/2024</span>
                                    <span class="text-slate-400">10:30</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Mimi">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">Mimi</span>
                                        <span class="text-[11px] text-slate-500">#PET-002</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">Mèo</span>
                                    <span class="text-[12px] text-slate-500">British Shorthair</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">1 tuổi 6 tháng</td>
                            <td class="py-3 px-4 text-slate-600">4.2 kg</td>
                            <td class="py-3 px-4 font-bold text-pink-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22v-4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20h4"></path></svg> 
                                    Cái
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[12px]">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    TP. Hồ Chí Minh
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold text-green-700 bg-green-50 border border-green-200">
                                    Có sẵn
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">14/06/2024</span>
                                    <span class="text-slate-400">15:45</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1544568100-847a948585b9?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Max">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">Max</span>
                                        <span class="text-[11px] text-slate-500">#PET-003</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">Chó</span>
                                    <span class="text-[12px] text-slate-500">Husky</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">3 tuổi</td>
                            <td class="py-3 px-4 text-slate-600">28 kg</td>
                            <td class="py-3 px-4 font-bold text-blue-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> 
                                    Đực
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[12px]">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Đà Nẵng
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold text-orange-700 bg-orange-50 border border-orange-200">
                                    Đang chờ duyệt
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">14/06/2024</span>
                                    <span class="text-slate-400">09:15</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Luna">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">Luna</span>
                                        <span class="text-[11px] text-slate-500">#PET-004</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">Mèo</span>
                                    <span class="text-[12px] text-slate-500">Persian</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">2 tuổi</td>
                            <td class="py-3 px-4 text-slate-600">3.8 kg</td>
                            <td class="py-3 px-4 font-bold text-pink-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22v-4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20h4"></path></svg> 
                                    Cái
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[12px]">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Hà Nội
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold text-purple-700 bg-purple-50 border border-purple-200">
                                    Đã được nhận nuôi
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">13/06/2024</span>
                                    <span class="text-slate-400">14:20</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Buddy">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">Buddy</span>
                                        <span class="text-[11px] text-slate-500">#PET-005</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">Chó</span>
                                    <span class="text-[12px] text-slate-500">Poodle</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">1 tuổi</td>
                            <td class="py-3 px-4 text-slate-600">6.5 kg</td>
                            <td class="py-3 px-4 font-bold text-blue-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> 
                                    Đực
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[12px]">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Hải Phòng
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold text-red-700 bg-red-50 border border-red-200">
                                    Không khả dụng
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">12/06/2024</span>
                                    <span class="text-slate-400">11:30</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-sm font-medium text-slate-500">Hiển thị 1 đến 5 của 128 kết quả</span>
                
                <div class="flex items-center gap-6">
                    <!-- Items per page -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-slate-500">Hiển thị</span>
                        <div class="relative">
                            <select class="h-9 pl-3 pr-8 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-700 focus:outline-none focus:border-teal-500 appearance-none cursor-pointer">
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="flex items-center gap-1.5">
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 text-slate-400 hover:bg-slate-50 hover:text-slate-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-white font-bold bg-teal-600 border border-teal-600 transition-colors shadow-sm">1</button>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-600 font-medium hover:bg-slate-50 border border-transparent transition-colors">2</button>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-600 font-medium hover:bg-slate-50 border border-transparent transition-colors">3</button>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-600 font-medium hover:bg-slate-50 border border-transparent transition-colors">4</button>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-600 font-medium hover:bg-slate-50 border border-transparent transition-colors">5</button>
                        <span class="flex items-center justify-center w-8 h-8 text-slate-400 tracking-widest">...</span>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg text-slate-600 font-medium hover:bg-slate-50 border border-transparent transition-colors">13</button>
                        <button class="flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
