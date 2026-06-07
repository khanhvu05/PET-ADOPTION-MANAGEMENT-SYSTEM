<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.adoptions.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Đơn Nhận Nuôi</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-semibold">Chi Tiết Đơn</span>
    </x-slot>

    <div x-data="{ activeTab: 'details' }" class="max-w-7xl mx-auto space-y-6 lg:space-y-8 font-sans" x-cloak>
        @php
            $badgeColor = match($application->Trang_thai) {
                'cho_duyet' => 'bg-slate-100 text-slate-600 border-slate-200',
                'cho_xac_nhan_don' => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                'cho_phong_van' => 'bg-blue-50 text-blue-600 border-blue-200',
                'da_duyet' => 'bg-green-50 text-green-600 border-green-200',
                'hoan_thanh' => 'bg-purple-50 text-purple-600 border-purple-200',
                'tu_choi' => 'bg-red-50 text-red-600 border-red-200',
                default => 'bg-slate-100 text-slate-600 border-slate-200',
            };
        @endphp
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Chi Tiết Đơn Nhận Nuôi</h1>
                <p class="text-sm font-medium text-slate-500 mt-1">#{{ substr($application->Ma_don, 0, 8) }}</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.adoptions.index') }}" class="px-4 py-2 border border-slate-200 text-slate-600 font-medium text-sm rounded-[10px] hover:bg-slate-50 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
                <a href="{{ route('admin.adoptions.edit', $application->Ma_don) }}" class="px-5 py-2 bg-sidebar-blue text-white font-medium text-sm rounded-[10px] hover:opacity-90 transition-colors flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Chỉnh sửa
                </a>
                <form action="{{ route('admin.adoptions.destroy', $application->Ma_don) }}" method="POST" class="inline confirm-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-[#e75e5b] text-white font-medium text-sm rounded-[10px] hover:bg-red-500 transition-colors flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Xóa
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Layout Grid -->
        <div class="flex flex-col xl:flex-row gap-6 lg:gap-8 relative items-start">
            
            <!-- LEFT COLUMN (Tabs and Content) -->
            <div class="flex-1 space-y-6 min-w-0">
                
                <!-- Navigation Tabs -->
                <div class="flex flex-wrap items-center gap-6 border-b border-slate-200">
                    <button @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Thông tin chi tiết
                    </button>
                    <button @click="activeTab = 'survey'" :class="activeTab === 'survey' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Kết quả khảo sát
                    </button>
                    <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Lịch sử xử lý
                    </button>
                    <button @click="activeTab = 'notes'" :class="activeTab === 'notes' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Ghi chú
                    </button>
                    <button @click="activeTab = 'docs'" :class="activeTab === 'docs' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        Tài liệu
                    </button>
                </div>

                <!-- Tabs Content Container -->
                <div>
                    <!-- TAB 1: Thông tin chi tiết (4 Boxes) -->
                    <div x-show="activeTab === 'details'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Box 1: Thông tin đơn -->
                            <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                                <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">
                                    Thông tin đơn
                                </h3>
                                
                                <div class="space-y-5 text-sm">
                                    <div class="flex items-center">
                                        <span class="text-slate-500 font-medium w-[200px] shrink-0">Mã đơn</span>
                                        <span class="text-slate-800 font-medium">#{{ substr($application->Ma_don, 0, 8) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-slate-500 font-medium w-[200px] shrink-0">Trạng thái</span>
                                        <div>
                                            <span class="{{ $badgeColor }} text-xs font-semibold px-2.5 py-1 rounded-[6px] border">{{ $application->trang_thai_label }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-slate-500 font-medium w-[200px] shrink-0">Ngày tạo</span>
                                        <span class="text-slate-800 font-medium">{{ $application->Ngay_tao->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-slate-500 font-medium w-[200px] shrink-0">Ngày cập nhật gần nhất</span>
                                        <span class="text-slate-800 font-medium">{{ $application->Ngay_cap_nhat->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-slate-500 font-medium w-[200px] shrink-0">Nguồn</span>
                                        <span class="text-slate-800 font-medium">Website</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-slate-500 font-medium w-[200px] shrink-0">Nhân viên xử lý</span>
                                        <span class="text-slate-800 font-medium">Admin</span>
                                    </div>
                                </div>
                            </div>

                                <!-- Box 2: Thú cưng được nhận nuôi -->
                            <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                                <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">
                                    Thú cưng được nhận nuôi
                                </h3>
                                
                                <div class="flex flex-col items-center text-center gap-4">
                                    <img src="{{ $application->thuCung->anh_url }}" alt="{{ $application->thuCung->Ten }}" class="w-40 h-40 object-cover rounded-full border-4 border-slate-50 shadow-md shrink-0">
                                    <div class="w-full">
                                        <div class="flex flex-col items-center gap-2 mb-2">
                                            <h4 class="text-xl font-bold text-slate-800">{{ $application->thuCung->Ten }}</h4>
                                            <span class="bg-{{ $application->thuCung->trang_thai_color }}-50 text-{{ $application->thuCung->trang_thai_color }}-600 text-[11px] font-semibold px-2.5 py-1 rounded-[6px] border border-{{ $application->thuCung->trang_thai_color }}-100 shrink-0">{{ $application->thuCung->trang_thai_label }}</span>
                                        </div>
                                        <p class="text-[14px] text-slate-500 mb-4 px-2">#{{ substr($application->thuCung->Ma_thu_cung, 0, 8) }} &bull; {{ $application->thuCung->Giong }} &bull; {{ $application->thuCung->nhom_tuoi_label }}</p>
                                        
                                        <div class="flex flex-wrap justify-center gap-x-6 gap-y-3 text-[14px] text-slate-600 bg-slate-50 rounded-[10px] p-4 border border-slate-100">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="10" cy="14" r="5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 3l-7.5 7.5M21 3v6M21 3h-6"/></svg>
                                                {{ $application->thuCung->gioi_tinh_label }}
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                                {{ $application->thuCung->Can_nang }} kg
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                                Tiêm phòng: {{ $application->thuCung->Da_tiem_phong ? 'Có' : 'Không' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                <!-- Box 3: Thông tin người nhận nuôi -->
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">
                                Thông tin người nhận nuôi
                            </h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6">
                                <!-- Cột Trái -->
                                <div class="space-y-5">
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            Họ và tên
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->Ho_ten }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            Email
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->nguoiDung->email ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            Số điện thoại
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->So_dien_thoai }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Địa chỉ
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm leading-relaxed">{{ $application->Dia_chi }}</span>
                                    </div>
                                </div>
                                <!-- Cột Phải -->
                                <div class="space-y-5">
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            Nghề nghiệp
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->Nghe_nghiep }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                            Loại nhà ở
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->Loai_nha_o }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[140px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Cam kết
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->Cam_ket ? 'Có cam kết' : 'Chưa cam kết' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Box 4: Thông tin bổ sung -->
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">
                                Thông tin bổ sung
                            </h3>
                            
                            <div class="grid grid-cols-1 gap-y-6">
                                <div class="space-y-5">
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[160px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                                            Đã từng nuôi thú cưng
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm">{{ $application->Kinh_nghiem }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-slate-500 font-medium text-[13px] flex items-center gap-2 w-[160px] shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                            Lý do nhận nuôi
                                        </span>
                                        <span class="flex-1 text-slate-800 font-medium text-sm leading-relaxed">{{ nl2br(e($application->Ly_do_nhan_nuoi)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: Khảo sát -->
                    <div x-show="activeTab === 'survey'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                                <h3 class="text-base font-semibold text-slate-800">
                                    Kết quả khảo sát đánh giá
                                </h3>
                            </div>

                            <div class="space-y-4">
                                @if($application->answers && $application->answers->count() > 0)
                                    @foreach($application->answers as $index => $answer)
                                        <div class="p-4 border border-slate-100 rounded-[10px]">
                                            <p class="text-sm font-semibold text-slate-800 mb-2">{{ $index + 1 }}. {{ $answer->question->Noi_dung ?? 'Câu hỏi' }}</p>
                                            <div class="bg-slate-50 p-3 rounded-[8px] border border-slate-100">
                                                <p class="text-sm text-slate-700">
                                                    @if($answer->Lua_chon_da_chon)
                                                        @if(is_array($answer->Lua_chon_da_chon))
                                                            {{ implode(', ', $answer->Lua_chon_da_chon) }}
                                                        @else
                                                            {{ $answer->Lua_chon_da_chon }}
                                                        @endif
                                                    @elseif($answer->Noi_dung_tra_loi)
                                                        {{ $answer->Noi_dung_tra_loi }}
                                                    @else
                                                        <span class="italic text-slate-400">Không có câu trả lời</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-slate-500 italic">Không có dữ liệu khảo sát cho đơn này.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: Lịch sử xử lý -->
                    <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">Lịch sử xử lý</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center shrink-0 border border-orange-100 text-orange-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Đơn được tạo</p>
                                        <p class="text-[12px] text-slate-500">{{ $application->Ngay_tao->format('d/m/Y H:i') }} - Bởi {{ $application->Ho_ten }}</p>
                                    </div>
                                </div>
                                @if($application->Ngay_cap_nhat != $application->Ngay_tao)
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center shrink-0 border border-blue-100 text-blue-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Cập nhật lần cuối ({{ $application->trang_thai_label }})</p>
                                        <p class="text-[12px] text-slate-500">{{ $application->Ngay_cap_nhat->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: Ghi chú -->
                    <div x-show="activeTab === 'notes'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="grid grid-cols-1 gap-6">
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6 space-y-4">
                            @if($application->Ghi_chu_admin)
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-semibold">AD</div>
                                    <div class="flex-1 bg-slate-50 p-4 rounded-[10px] border border-slate-100">
                                        <div class="flex justify-between mb-2">
                                            <p class="text-[13px] font-semibold text-slate-700">Admin</p>
                                            <p class="text-[11px] text-slate-400">{{ $application->Ngay_cap_nhat->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <p class="text-sm text-slate-600">{{ $application->Ghi_chu_admin }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-slate-500 italic">Chưa có ghi chú nào cho đơn này.</p>
                            @endif
                            
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <p class="text-xs text-slate-500 italic">Để thêm hoặc cập nhật ghi chú, vui lòng sử dụng khung "Ghi chú từ Admin" ở cột bên phải.</p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: Tài liệu đính kèm -->
                    <div x-show="activeTab === 'docs'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">Danh sách tài liệu</h3>
                            <p class="text-sm text-slate-500 italic">Đơn nhận nuôi này không có tài liệu đính kèm.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN (Khối 4: Panel Nút Hành Động) - GLOBAL SIDEBAR -->
            <div class="w-full xl:w-[320px] shrink-0">
                <div class="bg-white border border-slate-200 rounded-[10px] p-6 sticky top-6">
                    <h3 class="text-base font-semibold text-slate-800 mb-5 border-b border-slate-100 pb-3">
                        Xử lý Đơn
                    </h3>
                    
                    <div class="flex justify-between items-center mb-5">
                        <span class="text-[13px] text-slate-500 font-medium">Trạng thái</span>
                        <span class="{{ $badgeColor }} text-xs font-semibold px-2.5 py-1 rounded-[6px] border">{{ $application->trang_thai_label }}</span>
                    </div>
                    
                    @if(in_array($application->Trang_thai, ['cho_duyet', 'da_duyet']))
                    <form id="action-form" action="{{ route('admin.adoptions.update', $application->Ma_don) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="Trang_thai" id="trang_thai_input" value="">
                        

                        @if($application->Trang_thai === 'cho_duyet')
                            <button type="button" onclick="confirmAction('cho_xac_nhan_don', 'Hệ thống sẽ gửi email mời phỏng vấn đến ứng viên. Ứng viên có 24h để chọn lịch. Bạn có chắc chắn?')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-[8px] transition-colors">
                                Duyệt sơ bộ & Gửi mail mời Phỏng vấn
                            </button>
                            
                            <div class="mt-4 border-t border-slate-100 pt-4">
                                <p class="text-sm font-medium text-red-600 mb-2">Từ chối đơn</p>
                                <textarea name="Ghi_chu_admin" id="ghi_chu_reject" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-[8px] px-3 py-2 text-sm text-slate-700 focus:outline-none focus:border-red-500 transition-colors" placeholder="Lý do từ chối (bắt buộc)..."></textarea>
                                @error('Ghi_chu_admin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <button type="button" onclick="confirmReject()" class="w-full mt-2 bg-white hover:bg-red-50 text-red-600 border border-red-200 font-medium text-sm py-2.5 rounded-[8px] transition-colors">
                                    Từ chối đơn
                                </button>
                            </div>
                        @endif

                        @if($application->Trang_thai === 'da_duyet')
                            <button type="button" onclick="confirmAction('hoan_thanh', 'Xác nhận đã bàn giao thú cưng cho người nhận nuôi thành công?')" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium text-sm py-2.5 rounded-[8px] transition-colors">
                                Hoàn tất bàn giao & Đã nhận nuôi
                            </button>
                        @endif
                    </form>
                    @endif
                    
                    <div class="mt-6 pt-5 border-t border-slate-100">
                        <p class="text-[13px] font-medium text-slate-600 mb-2">Ghi chú từ Admin (không bắt buộc đối với duyệt đơn)</p>
                        <form action="{{ route('admin.adoptions.update', $application->Ma_don) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="Trang_thai" value="{{ $application->Trang_thai }}">
                            <textarea name="Ghi_chu_admin" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-[8px] px-3 py-2 text-sm text-slate-700 focus:outline-none focus:border-teal-500 transition-colors" placeholder="Cập nhật ghi chú nội bộ...">{{ $application->Ghi_chu_admin }}</textarea>
                            <button type="submit" class="w-full mt-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-sm rounded-[8px] py-2 transition-colors">Lưu Ghi Chú</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function confirmAction(status, textMessage) {
            let iconType = 'warning';
            let confirmBtnColorClass = 'bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm';
            
            if(status === 'rejected') {
                iconType = 'error';
                confirmBtnColorClass = 'bg-red-600 hover:bg-red-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm';
            } else if(status === 'completed') {
                iconType = 'success';
                confirmBtnColorClass = 'bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm';
            }

            Swal.fire({
                ...window.swalConfig,
                title: 'Xác nhận xử lý',
                text: textMessage,
                icon: iconType,
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
                customClass: {
                    ...window.swalConfig.customClass,
                    confirmButton: confirmBtnColorClass
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Đang xử lý...',
                        text: 'Vui lòng đợi trong giây lát. Hệ thống đang thực hiện và gửi email.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('trang_thai_input').value = status;
                    document.getElementById('action-form').submit();
                }
            })
        }

        function confirmReject() {
            let note = document.getElementById('ghi_chu_reject').value.trim();
            if(!note) {
                Swal.fire({
                    ...window.swalConfig,
                    icon: 'warning',
                    title: 'Thiếu thông tin',
                    text: 'Vui lòng nhập lý do từ chối để ứng viên được biết!',
                    confirmButtonText: 'Đã hiểu',
                    showCancelButton: false,
                    customClass: {
                        ...window.swalConfig.customClass,
                        confirmButton: 'bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm'
                    }
                });
                return;
            }
            confirmAction('rejected', 'Bạn có chắc chắn muốn từ chối đơn này? Hệ thống sẽ gửi email thông báo từ chối đến ứng viên.');
        }
    </script>
    @endpush
</x-admin-layout>
