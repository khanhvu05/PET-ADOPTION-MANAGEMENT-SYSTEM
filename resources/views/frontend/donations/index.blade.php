@extends('layouts.frontend')
@section('title', 'Ủng hộ')

@section('content')
<!-- HERO SECTION -->
<div class="relative pt-24 md:pt-32 pb-20 overflow-hidden bg-white">
    <!-- Abstract background blobs -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-teal-50 rounded-full blur-3xl opacity-60 -z-10 translate-x-1/3 -translate-y-1/4"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-orange-50 rounded-full blur-3xl opacity-60 -z-10 -translate-x-1/2 translate-y-1/3"></div>

    <div class="max-w-[1200px] mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <!-- Left Content -->
            <div class="w-full lg:w-[45%]">
                <h1 class="text-[40px] lg:text-[52px] font-black text-[#1D2B53] leading-[1.1] mb-6">
                    Mỗi đóng góp nhỏ,<br>
                    <span class="text-[#F58A3C] inline-flex items-center gap-3">
                        Một cuộc đời được yêu thương
                        <i data-lucide="heart" class="w-10 h-10 text-[#F58A3C] fill-current"></i>
                    </span>
                </h1>
                
                <p class="text-gray-500 font-medium text-[16px] leading-relaxed mb-10">
                    Cùng chúng tôi mang đến bữa ăn, thức ăn, chăm sóc y tế và yêu thương cho những thú cưng kém may mắn.
                </p>
                
                <div class="flex flex-wrap items-center gap-4 mb-10">
                    <a href="{{ route('frontend.donations.process') }}" class="bg-[#F58A3C] hover:bg-[#E07930] text-white px-8 py-3.5 rounded-xl font-bold flex items-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300">
                        <i data-lucide="heart-handshake" class="w-5 h-5"></i>
                        Ủng hộ ngay
                    </a>
                </div>
            </div>
            
            <!-- Right Content -->
            <div class="w-full lg:w-[55%] relative">
                <!-- Floating Icons -->
                <div class="absolute top-10 right-10 animate-bounce" style="animation-duration: 3s;"><i data-lucide="heart" class="w-8 h-8 text-pink-400 fill-current"></i></div>
                <div class="absolute bottom-20 left-10 animate-bounce" style="animation-duration: 4s;"><i data-lucide="star" class="w-6 h-6 text-yellow-400 fill-current"></i></div>
                <div class="absolute top-1/2 left-0 animate-pulse"><i data-lucide="sparkles" class="w-10 h-10 text-teal-400"></i></div>
                
                <img src="{{ asset('images/hero-img.png') }}" alt="Pets" class="w-full max-w-[600px] mx-auto object-contain relative z-10 drop-shadow-2xl">
                
                <!-- Circular background decoration -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[450px] h-[450px] bg-gradient-to-tr from-teal-50 to-orange-50 rounded-full -z-0"></div>
            </div>
        </div>
    </div>
</div>

