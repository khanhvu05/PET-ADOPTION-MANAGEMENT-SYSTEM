<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.donations.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Quyên Góp</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chi Tiết Quyên Góp</span>
    </x-slot>

    <div x-data="{ activeTab: 'details' }" class="max-w-7xl mx-auto space-y-6 lg:space-y-8" x-cloak>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">Chi Tiết Quyên Góp</h1>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 border border-green-200 gap-1 mt-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Hoàn thành
                    </span>
                </div>
                <p class="text-sm font-medium text-slate-400">#DON-00024</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
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
                Thông tin chung
            </button>
            <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Lịch sử giao dịch
            </button>
            <button @click="activeTab = 'notes'" :class="activeTab === 'notes' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Ghi chú
            </button>
        </div>

        <!-- Tabs Content -->
        <div>
            <!-- TAB 1: Thông tin chung -->
            <div x-show="activeTab === 'details'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left: Thông tin giao dịch -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin giao dịch</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Mã giao dịch</span>
                                <span class="text-[13px] font-bold text-slate-800">#DON-00024</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Trạng thái</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-green-100 text-green-700">Hoàn thành</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Số tiền</span>
                                <span class="text-[14px] font-bold text-teal-700">2,500,000 VND</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Hình thức quyên góp</span>
                                <span class="text-[13px] font-medium text-slate-800">Chuyển khoản ngân hàng</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Ngân hàng</span>
                                <span class="text-[13px] font-medium text-slate-800">Vietcombank</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Mã giao dịch ngân hàng</span>
                                <span class="text-[13px] font-medium text-slate-800">VCB123456789</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Ngày giao dịch</span>
                                <span class="text-[13px] font-medium text-slate-800">15/06/2024 14:30</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Lời nhắn</span>
                                <span class="text-[13px] font-medium text-slate-800">Chúc các bé sớm tìm được mái ấm ❤️</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Chiến dịch</span>
                                <div class="flex items-center gap-2">
                                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=100&h=100&fit=crop" class="w-8 h-8 rounded-lg object-cover" alt="Campaign">
                                    <div class="text-right">
                                        <p class="text-[12px] font-bold text-slate-800">Xây dựng trạm cứu hộ mới</p>
                                        <a href="#" class="text-[11px] font-bold text-teal-600 hover:underline">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Nguồn</span>
                                <span class="text-[13px] font-medium text-slate-800">Website</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Người xử lý</span>
                                <span class="text-[13px] font-medium text-slate-800">Admin</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Ngày tạo</span>
                                <span class="text-[13px] font-medium text-slate-800">15/06/2024 14:30</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-[13px] text-slate-500">Cập nhật lần cuối</span>
                                <span class="text-[13px] font-medium text-slate-800">15/06/2024 15:00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Thông tin người quyên góp -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin người quyên góp</h3>
                            
                            <div class="flex items-center gap-4 mb-6">
                                <img src="https://ui-avatars.com/api/?name=Tran+Quang+Huy&background=f1f5f9&color=64748b" class="w-12 h-12 rounded-full border border-slate-200" alt="Avatar">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-bold text-slate-900">Trần Quang Huy</h4>
                                        <span class="px-2 py-0.5 rounded-full bg-green-50 text-green-600 text-[10px] font-bold border border-green-200">Khách hàng</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="text-[13px] text-slate-700">quanghuy@gmail.com</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <span class="text-[13px] text-slate-700">0912 345 678</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-[13px] text-slate-700 leading-relaxed">123 Nguyễn Văn Cừ, Quận 5, TP. Hồ Chí Minh</span>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin hóa đơn -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin hóa đơn</h3>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                    <span class="text-[13px] text-slate-500">Mã hóa đơn</span>
                                    <span class="text-[13px] font-bold text-slate-800">INV-2024-00024</span>
                                </div>
                                <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                    <span class="text-[13px] text-slate-500">Trạng thái</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-teal-50 text-teal-700 border border-teal-200">Đã xuất hóa đơn</span>
                                </div>
                                <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                    <span class="text-[13px] text-slate-500">Ngày xuất</span>
                                    <span class="text-[13px] font-medium text-slate-800">15/06/2024 15:00</span>
                                </div>
                            </div>
                            
                            <button class="w-full flex items-center justify-center gap-2 border border-slate-200 bg-white hover:bg-slate-50 text-teal-700 text-sm font-bold py-2.5 rounded-xl transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Xem / Tải hóa đơn
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Lịch sử giao dịch -->
            <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left: Ảnh biên lai -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm h-full">
                    <h3 class="text-base font-bold text-slate-800 mb-6">Ảnh biên lai / Chứng từ</h3>
                    
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-4 flex flex-col items-center justify-center min-h-[400px] mb-6 relative group overflow-hidden bg-slate-50">
                        <div class="w-full max-w-sm bg-white border border-slate-200 rounded-lg shadow-sm p-6 space-y-4">
                            <!-- Mockup Receipt Header -->
                            <div class="flex items-center gap-2 border-b border-slate-100 pb-4">
                                <div class="w-6 h-6 rounded bg-green-500 shrink-0 flex items-center justify-center text-white text-xs font-bold">V</div>
                                <span class="font-bold text-green-700 text-sm">Vietcombank</span>
                            </div>
                            <div class="text-center pb-2">
                                <h4 class="font-bold text-slate-800 text-[13px]">BIÊN LAI CHUYỂN KHOẢN</h4>
                                <p class="text-[10px] text-slate-500">(Payment Receipt)</p>
                            </div>
                            <div class="space-y-2 text-[11px]">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Ngày, giờ giao dịch</span>
                                    <span class="text-slate-800 font-medium">15/06/2024 14:30:25</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Số tài khoản trích nợ</span>
                                    <span class="text-slate-800 font-medium">0011004322211</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Số tài khoản ghi có</span>
                                    <span class="text-slate-800 font-medium">0071001122334</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Tên người hưởng</span>
                                    <span class="text-slate-800 font-medium">Quỹ PetAdoption</span>
                                </div>
                                <div class="flex justify-between pt-2 border-t border-slate-100">
                                    <span class="text-slate-500">Số tiền</span>
                                    <span class="text-slate-800 font-bold">2,500,000 VND</span>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <span class="text-slate-500">Nội dung chuyển khoản</span>
                                    <span class="text-slate-800 font-medium text-right max-w-[150px]">Ủng hộ xây dựng trạm cứu hộ mới</span>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <span class="text-slate-500">Mã giao dịch</span>
                                    <span class="text-slate-800 font-medium">VCB123456789</span>
                                </div>
                            </div>
                            <div class="text-center pt-4 border-t border-slate-100">
                                <p class="text-[10px] font-bold text-green-700">Cảm ơn quý khách đã sử dụng dịch vụ của Vietcombank!</p>
                            </div>
                        </div>
                    </div>

                    <button class="w-full flex items-center justify-center gap-2 border border-slate-200 bg-white hover:bg-slate-50 text-teal-700 text-sm font-bold py-2.5 rounded-xl transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Tải ảnh gốc
                    </button>
                </div>

                <!-- Right: Lịch sử giao dịch -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm h-full">
                    <h3 class="text-base font-bold text-slate-800 mb-8">Lịch sử giao dịch</h3>
                    
                    <div class="relative pl-6 space-y-10 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-slate-100">
                        <!-- Node 1 -->
                        <div class="relative">
                            <div class="absolute -left-9 top-0.5 w-6 h-6 rounded-full bg-green-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[13px] text-slate-500 font-medium">15/06/2024 15:00</span>
                                </div>
                                <h4 class="text-[13px] font-bold text-green-700 mb-1">Hoàn thành</h4>
                                <p class="text-[13px] text-slate-600">Giao dịch đã được xác nhận và hoàn thành.</p>
                            </div>
                        </div>

                        <!-- Node 2 -->
                        <div class="relative">
                            <div class="absolute -left-9 top-0.5 w-6 h-6 rounded-full bg-blue-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[13px] text-slate-500 font-medium">15/06/2024 14:30</span>
                                </div>
                                <h4 class="text-[13px] font-bold text-slate-800 mb-1">Đang xử lý</h4>
                                <p class="text-[13px] text-slate-600">Giao dịch đang được kiểm tra và xác nhận.</p>
                            </div>
                        </div>

                        <!-- Node 3 -->
                        <div class="relative">
                            <div class="absolute -left-9 top-0.5 w-6 h-6 rounded-full bg-teal-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[13px] text-slate-500 font-medium">15/06/2024 14:30</span>
                                </div>
                                <h4 class="text-[13px] font-bold text-slate-800 mb-1">Đã nhận</h4>
                                <p class="text-[13px] text-slate-600">Giao dịch đã được tiếp nhận thành công.</p>
                            </div>
                        </div>

                        <!-- Node 4 -->
                        <div class="relative">
                            <div class="absolute -left-9 top-0.5 w-6 h-6 rounded-full bg-orange-100 border-4 border-white shadow-sm ring-1 ring-slate-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[13px] text-slate-500 font-medium">15/06/2024 14:30</span>
                                </div>
                                <h4 class="text-[13px] font-bold text-slate-800 mb-1">Tạo mới</h4>
                                <p class="text-[13px] text-slate-600">Đơn quyên góp được tạo.</p>
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
                                    <p class="text-[12px] text-slate-400 mt-0.5">15/06/2024 15:00</p>
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
                            <p class="text-[13px] font-medium text-slate-700 mt-2 leading-relaxed">Đã xác nhận tiền vào tài khoản Vietcombank. Tiến hành xuất biên lai và gửi email cảm ơn cho khách hàng.</p>
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

        </div>
    </div>
</x-admin-layout>
