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
                <a href="{{ route('admin.pets.edit', $pet->Ma_thu_cung) }}" class="bg-teal-700 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Chỉnh sửa
                </a>
            </div>
        </div>

        <!-- Top Section Split -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Main Profile Card -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm p-6 flex flex-col md:flex-row gap-6">
                <!-- Image Gallery -->
                <div class="w-full md:w-64 shrink-0 flex flex-col gap-3">
                    <div class="w-full aspect-[4/5] rounded-xl overflow-hidden bg-slate-100">
                        <img src="{{ $pet->Anh_dai_dien ?: $pet->anh_url }}" class="w-full h-full object-cover" alt="{{ $pet->Ten }}">
                    </div>
                    @if(is_array($pet->Thu_vien_anh) && count($pet->Thu_vien_anh) > 0)
                    <div class="flex gap-2">
                        @foreach(array_slice($pet->Thu_vien_anh, 0, 3) as $index => $url)
                            @if($index == 2 && count($pet->Thu_vien_anh) > 3)
                                <div class="relative w-12 h-12 rounded-lg overflow-hidden">
                                    <img src="{{ $url }}" class="w-full h-full object-cover bg-slate-100" alt="Thumb">
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-xs font-bold text-white cursor-pointer" @click="activeTab = 'images'">+{{ count($pet->Thu_vien_anh) - 2 }}</div>
                                </div>
                            @else
                                <img src="{{ $url }}" class="w-12 h-12 rounded-lg object-cover bg-slate-100" alt="Thumb">
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Pet Info -->
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h1 class="text-3xl font-bold text-slate-900">{{ $pet->Ten }}</h1>
                                @php
                                    $statusColors = [
                                        'san_sang' => 'green',
                                        'chua_san_sang' => 'orange',
                                        'da_nhan_nuoi' => 'blue',
                                        'da_mat' => 'slate'
                                    ];
                                    $color = $statusColors[$pet->Trang_thai] ?? 'slate';
                                @endphp
                                <span class="bg-{{ $color }}-100 text-{{ $color }}-700 text-xs font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1.5 border border-{{ $color }}-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500"></span> {{ $pet->trang_thai_label }}
                                </span>
                            </div>
                            <p class="text-sm font-medium text-slate-500">#{{ $pet->Ma_hien_thi }}</p>
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
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->loai_label }}</p>
                            </div>
                        </div>
                        <!-- Giống -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Giống</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->Giong }}</p>
                            </div>
                        </div>
                        <!-- Giới tính -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="10" cy="14" r="5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 3l-7.5 7.5M21 3v6M21 3h-6"/></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Giới tính</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->gioi_tinh_label }}</p>
                            </div>
                        </div>
                        <!-- Tuổi -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tuổi</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->nhom_tuoi_label }}</p>
                            </div>
                        </div>
                        <!-- Cân nặng -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Cân nặng</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->Can_nang ? number_format($pet->Can_nang, 1) . ' kg' : 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                        <!-- Màu lông -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Màu lông</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->Mau_long ?: 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                        <!-- Vị trí -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Vị trí</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->vi_tri_label }}</p>
                            </div>
                        </div>
                        <!-- Ngày tạo -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Ngày tạo</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $pet->Ngay_tao->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-5 bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-800 mb-2">Mô tả</h4>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $pet->Mo_ta ?: 'Chưa có mô tả.' }}
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
                            <span class="bg-{{ $color }}-100 text-{{ $color }}-700 text-xs font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1.5 border border-{{ $color }}-200">
                                <span class="w-1 h-1 rounded-full bg-{{ $color }}-500"></span> {{ $pet->trang_thai_label }}
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Tiêm phòng</span>
                            <span class="text-sm font-semibold text-slate-800 flex items-center gap-1">
                                {{ $pet->Da_tiem_phong ? 'Đã tiêm' : 'Chưa tiêm' }} <svg class="w-3.5 h-3.5 text-{{ $pet->Da_tiem_phong ? 'green' : 'slate' }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Đã triệt sản</span>
                            <span class="text-sm font-semibold text-slate-800 flex items-center gap-1">
                                {{ $pet->Da_triet_san ? 'Đã triệt sản' : 'Chưa triệt sản' }} <svg class="w-3.5 h-3.5 text-{{ $pet->Da_triet_san ? 'green' : 'slate' }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-slate-100 pt-3">
                            <span class="text-sm text-slate-500 font-medium">Ngày cập nhật gần nhất</span>
                            <span class="text-sm font-semibold text-slate-800">{{ $pet->Ngay_cap_nhat->format('d/m/Y H:i') }}</span>
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
                <button @click="activeTab = 'health'" :class="activeTab === 'health' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Lịch sử tiêm phòng
                </button>
                <button @click="activeTab = 'adoptions'" :class="activeTab === 'adoptions' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Đơn nhận nuôi
                </button>
                <button @click="activeTab = 'notes'" :class="activeTab === 'notes' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Lịch sử cập nhật
                </button>
                <button @click="activeTab = 'rescue'" :class="activeTab === 'rescue' ? 'pb-3 text-sm font-bold text-teal-700 border-b-2 border-teal-700 flex items-center gap-2' : 'pb-3 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-2'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Ca cứu hộ
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
                        @if($pet->Tinh_cach)
                            @foreach(explode(',', $pet->Tinh_cach) as $trait)
                                <span class="px-3 py-1 bg-teal-50 text-teal-700 border border-teal-200 rounded-full text-xs font-bold shadow-sm">{{ trim($trait) }}</span>
                            @endforeach
                        @else
                            <span class="text-sm text-slate-500">Chưa cập nhật</span>
                        @endif
                    </div>
                </div>

                <!-- Thói quen -->
                <div class="mb-6">
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Thói quen</h4>
                    @if($pet->Thoi_quen)
                        <p class="text-sm text-slate-600 leading-relaxed font-medium whitespace-pre-line">
                            {{ $pet->Thoi_quen }}
                        </p>
                    @else
                        <span class="text-sm text-slate-500">Chưa cập nhật</span>
                    @endif
                </div>

                <!-- Yêu thích -->
                <div>
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Yêu thích</h4>
                    @if($pet->Yeu_thich)
                        <p class="text-sm text-slate-600 leading-relaxed font-medium whitespace-pre-line">
                            {{ $pet->Yeu_thich }}
                        </p>
                    @else
                        <span class="text-sm text-slate-500">Chưa cập nhật</span>
                    @endif
                </div>
            </div>

            <!-- Right Info Block -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                <h4 class="text-sm font-bold text-slate-800 mb-4">Thông tin bổ sung</h4>
                <ul class="space-y-4">
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ngày tiếp nhận</p>
                        <p class="text-sm font-medium text-slate-800">{{ $pet->Ngay_tiep_nhan ? $pet->Ngay_tiep_nhan->format('d/m/Y') : 'Chưa rõ' }}</p>
                    </li>
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Người phụ trách</p>
                        <p class="text-sm font-medium text-slate-800">{{ $pet->nguoiPhuTrach ? $pet->nguoiPhuTrach->Ho_ten : 'Không có' }}</p>
                    </li>
                    <li>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Chế độ ăn đặc biệt</p>
                        <p class="text-sm font-medium text-slate-800">{{ $pet->Che_do_an_dac_biet ?: 'Không có' }}</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Timeline and Stats Block removed as data is not tracked in DB -->
            </div>

            <!-- 3. Tab: Lịch sử tiêm phòng -->
            <div x-show="activeTab === 'health'" x-cloak>
                <div class="space-y-6">
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <h3 class="text-sm font-bold text-slate-800">Lịch sử tiêm phòng</h3>
                            <button x-data @click="$dispatch('open-modal', 'add-health-record')" class="px-4 py-2 bg-teal-600 text-white font-bold text-[13px] rounded-xl hover:bg-teal-700 transition-colors shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                Thêm bản ghi mới
                            </button>
                        </div>
                        
                        <!-- Form Thêm mới ẩn/hiện (Có thể dùng Modal hoặc thả xuống) -->
                        <div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'add-health-record') open = true" class="mb-6">
                            <div x-show="open" x-transition class="bg-slate-50 border border-slate-200 rounded-xl p-5">
                                <h4 class="text-[13px] font-bold text-slate-800 mb-4">Nhập thông tin khám/tiêm phòng</h4>
                                <form action="{{ route('admin.pets.health.store', $pet->Ma_thu_cung) }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Ngày thực hiện <span class="text-red-500">*</span></label>
                                            <input type="date" name="Ngay_tiem" required class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nội dung / Tên Vaccine <span class="text-red-500">*</span></label>
                                            <input type="text" name="Ten_vac_xin" required placeholder="VD: Vaccine Care 5 bệnh..." class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Bác sĩ / Phòng khám</label>
                                            <input type="text" name="Ten_noi_tiem" placeholder="Tên phòng khám" class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Chi phí (VNĐ)</label>
                                            <input type="number" name="Chi_phi" min="0" placeholder="VD: 150000" class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-3">
                                        <button type="button" @click="open = false" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-200 bg-slate-100 rounded-lg">Hủy</button>
                                        <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg">Lưu bản ghi</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-[11px] text-slate-500 font-bold uppercase tracking-wider bg-slate-50/50 rounded-lg">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-lg">Ngày</th>
                                        <th class="px-4 py-3">Nội dung / Tên Vaccine</th>
                                        <th class="px-4 py-3">Bác sĩ / Phòng khám</th>
                                        <th class="px-4 py-3">Chi phí</th>
                                        <th class="px-4 py-3 rounded-r-lg text-right">Thao tác</th>
                                    </tr>
                                </thead>
                                    @if($pet->lichSuTiemChung->count() > 0)
                                        @foreach($pet->lichSuTiemChung as $health)
                                        <tbody x-data="{ 
                                            openEdit: false,
                                            isUpdating: false,
                                            tenVacXin: '{{ addslashes($health->Ten_vac_xin) }}',
                                            tenNoiTiem: '{{ addslashes($health->Ten_noi_tiem ?? '') }}',
                                            chiPhi: '{{ $health->Chi_phi ? round($health->Chi_phi) : '' }}',
                                            ngayTiemNhac: '{{ $health->Ngay_tiem_nhac_tiep ? $health->Ngay_tiem_nhac_tiep->format('Y-m-d') : '' }}',
                                            
                                            async submitUpdate(e) {
                                                this.isUpdating = true;
                                                const formData = new FormData(e.target);
                                                try {
                                                    const res = await fetch(e.target.action, {
                                                        method: 'POST',
                                                        headers: {
                                                            'X-Requested-With': 'XMLHttpRequest',
                                                            'Accept': 'application/json'
                                                        },
                                                        body: formData
                                                    });
                                                    const result = await res.json();
                                                    if (res.ok && result.success) {
                                                        this.tenVacXin = result.data.Ten_vac_xin;
                                                        this.tenNoiTiem = result.data.Ten_noi_tiem || '';
                                                        this.chiPhi = result.data.Chi_phi || '';
                                                        this.ngayTiemNhac = result.data.Ngay_tiem_nhac_tiep ? result.data.Ngay_tiem_nhac_tiep.substring(0, 10) : '';
                                                        this.openEdit = false;
                                                    } else {
                                                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                                                    }
                                                } catch(error) {
                                                    alert('Lỗi kết nối mạng.');
                                                } finally {
                                                    this.isUpdating = false;
                                                }
                                            }
                                        }" class="text-slate-700 font-medium border-b border-slate-100 last:border-b-0">
                                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                                <td class="px-4 py-4 text-slate-500 font-bold whitespace-nowrap">{{ $health->Ngay_tiem ? $health->Ngay_tiem->format('d/m/Y') : '-' }}</td>
                                                <td class="px-4 py-4" x-text="tenVacXin"></td>
                                                <td class="px-4 py-4 text-slate-600 whitespace-nowrap" x-text="tenNoiTiem ? tenNoiTiem : '-'"></td>
                                                <td class="px-4 py-4 font-bold text-slate-800 whitespace-nowrap" x-text="chiPhi ? new Intl.NumberFormat('vi-VN').format(chiPhi) + ' đ' : '-'"></td>
                                                <td class="px-4 py-4 text-right">
                                                    <button type="button" @click="openEdit = !openEdit" class="text-teal-600 hover:text-teal-800 bg-teal-50 hover:bg-teal-100 p-1.5 rounded-lg transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Edit Row -->
                                            <tr x-show="openEdit" x-cloak class="bg-slate-50">
                                                <td colspan="5" class="p-0">
                                                    <div class="p-4 border-b border-slate-100 shadow-inner">
                                                        <form action="{{ route('admin.pets.health.update', [$pet->Ma_thu_cung, $health->Ma_lan_tiem]) }}" @submit.prevent="submitUpdate" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                                                <div>
                                                                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Ngày thực hiện (Cố định)</label>
                                                                    <input type="date" name="Ngay_tiem" value="{{ $health->Ngay_tiem ? $health->Ngay_tiem->format('Y-m-d') : '' }}" readonly class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500 bg-slate-100 text-slate-500 cursor-not-allowed pointer-events-none">
                                                                </div>
                                                                <div>
                                                                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tên Vaccine <span class="text-red-500">*</span></label>
                                                                    <input type="text" name="Ten_vac_xin" x-model="tenVacXin" required class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500 bg-white">
                                                                </div>
                                                                <div>
                                                                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Phòng khám</label>
                                                                    <input type="text" name="Ten_noi_tiem" x-model="tenNoiTiem" class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500 bg-white">
                                                                </div>
                                                                <div>
                                                                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Chi phí (VNĐ)</label>
                                                                    <input type="number" name="Chi_phi" min="0" x-model="chiPhi" class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500 bg-white">
                                                                </div>
                                                            </div>
                                                            <div class="flex justify-end gap-3">
                                                                <button type="button" @click="openEdit = false" class="px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-200 bg-slate-100 rounded-lg" :disabled="isUpdating">Hủy</button>
                                                                <button type="submit" class="px-3 py-1.5 text-xs font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg disabled:opacity-50" :disabled="isUpdating">
                                                                    <span x-show="!isUpdating">Cập nhật</span>
                                                                    <span x-show="isUpdating">Đang lưu...</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    @else
                                        <tbody class="text-slate-700 font-medium">
                                            <tr>
                                                <td colspan="5" class="px-4 py-8 text-center text-slate-500 font-medium">Chưa có dữ liệu lịch sử sức khỏe.</td>
                                            </tr>
                                        </tbody>
                                    @endif
                            </table>
                        </div>
                    </div>


                </div>
            </div>

            <!-- 4. Tab: Đơn nhận nuôi -->
            <div x-show="activeTab === 'adoptions'" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <h3 class="text-sm font-bold text-slate-800">Lịch sử đơn nhận nuôi</h3>
                    </div>
                    
                    @if($pet->donNhanNuoi->count() > 0)
                    <div class="relative border-l-2 border-slate-100 ml-4 space-y-6">
                        @foreach($pet->donNhanNuoi as $application)
                        <div class="relative pl-8">
                            @php
                                $statusIcons = [
                                    'pending' => 'bg-orange-50 text-orange-600',
                                    'approved' => 'bg-green-50 text-green-600',
                                    'rejected' => 'bg-rose-50 text-rose-600',
                                ];
                                $iconClass = $statusIcons[$application->Trang_thai] ?? 'bg-slate-50 text-slate-600';
                            @endphp
                            <div class="absolute -left-[17px] top-4 w-8 h-8 {{ $iconClass }} border-2 border-white rounded-full flex items-center justify-center shadow-[0_0_0_2px_theme(colors.slate.100)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="bg-white border border-slate-100 rounded-xl p-5 shadow-sm">
                                <div class="flex flex-col md:flex-row justify-between gap-4">
                                    <!-- Left side -->
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2 py-0.5 rounded-md">#{{ $application->Ma_don }}</span>
                                        </div>
                                        <h4 class="text-base font-bold text-slate-800 mb-3">{{ $application->Nguoi_Dung ? $application->Nguoi_Dung->Ho_ten : 'Khách vãng lai' }}</h4>
                                        <div class="space-y-2">
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                {{ $application->Nguoi_Dung ? $application->Nguoi_Dung->So_dien_thoai : ($application->So_dien_thoai ?: 'Không rõ') }}
                                            </p>
                                            <p class="text-sm text-slate-600 flex items-center gap-2 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                {{ $application->Nguoi_Dung ? $application->Nguoi_Dung->Email : 'Không rõ' }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Right side -->
                                    <div class="flex flex-col justify-between items-start md:items-end">
                                        <div class="space-y-2.5 mb-4 md:mb-0 w-full md:w-auto">
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Ngày tạo:</span> <span class="text-slate-800 font-medium">{{ $application->Ngay_tao->format('d/m/Y H:i') }}</span></p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Trạng thái:</span> 
                                                <span class="{{ str_replace('text', 'border', $iconClass) }} text-[11px] font-bold px-2.5 py-0.5 rounded-full border">
                                                    {{ $application->trang_thai_label }}
                                                </span>
                                            </p>
                                            <p class="text-sm flex items-center justify-between md:justify-end gap-3"><span class="text-slate-500 font-medium">Cập nhật:</span> <span class="text-slate-800 font-medium">{{ $application->Ngay_cap_nhat ? $application->Ngay_cap_nhat->format('d/m/Y H:i') : '-' }}</span></p>
                                        </div>
                                        <a href="{{ route('admin.adoptions.show', $application->Ma_don) }}" class="px-4 py-1.5 border border-teal-200 text-teal-600 font-bold text-sm rounded-lg hover:bg-teal-50 transition-colors w-full md:w-auto text-center">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <p class="text-sm font-medium text-slate-500 mt-8">Tổng cộng {{ $pet->donNhanNuoi->count() }} đơn nhận nuôi</p>
                    @else
                    <div class="p-8 text-center bg-slate-50 border border-slate-200 rounded-2xl">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="text-sm font-bold text-slate-500">Bé chưa có đơn nhận nuôi nào.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- 5. Tab: Ghi chú -->
            <div x-show="activeTab === 'notes'" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                    <h3 class="text-sm font-bold text-slate-800 mb-6">Lịch sử cập nhật hồ sơ</h3>

                    <div class="space-y-4">
                        @if($pet->ghiChu->count() > 0)
                            @foreach($pet->ghiChu as $note)
                            <div class="flex items-start gap-4 p-4 bg-slate-50 border border-slate-100 rounded-xl">
                                <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 shrink-0 text-xs font-bold">
                                    {{ mb_substr($note->nguoiDung->Ho_ten ?? 'Hệ thống', 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-bold text-slate-800">{{ $note->nguoiDung->Ho_ten ?? 'Hệ thống' }}</span>
                                        <span class="text-[11px] text-slate-400">{{ $note->Ngay_tao->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <p class="text-sm text-slate-600 font-medium whitespace-pre-line">{{ $note->Noi_dung }}</p>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="p-8 text-center bg-slate-50 border border-slate-200 rounded-2xl">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <p class="text-sm font-bold text-slate-500">Chưa có lịch sử cập nhật nào.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
            <!-- 5. Tab: Ca cứu hộ -->
            <div x-show="activeTab === 'rescue'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                @if($pet->caCuuHo->count() > 0)
                @php $rescue = $pet->caCuuHo->first(); @endphp
                <div x-data="{ isEditing: false }" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-sm font-bold text-slate-800">Thông tin ca cứu hộ #{{ substr($rescue->Ma_ca_cuu_ho, 0, 8) }}</h3>
                        <button x-show="!isEditing" @click="isEditing = true" type="button" class="px-4 py-2 text-xs font-bold text-teal-700 bg-teal-50 hover:bg-teal-100 rounded-lg transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Cập nhật
                        </button>
                    </div>

                    <!-- Mode Xem -->
                    <div x-show="!isEditing" class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ngày cứu hộ</p>
                            <p class="text-sm font-medium text-slate-800">{{ $rescue->Ngay_cuu_ho ? $rescue->Ngay_cuu_ho->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Loại cứu hộ</p>
                            <p class="text-sm font-medium text-slate-800">
                                @switch($rescue->Loai_cuu_ho)
                                    @case('lang_thang') Lang thang @break
                                    @case('lac_duong') Lạc đường @break
                                    @case('bi_bo_roi') Bị bỏ rơi @break
                                    @case('bi_nguoc_dai') Bị ngược đãi @break
                                    @default {{ $rescue->Loai_cuu_ho }}
                                @endswitch
                            </p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Địa điểm phát hiện</p>
                            <p class="text-sm font-medium text-slate-800">{{ $rescue->Dia_diem_cuu_ho ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Người báo cáo</p>
                            <p class="text-sm font-medium text-slate-800">{{ $rescue->Nguoi_bao_cao ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Chi phí cứu hộ</p>
                            <p class="text-sm font-medium text-slate-800">{{ $rescue->Chi_phi_cuu_ho ? number_format($rescue->Chi_phi_cuu_ho) . ' đ' : '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ghi chú</p>
                            <p class="text-sm font-medium text-slate-800 whitespace-pre-line">{{ $rescue->Ghi_chu ?: '-' }}</p>
                        </div>
                    </div>

                    <!-- Mode Sửa -->
                    <form x-show="isEditing" x-cloak action="{{ route('admin.pets.rescue.update', [$pet->Ma_thu_cung, $rescue->Ma_ca_cuu_ho]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Ngày cứu hộ <span class="text-red-500">*</span></label>
                                <input type="date" name="Ngay_cuu_ho" value="{{ $rescue->Ngay_cuu_ho ? $rescue->Ngay_cuu_ho->format('Y-m-d') : '' }}" required class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Loại cứu hộ <span class="text-red-500">*</span></label>
                                <select name="Loai_cuu_ho" required class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                                    <option value="">-- Chọn loại --</option>
                                    <option value="lang_thang" {{ $rescue->Loai_cuu_ho == 'lang_thang' ? 'selected' : '' }}>Lang thang</option>
                                    <option value="lac_duong" {{ $rescue->Loai_cuu_ho == 'lac_duong' ? 'selected' : '' }}>Lạc đường</option>
                                    <option value="bi_bo_roi" {{ $rescue->Loai_cuu_ho == 'bi_bo_roi' ? 'selected' : '' }}>Bị bỏ rơi</option>
                                    <option value="bi_nguoc_dai" {{ $rescue->Loai_cuu_ho == 'bi_nguoc_dai' ? 'selected' : '' }}>Bị ngược đãi</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Địa điểm phát hiện</label>
                                <input type="text" name="Dia_diem_cuu_ho" value="{{ $rescue->Dia_diem_cuu_ho }}" placeholder="VD: Đường Nguyễn Văn Cừ, Q5..." class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Người báo cáo</label>
                                <input type="text" name="Nguoi_bao_cao" value="{{ $rescue->Nguoi_bao_cao }}" placeholder="Tên người báo" class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Chi phí cứu hộ (VNĐ)</label>
                                <input type="number" name="Chi_phi_cuu_ho" value="{{ $rescue->Chi_phi_cuu_ho }}" placeholder="VD: 500000" min="0" class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Ghi chú</label>
                                <textarea name="Ghi_chu" rows="2" placeholder="Mô tả tình trạng khi phát hiện..." class="w-full rounded-lg border-slate-200 text-sm focus:ring-teal-500 focus:border-teal-500">{{ $rescue->Ghi_chu }}</textarea>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-slate-100">
                            <button type="button" @click="isEditing = false" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-200 bg-slate-100 rounded-lg">Hủy</button>
                            <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="py-8 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="text-sm font-medium text-slate-500">Thú cưng này không có thông tin ca cứu hộ liên kết.</p>
                        <p class="text-xs text-slate-400 mt-1">Vui lòng cập nhật trong phần chỉnh sửa thú cưng nếu cần.</p>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>
