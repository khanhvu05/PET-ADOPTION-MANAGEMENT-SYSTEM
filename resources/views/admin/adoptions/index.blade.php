<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Đơn Nhận Nuôi</span>
    </x-slot>

    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Quản Lý Đơn Nhận Nuôi</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Theo dõi và quản lý tất cả các yêu cầu nhận nuôi thú cưng.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <!-- Export Button -->
                <button class="flex items-center justify-center gap-2 h-10 px-4 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-700 shadow-sm hover:bg-slate-50 transition-all shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </button>
            </div>
        </div>

        <!-- Metrics Cards Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            <x-admin.kpi-card title="Tổng Đơn" value="{{ $stats['total'] }}" percent="0" />
            <x-admin.kpi-card title="Đang Xử Lý" value="{{ $stats['pending'] }}" percent="0" />
            <x-admin.kpi-card title="Đã Phê Duyệt" value="{{ $stats['approved'] }}" percent="0" />
            <x-admin.kpi-card title="Đã Từ Chối" value="{{ $stats['rejected'] }}" percent="0" />
            <x-admin.kpi-card title="Đã Nhận Nuôi" value="{{ $stats['completed'] }}" percent="0" />
        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <!-- Filters Section -->
            <form method="GET" action="{{ route('admin.adoptions.index') }}" class="p-6 pb-4 border-b border-slate-100 overflow-x-auto custom-scrollbar" id="filterForm">
                <!-- Preserve pagination size -->
                <input type="hidden" name="per_page" value="{{ request('per_page', 8) }}">
                
                <div class="flex items-end gap-4 min-w-[900px]">
                    <!-- Search Input -->
                    <div class="w-[280px] shrink-0">
                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm đơn (tên, SĐT, mã đơn)..." class="w-full h-11 pl-4 pr-10 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-900 placeholder-slate-400 transition-all shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="flex items-end gap-3 flex-1">
                        <!-- Dropdown 1 -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Trạng thái</label>
                            <div class="relative">
                                <select name="trang_thai" onchange="document.getElementById('filterForm').submit()" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm appearance-none cursor-pointer">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="pending" {{ request('trang_thai') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="pre_approved" {{ request('trang_thai') == 'pre_approved' ? 'selected' : '' }}>Duyệt sơ bộ</option>
                                    <option value="approved" {{ request('trang_thai') == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                                    <option value="rejected" {{ request('trang_thai') == 'rejected' ? 'selected' : '' }}>Từ chối</option>
                                    <option value="cancelled" {{ request('trang_thai') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    <option value="completed" {{ request('trang_thai') == 'completed' ? 'selected' : '' }}>Đã nhận nuôi</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown 2 -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Loài thú cưng</label>
                            <div class="relative">
                                <select name="loai_thu_cung" onchange="document.getElementById('filterForm').submit()" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm appearance-none cursor-pointer">
                                    <option value="">Tất cả loài</option>
                                    <option value="cho" {{ request('loai_thu_cung') == 'cho' ? 'selected' : '' }}>Chó</option>
                                    <option value="meo" {{ request('loai_thu_cung') == 'meo' ? 'selected' : '' }}>Mèo</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Date range -->
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Từ ngày</label>
                            <div class="relative">
                                <input type="date" name="ngay_tu" value="{{ request('ngay_tu') }}" onchange="document.getElementById('filterForm').submit()" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm">
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 flex-1">
                            <label class="text-xs font-bold text-slate-700">Đến ngày</label>
                            <div class="relative">
                                <input type="date" name="ngay_den" value="{{ request('ngay_den') }}" onchange="document.getElementById('filterForm').submit()" class="w-full h-11 px-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:outline-none focus:border-teal-500 shadow-sm">
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('admin.adoptions.index') }}" class="flex items-center justify-center gap-2 h-11 px-4 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-700 shadow-sm hover:bg-slate-50 transition-all">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Làm mới
                            </a>
                            <button type="submit" class="flex items-center justify-center gap-2 h-11 px-4 bg-teal-600 border border-transparent rounded-xl font-bold text-sm text-white shadow-sm hover:bg-teal-700 transition-all">
                                Lọc
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Table Container -->
            <div class="p-4 overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[1100px] whitespace-nowrap">
                    <thead>
                        <tr class="bg-teal-50">
                            <th class="py-3 px-4 w-12 text-center rounded-l-xl">#</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Mã Đơn</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Người Đăng Ký</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Thú Cưng</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Thông Tin Liên Hệ</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800">Ngày Tạo</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 text-center">Trạng Thái</th>
                            <th class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-teal-800 text-center rounded-r-xl">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($applications as $index => $app)
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                            <td class="py-3 px-4 text-center text-slate-500 font-medium">
                                {{ $applications->firstItem() + $index }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 text-[13px]">#{{ substr($app->Ma_don, 0, 8) }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span class="font-bold text-slate-800 text-[13px]">{{ $app->Ho_ten }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        <span class="text-[12px] text-slate-500">{{ optional($app->nguoiDung)->Email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if($app->thuCung)
                                <div class="flex items-center gap-3">
                                    <img src="{{ $app->thuCung->AnhUrl }}" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="{{ $app->thuCung->Ten }}">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800 text-[13px]">{{ $app->thuCung->Ten }}</span>
                                        <span class="text-[12px] text-slate-500">{{ $app->thuCung->Giong }}</span>
                                    </div>
                                </div>
                                @else
                                <span class="text-xs text-gray-500 italic">Thú cưng đã bị xóa</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        <span class="text-[12px] text-slate-600">{{ $app->So_dien_thoai }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="text-[12px] text-slate-500 truncate max-w-[150px]" title="{{ $app->Dia_chi }}">{{ Str::limit($app->Dia_chi, 20) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-col text-[12px]">
                                    <span class="text-slate-700">{{ $app->Ngay_tao->format('d/m/Y') }}</span>
                                    <span class="text-slate-400">{{ $app->Ngay_tao->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($app->Trang_thai == 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold text-slate-600 bg-slate-100 border border-slate-200">
                                        Chờ duyệt
                                    </span>
                                @elseif($app->Trang_thai == 'pre_approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold text-orange-600 bg-orange-50 border border-orange-200">
                                        Duyệt sơ bộ
                                    </span>
                                @elseif($app->Trang_thai == 'approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold text-green-600 bg-green-50 border border-green-200">
                                        Đã duyệt
                                    </span>
                                @elseif($app->Trang_thai == 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold text-red-600 bg-red-50 border border-red-200">
                                        Từ chối
                                    </span>
                                @elseif($app->Trang_thai == 'cancelled')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold text-gray-600 bg-gray-100 border border-gray-200">
                                        Đã hủy
                                    </span>
                                @elseif($app->Trang_thai == 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold text-purple-600 bg-purple-50 border border-purple-200">
                                        Đã nhận nuôi
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.adoptions.show', $app->Ma_don) }}" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-blue-500 hover:bg-blue-50 transition-colors shadow-sm" title="Xem chi tiết">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    
                                    @if(in_array($app->Trang_thai, ['rejected', 'cancelled']))
                                    <form action="{{ route('admin.adoptions.destroy', $app->Ma_don) }}" method="POST" class="inline confirm-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center w-8 h-8 rounded border border-slate-200 text-red-500 hover:bg-red-50 transition-colors shadow-sm" title="Xóa">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-10 text-center text-slate-500">
                                Không tìm thấy đơn nhận nuôi nào phù hợp.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if($applications->hasPages())
            <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100">
                <span class="text-sm font-medium text-slate-500">
                    Hiển thị {{ $applications->firstItem() }} đến {{ $applications->lastItem() }} của {{ $applications->total() }} kết quả
                </span>
                
                <div class="flex items-center gap-6">
                    <!-- Items per page -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-slate-500">Hiển thị</span>
                        <div class="relative">
                            <select onchange="window.location.href=this.value" class="h-9 pl-3 pr-8 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-700 focus:outline-none focus:border-teal-500 appearance-none cursor-pointer">
                                <option value="{{ request()->fullUrlWithQuery(['per_page' => 8]) }}" {{ request('per_page', 8) == 8 ? 'selected' : '' }}>8</option>
                                <option value="{{ request()->fullUrlWithQuery(['per_page' => 15]) }}" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                <option value="{{ request()->fullUrlWithQuery(['per_page' => 30]) }}" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="flex items-center">
                        {{ $applications->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100">
                <span class="text-sm font-medium text-slate-500">
                    Tổng cộng: {{ $applications->total() }} kết quả
                </span>
            </div>
            @endif

        </div>
    </div>
</x-admin-layout>
