@extends('layouts.frontend')
@section('title', 'Giới thiệu')

@section('content')
<!-- Hero Section -->
<section class="relative pt-24 lg:pt-40 pb-10 lg:pb-20 px-6 lg:px-16 max-w-[1400px] mx-auto flex flex-col-reverse lg:flex-row items-center gap-6 lg:gap-12">
    <!-- Left Text Content -->
    <div class="w-full lg:w-1/2 flex flex-col items-center text-center lg:items-start lg:text-left relative z-10 pt-4 lg:pt-0">
        <!-- Floating paw decorative left behind text -->
        <svg class="absolute -top-10 -left-10 w-24 h-24 text-[#E8F6F8] fill-current -z-10 transform -rotate-12" viewBox="0 0 512 512"><path d="M226.5 92.9c14.3 42.9-.3 86.4-32.6 96.8s-70.1-15.6-84.4-58.5c-14.3-42.9.3-86.4 32.6-96.8s70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-1.2-78.5-33.6c-18.9-32.4-14.3-70.1 10.2-84.1s59.6 1.2 78.5 33.6zM225.4 212.3c3.5 1.5 7.1 2.9 10.7 4.1 43.6 14.2 92.5 13.9 135.9-2.9 3.8-1.5 7.4-3.1 11-4.9 31.9-15.7 62-42.4 82.5-76.3 35.8-59.4 14.2-132-48.4-162.2-50.6-24.4-107.5-12.7-145 23.3-37.5-36-94.4-47.7-145-23.3-62.6 30.2-84.2 102.8-48.4 162.2 20.4 33.9 50.5 60.5 82.4 76.2 1.4.7 2.8 1.4 4.3 2.1zM495.2 284c-24.5-14.1-61.9-2.4-80.8 30s-14.3 71.9 10.2 86 61.9 2.4 80.8-30c18.9-32.4 14.3-71.9-10.2-86zM418.7 189.7c-32.3-10.4-64.9 13.2-79.2 56.1s-4.9 88.5 27.4 98.9c32.3 10.4 64.9-13.2 79.2-56.1s4.9-88.5-27.4-98.9z"/></svg>

        <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-[72px] font-black leading-[1.05] tracking-tight mb-2 lg:mb-4 relative max-w-full">
            <span class="text-dark">PETJAM</span><br />
            <span class="text-primary relative inline-block pr-12 lg:pr-14 mt-1 lg:mt-0">
                Trao yêu thương
                <svg class="absolute right-0 top-1 w-8 h-8 lg:w-10 lg:h-10 text-primary transform rotate-[15deg]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </span>
        </h1>
        
        <p class="text-base lg:text-lg text-dark font-bold mb-6 lg:mb-10 max-w-[80%] mx-auto lg:mx-0">
            Chúng tôi tin rằng mọi thú cưng đều xứng đáng có một ngôi nhà và một gia đình yêu thương.
        </p>

        <div class="flex flex-row items-center justify-center lg:justify-start gap-2 sm:gap-4 mb-8 lg:mb-12 w-full lg:w-max">
            <a href="{{ route('frontend.adoptions.index') }}" class="btn-primary text-xs sm:text-base px-4 sm:px-8 py-3 sm:py-3.5 border border-primary flex-1 lg:flex-none justify-center whitespace-nowrap">
                <i data-lucide="paw-print" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                Nhận nuôi ngay
            </a>
            <!-- <a href="{{ route('frontend.donations.index') }}" class="btn-outline-teal text-xs sm:text-base px-4 sm:px-8 py-3 sm:py-3.5 bg-white border-[1.5px] border-secondary text-secondary flex-1 lg:flex-none justify-center whitespace-nowrap">
                Ủng hộ chúng tôi
            </a> -->
        </div>

        <!-- KPIs row -->
        <div class="grid grid-cols-2 md:flex items-start md:items-center justify-items-start justify-center lg:justify-start gap-4 lg:gap-8 mx-auto lg:mx-0 w-full lg:w-max">
            <!-- KPI 1 -->
            <div class="flex flex-col gap-2 w-max">
                <div class="flex items-center gap-3">
                    <div class="w-[56px] h-[56px] flex items-center justify-center">
                        <svg class="w-10 h-10" fill="#0E7490" viewBox="0 0 24 24">
                            <circle cx="4.5" cy="9.5" r="2.5" />
                            <circle cx="9" cy="5.5" r="2.5" />
                            <circle cx="15" cy="5.5" r="2.5" />
                            <circle cx="19.5" cy="9.5" r="2.5" />
                            <path d="M17.34 14.86c-.87-1.02-1.6-1.89-2.48-2.91-.46-.54-1.05-1.08-1.75-1.32-.11-.04-.22-.07-.33-.09-.25-.04-.52-.04-.78-.04s-.53 0-.79.05c-.11.02-.22.05-.33.09-.7.24-1.28.78-1.75 1.32-.87 1.02-1.6 1.89-2.48 2.91-1.31 1.31-2.92 2.76-2.62 4.79.29 1.02 1.02 2.03 2.33 2.32.73.15 3.06-.44 5.54-.44h.18c2.48 0 4.81.58 5.54.44 1.31-.29 2.04-1.31 2.33-2.32.31-2.04-1.3-3.49-2.61-4.8z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[20px] font-black text-[#0E7490] leading-none">2.458+</span>
                        <span class="text-[13px] font-bold text-[#F58A3C] leading-tight mt-1">Thú cưng</span>
                        <span class="text-muted font-semibold text-[11px]">Đã nhận nuôi</span>
                    </div>
                </div>
                <div class="flex items-center mt-1">
                    <div class="w-[6px] h-[6px] rounded-full bg-[#0E7490]"></div>
                    <div class="w-16 h-[2px] ml-1" style="background-image: linear-gradient(to right, #0E7490 50%, transparent 50%); background-size: 6px 2px; background-repeat: repeat-x; opacity: 0.3;"></div>
                </div>
            </div>
            <!-- KPI 2 -->
            <div class="flex flex-col gap-2 w-max">
                <div class="flex items-center gap-3">
                    <div class="w-[56px] h-[56px] flex items-center justify-center">
                        <svg class="w-10 h-10" fill="#FA7226" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[20px] font-black text-[#0E7490] leading-none">3.892+</span>
                        <span class="text-[13px] font-bold text-[#F58A3C] leading-tight mt-1">Người dùng</span>
                        <span class="text-muted font-semibold text-[11px]">Đã tham gia</span>
                    </div>
                </div>
                <div class="flex items-center mt-1">
                    <div class="w-[6px] h-[6px] rounded-full bg-[#0E7490]"></div>
                    <div class="w-16 h-[2px] ml-1" style="background-image: linear-gradient(to right, #0E7490 50%, transparent 50%); background-size: 6px 2px; background-repeat: repeat-x; opacity: 0.3;"></div>
                </div>
            </div>
            <!-- KPI 3 -->
            <div class="flex flex-col gap-2 w-max">
                <div class="flex items-center gap-3">
                    <div class="w-[56px] h-[56px] flex items-center justify-center">
                        <svg class="w-10 h-10" fill="#0E7490" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[20px] font-black text-[#0E7490] leading-none">58+</span>
                        <span class="text-[13px] font-bold text-[#F58A3C] leading-tight mt-1">Đối tác</span>
                        <span class="text-muted font-semibold text-[11px]">Đồng hành</span>
                    </div>
                </div>
                <div class="flex items-center mt-1">
                    <div class="w-[6px] h-[6px] rounded-full bg-[#F58A3C]"></div>
                    <div class="w-16 h-[2px] ml-1" style="background-image: linear-gradient(to right, #F58A3C 50%, transparent 50%); background-size: 6px 2px; background-repeat: repeat-x; opacity: 0.3;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Image -->
    <div class="w-full lg:w-1/2 relative flex justify-center items-center mt-2 lg:mt-0 lg:mr-10">
        <!-- Main Dogs & Cat Image -->
        <img src="{{ asset('images/hero-img.png') }}" class="relative z-30 w-full lg:w-[135%] scale-100 lg:scale-[1.3] h-auto object-contain" alt="Dogs and Cat Waiting for Adoption">
    </div>
</section>

<!-- About Section -->
<section class="py-12 lg:py-20 px-6 lg:px-16 max-w-[1400px] mx-auto mt-6 relative">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
        <!-- Left Image Composition -->
        <div class="relative w-full aspect-square flex items-center justify-center">
            <!-- Decorative blobs/background -->
            <div class="absolute inset-0 bg-[#E8F6F8] rounded-full scale-90 -z-10 translate-x-4 -translate-y-4"></div>
            
            <div class="w-[65%] h-[75%] rounded-[30px] overflow-hidden border-4 border-white shadow-xl relative z-20 -translate-x-10 -rotate-3">
                <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Woman holding dog">
            </div>
            
            <div class="w-[55%] h-[60%] rounded-[30px] overflow-hidden border-4 border-white shadow-xl absolute right-0 bottom-10 z-30 rotate-6">
                <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Happy dog">
            </div>
            
            <!-- Floating icons -->
            <i data-lucide="paw-print" class="absolute top-10 left-10 w-12 h-12 text-[#E8F6F8] fill-current z-0 -rotate-12"></i>
            <i data-lucide="heart" class="absolute bottom-0 left-20 w-8 h-8 text-primary z-40 -rotate-12"></i>
        </div>

        <!-- Right Content -->
        <div class="flex flex-col">
            <span class="text-xs font-black text-secondary tracking-widest uppercase mb-2">VỀ PETJAM</span>
            <h2 class="text-4xl lg:text-[42px] font-black text-dark mb-6 leading-tight">Chúng tôi là ai?</h2>
            
            <p class="text-[15px] font-bold text-muted mb-4 leading-relaxed">
                PETJAM là nền tảng kết nối cộng đồng yêu thú cưng, các trạm cứu hộ và những tấm lòng nhân ái.
            </p>
            <p class="text-[15px] font-bold text-muted mb-10 leading-relaxed">
                Chúng tôi hoạt động với mục tiêu: <strong class="text-dark">cứu hộ – chăm sóc – tìm mái ấm mới</strong> cho những bé thú cưng bị bỏ rơi, lạc hoặc gặp hoàn cảnh khó khăn.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col md:items-start items-center text-center md:text-left gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#FFF5EF] flex items-center justify-center text-primary">
                        <i data-lucide="heart-pulse" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-dark text-sm mb-1">Cứu hộ</h4>
                        <p class="text-xs font-semibold text-muted leading-snug">Giải cứu và chăm sóc kịp thời</p>
                    </div>
                </div>
                <div class="flex flex-col md:items-start items-center text-center md:text-left gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#E8F6F8] flex items-center justify-center text-secondary">
                        <i data-lucide="home" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-dark text-sm mb-1">Chăm sóc</h4>
                        <p class="text-xs font-semibold text-muted leading-snug">Điều trị, tiêm phòng, nuôi dưỡng</p>
                    </div>
                </div>
                <div class="flex flex-col md:items-start items-center text-center md:text-left gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#EBF0F9] flex items-center justify-center text-[#1D2B53]">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-dark text-sm mb-1">Nhận nuôi</h4>
                        <p class="text-xs font-semibold text-muted leading-snug">Kết nối để các bé tìm được mái ấm mới</p>
                    </div>
                </div>
            </div>
            <i data-lucide="paw-print" class="absolute right-0 top-1/2 w-16 h-16 text-[#E8F6F8] fill-current z-0 rotate-12"></i>
        </div>
    </div>
</section>

<!-- Mission & Core Values Section -->
<section class="py-12 lg:py-20 px-6 lg:px-16 max-w-[1400px] mx-auto bg-white rounded-3xl mt-6 border border-gray-100 shadow-sm">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Mission -->
        <div class="flex flex-col justify-center">
            <span class="text-xs font-black text-secondary tracking-widest uppercase mb-2">SỨ MỆNH</span>
            <h2 class="text-3xl lg:text-4xl font-black text-dark mb-4 leading-tight">
                Vì một thế giới tốt đẹp hơn cho <span class="text-primary">thú cưng</span> 
                <svg class="inline-block w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </h2>
            <p class="text-[15px] font-bold text-muted mb-8 leading-relaxed max-w-md">
                Chúng tôi nỗ lực mỗi ngày để lan tỏa tình yêu thương và trách nhiệm đến cộng đồng.
            </p>
            <div class="w-full h-[220px] rounded-[30px] overflow-hidden mt-auto relative">
                <div class="absolute inset-0 bg-[#E8F6F8] rounded-[30px] flex items-center justify-center overflow-hidden">
                    <!-- Placeholder for Mission Image -->
                    <img src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-multiply opacity-90" alt="Dog and cat">
                    <i data-lucide="paw-print" class="absolute right-4 top-4 w-12 h-12 text-white/50 fill-current z-0 rotate-12"></i>
                </div>
            </div>
        </div>

        <!-- Core Values -->
        <div class="flex flex-col">
            <span class="text-xs font-black text-secondary tracking-widest uppercase mb-6">GIÁ TRỊ CỐT LÕI</span>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Value 1 -->
                <div class="bg-[#FAFAFA] border border-gray-100 rounded-3xl p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center text-secondary mb-4">
                        <i data-lucide="shield-check" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-black text-dark text-lg mb-2">Tận tâm</h4>
                    <p class="text-xs font-semibold text-muted leading-relaxed">Đặt lợi ích của thú cưng lên hàng đầu</p>
                </div>
                
                <!-- Value 2 -->
                <div class="bg-[#FAFAFA] border border-gray-100 rounded-3xl p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center text-secondary mb-4">
                        <i data-lucide="users" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-black text-dark text-lg mb-2">Minh bạch</h4>
                    <p class="text-xs font-semibold text-muted leading-relaxed">Công khai mọi hoạt động và đóng góp</p>
                </div>
                
                <!-- Value 3 -->
                <div class="bg-[#FAFAFA] border border-gray-100 rounded-3xl p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center text-primary mb-4">
                        <i data-lucide="handshake" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-black text-dark text-lg mb-2">Kết nối</h4>
                    <p class="text-xs font-semibold text-muted leading-relaxed">Xây dựng cộng đồng nhân ái & bền vững</p>
                </div>
                
                <!-- Value 4 -->
                <div class="bg-[#FAFAFA] border border-gray-100 rounded-3xl p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center text-green-500 mb-4">
                        <i data-lucide="leaf" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-black text-dark text-lg mb-2">Trách nhiệm</h4>
                    <p class="text-xs font-semibold text-muted leading-relaxed">Lan tỏa ý thức bảo vệ động vật</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What we have done (Những điều chúng tôi đã làm) -->
<section class="py-12 lg:py-20 px-6 lg:px-16 max-w-[1400px] mx-auto mt-6">
    <div class="text-center mb-12 relative">
        <h2 class="text-3xl font-extrabold text-dark tracking-tight inline-block relative">
            Những điều chúng tôi đã làm
            <svg class="absolute -right-8 top-0 w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-24 h-1 bg-secondary rounded-full opacity-50"></div>
        </h2>
        <!-- Decorative dotted lines -->
        <svg class="absolute top-1/2 left-0 w-[20%] h-10 hidden lg:block text-secondary opacity-30" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,0 100,10" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4"/></svg>
        <svg class="absolute top-1/2 right-0 w-[20%] h-10 hidden lg:block text-primary opacity-30" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,20 100,10" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="4 4"/></svg>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <!-- Card 1 -->
        <div class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
            <img src="https://images.pexels.com/photos/6235233/pexels-photo-6235233.jpeg?auto=compress&cs=tinysrgb&w=400&h=320&fit=crop" class="w-full h-32 object-cover" alt="Vet caring for dog">
            <div class="p-4 flex flex-col justify-center h-24 bg-white border-t-2 border-secondary/20">
                <span class="text-2xl font-black text-secondary leading-none mb-1">1.245</span>
                <span class="text-[11px] font-bold text-dark leading-tight uppercase">Ca cứu hộ<br>& điều trị</span>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
            <img src="https://images.unsplash.com/photo-1544568100-847a948585b9?q=80&w=400&auto=format&fit=crop" class="w-full h-32 object-cover" alt="Happy adopted dog">
            <div class="p-4 flex flex-col justify-center h-24 bg-white border-t-2 border-primary/20">
                <span class="text-2xl font-black text-primary leading-none mb-1">2.458</span>
                <span class="text-[11px] font-bold text-dark leading-tight uppercase">Bé thú cưng đã tìm<br>được mái ấm</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
            <img src="https://images.unsplash.com/photo-1522276498395-f4f68f7f8454?q=80&w=400&auto=format&fit=crop" class="w-full h-32 object-cover" alt="Community">
            <div class="p-4 flex flex-col justify-center h-24 bg-white border-t-2 border-secondary/20">
                <span class="text-2xl font-black text-secondary leading-none mb-1">3.892</span>
                <span class="text-[11px] font-bold text-dark leading-tight uppercase">Người dùng<br>đồng hành</span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
            <img src="https://images.unsplash.com/photo-1616628188550-808682f3926d?q=80&w=400&auto=format&fit=crop" class="w-full h-32 object-cover" alt="Donation box">
            <div class="p-4 flex flex-col justify-center h-24 bg-white border-t-2 border-[#1D2B53]/20">
                <span class="text-2xl font-black text-[#1D2B53] leading-none mb-1">1.256</span>
                <span class="text-[11px] font-bold text-dark leading-tight uppercase">Lượt quyên góp<br>trong tháng</span>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-2 transition-transform duration-300">
            <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=400&auto=format&fit=crop" class="w-full h-32 object-cover" alt="Partners holding hands">
            <div class="p-4 flex flex-col justify-center h-24 bg-white border-t-2 border-green-500/20">
                <span class="text-2xl font-black text-green-500 leading-none mb-1">58</span>
                <span class="text-[11px] font-bold text-dark leading-tight uppercase">Đối tác & trạm cứu hộ<br>đồng hành</span>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-10 lg:py-16 px-6 lg:px-16 max-w-[1400px] mx-auto mt-6 mb-16 relative">
    <div class="bg-[#FFF5EF] rounded-[40px] px-8 lg:px-12 py-10 lg:py-12 flex flex-col md:flex-row items-center justify-between relative overflow-visible shadow-sm border border-orange-50">
        
        <!-- Text -->
        <div class="flex flex-col z-10 w-full md:w-1/2 text-center md:text-left mb-8 md:mb-0">
            <h2 class="text-2xl lg:text-3xl font-black text-dark mb-3">
                Bạn có thể tạo nên sự khác biệt
                <svg class="inline-block w-6 h-6 text-primary ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </h2>
            <p class="text-[14px] font-bold text-muted mb-6">
                Mỗi hành động nhỏ đều có thể thay đổi cuộc sống của một bé thú cưng.
            </p>
            <div class="flex items-center justify-center md:justify-start gap-3">
                <a href="{{ route('frontend.adoptions.index') }}" class="btn-outline-teal text-sm bg-white hover:bg-secondary hover:text-white px-6 py-3 border-gray-200 text-dark shadow-sm transition-colors rounded-xl">Tìm hiểu thêm</a>
                <!-- <a href="{{ route('frontend.donations.index') }}" class="btn-primary text-sm px-6 py-3 rounded-xl">Tham gia ngay</a> -->
            </div>
        </div>

        <!-- Right Side Dogs Image Overlay -->
        <div class="w-full md:w-[45%] h-[200px] md:h-[250px] relative md:absolute md:-right-10 md:-top-12 z-20 flex justify-end items-end">
            <img src="https://images.unsplash.com/photo-1544568100-847a948585b9?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover rounded-[30px] border-4 border-white shadow-xl md:w-[120%] lg:w-[130%]" alt="Dogs">
        </div>
        
        <!-- Decorative Hearts -->
        <i data-lucide="heart" class="absolute top-6 right-1/2 w-6 h-6 text-primary opacity-50"></i>
        <i data-lucide="heart" class="absolute bottom-6 left-1/3 w-4 h-4 text-secondary opacity-50"></i>
    </div>
</section>

@endsection
