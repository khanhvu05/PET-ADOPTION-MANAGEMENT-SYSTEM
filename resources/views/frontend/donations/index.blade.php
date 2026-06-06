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
                
                <div class="flex flex-wrap items-center gap-4 mb-12">
                    <a href="{{ route('frontend.donations.process') }}" class="bg-[#F58A3C] hover:bg-[#E07930] text-white px-8 py-3.5 rounded-xl font-bold flex items-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300">
                        <i data-lucide="heart-handshake" class="w-5 h-5"></i>
                        Ủng hộ ngay
                    </a>
                    
                    <button class="bg-white hover:bg-gray-50 text-[#1D2B53] border border-gray-200 px-8 py-3.5 rounded-xl font-bold flex items-center gap-2 shadow-sm hover:-translate-y-1 transition-all duration-300">
                        <i data-lucide="play-circle" class="w-5 h-5 text-[#F58A3C]"></i>
                        Xem câu chuyện
                    </button>
                </div>

                <div class="inline-flex items-center gap-4 bg-white border border-gray-100 shadow-sm p-4 rounded-xl hover:shadow-md transition-shadow cursor-pointer">
                    <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#1D2B53] text-[14px]">Xem danh sách ủng hộ công khai</p>
                        <p class="text-[12px] text-gray-400">Minh bạch, rõ ràng, cập nhật liên tục</p>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-gray-300 ml-2"></i>
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