<!-- LỜI KÊU GỌI -->
<div class="max-w-[1000px] mx-auto px-6 -mt-8 relative z-20">
    <div class="bg-gradient-to-r from-orange-50 to-amber-50/30 rounded-[24px] p-8 md:p-12 border border-orange-100/50 shadow-sm flex flex-col md:flex-row items-center gap-8 md:gap-12 overflow-hidden relative">
        <div class="w-24 h-24 rounded-full bg-white shadow-sm flex items-center justify-center shrink-0 relative z-10">
            <i data-lucide="heart-handshake" class="w-12 h-12 text-[#F58A3C]"></i>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-[#1D2B53] mb-3">Lời kêu gọi từ trái tim</h3>
            <p class="text-gray-600 font-medium text-[15px] leading-relaxed mb-4">
                Hàng ngày có hàng ngàn thú cưng bị bỏ rơi, bị bạo hành và không nơi nương tựa. Chúng tôi tin rằng, với sự chung tay của cộng đồng, mọi thú cưng đều xứng đáng có một mái ấm và một cuộc sống hạnh phúc.
            </p>
            <p class="font-bold text-[#F58A3C] text-[15px]">
                Sự sẻ chia của bạn hôm nay, có thể thay đổi cả cuộc đời của một bé chó, mèo.<br>
                Hãy cùng nhau lan tỏa yêu thương! <i data-lucide="heart" class="inline w-4 h-4 ml-1 fill-current"></i>
            </p>
        </div>
        <!-- Decorative abstract shape inside the card -->
        <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-orange-100/50 to-transparent z-0"></div>
    </div>
</div>

<!-- QUY TRÌNH ỦNG HỘ -->
<div class="py-20 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-[#1D2B53] mb-4">Quy trình ủng hộ</h2>
            <div class="w-16 h-1 bg-[#F58A3C] mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <!-- Connecting line for desktop -->
            <div class="hidden md:block absolute top-[45px] left-1/8 right-1/8 w-3/4 mx-auto h-[1px] border-t-2 border-dashed border-teal-100 z-0"></div>
            
            <div class="text-center relative z-10">
                <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 relative group hover:-translate-y-2 transition-transform duration-300">
                    <div class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-teal-500 text-white font-bold flex items-center justify-center text-sm shadow-md">1</div>
                    <i data-lucide="hand-coins" class="w-10 h-10 text-[#F58A3C]"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Chọn mức ủng hộ</h4>
                <p class="text-gray-500 text-[13px] px-4">Lựa chọn số tiền phù hợp với mong muốn của bạn</p>
            </div>
            
            <div class="text-center relative z-10">
                <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 relative group hover:-translate-y-2 transition-transform duration-300">
                    <div class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-teal-500 text-white font-bold flex items-center justify-center text-sm shadow-md">2</div>
                    <i data-lucide="wallet" class="w-10 h-10 text-teal-500"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Thanh toán an toàn</h4>
                <p class="text-gray-500 text-[13px] px-4">Thanh toán nhanh chóng, bảo mật qua VNPAY</p>
            </div>

            <div class="text-center relative z-10">
                <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 relative group hover:-translate-y-2 transition-transform duration-300">
                    <div class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-teal-500 text-white font-bold flex items-center justify-center text-sm shadow-md">3</div>
                    <i data-lucide="file-check-2" class="w-10 h-10 text-[#F58A3C]"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Chứng từ rõ ràng</h4>
                <p class="text-gray-500 text-[13px] px-4">Toàn bộ khoản ủng hộ minh bạch trên danh sách công khai</p>
            </div>

            <div class="text-center relative z-10">
                <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 relative group hover:-translate-y-2 transition-transform duration-300">
                    <div class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-teal-500 text-white font-bold flex items-center justify-center text-sm shadow-md">4</div>
                    <i data-lucide="cat" class="w-10 h-10 text-pink-500"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Thay đổi cuộc sống</h4>
                <p class="text-gray-500 text-[13px] px-4">Mang đến bữa ăn, y tế và mái ấm cho thú cưng</p>
            </div>
        </div>
    </div>
</div>


<!-- CHIẾN DỊCH GÂY QUỸ -->
<div class="py-20 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#1D2B53] mb-4">Chiến dịch đang gây quỹ</h2>
                <p class="text-gray-500 font-medium text-[15px] max-w-2xl">Chung tay giúp đỡ các bé thú cưng đang gặp hoàn cảnh khó khăn cần được chăm sóc y tế khẩn cấp hoặc những dự án xây dựng mái ấm tốt hơn.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                @php
                    $daysLeft = null;
                    if ($campaign->Ngay_ket_thuc) {
                        $daysLeft = round(now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($campaign->Ngay_ket_thuc)->startOfDay(), false));
                    }
                @endphp
                <div class="bg-white rounded-[20px] overflow-hidden border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-300 group flex flex-col">
                    <div class="aspect-[16/10] relative overflow-hidden bg-gray-100">
                        <img src="{{ $campaign->Anh_dai_dien ?? 'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $campaign->Tieu_de }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-teal-500 text-white text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">Gây quỹ</div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-[18px] font-black text-[#1D2B53] mb-2 leading-tight group-hover:text-teal-600 transition-colors">
                            <a href="{{ route('frontend.donations.process.campaign', $campaign->Ma_chien_dich) }}">{{ $campaign->Tieu_de }}</a>
                        </h3>
                        <p class="text-[14px] text-gray-500 mb-6 line-clamp-2">{{ $campaign->Mo_ta ?? 'Chưa có mô tả...' }}</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-end mb-2">
                                <div>
                                    <span class="text-[18px] font-black text-teal-600 leading-none">{{ number_format($campaign->So_tien_hien_tai, 0, ',', '.') }}đ</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[13px] font-bold text-gray-400 leading-none">/ {{ $campaign->So_tien_muc_tieu ? number_format($campaign->So_tien_muc_tieu, 0, ',', '.') . 'đ' : 'Không giới hạn' }}</span>
                                </div>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="h-2.5 w-full bg-gray-100 rounded-full overflow-hidden mb-4">
                                <div class="h-full bg-gradient-to-r from-teal-400 to-teal-500 rounded-full" style="width: {{ $campaign->progress }}%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between py-4 border-t border-gray-50 mb-4">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="info" class="w-4 h-4 text-gray-400"></i>
                                    <span class="text-[13px] font-bold text-gray-600">Đang hoạt động</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="clock" class="w-4 h-4 text-gray-400"></i>
                                    <span class="text-[13px] font-bold text-gray-600">
                                        @if($daysLeft !== null)
                                            @if($daysLeft >= 0)
                                                Còn {{ $daysLeft }} ngày
                                            @else
                                                Đã hết hạn
                                            @endif
                                        @else
                                            Vô thời hạn
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('frontend.donations.process.campaign', $campaign->Ma_chien_dich) }}" class="block w-full text-center bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[15px] py-3.5 rounded-xl transition-colors shadow-[0_4px_10px_rgba(245,138,60,0.2)]">
                                Ủng hộ ngay
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-3xl p-10 text-center border border-gray-100 shadow-sm max-w-lg mx-auto flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mb-4 text-teal-600">
                        <i data-lucide="alert-circle" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-lg font-bold text-dark mb-1">Hiện tại không có chiến dịch hoạt động</h3>
                    <p class="text-gray-500 text-sm mb-6">Bạn vẫn có thể đóng góp vào quỹ chung của chúng tôi để giúp đỡ các bé thú cưng.</p>
                    <a href="{{ route('frontend.donations.process') }}" class="btn-primary text-sm">Ủng hộ quỹ chung</a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- BẢNG VINH DANH -->
