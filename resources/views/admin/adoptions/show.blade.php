<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.adoptions.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Đơn Nhận Nuôi</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chi Tiết Đơn</span>
    </x-slot>

    <div x-data="{ activeTab: 'details' }" class="max-w-7xl mx-auto space-y-6 lg:space-y-8" x-cloak>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">Chi Tiết Đơn Nhận Nuôi</h1>
                <p class="text-sm font-medium text-slate-400 mt-1">#ADP-0002</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.adoptions.index') }}" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
                <button class="px-5 py-2 bg-orange-500 text-white font-semibold text-sm rounded-xl hover:bg-orange-600 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Chỉnh sửa
                </button>
                <button class="px-4 py-2 border border-red-200 text-red-600 font-semibold text-sm rounded-xl hover:bg-red-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Xóa
                </button>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-8 border-b border-slate-200">
            <button @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Thông tin chi tiết
            </button>
            <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Lịch sử xử lý
            </button>
            <button @click="activeTab = 'notes'" :class="activeTab === 'notes' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Ghi chú
            </button>
            <button @click="activeTab = 'docs'" :class="activeTab === 'docs' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                Tài liệu đính kèm
            </button>
        </div>

        <!-- Tabs Content -->
        <div>
            <!-- TAB 1: Thông tin chi tiết -->
            <div x-show="activeTab === 'details'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                
                <!-- Row 1: Thông tin đơn & Thú cưng -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left: Thông tin đơn -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin đơn</h3>
                        
                        <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                            <div>
                                <p class="text-[13px] text-slate-500 mb-1">Mã đơn</p>
                                <p class="text-[13px] font-bold text-slate-800">#ADP-0002</p>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 mb-1">Trạng thái</p>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-orange-100 text-orange-600">Đang xử lý</span>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 mb-1">Ngày tạo</p>
                                <p class="text-[13px] font-medium text-slate-800">14/06/2024 15:45</p>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 mb-1">Ngày cập nhật gần nhất</p>
                                <p class="text-[13px] font-medium text-slate-800">15/06/2024 09:20</p>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 mb-1">Nguồn</p>
                                <p class="text-[13px] font-medium text-slate-800">Website</p>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 mb-1">Nhân viên xử lý</p>
                                <p class="text-[13px] font-medium text-slate-800">Admin</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Thú cưng được nhận nuôi -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm flex flex-col justify-center">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Thú cưng được nhận nuôi</h3>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-24 h-24 rounded-xl overflow-hidden shrink-0 border border-slate-200">
                                <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&q=80&w=200" alt="Lucky" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="text-base font-bold text-slate-900">Lucky</h4>
                                        <p class="text-[13px] text-slate-500 mt-1">#PET-005 • Golden Retriever • 2 tuổi 3 tháng</p>
                                    </div>
                                    <span class="px-2 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-lg border border-green-200">Có sẵn</span>
                                </div>
                                <div class="flex items-center gap-4 mt-4 text-[13px] text-slate-600 font-medium">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Đực
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                        25 kg
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                        Vàng kem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Thông tin người nhận nuôi -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                    <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin người nhận nuôi</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-y-6 gap-x-8">
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Họ và tên
                            </p>
                            <p class="text-[13px] font-bold text-slate-900 pl-6">Trần Quang Huy</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Email
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">quanghuy@gmail.com</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                Số điện thoại
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">0912 345 678</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Ngày sinh
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">14/08/1994</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Giới tính
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">Nam</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                CMND/CCCD
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">123456789012</p>
                        </div>
                        <div class="lg:col-span-2">
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Địa chỉ
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6 leading-relaxed">123 Nguyễn Văn Cừ, Quận 5, TP. Hồ Chí Minh</p>
                        </div>
                        <div class="lg:col-span-2">
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Nghề nghiệp
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6 leading-relaxed">Nhân viên văn phòng</p>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Thông tin bổ sung -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                    <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin bổ sung</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8">
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Biết đến chúng tôi từ
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">Facebook</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Có sẵn sàng chi trả phí chăm sóc
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">Có, tôi sẵn sàng</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Đã từng nuôi thú cưng
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">Có</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                Nơi ở hiện tại
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">Chung cư</p>
                        </div>
                        <div class="lg:col-span-2">
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                Lý do nhận nuôi
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">Tôi yêu động vật và mong muốn có một người bạn đồng hành.</p>
                        </div>
                        <div>
                            <p class="flex items-center gap-2 text-[13px] text-slate-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Thời gian chăm sóc
                            </p>
                            <p class="text-[13px] font-medium text-slate-900 pl-6">2 - 4 giờ mỗi ngày</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Lịch sử xử lý -->
            <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-12 shadow-sm">
                    <div class="relative max-w-4xl mx-auto pl-28 sm:pl-48 space-y-12 before:absolute before:left-[118px] sm:before:left-[216px] before:top-4 before:bottom-4 before:w-[2px] before:bg-slate-100">
                        <!-- Node 1 -->
                        <div class="relative">
                            <div class="absolute -left-28 sm:-left-48 top-1.5 text-[13px] text-slate-500 font-medium">14/06/2024 15:45</div>
                            <div class="absolute -left-[14px] top-1.5 w-7 h-7 rounded-full bg-orange-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 flex-1 w-full">
                                    <p class="text-sm font-bold text-slate-800 mb-1">Đơn được tạo</p>
                                    <p class="text-[13px] font-medium text-slate-600 leading-snug">Đơn nhận nuôi đã được tạo bởi Trần Quang Huy.</p>
                                </div>
                                <div class="text-right shrink-0 mt-2 sm:mt-0">
                                    <p class="text-[13px] font-bold text-slate-800">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-500">Hệ thống</p>
                                </div>
                            </div>
                        </div>
                        <!-- Node 2 -->
                        <div class="relative">
                            <div class="absolute -left-28 sm:-left-48 top-1.5 text-[13px] text-slate-500 font-medium">15/06/2024 09:20</div>
                            <div class="absolute -left-[14px] top-1.5 w-7 h-7 rounded-full bg-blue-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 flex-1 w-full">
                                    <p class="text-sm font-bold text-slate-800 mb-1">Đang xử lý</p>
                                    <p class="text-[13px] font-medium text-slate-600 leading-snug">Admin đang xem xét đơn nhận nuôi.</p>
                                </div>
                                <div class="text-right shrink-0 mt-2 sm:mt-0">
                                    <p class="text-[13px] font-bold text-slate-800">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-500">Hệ thống</p>
                                </div>
                            </div>
                        </div>
                        <!-- Node 3 -->
                        <div class="relative">
                            <div class="absolute -left-28 sm:-left-48 top-1.5 text-[13px] text-slate-500 font-medium">15/06/2024 14:30</div>
                            <div class="absolute -left-[14px] top-1.5 w-7 h-7 rounded-full bg-green-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="bg-green-50 border border-green-100 rounded-xl p-4 flex-1 w-full">
                                    <p class="text-sm font-bold text-slate-800 mb-1">Đã phê duyệt</p>
                                    <p class="text-[13px] font-medium text-slate-600 leading-snug">Đơn nhận nuôi đã được phê duyệt.</p>
                                </div>
                                <div class="text-right shrink-0 mt-2 sm:mt-0">
                                    <p class="text-[13px] font-bold text-slate-800">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-500">Nguyễn Minh Anh</p>
                                </div>
                            </div>
                        </div>
                        <!-- Node 4 (Pending) -->
                        <div class="relative opacity-60">
                            <div class="absolute -left-28 sm:-left-48 top-1.5 text-[13px] text-slate-400 font-medium">-</div>
                            <div class="absolute -left-[14px] top-1.5 w-7 h-7 rounded-full bg-slate-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-300"></div>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="bg-white border border-slate-100 rounded-xl p-4 flex-1 w-full">
                                    <p class="text-sm font-bold text-slate-500 mb-1">Đã nhận nuôi</p>
                                    <p class="text-[13px] font-medium text-slate-400 leading-snug">Thú cưng đã được bàn giao cho người nhận nuôi.</p>
                                </div>
                                <div class="text-right shrink-0 mt-2 sm:mt-0">
                                    <p class="text-[13px] font-bold text-slate-400">-</p>
                                    <p class="text-[12px] font-medium text-slate-400">-</p>
                                </div>
                            </div>
                        </div>
                        <!-- Node 5 (Pending) -->
                        <div class="relative opacity-60">
                            <div class="absolute -left-28 sm:-left-48 top-1.5 text-[13px] text-slate-400 font-medium">-</div>
                            <div class="absolute -left-[14px] top-1.5 w-7 h-7 rounded-full bg-slate-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-300"></div>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="bg-white border border-slate-100 rounded-xl p-4 flex-1 w-full">
                                    <p class="text-sm font-bold text-slate-500 mb-1">Hoàn tất</p>
                                    <p class="text-[13px] font-medium text-slate-400 leading-snug">Đơn nhận nuôi đã hoàn tất.</p>
                                </div>
                                <div class="text-right shrink-0 mt-2 sm:mt-0">
                                    <p class="text-[13px] font-bold text-slate-400">-</p>
                                    <p class="text-[12px] font-medium text-slate-400">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: Ghi chú -->
            <div x-show="activeTab === 'notes'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Danh sách ghi chú -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-base font-bold text-slate-800 mb-4 px-2">Danh sách ghi chú</h3>
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-start gap-4">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full bg-slate-100 shrink-0" alt="Avatar">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] text-slate-400 mt-0.5">15/06/2024 09:20</p>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button class="p-1.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-[13px] font-medium text-slate-700 mt-2 leading-relaxed">Ứng viên có kinh nghiệm nuôi chó, thông tin rõ ràng. Tiến hành xác minh địa chỉ và điều kiện nuôi.</p>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-start gap-4">
                        <img src="https://ui-avatars.com/api/?name=Nguyen+Minh+Anh&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full bg-slate-100 shrink-0" alt="Avatar">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Nguyễn Minh Anh</p>
                                    <p class="text-[12px] text-slate-400 mt-0.5">15/06/2024 14:20</p>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button class="p-1.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-[13px] font-medium text-slate-700 mt-2 leading-relaxed">Đã xác minh địa chỉ, điều kiện nuôi phù hợp. Đề xuất phê duyệt.</p>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-start gap-4">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full bg-slate-100 shrink-0" alt="Avatar">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] text-slate-400 mt-0.5">15/06/2024 14:35</p>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button class="p-1.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-[13px] font-medium text-slate-700 mt-2 leading-relaxed">Đã phê duyệt đơn. Hẹn lịch bàn giao thú cưng.</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Thêm ghi chú mới -->
                <div>
                    <h3 class="text-base font-bold text-slate-800 mb-4 px-2">Thêm ghi chú mới</h3>
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                        <div>
                            <textarea rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-[13px] font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-none" placeholder="Nhập nội dung ghi chú..."></textarea>
                            <p class="text-right text-[11px] text-slate-400 mt-1 font-medium">0/500</p>
                        </div>
                        <button class="w-full bg-teal-700 text-white font-bold text-sm rounded-xl py-3 hover:bg-teal-800 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Thêm ghi chú
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB 4: Tài liệu đính kèm -->
            <div x-show="activeTab === 'docs'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                    <h3 class="text-base font-bold text-slate-800 mb-6">Danh sách tài liệu</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- File 1: Hình ảnh -->
                        <div class="border border-slate-200 rounded-xl p-4 flex items-center gap-4 group hover:border-teal-200 transition-colors">
                            <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center shrink-0 border border-green-100">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">Ảnh CCCD mặt trước</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">cccd_front.jpg</p>
                                <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                    <span>1.2 MB</span>
                                    <span>•</span>
                                    <span>Tải lên: 14/06/2024 15:45</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- File 2: Hình ảnh -->
                        <div class="border border-slate-200 rounded-xl p-4 flex items-center gap-4 group hover:border-teal-200 transition-colors">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&q=80&w=100" class="w-full h-full object-cover opacity-80" alt="Preview">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">Ảnh CCCD mặt sau</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">cccd_back.jpg</p>
                                <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                    <span>1.1 MB</span>
                                    <span>•</span>
                                    <span>Tải lên: 14/06/2024 15:45</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- File 3: PDF -->
                        <div class="border border-slate-200 rounded-xl p-4 flex items-center gap-4 group hover:border-teal-200 transition-colors">
                            <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center shrink-0 border border-red-100">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">Giấy xác nhận cư trú</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">xac_nhan_cu_tru.pdf</p>
                                <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                    <span>2.4 MB</span>
                                    <span>•</span>
                                    <span>Tải lên: 14/06/2024 15:50</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- File 4: Không gian sống -->
                        <div class="border border-slate-200 rounded-xl p-4 flex items-center gap-4 group hover:border-teal-200 transition-colors">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&q=80&w=100" class="w-full h-full object-cover opacity-80" alt="Preview">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">Ảnh không gian sống</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">khong_gian_song.jpg</p>
                                <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                    <span>2.3 MB</span>
                                    <span>•</span>
                                    <span>Tải lên: 14/06/2024 15:50</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- File 5: Video -->
                        <div class="border border-slate-200 rounded-xl p-4 flex items-center gap-4 group hover:border-teal-200 transition-colors">
                            <div class="w-12 h-12 rounded-lg bg-indigo-50 flex items-center justify-center shrink-0 border border-indigo-100">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">Video giới thiệu</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">gioi_thieu.mp4</p>
                                <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                    <span>15.6 MB</span>
                                    <span>•</span>
                                    <span>Tải lên: 14/06/2024 15:55</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Thêm tài liệu (Upload Box) -->
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-slate-50 hover:border-slate-300 transition-colors group">
                            <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover:text-teal-600 group-hover:border-teal-200 shadow-sm transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-600 group-hover:text-teal-700 transition-colors">Thêm tài liệu</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
