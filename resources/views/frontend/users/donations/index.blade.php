@extends('layouts.frontend')
@section('title', 'Lịch sử ủng hộ - ' . config('app.name'))

@section('content')
<div class="bg-[#FAFAFA] min-h-screen pt-24 pb-20">
    <div class="max-w-[1100px] mx-auto px-4 md:px-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-[13px] text-gray-400 mb-8 font-medium">
            <a href="{{ route('frontend.donations.index') }}" class="hover:text-[#F58A3C] transition-colors">Ủng hộ</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#1D2B53] font-bold">Lịch sử ủng hộ của tôi</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-[#1D2B53] mb-2">Lịch sử ủng hộ</h1>
                <p class="text-gray-500 font-medium text-[14px]">Danh sách tất cả các lần bạn đã đóng góp cho chúng tôi.</p>
            </div>
            <a href="{{ route('frontend.donations.process') }}" class="inline-flex items-center gap-2 bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[14px] px-5 py-3 rounded-xl shadow-[0_4px_15px_rgba(245,138,60,0.25)] hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Ủng hộ thêm
            </a>
        </div>

        @forelse($donations as $donation)
            @php
                $statusConfig = match($donation->Trang_thai) {
                    'success' => ['label' => 'Thành công', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-100', 'dot' => 'bg-emerald-500'],
                    'pending' => ['label' => 'Đang xử lý', 'class' => 'bg-amber-50 text-amber-700 border-amber-100', 'dot' => 'bg-amber-400'],
                    'failed'  => ['label' => 'Thất bại', 'class' => 'bg-red-50 text-red-600 border-red-100', 'dot' => 'bg-red-500'],
                    default   => ['label' => 'Không xác định', 'class' => 'bg-gray-50 text-gray-600 border-gray-100', 'dot' => 'bg-gray-400'],
                };
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.04)] hover:shadow-[0_4px_20px_rgba(0,0,0,0.08)] transition-all duration-200 mb-4 overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center gap-4 p-6">

                    {{-- Icon --}}
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-[#F58A3C]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                            <h3 class="font-bold text-[#1D2B53] text-[15px] truncate">
                                @if($donation->chienDich)
                                    {{ $donation->chienDich->Tieu_de }}
                                @else
                                    Ủng hộ Quỹ chung
                                @endif
                            </h3>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusConfig['class'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-4 text-[12px] text-gray-400 font-medium">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ ($donation->Thoi_diem_thanh_toan ?? $donation->Ngay_tao)->format('H:i - d/m/Y') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                {{ $donation->Ma_giao_dich_he_thong }}
                            </span>
                            @if($donation->An_danh)
                                <span class="bg-gray-100 text-gray-500 px-2 py-0.5 rounded text-[11px] font-bold">Ẩn danh</span>
                            @endif
                        </div>
                        @if($donation->Loi_nhan)
                            <p class="mt-2 text-[13px] text-gray-500 italic truncate">"{{ $donation->Loi_nhan }}"</p>
                        @endif
                    </div>

                    {{-- Amount --}}
                    <div class="text-right shrink-0">
                        <div class="text-2xl font-black {{ $donation->Trang_thai === 'success' ? 'text-emerald-600' : 'text-gray-400' }}">
                            +{{ number_format($donation->So_tien, 0, ',', '.') }}đ
                        </div>
                        @if($donation->Ma_ngan_hang)
                            <div class="text-[11px] text-gray-400 font-bold mt-1">{{ $donation->Ma_ngan_hang }}</div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-16 text-center">
                <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-10 h-10 text-[#F58A3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black text-[#1D2B53] mb-2">Bạn chưa có lần ủng hộ nào</h3>
                <p class="text-gray-500 text-[14px] mb-8 font-medium">Hãy là một trong những người đầu tiên chung tay vì các bé thú cưng!</p>
                <a href="{{ route('frontend.donations.process') }}" class="inline-flex items-center gap-2 bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[14px] px-8 py-3.5 rounded-xl shadow-[0_4px_15px_rgba(245,138,60,0.25)] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Ủng hộ ngay
                </a>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($donations->hasPages())
            <div class="mt-8">
                {{ $donations->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