<div class="py-20 bg-[#FFF5EF]/40 border-t border-orange-100/30">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-[#1D2B53] mb-4 flex items-center justify-center gap-3">
                Bảng Vinh Danh Nhà Hảo Tâm
                <i data-lucide="sparkles" class="w-8 h-8 text-amber-500 fill-current"></i>
            </h2>
            <p class="text-gray-500 font-medium text-[15px]">Chân thành cảm ơn những đóng góp và tấm lòng vàng từ cộng đồng dành cho các bé thú cưng.</p>
            <div class="w-16 h-1 bg-[#F58A3C] mx-auto rounded-full mt-4"></div>
        </div>

        @if($recentDonations->isEmpty())
            <div class="bg-white rounded-3xl p-10 text-center border border-gray-100 shadow-sm max-w-lg mx-auto flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="heart" class="w-8 h-8 text-primary"></i>
                </div>
                <h3 class="text-lg font-bold text-dark mb-1">Hãy là người đầu tiên ủng hộ!</h3>
                <p class="text-gray-500 text-sm mb-6 font-medium">Mọi sự đóng góp đều vô cùng ý nghĩa đối với các bé.</p>
                <a href="{{ route('frontend.donations.process') }}" class="btn-primary text-sm">Ủng hộ ngay</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                @foreach($recentDonations as $donation)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex items-start gap-4 transition-all duration-300 hover:shadow-md">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center shrink-0 text-primary">
                            <i data-lucide="heart" class="w-6 h-6 fill-current"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-bold text-[#1D2B53] truncate">
                                        {{ $donation->An_danh ? 'Nhà hảo tâm ẩn danh' : $donation->Ten_nguoi_ung_ho }}
                                    </h4>
                                    <p class="text-xs text-gray-400 font-bold mt-0.5">
                                        {{ $donation->Thoi_diem_thanh_toan ? $donation->Thoi_diem_thanh_toan->format('H:i d/m/Y') : $donation->Ngay_tao->format('H:i d/m/Y') }}
                                    </p>
                                </div>
                                <span class="text-emerald-600 font-black text-[16px] shrink-0">+{{ number_format($donation->So_tien, 0, ',', '.') }}đ</span>
                            </div>
                            @if($donation->Loi_nhan)
                                <div class="p-3 bg-gray-50 rounded-xl text-gray-600 text-[13px] font-medium leading-relaxed italic border border-gray-100/50">
                                    "{{ $donation->Loi_nhan }}"
                                </div>
                            @endif
                            @if($donation->chienDich)
                                <p class="text-[11px] font-bold text-teal-600 mt-2 flex items-center gap-1">
                                    <i data-lucide="tag" class="w-3 h-3"></i>
                                    Chiến dịch: {{ $donation->chienDich->Tieu_de }}
                                </p>
                            @else
                                <p class="text-[11px] font-bold text-gray-400 mt-2 flex items-center gap-1">
                                    <i data-lucide="globe" class="w-3 h-3"></i>
                                    Ủng hộ quỹ chung
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- STATS -->
<div class="py-16 bg-white border-y border-gray-100">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-start justify-between gap-10">
            <div class="lg:w-1/3">
                <h3 class="text-2xl font-black text-[#1D2B53] mb-3">Cùng nhau tạo nên<br>điều kỳ diệu</h3>
                <p class="text-gray-500 font-medium text-[14px]">Nhờ sự tin tưởng và ủng hộ của cộng đồng, chúng tôi đã và đang giúp đỡ nhiều thú cưng hơn mỗi ngày.</p>
            </div>
            
            <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Stat 1 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-orange-50 flex items-center justify-center text-[#F58A3C]">
                        <i data-lucide="home" class="w-6 h-6"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-2xl font-black text-[#F58A3C] leading-tight">1.850+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide leading-tight mt-0.5">Thú cưng được giúp đỡ</div>
                    </div>
                </div>
                
                <!-- Stat 2 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-teal-50 flex items-center justify-center text-teal-500">
                        <i data-lucide="stethoscope" class="w-6 h-6"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-2xl font-black text-teal-500 leading-tight">3.280+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide leading-tight mt-0.5">Lượt khám &amp; điều trị</div>
                    </div>
                </div>
                
                <!-- Stat 3: Tổng Quyên Góp -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-pink-50 flex items-center justify-center text-pink-500">
                        <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-2xl font-black text-pink-500 leading-tight break-all">{{ number_format($totalAmount, 0, ',', '.') }}đ</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide leading-tight mt-0.5">Tổng tiền đã ủng hộ</div>
                    </div>
                </div>
                
                <!-- Stat 4 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                        <i data-lucide="utensils" class="w-6 h-6"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-2xl font-black text-blue-500 leading-tight">12.450+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide leading-tight mt-0.5">Bữa ăn được trao</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TRUST BADGES -->
<div class="py-12 bg-[#FAFAFA]">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="flex flex-col items-center text-center px-4">
                <i data-lucide="shield-check" class="w-8 h-8 text-blue-500 mb-3"></i>
                <h4 class="font-bold text-[#1D2B53] text-[15px] mb-1">Minh bạch</h4>
                <p class="text-[12px] text-gray-500 font-medium">Công khai quỹ và báo cáo sử dụng định kỳ</p>
            </div>
            <div class="flex flex-col items-center text-center px-4">
                <i data-lucide="lock" class="w-8 h-8 text-teal-500 mb-3"></i>
                <h4 class="font-bold text-[#1D2B53] text-[15px] mb-1">An toàn</h4>
                <p class="text-[12px] text-gray-500 font-medium">Bảo mật thông tin và giao dịch tuyệt đối</p>
            </div>
            <div class="flex flex-col items-center text-center px-4">
                <i data-lucide="heart" class="w-8 h-8 text-pink-500 mb-3"></i>
                <h4 class="font-bold text-[#1D2B53] text-[15px] mb-1">Uy tín</h4>
                <p class="text-[12px] text-gray-500 font-medium">Được cộng đồng tin tưởng và đồng hành</p>
            </div>
            <div class="flex flex-col items-center text-center px-4">
                <i data-lucide="check-circle-2" class="w-8 h-8 text-[#F58A3C] mb-3"></i>
                <h4 class="font-bold text-[#1D2B53] text-[15px] mb-1">Trách nhiệm</h4>
                <p class="text-[12px] text-gray-500 font-medium">Cam kết sử dụng 100% cho mục tiêu cứu trợ</p>
            </div>
        </div>
    </div>
</div>

<!-- BÉ NGOAN TRONG TUẦN -->
<div class="py-20 bg-white">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-[#1D2B53] mb-4">Bé ngoan trong tuần</h2>
            <p class="text-gray-500 font-medium text-[15px]">Những bé đang tìm kiếm một mái ấm yêu thương. Bạn có thể thay đổi cuộc đời của các bé!</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pet 1 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="aspect-square relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Mio" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-teal-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Đang tìm nhà</div>
                </div>
                <div class="p-5">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2">Mio</h3>
                    <div class="flex items-center gap-3 text-[12px] font-bold text-gray-500 mb-3">
                        <span>Chó</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>4 tháng</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>3kg</span>
                    </div>
                    <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Cún rất hiếu động, ngoan ngoãn và thân thiện. Đã tiêm vắc xin đầy đủ.</p>
                    <a href="#" class="text-teal-600 font-bold text-[13px] hover:text-teal-700 flex items-center gap-1">Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>

            <!-- Pet 2 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="aspect-[4/3] sm:aspect-square relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Cam" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-teal-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Đang tìm nhà</div>
                </div>
                <div class="p-5">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2">Cam</h3>
                    <div class="flex items-center gap-3 text-[12px] font-bold text-gray-500 mb-3">
                        <span>Mèo</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>3 tháng</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>2kg</span>
                    </div>
                    <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Lông vàng cam rực rỡ, thích được vuốt ve và rất quấn người.</p>
                    <a href="#" class="text-teal-600 font-bold text-[13px] hover:text-teal-700 flex items-center gap-1">Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>

            <!-- Pet 3 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="aspect-[4/3] sm:aspect-square relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bin" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-teal-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Đang tìm nhà</div>
                </div>
                <div class="p-5">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2">Bin</h3>
                    <div class="flex items-center gap-3 text-[12px] font-bold text-gray-500 mb-3">
                        <span>Chó</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>2 tháng</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>10kg</span>
                    </div>
                    <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Siêu khỏe mạnh, thông minh và cực kỳ trung thành.</p>
                    <a href="#" class="text-teal-600 font-bold text-[13px] hover:text-teal-700 flex items-center gap-1">Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>

            <!-- Pet 4 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                <div class="aspect-[4/3] sm:aspect-square relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Mướp" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-teal-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Đang tìm nhà</div>
                </div>
                <div class="p-5">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2">Mướp</h3>
                    <div class="flex items-center gap-3 text-[12px] font-bold text-gray-500 mb-3">
                        <span>Mèo</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>6 tháng</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>3kg</span>
                    </div>
                    <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Khá trầm tính, lanh lợi, đã sổ giun và tiêm phòng đầy đủ.</p>
                    <a href="#" class="text-teal-600 font-bold text-[13px] hover:text-teal-700 flex items-center gap-1">Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('frontend.adoptions.index') }}" class="inline-flex items-center gap-2 bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[15px] px-8 py-3.5 rounded-xl transition-colors shadow-sm">
                <i data-lucide="paw-print" class="w-5 h-5"></i>
                Xem tất cả bé đang tìm nhà
            </a>
        </div>
    </div>
</div>
@endsection
