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
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Quản Lý Thú Cưng</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Quản lý thông tin và hồ sơ của tất cả thú cưng trong hệ thống</p>
            </div>
            
            <div class="flex items-center gap-3">
                <!-- Export Button -->
                <button class="flex items-center justify-center gap-2 h-10 px-4 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-700 shadow-sm hover:bg-slate-50 transition-all shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </button>
                
                <!-- Add New Button -->
                <a href="{{ route('admin.pets.create') }}" class="flex items-center justify-center gap-2 h-10 px-5 bg-[#41859c] text-white rounded-xl font-bold text-sm shadow-sm hover:bg-[#32697b] transition-all shrink-0">
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
                value="{{ $stats['total']['value'] }}" 
                percent="{{ $stats['total']['growth'] }}" 
            />

            <!-- Card 2 -->
            <x-admin.kpi-card 
                title="Sẵn Sàng" 
                value="{{ $stats['ready']['value'] }}" 
                percent="{{ $stats['ready']['growth'] }}" 
            />

            <!-- Card 3 -->
            <x-admin.kpi-card 
                title="Đã Nhận Nuôi" 
                value="{{ $stats['adopted']['value'] }}" 
                percent="{{ $stats['adopted']['growth'] }}" 
            />

            <!-- Card 4 -->
            <x-admin.kpi-card 
                title="Đang Cứu Hộ" 
                value="{{ $stats['rescue']['value'] }}" 
                percent="{{ $stats['rescue']['growth'] }}" 
            />

            <!-- Card 5 -->
            <x-admin.kpi-card 
                title="Không Khả Dụng" 
                value="{{ $stats['unavailable']['value'] }}" 
                percent="{{ $stats['unavailable']['growth'] }}" 
            />

        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden relative">
            
            <!-- Filters Section -->
            <form id="filter-form" action="{{ route('admin.pets.index') }}" method="GET" class="p-6 pb-4 border-b border-slate-100 overflow-x-auto custom-scrollbar">
                <div class="flex items-end gap-4 min-w-[900px]">
                    <!-- Search Input -->
                    <div class="w-[260px] shrink-0">
                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm thú cưng..." class="w-full h-11 pl-4 pr-10 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#41859c] focus:ring-1 focus:ring-[#41859c] text-slate-900 placeholder-slate-400 transition-all shadow-sm">
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
                                <select name="loai" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-[#41859c] shadow-sm appearance-none cursor-pointer">
                                    <option value="all">Tất cả loại</option>
                                    <option value="cho" {{ request('loai') == 'cho' ? 'selected' : '' }}>Chó</option>
                                    <option value="meo" {{ request('loai') == 'meo' ? 'selected' : '' }}>Mèo</option>
                                    <option value="khac" {{ request('loai') == 'khac' ? 'selected' : '' }}>Khác</option>
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
                                <select name="giong" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-[#41859c] shadow-sm appearance-none cursor-pointer">
                                    <option value="all">Tất cả giống</option>
                                    @foreach($breeds as $breed)
                                        <option value="{{ $breed }}" {{ request('giong') == $breed ? 'selected' : '' }}>{{ $breed }}</option>
                                    @endforeach
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
                                <select name="trang_thai" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-[#41859c] shadow-sm appearance-none cursor-pointer">
                                    <option value="all">Tất cả trạng thái</option>
                                    <option value="san_sang" {{ request('trang_thai') == 'san_sang' ? 'selected' : '' }}>Sẵn sàng</option>
                                    <option value="dang_cuu_ho" {{ request('trang_thai') == 'dang_cuu_ho' ? 'selected' : '' }}>Đang cứu hộ</option>
                                    <option value="chua_san_sang" {{ request('trang_thai') == 'chua_san_sang' ? 'selected' : '' }}>Chưa sẵn sàng</option>
                                    <option value="da_nhan_nuoi" {{ request('trang_thai') == 'da_nhan_nuoi' ? 'selected' : '' }}>Đã nhận nuôi</option>
                                    <option value="da_mat" {{ request('trang_thai') == 'da_mat' ? 'selected' : '' }}>Đã mất</option>
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
                                <select name="gioi_tinh" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-[#41859c] shadow-sm appearance-none cursor-pointer">
                                    <option value="all">Tất cả giới tính</option>
                                    <option value="duc" {{ request('gioi_tinh') == 'duc' ? 'selected' : '' }}>Đực</option>
                                    <option value="cai" {{ request('gioi_tinh') == 'cai' ? 'selected' : '' }}>Cái</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('admin.pets.index') }}" class="flex items-center justify-center w-11 h-11 bg-white border border-slate-200 rounded-xl text-slate-500 shadow-sm hover:bg-slate-50 hover:text-red-500 transition-all" title="Làm mới bộ lọc">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <div id="pet-table-container" class="relative">
                <!-- Loading Overlay -->
                <style>
                    @keyframes forceSpin { 100% { transform: rotate(360deg); } }
                </style>
                <div id="table-loading-overlay" class="absolute inset-0 z-50 flex items-center justify-center hidden rounded-b-xl" style="background-color: rgba(255,255,255,0.6); backdrop-filter: blur(2px);">
                    <svg class="h-8 w-8 text-[#41859c]" style="animation: forceSpin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
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
                        @forelse($pets as $pet)
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-600 bg-white shadow-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $pet->anh_url }}" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="{{ $pet->Ten }}">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">{{ $pet->Ten }}</span>
                                        <span class="text-[11px] text-slate-500">#{{ $pet->Ma_hien_thi }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">{{ $pet->loai_label }}</span>
                                    <span class="text-[12px] text-slate-500">{{ $pet->Giong }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">{{ $pet->nhom_tuoi_label }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $pet->Can_nang }} kg</td>
                            <td class="py-3 px-4 font-bold {{ $pet->Gioi_tinh == 'duc' ? 'text-blue-500' : ($pet->Gioi_tinh == 'cai' ? 'text-pink-500' : 'text-slate-500') }}">
                                <div class="flex items-center gap-1.5">
                                    @if($pet->Gioi_tinh == 'duc')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="10" cy="14" r="5" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 3l-7.5 7.5M21 3v6M21 3h-6"/></svg> 
                                    @elseif($pet->Gioi_tinh == 'cai')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="9" r="5" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14v7M9 18h6"/></svg> 
                                    @endif
                                    {{ $pet->gioi_tinh_label }}
                                </div>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[12px]">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $pet->vi_tri_label }}
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-[10px] text-[11px] font-bold text-{{ $pet->trang_thai_color }}-700 bg-{{ $pet->trang_thai_color }}-50 border border-{{ $pet->trang_thai_color }}-200">
                                    {{ $pet->trang_thai_label }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">{{ $pet->Ngay_tao->format('d/m/Y') }}</span>
                                    <span class="text-slate-400">{{ $pet->Ngay_tao->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pets.show', $pet->Ma_thu_cung) }}" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.pets.edit', $pet->Ma_thu_cung) }}" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-orange-500 hover:bg-orange-50 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.pets.destroy', $pet->Ma_thu_cung) }}" method="POST" class="inline confirm-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="py-8 text-center text-slate-500">
                                Chưa có thú cưng nào.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $pets->links('admin.pagination.custom') }}
            </div>
            
            </div> <!-- End pet-table-container -->
        </div>
    </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof window.initAjaxTable === 'function') {
                window.initAjaxTable('pet-table-container', 'filter-form');
            }
        });
    </script>
</x-admin-layout>
