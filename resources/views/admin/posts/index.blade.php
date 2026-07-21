<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Bài Viết</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Quản Lý Bài Viết</h2>
                <p class="text-sm text-slate-500">Quản lý các bài viết, tin tức và nội dung trên hệ thống.</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- 
                @can('posts.export')
                <button class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </button>
                @endcan
                --}}
                @can('posts.create')
                <button class="bg-teal-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Bài Viết
                </button>
                @endcan
            </div>
        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <!-- Filters Section -->
            <div class="p-6 pb-4 border-b border-slate-100 overflow-x-auto custom-scrollbar">
                <div class="flex gap-4 min-w-max items-end">
                    <!-- Search -->
                    <div class="w-72">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" placeholder="Tìm kiếm bài viết..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm">
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="w-44">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Danh mục</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Chăm sóc</option>
                            <option>Câu chuyện</option>
                            <option>Dinh dưỡng</option>
                            <option>Kiến thức</option>
                            <option>Sức khỏe</option>
                        </select>
                    </div>

                    <div class="w-40">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Trạng thái</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Đã đăng</option>
                            <option>Bản nháp</option>
                        </select>
                    </div>

                    <div class="w-40">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Tác giả</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Admin</option>
                            <option>Moderator</option>
                        </select>
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
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Bài Viết</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Danh Mục</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Tác Giả</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Ngày Đăng</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Lượt Xem</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Trạng Thái</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100 text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        <!-- Row 1 -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Dog" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-semibold text-slate-900 w-48 line-clamp-2">5 cách giúp thú cưng vượt qua mùa hè nóng bức</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600">Chăm sóc</td>
                            <td class="py-4 px-6 text-slate-600">Admin</td>
                            <td class="py-4 px-6 text-slate-600">15/06/2024 10:30</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">1,234</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã đăng
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.posts.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
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
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Dog" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-semibold text-slate-900 w-48 line-clamp-2">Dấu hiệu nhận biết thú cưng bị stress</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600">Chăm sóc</td>
                            <td class="py-4 px-6 text-slate-600">Admin</td>
                            <td class="py-4 px-6 text-slate-600">14/06/2024 15:20</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">856</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã đăng
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.posts.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
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
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Dog" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-semibold text-slate-900 w-48 line-clamp-2">Hành trình giải cứu những chú chó bị bỏ rơi</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600">Câu chuyện</td>
                            <td class="py-4 px-6 text-slate-600">Admin</td>
                            <td class="py-4 px-6 text-slate-600">13/06/2024 09:15</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">2,045</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã đăng
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.posts.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
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
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Cat" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-semibold text-slate-900 w-48 line-clamp-2">Hướng dẫn chọn thức ăn phù hợp cho mèo</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600">Dinh dưỡng</td>
                            <td class="py-4 px-6 text-slate-600">Admin</td>
                            <td class="py-4 px-6 text-slate-600">12/06/2024 14:10</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">1,678</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Đã đăng
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.posts.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
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
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 shrink-0 overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Dog" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-semibold text-slate-900 w-48 line-clamp-2">Tại sao nên nhận nuôi thay vì mua thú cưng?</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600">Kiến thức</td>
                            <td class="py-4 px-6 text-slate-600">Admin</td>
                            <td class="py-4 px-6 text-slate-600">11/06/2024 11:30</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">3,210</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-300">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Bản nháp
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                                                <div class="flex items-center justify-center relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors border border-slate-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div x-show="open" x-transition class="absolute right-8 top-0 w-40 bg-white rounded-xl shadow-lg border border-slate-200 z-50 overflow-hidden text-left" style="display: none;">
                                        <a href="{{ route('admin.posts.show', 1) }}" class="flex items-center gap-2 px-4 py-2.5 text-[13px] font-bold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
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
                <span class="text-sm text-slate-500">Hiển thị 1 đến 5 của 45 kết quả</span>
                
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
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:bg-slate-50 hover:text-slate-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
