@extends('layouts.frontend')
@section('title', 'Kết quả quyên góp - ' . config('app.name'))

@section('styles')
<style>
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes ping-slow {
        75%, 100% { transform: scale(1.8); opacity: 0; }
    }
    .animate-bounce-in { animation: bounceIn 0.6s ease-out forwards; }
    .animate-fade-slide { animation: fadeSlideUp 0.5s ease-out forwards; }
    .animation-delay-1 { animation-delay: 0.15s; opacity: 0; }
    .animation-delay-2 { animation-delay: 0.3s; opacity: 0; }
    .animation-delay-3 { animation-delay: 0.45s; opacity: 0; }
    .ping-slow { animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite; }
</style>
@endsection

@section('content')
@php
    $isSuccess = $donation->Trang_thai === 'success';
@endphp

<div class="bg-[#FAFAFA] min-h-screen pt-24 pb-20">
    <div class="max-w-[700px] mx-auto px-4 md:px-6">

        {{-- STATUS ICON --}}
        <div class="text-center mb-10 animate-bounce-in">
            @if($isSuccess)
                <div class="relative inline-flex items-center justify-center">
                    <div class="absolute w-28 h-28 bg-emerald-400 rounded-full opacity-20 ping-slow"></div>
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-2xl shadow-teal-200 relative z-10">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-[#1D2B53] mt-6 mb-3">Cảm ơn bạn rất nhiều! 🎉</h1>
                <p class="text-gray-500 font-medium text-[15px]">
                    Khoản đóng góp <strong class="text-[#F58A3C]">{{ number_format($donation->So_tien, 0, ',', '.') }}đ</strong> của bạn đã được xác nhận thành công.
                </p>
            @else
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-red-400 to-rose-500 flex items-center justify-center shadow-2xl shadow-red-200 mx-auto">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-[#1D2B53] mt-6 mb-3">Giao dịch không thành công</h1>
                <p class="text-gray-500 font-medium text-[15px]">
                    Khoản đóng góp của bạn chưa được xử lý. Vui lòng thử lại hoặc liên hệ hỗ trợ.
                </p>
            @endif
        </div>

        {{-- TRANSACTION DETAIL CARD --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.06)] border border-gray-100 overflow-hidden animate-fade-slide animation-delay-1">

            {{-- Card Header --}}
            <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-[17px] font-black text-[#1D2B53]">Thông tin giao dịch</h2>
                @if($isSuccess)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 font-bold text-[12px] rounded-full border border-emerald-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Thành công
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 font-bold text-[12px] rounded-full border border-red-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Thất bại
                    </span>
                @endif
            </div>

            {{-- Card Body --}}
            <div class="px-8 py-6 divide-y divide-gray-50">

                <div class="flex justify-between items-center py-4">
                    <span class="text-[13px] text-gray-500 font-medium">Mã giao dịch hệ thống</span>
                    <span class="font-bold text-[#1D2B53] font-mono text-[13px] bg-gray-50 px-3 py-1 rounded-lg">{{ $donation->Ma_giao_dich_he_thong }}</span>
                </div>

                @if($donation->Ma_giao_dich_vnpay)
                    <div class="flex justify-between items-center py-4">
                        <span class="text-[13px] text-gray-500 font-medium">Mã giao dịch VNPay</span>
                        <span class="font-bold text-[#1D2B53] font-mono text-[13px]">{{ $donation->Ma_giao_dich_vnpay }}</span>
                    </div>
                @endif

                <div class="flex justify-between items-center py-4">
                    <span class="text-[13px] text-gray-500 font-medium">Thời gian</span>
                    <span class="font-bold text-[#1D2B53] text-[13px]">
                        {{ ($donation->Thoi_diem_thanh_toan ?? $donation->Ngay_tao)->format('H:i:s - d/m/Y') }}
                    </span>
                </div>

                <div class="flex justify-between items-center py-4">
                    <span class="text-[13px] text-gray-500 font-medium">Số tiền</span>
                    <span class="font-black text-[#F58A3C] text-xl">{{ number_format($donation->So_tien, 0, ',', '.') }}đ</span>
                </div>

                <div class="flex justify-between items-center py-4">
                    <span class="text-[13px] text-gray-500 font-medium">Người đóng góp</span>
                    <span class="font-bold text-[#1D2B53] text-[13px] flex items-center gap-2">
                        @if($donation->An_danh)
                            <span class="bg-gray-100 text-gray-500 px-2 py-0.5 rounded text-[11px] font-bold">Ẩn danh</span>
                        @else
                            {{ $donation->Ten_nguoi_ung_ho }}
                        @endif
                    </span>
                </div>

                <div class="flex justify-between items-start py-4">
                    <span class="text-[13px] text-gray-500 font-medium">Mục đích</span>
                    <span class="font-bold text-[#1D2B53] text-[13px] text-right max-w-[240px]">
                        @if($donation->chienDich)
                            <span class="text-teal-600">{{ $donation->chienDich->Tieu_de }}</span>
                        @else
                            <span class="text-gray-600">Quỹ chung</span>
                        @endif
                    </span>
                </div>

                @if($donation->Loi_nhan)
                    <div class="py-4">
                        <span class="text-[13px] text-gray-500 font-medium block mb-2">Lời nhắn</span>
                        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 text-[14px] text-gray-700 font-medium italic leading-relaxed">
                            "{{ $donation->Loi_nhan }}"
                        </div>
                    </div>
                @endif

                @if($donation->Ma_ngan_hang)
                    <div class="flex justify-between items-center py-4">
                        <span class="text-[13px] text-gray-500 font-medium">Ngân hàng</span>
                        <span class="font-bold text-[#1D2B53] text-[13px] bg-blue-50 px-3 py-1 rounded-lg text-blue-700">{{ $donation->Ma_ngan_hang }}</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="mt-8 space-y-3 animate-fade-slide animation-delay-2">
            @if($isSuccess)
                <a href="{{ route('frontend.donations.index') }}" class="w-full flex items-center justify-center gap-2 bg-[#F58A3C] hover:bg-[#E07930] text-white px-8 py-4 rounded-2xl font-bold text-[15px] shadow-[0_4px_20px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Xem các chiến dịch khác
                </a>
                @auth
                    <a href="{{ route('frontend.user.donations.index') }}" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-200 hover:border-teal-400 hover:bg-teal-50 text-[#1D2B53] hover:text-teal-700 px-8 py-4 rounded-2xl font-bold text-[15px] transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Xem lịch sử ủng hộ của tôi
                    </a>
                @endauth
            @else
                <a href="{{ route('frontend.donations.process') }}" class="w-full flex items-center justify-center gap-2 bg-[#F58A3C] hover:bg-[#E07930] text-white px-8 py-4 rounded-2xl font-bold text-[15px] shadow-[0_4px_20px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Thử lại
                </a>
                <a href="{{ route('frontend.donations.index') }}" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-600 px-8 py-4 rounded-2xl font-bold text-[15px] hover:bg-gray-50 transition-all duration-300">
                    Quay về trang ủng hộ
                </a>
            @endif
        </div>

        {{-- THANK YOU NOTES - only for success --}}
        @if($isSuccess)
            <div class="mt-8 bg-gradient-to-br from-orange-50 to-amber-50 border border-orange-100 rounded-3xl p-8 text-center animate-fade-slide animation-delay-3">
                <div class="text-4xl mb-4">🐾</div>
                <h3 class="font-black text-[#1D2B53] text-[18px] mb-2">Sự ủng hộ của bạn thật ý nghĩa!</h3>
                <p class="text-gray-600 text-[14px] leading-relaxed font-medium">
                    Cảm ơn bạn đã đồng hành cùng chúng tôi. Mỗi đồng góp của bạn sẽ mang lại những bữa ăn ngon, những buổi chữa bệnh và những nụ cười của các bé thú cưng đáng yêu.
                </p>
                <div class="mt-5 text-[13px] text-gray-400 font-medium">
                    📧 Email xác nhận đã được gửi (nếu bạn đã đăng nhập)
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