<!-- PHƯƠNG THỨC ỦNG HỘ -->
<div class="py-20 bg-[#FAFAFA]">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-[#1D2B53] mb-4">Các phương thức ủng hộ</h2>
            <p class="text-gray-500 font-medium text-[15px]">Ngoài thanh toán online, bạn có thể lựa chọn các hình thức ủng hộ khác phù hợp.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Chuyển khoản -->
            <div class="bg-blue-50/50 rounded-[20px] p-6 border border-blue-100/50 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-5">
                    <i data-lucide="landmark" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Chuyển khoản ngân hàng</h4>
                <p class="text-gray-500 text-[13px] mb-6">Chuyển khoản trực tiếp đến số tài khoản của chúng tôi.</p>
                <a href="#" class="inline-flex items-center gap-1 text-blue-600 font-bold text-[13px] hover:text-blue-700">
                    Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- QR Code -->
            <div class="bg-teal-50/50 rounded-[20px] p-6 border border-teal-100/50 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mb-5">
                    <i data-lucide="qr-code" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Quét mã QR</h4>
                <p class="text-gray-500 text-[13px] mb-6">Quét mã QR của ngân hàng để ủng hộ nhanh chóng.</p>
                <a href="#" class="inline-flex items-center gap-1 text-teal-600 font-bold text-[13px] hover:text-teal-700">
                    Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Hiện vật -->
            <div class="bg-orange-50/50 rounded-[20px] p-6 border border-orange-100/50 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-orange-100 text-[#F58A3C] rounded-xl flex items-center justify-center mb-5">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Ủng hộ hiện vật</h4>
                <p class="text-gray-500 text-[13px] mb-6">Thức ăn, vật dụng, thuốc men cho các bé thú cưng.</p>
                <a href="#" class="inline-flex items-center gap-1 text-[#F58A3C] font-bold text-[13px] hover:text-orange-600">
                    Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Tình nguyện viên -->
            <div class="bg-pink-50/50 rounded-[20px] p-6 border border-pink-100/50 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center mb-5">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-[#1D2B53] text-[16px] mb-2">Trở thành tình nguyện viên</h4>
                <p class="text-gray-500 text-[13px] mb-6">Dành thời gian, kỹ năng để giúp đỡ các bé.</p>
                <a href="#" class="inline-flex items-center gap-1 text-pink-600 font-bold text-[13px] hover:text-pink-700">
                    Xem chi tiết <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
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
            <a href="#" class="inline-flex items-center gap-2 text-[#F58A3C] font-bold hover:text-orange-600 transition-colors">
                Xem tất cả chiến dịch <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Campaign Card 1 -->
            <div class="bg-white rounded-[20px] overflow-hidden border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-300 group flex flex-col">
                <div class="aspect-[16/10] relative overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=800&q=80" alt="Lucky" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-teal-500 text-white text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">Chi phí y tế</div>
                </div>
                
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2 leading-tight group-hover:text-teal-600 transition-colors">
                        <a href="#">Cứu trợ Lucky bị viêm phổi nặng</a>
                    </h3>
                    <p class="text-[14px] text-gray-500 mb-6 line-clamp-2">Lucky được phát hiện trong tình trạng nguy kịch, cần chi phí lớn để điều trị viêm phổi và phục hồi sức khỏe.</p>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <span class="text-[18px] font-black text-teal-600 leading-none">32.450.000đ</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[13px] font-bold text-gray-400 leading-none">/ 50.000.000đ</span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="h-2.5 w-full bg-gray-100 rounded-full overflow-hidden mb-4">
                            <div class="h-full bg-gradient-to-r from-teal-400 to-teal-500 rounded-full" style="width: 65%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between py-4 border-t border-gray-50 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4 text-gray-400"></i>
                                <span class="text-[13px] font-bold text-gray-600">128 <span class="font-normal text-gray-400">lượt ủng hộ</span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-gray-400"></i>
                                <span class="text-[13px] font-bold text-gray-600">15 <span class="font-normal text-gray-400">ngày còn lại</span></span>
                            </div>
                        </div>
                        
                        <a href="{{ route('frontend.donations.process', ['campaign_id' => 1]) }}" class="block w-full text-center bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[15px] py-3.5 rounded-xl transition-colors shadow-[0_4px_10px_rgba(245,138,60,0.2)]">
                            Ủng hộ ngay
                        </a>
                    </div>
                </div>
            </div>

            <!-- Campaign Card 2 -->
            <div class="bg-white rounded-[20px] overflow-hidden border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-300 group flex flex-col">
                <div class="aspect-[16/10] relative overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=800&q=80" alt="Mèo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-orange-500 text-white text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">Thức ăn</div>
                </div>
                
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2 leading-tight group-hover:text-orange-500 transition-colors">
                        <a href="#">Quỹ thức ăn tháng 6 cho trạm cứu hộ</a>
                    </h3>
                    <p class="text-[14px] text-gray-500 mb-6 line-clamp-2">Hơn 150 bé chó mèo đang cần sự chung tay để đảm bảo những bữa ăn dinh dưỡng trong tháng tới.</p>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <span class="text-[18px] font-black text-orange-500 leading-none">12.500.000đ</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[13px] font-bold text-gray-400 leading-none">/ 20.000.000đ</span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="h-2.5 w-full bg-gray-100 rounded-full overflow-hidden mb-4">
                            <div class="h-full bg-gradient-to-r from-orange-400 to-[#F58A3C] rounded-full" style="width: 62.5%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between py-4 border-t border-gray-50 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4 text-gray-400"></i>
                                <span class="text-[13px] font-bold text-gray-600">85 <span class="font-normal text-gray-400">lượt ủng hộ</span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-gray-400"></i>
                                <span class="text-[13px] font-bold text-gray-600">5 <span class="font-normal text-gray-400">ngày còn lại</span></span>
                            </div>
                        </div>
                        
                        <a href="{{ route('frontend.donations.process', ['campaign_id' => 2]) }}" class="block w-full text-center bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[15px] py-3.5 rounded-xl transition-colors shadow-[0_4px_10px_rgba(245,138,60,0.2)]">
                            Ủng hộ ngay
                        </a>
                    </div>
                </div>
            </div>

            <!-- Campaign Card 3 -->
            <div class="bg-white rounded-[20px] overflow-hidden border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-300 group flex flex-col">
                <div class="aspect-[16/10] relative overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&w=800&q=80" alt="Chó" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-pink-500 text-white text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">Xây dựng</div>
                </div>
                
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-[18px] font-black text-[#1D2B53] mb-2 leading-tight group-hover:text-pink-500 transition-colors">
                        <a href="#">Sửa chữa mái che mùa mưa bão</a>
                    </h3>
                    <p class="text-[14px] text-gray-500 mb-6 line-clamp-2">Mái che của trạm đã xuống cấp trầm trọng, cần sửa chữa gấp để các bé có nơi trú ẩn an toàn.</p>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <span class="text-[18px] font-black text-pink-500 leading-none">5.200.000đ</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[13px] font-bold text-gray-400 leading-none">/ 15.000.000đ</span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="h-2.5 w-full bg-gray-100 rounded-full overflow-hidden mb-4">
                            <div class="h-full bg-gradient-to-r from-pink-400 to-pink-500 rounded-full" style="width: 34%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between py-4 border-t border-gray-50 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4 text-gray-400"></i>
                                <span class="text-[13px] font-bold text-gray-600">32 <span class="font-normal text-gray-400">lượt ủng hộ</span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-gray-400"></i>
                                <span class="text-[13px] font-bold text-gray-600">20 <span class="font-normal text-gray-400">ngày còn lại</span></span>
                            </div>
                        </div>
                        
                        <a href="{{ route('frontend.donations.process', ['campaign_id' => 3]) }}" class="block w-full text-center bg-[#F58A3C] hover:bg-[#E07930] text-white font-bold text-[15px] py-3.5 rounded-xl transition-colors shadow-[0_4px_10px_rgba(245,138,60,0.2)]">
                            Ủng hộ ngay
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- STATS -->
<div class="py-16 bg-white border-y border-gray-100">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
            <div class="lg:w-1/3">
                <h3 class="text-2xl font-black text-[#1D2B53] mb-3">Cùng nhau tạo nên<br>điều kỳ diệu</h3>
                <p class="text-gray-500 font-medium text-[14px]">Nhờ sự tin tưởng và ủng hộ của cộng đồng, chúng tôi đã và đang giúp đỡ nhiều thú cưng hơn mỗi ngày.</p>
            </div>
            
            <div class="lg:w-2/3 grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Stat 1 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-[#F58A3C]">
                        <i data-lucide="home" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-[#F58A3C]">1.850+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Thú cưng được giúp đỡ</div>
                    </div>
                </div>
                
                <!-- Stat 2 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-teal-50 flex items-center justify-center text-teal-500">
                        <i data-lucide="stethoscope" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-teal-500">3.280+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Lượt khám & điều trị</div>
                    </div>
                </div>
                
                <!-- Stat 3 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-pink-50 flex items-center justify-center text-pink-500">
                        <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-pink-500">5.600+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Nhà hảo tâm đồng hành</div>
                    </div>
                </div>
                
                <!-- Stat 4 -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                        <i data-lucide="utensils" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-blue-500">12.450+</div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wide">Bữa ăn được trao</div>
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
