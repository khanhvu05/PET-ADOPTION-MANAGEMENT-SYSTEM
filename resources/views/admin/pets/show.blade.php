<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.pets.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Thú Cưng</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chi Tiết Thú Cưng</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6 pb-12">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Chi Tiết Thú Cưng</h2>
                <p class="text-sm text-slate-500">Xem và quản lý thông tin chi tiết của thú cưng.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pets.index') }}" class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-sm transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
                <a href="#" class="bg-orange-500 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-orange-600 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Chỉnh sửa
                </a>
                <button class="bg-white border border-red-200 text-red-600 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-red-50 hover:shadow-sm transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Xóa
                </button>
            </div>
        </div>

        <!-- Top Section Split -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Main Profile Card -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm p-6 flex flex-col md:flex-row gap-6">
                <!-- Image Gallery -->
                <div class="w-full md:w-64 shrink-0 flex flex-col gap-3">
                    <div class="w-full aspect-[4/5] rounded-xl overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1" class="w-full h-full object-cover" alt="Lucky">
                    </div>
                    <div class="flex gap-2">
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba" class="w-12 h-12 rounded-lg object-cover bg-slate-100" alt="Thumb">
                        <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e" class="w-12 h-12 rounded-lg object-cover bg-slate-100" alt="Thumb">
                        <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500">+2</div>
                    </div>
                </div>

                <!-- Pet Info -->
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h1 class="text-3xl font-bold text-slate-900">Lucky</h1>
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1.5 border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Có sẵn
                                </span>
                            </div>
                            <p class="text-sm font-medium text-slate-500">#PET-001</p>
                        </div>
                    </div>

                    <!-- 2-col info grid -->
                    <div class="grid grid-cols-2 gap-y-4 gap-x-6 py-5 border-y border-slate-100">
                        <!-- Loài -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Loài</p>
                                <p class="text-sm font-semibold text-slate-800">Chó</p>
                            </div>
                        </div>
                        <!-- Giống -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Giống</p>
                                <p class="text-sm font-semibold text-slate-800">Golden Retriever</p>
                            </div>
                        </div>
                        <!-- Giới tính -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v4h-2zm0 6h2v2h-2z" transform="matrix(0 1 -1 0 24 0)"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Giới tính</p>
                                <p class="text-sm font-semibold text-slate-800">Đực</p>
                            </div>
                        </div>
                        <!-- Tuổi -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tuổi</p>
                                <p class="text-sm font-semibold text-slate-800">2 tuổi 3 tháng</p>
                            </div>
                        </div>
                        <!-- Cân nặng -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Cân nặng</p>
                                <p class="text-sm font-semibold text-slate-800">25 kg</p>
                            </div>
                        </div>
                        <!-- Màu lông -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Màu lông</p>
                                <p class="text-sm font-semibold text-slate-800">Vàng kem</p>
                            </div>
                        </div>
                        <!-- Vị trí -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Vị trí</p>
                                <p class="text-sm font-semibold text-slate-800">Hà Nội</p>
                            </div>
                        </div>
                        <!-- Ngày tạo -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Ngày tạo</p>
                                <p class="text-sm font-semibold text-slate-800">15/06/2024 10:30</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-5 bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-800 mb-2">Mô tả</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Lucky là một chú chó Golden Retriever rất thân thiện và thông minh. Bé hòa đồng với mọi người và đặc biệt rất thích chơi đùa.<br><br>
                            Lucky đã được huấn luyện cơ bản và có thói quen vệ sinh tốt.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Status Card -->
            <div class="lg:col-span-1 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Trạng thái & Hoạt động</h3>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <ul class="space-y-4">
                        <li class="flex justify-between items-center py-1">
                            <span class="text-sm text-slate-500 font-medium">Trạng thái</span>
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1.5 border border-green-200">
                                <span class="w-1 h-1 rounded-full bg-green-500"></span> Có sẵn
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Tình trạng sức khỏe</span>
                            <span class="text-sm font-semibold text-slate-800 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Tốt
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Tiêm phòng</span>
                            <span class="text-sm font-semibold text-slate-800 flex items-center gap-1">
                                Đã tiêm đầy đủ <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Đã triệt sản</span>
                            <span class="text-sm font-semibold text-slate-800 flex items-center gap-1">
                                Đã triệt sản <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Lượt xem</span>
                            <span class="text-sm font-semibold text-slate-800">1,234</span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Ngày cập nhật gần nhất</span>
                            <span class="text-sm font-semibold text-slate-800">16/06/2024 14:20</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div x-data="{ activeTab: 'details' }">
            <!-- Tabs Navigation -->
            <div class="flex gap-8 border-b border-slate-200 px-2 mt-6">
                <button @click="activeTab = 'details'" :class="activeTab === 'details' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Thông tin chi tiết
                </button>
                <button @click="activeTab = 'images'" :class="activeTab === 'images' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Hình ảnh
                </button>
                <button @click="activeTab = 'health'" :class="activeTab === 'health' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Lịch sử sức khỏe
                </button>
                <button @click="activeTab = 'adoptions'" :class="activeTab === 'adoptions' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Đơn nhận nuôi
                </button>
                <button @click="activeTab = 'notes'" :class="activeTab === 'notes' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Ghi chú
                </button>
            </div>

        <!-- Tab Contents -->
        <div class="mt-6">
            <!-- 1. Tab: Thông tin chi tiết -->
            <div x-show="activeTab === 'details'" x-cloak>
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                    <!-- Left Info Block -->
            <div class="lg:col-span-3 bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <!-- Tính cách -->
                <div class="mb-6">
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Tính cách</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-teal-50 text-teal-700 border border-teal-200 rounded-full text-xs font-bold shadow-sm">Thân thiện</span>
                        <span class="px-3 py-1 bg-green-50 text-green-700 border border-green-200 rounded-full text-xs font-bold shadow-sm">Hiền lành</span>
                        <span class="px-3 py-1 bg-orange-50 text-orange-700 border border-orange-200 rounded-full text-xs font-bold shadow-sm">Năng động</span>
                        <span class="px-3 py-1 bg-purple-50 text-purple-700 border border-purple-200 rounded-full text-xs font-bold shadow-sm">Thông minh</span>
                    </div>
                </div>

                <!-- Thói quen -->
                <div class="mb-6">
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Thói quen</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                            <svg class="w-4 h-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Đi vệ sinh đúng chỗ
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                            <svg class="w-4 h-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Không phá đồ
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                            <svg class="w-4 h-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Thân thiện với trẻ em
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                            <svg class="w-4 h-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Thân thiện với thú cưng khác
                        </li>
                    </ul>
                </div>

                <!-- Yêu thích -->
                <div>
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Yêu thích</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">
                        Chơi bóng, Đi dạo, Vuốt ve
                    </p>
                </div>
            </div>

            <!-- Right Info Block -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h4 class="text-sm font-bold text-slate-800 mb-4">Thông tin bổ sung</h4>
                <ul class="space-y-4">
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nguồn</p>
                        <p class="text-sm font-medium text-slate-800">Trung tâm cứu hộ</p>
                    </li>
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ngày nhập</p>
                        <p class="text-sm font-medium text-slate-800">10/06/2024</p>
                    </li>
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Người phụ trách</p>
                        <p class="text-sm font-medium text-slate-800">Admin</p>
                    </li>
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ghi chú</p>
                        <p class="text-sm font-medium text-slate-800">Không có ghi chú</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Timeline and Stats Block -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Timeline -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h4 class="text-sm font-bold text-slate-800 mb-6">Lịch sử hoạt động</h4>
                <div class="relative border-l-2 border-slate-100 ml-3 space-y-6">
                    <div class="relative pl-6">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-teal-100 border-2 border-teal-500 rounded-full"></div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline gap-2 mb-1">
                            <span class="text-xs font-bold text-slate-500 w-28 shrink-0">16/06/2024 14:20</span>
                            <span class="text-sm font-bold text-slate-800">Cập nhật thông tin</span>
                        </div>
                        <p class="text-sm text-slate-500 sm:pl-[120px]">Admin đã cập nhật thông tin thú cưng</p>
                    </div>
                    <div class="relative pl-6">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-slate-100 border-2 border-slate-300 rounded-full"></div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline gap-2 mb-1">
                            <span class="text-xs font-bold text-slate-500 w-28 shrink-0">15/06/2024 10:30</span>
                            <span class="text-sm font-bold text-slate-800">Thêm thú cưng</span>
                        </div>
                        <p class="text-sm text-slate-500 sm:pl-[120px]">Admin đã thêm thú cưng vào hệ thống</p>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h4 class="text-sm font-bold text-slate-800 mb-6">Thống kê nhanh</h4>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Stat 1 -->
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900">1,234</p>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Lượt xem</p>
                        </div>
                    </div>
                    <!-- Stat 2 -->
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900">56</p>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Lượt yêu thích</p>
                        </div>
                    </div>
                    <!-- Stat 3 -->
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900">12</p>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Lượt chia sẻ</p>
                        </div>
                    </div>
                    <!-- Stat 4 -->
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-slate-900">3</p>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Đơn nhận nuôi</p>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>

            <!-- 2. Tab: Hình ảnh -->
            <div x-show="activeTab === 'images'" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                    <h3 class="text-sm font-bold text-slate-800 mb-6">Hình ảnh</h3>
                    
                    <div class="space-y-4">
                        <!-- Row 1: 3 large images -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1" class="w-full h-full object-cover" alt="Image 1">
                            </div>
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a" class="w-full h-full object-cover" alt="Image 2">
                            </div>
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1537151608804-ea2d15a369ce" class="w-full h-full object-cover" alt="Image 3">
                            </div>
                        </div>

                        <!-- Row 2: thumbnails + add button -->
                        <div class="flex flex-wrap gap-4">
                            <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba" class="w-full h-full object-cover" alt="Thumb 1">
                            </div>
                            <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e" class="w-full h-full object-cover" alt="Thumb 2">
                            </div>
                            <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1517423440428-a5a00ad493e8" class="w-full h-full object-cover" alt="Thumb 3">
                            </div>
                            <button class="w-24 h-24 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center text-slate-500 hover:text-orange-brand hover:border-orange-brand hover:bg-orange-50 transition-colors">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span class="text-xs font-medium">Thêm ảnh</span>
                            </button>
                        </div>
                    </div>
                    
                    <p class="text-sm font-medium text-slate-500 mt-8">Tổng cộng 7 ảnh</p>
                </div>
            </div>

            <!-- 3. Tab: Lịch sử sức khỏe -->
            <div x-show="activeTab === 'health'" x-cloak>
                <div class="space-y-6">
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                        <h3 class="text-sm font-bold text-slate-800 mb-6">Lịch sử sức khỏe</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-[11px] text-slate-500 font-bold uppercase tracking-wider bg-slate-50/50 rounded-lg">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-lg">Ngày</th>
                                        <th class="px-4 py-3">Loại</th>
                                        <th class="px-4 py-3">Nội dung</th>
                                        <th class="px-4 py-3">Bác sĩ / Phòng khám</th>
                                        <th class="px-4 py-3 rounded-r-lg">Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody class="text-slate-700 font-medium divide-y divide-slate-100">
                                    <tr>
                                        <td class="px-4 py-4 text-slate-500 font-bold whitespace-nowrap">15/06/2024</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Tiêm phòng</td>
                                        <td class="px-4 py-4">Tiêm vaccine 5 bệnh (Care)</td>
                                        <td class="px-4 py-4 text-slate-600 whitespace-nowrap">PetCare Clinic</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Định kỳ</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-slate-500 font-bold whitespace-nowrap">10/06/2024</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Khám sức khỏe</td>
                                        <td class="px-4 py-4">Khám tổng quát</td>
                                        <td class="px-4 py-4 text-slate-600 whitespace-nowrap">PetCare Clinic</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Sức khỏe tốt</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-slate-500 font-bold whitespace-nowrap">10/06/2024</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Tẩy giun</td>
                                        <td class="px-4 py-4">Tẩy giun định kỳ</td>
                                        <td class="px-4 py-4 text-slate-600 whitespace-nowrap">PetCare Clinic</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">-</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-slate-500 font-bold whitespace-nowrap">05/06/2024</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Điều trị</td>
                                        <td class="px-4 py-4">Điều trị viêm tai nhẹ</td>
                                        <td class="px-4 py-4 text-slate-600 whitespace-nowrap">PetCare Clinic</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Đã khỏi</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-slate-500 font-bold whitespace-nowrap">01/06/2024</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">Tiêm phòng</td>
                                        <td class="px-4 py-4">Tiêm vaccine dại</td>
                                        <td class="px-4 py-4 text-slate-600 whitespace-nowrap">PetCare Clinic</td>
                                        <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                        <h3 class="text-sm font-bold text-slate-800 mb-6">Lịch nhắc nhở</h3>
                        
                        <div class="space-y-4">
                            <!-- Reminder 1 -->
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">Tiêm phòng định kỳ</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <span class="text-sm font-bold text-slate-500 hidden sm:block">15/06/2025</span>
                                    <span class="bg-green-50 text-green-600 border border-green-100 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Còn 364 ngày</span>
                                </div>
                            </div>
                            <!-- Reminder 2 -->
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">Tẩy giun định kỳ</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <span class="text-sm font-bold text-slate-500 hidden sm:block">10/09/2024</span>
                                    <span class="bg-green-50 text-green-600 border border-green-100 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Còn 91 ngày</span>
                                </div>
                            </div>
                            <!-- Reminder 3 -->
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">Khám sức khỏe định kỳ</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <span class="text-sm font-bold text-slate-500 hidden sm:block">10/12/2024</span>
                                    <span class="bg-green-50 text-green-600 border border-green-100 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Còn 182 ngày</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Tab: Đơn nhận nuôi -->
            <div x-show="activeTab === 'adoptions'" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <h3 class="text-sm font-bold text-slate-800">Lịch sử đơn nhận nuôi</h3>
                        <a href="{{ route('admin.adoptions.create', ['from' => 'pet', 'pet_id' => 1]) }}" class="px-4 py-2 bg-teal-600 text-white font-bold text-[13px] rounded-xl hover:bg-teal-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            Thêm đơn mới
                        </a>
                    </div>
                    
                    <div class="relative border-l-2 border-slate-100 ml-4 space-y-6">
                        <!-- Application 1 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[17px] top-4 w-8 h-8 bg-teal-50 border-2 border-white rounded-full flex items-center justify-center text-teal-600 shadow-[0_0_0_2px_theme(colors.slate.100)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="bg-white border border-slate-100 rounded-xl p-5 shadow-sm">
                                <div class="flex flex-col md:flex-row justify-between gap-4">
                                    <!-- Left side -->
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2 py-0.5 rounded-md">#ADP-0002</span>
                                        </div>
                                        <h4 class="text-base font-bold text-slate-800 mb-3">Trần Quang Huy</h4>
                                        <div class="space-y-2">
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                0932 345 678
                                            </p>
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                quanghuy@gmail.com
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Right side -->
                                    <div class="flex flex-col justify-between items-start md:items-end">
                                        <div class="space-y-2.5 mb-4 md:mb-0 w-full md:w-auto">
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày tạo:</span> <span class="text-slate-800 font-medium">14/06/2024 15:45</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Trạng thái:</span> <span class="bg-green-50 text-green-600 text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-green-100">Đã phê duyệt</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày xử lý:</span> <span class="text-slate-800 font-medium">15/06/2024 09:20</span></p>
                                        </div>
                                        <button class="px-4 py-1.5 border border-teal-200 text-teal-600 font-bold text-sm rounded-lg hover:bg-teal-50 transition-colors w-full md:w-auto text-center">Xem chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Application 2 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[17px] top-4 w-8 h-8 bg-blue-50 border-2 border-white rounded-full flex items-center justify-center text-blue-600 shadow-[0_0_0_2px_theme(colors.slate.100)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="bg-white border border-slate-100 rounded-xl p-5 shadow-sm">
                                <div class="flex flex-col md:flex-row justify-between gap-4">
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2 py-0.5 rounded-md">#ADP-0001</span>
                                        </div>
                                        <h4 class="text-base font-bold text-slate-800 mb-3">Nguyễn Minh Anh</h4>
                                        <div class="space-y-2">
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                0901 234 567
                                            </p>
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                minhanh@gmail.com
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between items-start md:items-end">
                                        <div class="space-y-2.5 mb-4 md:mb-0 w-full md:w-auto">
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày tạo:</span> <span class="text-slate-800 font-medium">15/06/2024 10:30</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Trạng thái:</span> <span class="bg-orange-50 text-orange-600 text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-orange-100">Đang xử lý</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày xử lý:</span> <span class="text-slate-800 font-medium">-</span></p>
                                        </div>
                                        <button class="px-4 py-1.5 border border-teal-200 text-teal-600 font-bold text-sm rounded-lg hover:bg-teal-50 transition-colors w-full md:w-auto text-center">Xem chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Application 3 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[17px] top-4 w-8 h-8 bg-rose-50 border-2 border-white rounded-full flex items-center justify-center text-rose-600 shadow-[0_0_0_2px_theme(colors.slate.100)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <div class="bg-white border border-slate-100 rounded-xl p-5 shadow-sm">
                                <div class="flex flex-col md:flex-row justify-between gap-4">
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2 py-0.5 rounded-md">#ADP-0003</span>
                                        </div>
                                        <h4 class="text-base font-bold text-slate-800 mb-3">Phạm Thảo Vy</h4>
                                        <div class="space-y-2">
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                0987 654 321
                                            </p>
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                thaovy@gmail.com
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between items-start md:items-end">
                                        <div class="space-y-2.5 mb-4 md:mb-0 w-full md:w-auto">
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày tạo:</span> <span class="text-slate-800 font-medium">14/06/2024 09:15</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Trạng thái:</span> <span class="bg-rose-50 text-rose-600 text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-rose-100">Đã từ chối</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày xử lý:</span> <span class="text-slate-800 font-medium">14/06/2024 11:00</span></p>
                                        </div>
                                        <button class="px-4 py-1.5 border border-teal-200 text-teal-600 font-bold text-sm rounded-lg hover:bg-teal-50 transition-colors w-full md:w-auto text-center">Xem chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-sm font-medium text-slate-500 mt-8">Hiển thị 1 đến 3 của 3 kết quả</p>
                </div>
            </div>

            <!-- 5. Tab: Ghi chú -->
            <div x-show="activeTab === 'notes'" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                    <h3 class="text-sm font-bold text-slate-800 mb-6">Ghi chú</h3>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <input type="text" class="flex-1 rounded-lg border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm px-4 py-2.5 bg-slate-50/50" placeholder="Nhập ghi chú...">
                        <button class="bg-teal-700 hover:bg-teal-800 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Thêm ghi chú
                        </button>
                    </div>

                    <div class="space-y-4">
                        <!-- Note 1 -->
                        <div class="p-5 rounded-xl border border-slate-100 bg-white shadow-sm hover:shadow-md transition-shadow relative group">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=475569&color=fff" alt="Admin" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">Admin</h4>
                                    <p class="text-[11px] font-medium text-slate-500">16/06/2024 14:20</p>
                                </div>
                            </div>
                            <p class="text-sm text-slate-600 pl-[56px] leading-relaxed">Cập nhật thông tin sức khỏe: Tiêm vaccine 5 bệnh và tẩy giun.</p>
                            
                            <div class="absolute right-4 top-4 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors p-1.5 rounded-lg hover:bg-blue-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="text-slate-400 hover:text-red-600 transition-colors p-1.5 rounded-lg hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Note 2 -->
                        <div class="p-5 rounded-xl border border-slate-100 bg-white shadow-sm hover:shadow-md transition-shadow relative group">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=475569&color=fff" alt="Admin" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">Admin</h4>
                                    <p class="text-[11px] font-medium text-slate-500">16/06/2024 10:30</p>
                                </div>
                            </div>
                            <p class="text-sm text-slate-600 pl-[56px] leading-relaxed">Thêm mới thú cưng vào hệ thống.</p>
                            
                            <div class="absolute right-4 top-4 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors p-1.5 rounded-lg hover:bg-blue-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="text-slate-400 hover:text-red-600 transition-colors p-1.5 rounded-lg hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Note 3 -->
                        <div class="p-5 rounded-xl border border-slate-100 bg-white shadow-sm hover:shadow-md transition-shadow relative group">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=475569&color=fff" alt="Admin" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">Admin</h4>
                                    <p class="text-[11px] font-medium text-slate-500">10/06/2024 16:00</p>
                                </div>
                            </div>
                            <p class="text-sm text-slate-600 pl-[56px] leading-relaxed">Lucky rất thích chơi bóng và đi dạo.</p>
                            
                            <div class="absolute right-4 top-4 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors p-1.5 rounded-lg hover:bg-blue-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="text-slate-400 hover:text-red-600 transition-colors p-1.5 rounded-lg hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
