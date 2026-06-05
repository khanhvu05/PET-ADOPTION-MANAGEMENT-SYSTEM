@extends('layouts.frontend')
@section('title', 'Chi tiết thú cưng - ' . $pet->Ten)
@section('content')

@php
    $healthPoints = [];
    if ($pet->Da_tiem_phong) $healthPoints[] = ['icon' => 'shield-check', 'text' => 'Đã tiêm phòng'];
    if ($pet->Da_triet_san) $healthPoints[] = ['icon' => 'activity', 'text' => 'Đã triệt sản'];
    $healthPoints[] = ['icon' => 'check-circle-2', 'text' => 'Tình trạng: ' . $pet->TrangThaiLabel];

    $traits = [];
    if ($pet->Than_thien_nguoi) $traits[] = 'Thân thiện với người';
    if ($pet->Than_thien_cho) $traits[] = 'Hòa đồng với chó khác';
    if ($pet->Than_thien_meo) $traits[] = 'Hòa đồng với mèo';
    if (empty($traits)) $traits[] = 'Ngoan ngoãn';
    
    $kichThuoc = $pet->Can_nang < 5 ? 'Nhỏ' : ($pet->Can_nang > 15 ? 'Lớn' : 'Trung bình');
@endphp

<div class="bg-white min-h-screen pt-24 pb-20">
    <div class="max-w-[1300px] mx-auto px-4 md:px-6">
        
        <!-- Back Button -->
        <a href="{{ route('frontend.adoptions.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#F58A3C] transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Quay lại danh sách thú cưng
        </a>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- LEFT COLUMN (Main Content) -->
            <div class="w-full lg:w-[65%] space-y-8">
                
                <!-- TOP SECTION: Images & Basic Info -->
                <div class="flex flex-col md:flex-row gap-8">
                    
                    <!-- Left: Images -->
                    <div class="w-full md:w-1/2">
                        <!-- Main Image -->
                        <div class="relative w-full aspect-[4/3] rounded-[24px] overflow-hidden mb-3 border border-gray-100">
                            <img src="{{ $pet->AnhUrl }}" alt="{{ $pet->Ten }}" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 {{ $pet->Loai == 'cho' ? 'bg-[#40C057]' : ($pet->Loai == 'meo' ? 'bg-[#FCC419]' : 'bg-[#0AA5C0]') }} text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-sm">
                                {{ $pet->LoaiLabel }}
                            </div>
                            @if($pet->Da_tiem_phong)
                            <div class="absolute top-4 right-4 bg-emerald-500 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-sm">
                                Đã tiêm phòng
                            </div>
                            @endif
                            <button class="absolute bottom-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-500 shadow-lg hover:scale-110 transition duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                        </div>
                        <!-- Thumbnails -->
                        <div class="flex gap-2">
                            <img src="{{ $pet->AnhUrl }}" class="w-[calc(25%-6px)] aspect-square rounded-xl object-cover border-2 border-[#F58A3C] cursor-pointer shadow-sm">
                            <img src="{{ $pet->AnhUrl }}" class="w-[calc(25%-6px)] aspect-square rounded-xl object-cover border border-gray-200 cursor-pointer hover:border-[#F58A3C] transition">
                            <img src="{{ $pet->AnhUrl }}" class="w-[calc(25%-6px)] aspect-square rounded-xl object-cover border border-gray-200 cursor-pointer hover:border-[#F58A3C] transition">
                            <img src="{{ $pet->AnhUrl }}" class="w-[calc(25%-6px)] aspect-square rounded-xl object-cover border border-gray-200 cursor-pointer hover:border-[#F58A3C] transition">
                        </div>
                    </div>

                    <!-- Right: Info -->
                    <div class="w-full md:w-1/2">
                        <div class="flex items-center gap-3 mb-4">
                            <h1 class="text-[32px] font-black text-[#1D2B53]">{{ $pet->Ten }}</h1>
                            @if($pet->Gioi_tinh == 'duc')
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 3l-7.5 7.5M21 3v6M21 3h-6M21 3a4 4 0 00-4-4H3v14a4 4 0 004 4h14a4 4 0 004-4V3z" style="display:none;"/><circle cx="10" cy="14" r="5" stroke-width="2.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 3l-7.5 7.5M21 3v6M21 3h-6"/></svg>
                            @elseif($pet->Gioi_tinh == 'cai')
                                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="9" r="5" stroke-width="2.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14v7M9 18h6"/></svg>
                            @endif
                        </div>

                        <div class="flex items-center gap-6 text-sm font-bold text-gray-500 mb-6">
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="calendar" class="w-4 h-4"></i> {{ $pet->NhomTuoiLabel }}
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="weight" class="w-4 h-4"></i> {{ $pet->Can_nang }} kg
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="map-pin" class="w-4 h-4"></i> {{ $pet->ViTriLabel }}
                            </div>
                        </div>

                        <div class="bg-[#FFF8F3] border border-orange-50 rounded-2xl p-5 mb-8 flex gap-3">
                            <i data-lucide="heart" class="w-5 h-5 text-[#F58A3C] shrink-0 mt-0.5"></i>
                            <p class="text-[13px] text-gray-600 font-medium leading-relaxed">
                                {{ Str::limit($pet->Mo_ta, 100) }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-[15px] font-black text-[#1D2B53] mb-4">Thông tin sức khỏe</h3>
                            <div class="space-y-4">
                                @foreach($healthPoints as $item)
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                                            <i data-lucide="{{ $item['icon'] }}" class="w-3 h-3"></i>
                                        </div>
                                        <span class="text-[13px] font-bold text-gray-600">{{ $item['text'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BOTTOM SECTION: Details & Story -->
                <div class="flex flex-col md:flex-row gap-6">
                    
                    <!-- Thông tin chi tiết -->
                    <div class="w-full md:w-[40%] bg-[#FAFAFA] rounded-[24px] p-6 border border-gray-100">
                        <h3 class="text-[15px] font-black text-[#1D2B53] mb-5">Thông tin chi tiết</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Giống loài</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $pet->Giong ?: 'Chưa xác định' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Độ tuổi</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $pet->NhomTuoiLabel }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Giới tính</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $pet->GioiTinhLabel }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Kích thước</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $kichThuoc }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Cân nặng</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $pet->Can_nang }} kg</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Địa điểm</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $pet->ViTriLabel }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-bold text-[#1D2B53]">Ngày tiếp nhận</span>
                                <span class="text-[13px] font-medium text-gray-500">{{ $pet->Ngay_tiep_nhan ? $pet->Ngay_tiep_nhan->format('d/m/Y') : 'Không rõ' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tính cách & Câu chuyện -->
                    <div class="w-full md:w-[60%] space-y-6">
                        <!-- Tính cách -->
                        <div class="bg-[#FAFAFA] rounded-[24px] p-6 border border-gray-100 relative overflow-hidden">
                            <h3 class="text-[15px] font-black text-[#1D2B53] mb-4">Tính cách</h3>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($traits as $trait)
                                    <span class="bg-[#FFF5EF] text-[#F58A3C] px-3 py-1.5 rounded-lg text-[11px] font-bold">{{ $trait }}</span>
                                @endforeach
                            </div>
                            <i data-lucide="paw-print" class="absolute bottom-4 right-4 w-12 h-12 text-[#F58A3C]/10 -rotate-12"></i>
                        </div>

                        <!-- Câu chuyện -->
                        <div class="bg-[#FAFAFA] rounded-[24px] p-6 border border-gray-100 relative overflow-hidden">
                            <h3 class="text-[15px] font-black text-[#1D2B53] mb-4">Câu chuyện của {{ $pet->Ten }}</h3>
                            <p class="text-[13px] text-gray-500 font-medium leading-relaxed whitespace-pre-wrap">
                                {{ $pet->Mo_ta ?: 'Chưa có thông tin mô tả chi tiết cho thú cưng này.' }}
                            </p>
                            <div class="absolute bottom-4 right-4 flex items-center justify-center w-8 h-8 opacity-20">
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN (Sidebar) -->
            <div class="w-full lg:w-[35%] space-y-6">
                
                <!-- CTA Card -->
                <div class="bg-[#FAFAFA] rounded-[32px] p-8 border border-gray-100">
                    <h3 class="text-[20px] font-black text-[#1D2B53] mb-2">Bạn muốn nhận nuôi {{ $pet->Ten }}?</h3>
                    <p class="text-[13px] text-gray-500 font-medium mb-6">Hãy yêu thương và cho bé một mái ấm hạnh phúc!</p>
                    
                    @if($pet->Trang_thai == 'san_sang')
                        @if($existingApplication)
                            <div class="w-full bg-orange-100 text-orange-600 font-bold py-3.5 px-4 rounded-xl text-center shadow-sm text-[13px] mb-4">
                                Bạn đã gửi đơn nhận nuôi bé này
                            </div>
                        @else
                            <a href="{{ route('frontend.adoptions.create', $pet->Ma_thu_cung) }}" class="w-full bg-[#F58A3C] hover:bg-orange-500 text-white font-black py-3.5 px-4 rounded-xl transition-all flex items-center justify-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.2)] hover:-translate-y-1 mb-4 text-[13px]">
                                <i data-lucide="heart" class="w-4 h-4"></i>
                                Gửi đơn nhận nuôi
                            </a>
                        @endif
                    @else
                        <div class="w-full bg-gray-200 text-gray-500 font-bold py-3.5 px-4 rounded-xl text-center shadow-sm text-[13px] mb-4">
                            Thú cưng {{ $pet->TrangThaiLabel }}
                        </div>
                    @endif
                    
                    <div class="flex gap-3">
                        <button class="flex-1 bg-white hover:bg-slate-50 text-[#1D2B53] border border-gray-200 font-bold py-3 px-4 rounded-xl transition flex items-center justify-center gap-2 text-[12px]">
                            <i data-lucide="share-2" class="w-3.5 h-3.5 text-emerald-500"></i> Chia sẻ
                        </button>
                        <button class="flex-1 bg-white hover:bg-slate-50 text-[#1D2B53] border border-gray-200 font-bold py-3 px-4 rounded-xl transition flex items-center justify-center gap-2 text-[12px]">
                            <i data-lucide="bookmark" class="w-3.5 h-3.5 text-emerald-500"></i> Lưu
                        </button>
                    </div>
                </div>

                <!-- Process Card -->
                <div class="bg-[#FAFAFA] rounded-[32px] p-8 border border-gray-100">
                    <h3 class="text-[16px] font-black text-[#1D2B53] mb-6">Quy trình nhận nuôi</h3>
                    
                    <div class="relative pl-6 space-y-6 mb-8">
                        <div class="absolute left-[11px] top-2 bottom-2 w-px bg-gray-200"></div>
                        
                        <div class="relative">
                            <div class="absolute -left-[33px] bg-[#FFF5EF] text-[#F58A3C] w-7 h-7 rounded-full flex items-center justify-center border-4 border-[#FAFAFA] z-10">
                                <i data-lucide="search" class="w-3 h-3"></i>
                            </div>
                            <h4 class="text-[13px] font-black text-[#1D2B53]">1. Tìm hiểu</h4>
                            <p class="text-[11px] font-bold text-gray-500 mt-0.5">Xem thông tin và chọn thú cưng phù hợp</p>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[33px] bg-[#FFF5EF] text-[#F58A3C] w-7 h-7 rounded-full flex items-center justify-center border-4 border-[#FAFAFA] z-10">
                                <i data-lucide="file-text" class="w-3 h-3"></i>
                            </div>
                            <h4 class="text-[13px] font-black text-[#1D2B53]">2. Gửi đơn</h4>
                            <p class="text-[11px] font-bold text-gray-500 mt-0.5">Điền thông tin và gửi đơn nhận nuôi</p>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[33px] bg-emerald-50 text-emerald-500 w-7 h-7 rounded-full flex items-center justify-center border-4 border-[#FAFAFA] z-10">
                                <i data-lucide="user" class="w-3 h-3"></i>
                            </div>
                            <h4 class="text-[13px] font-black text-[#1D2B53]">3. Phỏng vấn</h4>
                            <p class="text-[11px] font-bold text-gray-500 mt-0.5">Chúng tôi sẽ liên hệ trao đổi với bạn</p>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[33px] bg-emerald-500 text-white w-7 h-7 rounded-full flex items-center justify-center border-4 border-[#FAFAFA] z-10">
                                <i data-lucide="heart" class="w-3 h-3"></i>
                            </div>
                            <h4 class="text-[13px] font-black text-[#1D2B53]">4. Nhận nuôi</h4>
                            <p class="text-[11px] font-bold text-gray-500 mt-0.5">Hoàn tất thủ tục và đón bé về nhà</p>
                        </div>
                    </div>

                    <button class="w-full bg-white hover:bg-slate-50 text-[#1D2B53] border border-gray-200 font-black py-3 rounded-xl transition text-[12px]">
                        Xem chi tiết quy trình
                    </button>
                </div>

                <!-- Support Card -->
                <div class="bg-[#FAFAFA] rounded-[32px] p-8 border border-gray-100 relative overflow-hidden">
                    <div class="w-[60%]">
                        <h3 class="text-[16px] font-black text-[#1D2B53] mb-2">Cần hỗ trợ?</h3>
                        <p class="text-[11px] font-bold text-gray-500 mb-5 leading-relaxed">Đội ngũ của chúng tôi luôn sẵn sàng hỗ trợ bạn</p>
                        
                        <div class="space-y-3 text-[11px] font-bold text-gray-600">
                            <div class="flex items-center gap-2">
                                <i data-lucide="phone-call" class="w-3.5 h-3.5 text-emerald-500"></i> (+84) 123 456 789
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="mail" class="w-3.5 h-3.5 text-emerald-500"></i> support@petjam.com
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-emerald-500"></i> Thứ 2 - Chủ nhật: 8:00 - 20:00
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cute Dog Illustration -->
                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=200&h=200&fit=crop" alt="Support Dog" class="absolute bottom-0 right-0 w-32 h-32 object-cover object-top border-none transform -scale-x-100 mix-blend-multiply filter contrast-125">
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
