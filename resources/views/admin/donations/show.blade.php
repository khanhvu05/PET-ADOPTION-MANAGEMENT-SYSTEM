<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('admin.donations.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Quyên Góp</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-700 font-bold">Chi Tiết Quyên Góp</span>
    </x-slot>

    <div x-data="{ activeTab: 'details' }" class="max-w-7xl mx-auto space-y-6 lg:space-y-8" x-cloak>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">Chi Tiết Quyên Góp</h1>
                    @php
                        $statusConfig = match($donation->Trang_thai) {
                            'success' => ['label' => 'Thành công', 'class' => 'bg-green-100 text-green-700 border-green-200'],
                            'pending' => ['label' => 'Đang xử lý', 'class' => 'bg-amber-100 text-amber-700 border-amber-200'],
                            'failed'  => ['label' => 'Thất bại', 'class' => 'bg-red-100 text-red-600 border-red-200'],
                            default   => ['label' => 'Không xác định', 'class' => 'bg-gray-100 text-gray-600 border-gray-200'],
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold {{ $statusConfig['class'] }} border gap-1 mt-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $statusConfig['label'] }}
                    </span>
                </div>
                <p class="text-sm font-medium text-slate-400">#{{ $donation->Ma_giao_dich_he_thong }}</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Quay lại
                </a>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-8 border-b border-slate-200">
            <button @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Thông tin chung
            </button>
            <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Lịch sử giao dịch
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
                                <span class="text-[13px] text-slate-500">Mã GD hệ thống</span>
                                <span class="text-[13px] font-bold text-slate-800 font-mono">{{ $donation->Ma_giao_dich_he_thong }}</span>
                            </div>
                            @if($donation->Ma_giao_dich_vnpay)
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Mã GD VNPay</span>
                                <span class="text-[13px] font-bold text-slate-800 font-mono">{{ $donation->Ma_giao_dich_vnpay }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Trạng thái</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $statusConfig['class'] }} border">{{ $statusConfig['label'] }}</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Số tiền</span>
                                <span class="text-[15px] font-bold text-teal-700">{{ number_format($donation->So_tien, 0, ',', '.') }} VNĐ</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Ngân hàng / Cổng TT</span>
                                <span class="text-[13px] font-bold text-slate-800">{{ $donation->Ma_ngan_hang ?? 'VNPay' }}</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Ngày tạo</span>
                                <span class="text-[13px] font-bold text-slate-800">{{ $donation->Ngay_tao->format('H:i:s - d/m/Y') }}</span>
                            </div>
                            @if($donation->Thoi_diem_thanh_toan)
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Thời điểm thanh toán</span>
                                <span class="text-[13px] font-bold text-emerald-700">{{ $donation->Thoi_diem_thanh_toan->format('H:i:s - d/m/Y') }}</span>
                            </div>
                            @endif
                            @if($donation->chienDich)
                            <div class="flex justify-between items-start">
                                <span class="text-[13px] text-slate-500">Chiến dịch</span>
                                <a href="{{ route('admin.donation_campaigns.index') }}" class="text-[13px] font-bold text-teal-600 hover:text-teal-700 text-right max-w-[200px]">
                                    {{ $donation->chienDich->Tieu_de }}
                                </a>
                            </div>
                            @else
                            <div class="flex justify-between items-start">
                                <span class="text-[13px] text-slate-500">Chiến dịch</span>
                                <span class="text-[13px] font-bold text-slate-400 italic">Quỹ chung</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Thông tin người ủng hộ -->
                    <div class="space-y-6">
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <h3 class="text-base font-bold text-slate-800 mb-6">Người ủng hộ</h3>
                            
                            <div class="flex items-center gap-4 mb-5">
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-[#F58A3C] font-black text-lg shrink-0">
                                    {{ mb_substr($donation->Ten_nguoi_ung_ho, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">{{ $donation->Ten_nguoi_ung_ho }}</p>
                                    @if($donation->An_danh)
                                        <span class="text-[11px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded font-bold">Ẩn danh</span>
                                    @endif
                                    @if($donation->nguoiDung)
                                        <p class="text-[12px] text-slate-500 mt-0.5">{{ $donation->nguoiDung->Email }}</p>
                                    @else
                                        <p class="text-[12px] text-slate-400 italic mt-0.5">Khách vãng lai</p>
                                    @endif
                                </div>
                            </div>

                            @if($donation->Loi_nhan)
                                <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">
                                    <p class="text-[12px] font-bold text-orange-700 mb-1">Lời nhắn</p>
                                    <p class="text-[13px] text-gray-700 italic leading-relaxed">"{{ $donation->Loi_nhan }}"</p>
                                </div>
                            @endif
                        </div>

                        @if($donation->nguoiDung)
                        <div class="bg-teal-50 border border-teal-100 rounded-2xl p-5">
                            <h4 class="text-sm font-bold text-teal-800 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Thông tin tài khoản
                            </h4>
                            <div class="space-y-2 text-[13px]">
                                <div class="flex justify-between">
                                    <span class="text-teal-700">Họ tên</span>
                                    <span class="font-bold text-teal-900">{{ $donation->nguoiDung->Ho_ten }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-teal-700">Email</span>
                                    <span class="font-bold text-teal-900">{{ $donation->nguoiDung->Email }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TAB 2: Lịch sử giao dịch (timeline đơn giản) -->
            <div x-show="activeTab === 'history'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                    <h3 class="text-base font-bold text-slate-800 mb-6">Nhật ký giao dịch</h3>
                    <div class="relative pl-6 space-y-6">
                        <div class="absolute left-[11px] top-2 bottom-2 w-px bg-slate-200"></div>
                        
                        <!-- Tạo đơn -->
                        <div class="relative">
                            <div class="absolute -left-6 top-1 w-3 h-3 bg-white border-2 border-slate-400 rounded-full z-10"></div>
                            <p class="text-xs font-bold text-slate-400 mb-0.5">{{ $donation->Ngay_tao->format('H:i:s - d/m/Y') }}</p>
                            <p class="text-sm font-bold text-slate-800">Tạo giao dịch ủng hộ</p>
                            <p class="text-xs text-slate-500 mt-0.5">Số tiền: {{ number_format($donation->So_tien, 0, ',', '.') }}đ — Trạng thái: Đang xử lý</p>
                        </div>

                        @if($donation->Thoi_diem_thanh_toan)
                        <div class="relative">
                            <div class="absolute -left-6 top-1 w-3.5 h-3.5 -ml-0.5 bg-emerald-50 border border-emerald-300 text-emerald-600 rounded-full z-10 flex items-center justify-center">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <p class="text-xs font-bold text-slate-400 mb-0.5">{{ $donation->Thoi_diem_thanh_toan->format('H:i:s - d/m/Y') }}</p>
                            <p class="text-sm font-bold text-emerald-700">Thanh toán thành công qua VNPay</p>
                            @if($donation->Ma_giao_dich_vnpay)
                                <p class="text-xs text-slate-500 mt-0.5">Mã GD VNPay: {{ $donation->Ma_giao_dich_vnpay }}</p>
                            @endif
                        </div>
                        @elseif($donation->Trang_thai === 'failed')
                        <div class="relative">
                            <div class="absolute -left-6 top-1 w-3.5 h-3.5 -ml-0.5 bg-red-50 border border-red-300 text-red-500 rounded-full z-10 flex items-center justify-center">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <p class="text-xs font-bold text-slate-400 mb-0.5">{{ $donation->updated_at->format('H:i:s - d/m/Y') }}</p>
                            <p class="text-sm font-bold text-red-600">Thanh toán thất bại</p>
                            @if($donation->Ma_phan_hoi_vnpay)
                                <p class="text-xs text-slate-500 mt-0.5">Mã lỗi VNPay: {{ $donation->Ma_phan_hoi_vnpay }}</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
