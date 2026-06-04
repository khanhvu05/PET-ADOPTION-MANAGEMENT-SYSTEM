@extends('layouts.frontend')
@section('content')
    <!-- Hero Banner -->
    <section class="w-full max-w-[1500px] mx-auto px-4 md:px-6 pt-20 md:pt-24 pb-4 md:pb-6 flex justify-center">
        <img src="{{ asset('images/bg-nhanuoi.png') }}" alt="Trao yêu thương Nhận lại hạnh phúc" class="w-full h-auto object-contain">
    </section>


    <!-- Main Content -->
    <main class="max-w-[1500px] mx-auto px-4 md:px-6 pb-32 md:pb-20 flex flex-col xl:flex-row gap-6">
        
        <!-- Left Sidebar: Filters -->
        <aside class="w-full xl:w-[260px] shrink-0">
            <div class="bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-bold text-[#1D2B53] text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        Bộ lọc tìm kiếm
                    </h3>
                    <button class="text-[#F58A3C] text-[11px] font-medium hover:underline">Xóa bộ lọc</button>
                </div>

                <!-- Pet Type -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-3">Loại thú cưng</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button class="border-[1.5px] border-[#F58A3C] bg-[#FFF5EF] text-[#F58A3C] rounded-lg py-3 flex flex-col items-center gap-1.5 font-medium shadow-sm">
                            <i data-lucide="dog" class="w-7 h-7 mb-0.5"></i>
                            <span class="text-[11px]">Chó</span>
                        </button>
                        <button class="border-[1.5px] border-gray-100 hover:border-gray-200 text-gray-500 rounded-lg py-3 flex flex-col items-center gap-1.5 font-medium transition bg-white">
                            <i data-lucide="cat" class="w-7 h-7 mb-0.5"></i>
                            <span class="text-[11px]">Mèo</span>
                        </button>
                        <button class="border-[1.5px] border-gray-100 hover:border-gray-200 text-gray-500 rounded-lg py-3 flex flex-col items-center gap-1.5 font-medium transition bg-white">
                            <i data-lucide="paw-print" class="w-7 h-7 mb-0.5"></i>
                            <span class="text-[11px]">Khác</span>
                        </button>
                    </div>
                </div>

                <!-- Age Dropdown -->
                <div class="mb-6" x-data="{ open: false, selected: 'Tất cả độ tuổi' }">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Độ tuổi</label>
                    <div class="relative">
                        <button @click="open = !open" @click.away="open = false" type="button" class="w-full flex items-center justify-between bg-white border border-gray-100 text-[#1D2B53] rounded-lg px-4 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-[#F58A3C] font-medium cursor-pointer transition-all">
                            <span x-text="selected"></span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute z-50 w-full mt-2 bg-white border border-gray-100 rounded-lg shadow-xl overflow-hidden py-1">
                            <template x-for="option in ['Tất cả độ tuổi', 'Dưới 1 tuổi', '1 - 3 tuổi', 'Trên 3 tuổi']">
                                <button @click="selected = option; open = false" type="button" class="w-full text-left px-4 py-2.5 text-xs font-medium hover:bg-orange-50 transition-colors" :class="{'bg-orange-50 text-[#F58A3C]': selected === option, 'text-[#1D2B53]': selected !== option}" x-text="option"></button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Size Chips -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Kích thước</label>
                    <div class="flex flex-wrap gap-2">
                        <button class="flex-1 bg-white border border-gray-100 text-gray-500 hover:border-[#F58A3C] hover:text-[#F58A3C] font-medium py-2 rounded-lg text-xs transition">
                            Nhỏ
                        </button>
                        <button class="flex-1 bg-white border border-gray-100 text-gray-500 hover:border-[#F58A3C] hover:text-[#F58A3C] font-medium py-2 rounded-lg text-xs transition">
                            Trung bình
                        </button>
                        <button class="flex-1 bg-white border border-gray-100 text-gray-500 hover:border-[#F58A3C] hover:text-[#F58A3C] font-medium py-2 rounded-lg text-xs transition">
                            Lớn
                        </button>
                    </div>
                </div>

                <!-- Gender Chips -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Giới tính</label>
                    <div class="flex flex-wrap gap-2">
                        <button class="flex-1 bg-white border border-gray-100 text-gray-500 hover:border-[#F58A3C] hover:text-[#F58A3C] font-medium py-2 rounded-[14px] text-xs transition">
                            Đực
                        </button>
                        <button class="flex-1 bg-white border border-gray-100 text-gray-500 hover:border-[#F58A3C] hover:text-[#F58A3C] font-medium py-2 rounded-[14px] text-xs transition">
                            Cái
                        </button>
                    </div>
                </div>
                
                <!-- Health Status -->
                <div class="mb-6 space-y-3">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Tình trạng sức khỏe</label>
                    <label class="flex items-center gap-3 text-gray-600 text-xs font-medium cursor-pointer hover:text-[#F58A3C] transition">
                        <input type="checkbox" class="w-4 h-4 text-[#F58A3C] border-gray-200 rounded focus:ring-[#F58A3C] focus:ring-offset-0">
                        Khỏe mạnh
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 text-xs font-medium cursor-pointer hover:text-[#F58A3C] transition">
                        <input type="checkbox" class="w-4 h-4 text-[#F58A3C] border-gray-200 rounded focus:ring-[#F58A3C] focus:ring-offset-0">
                        Đã tiêm phòng
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 text-xs font-medium cursor-pointer hover:text-[#F58A3C] transition">
                        <input type="checkbox" class="w-4 h-4 text-[#F58A3C] border-gray-200 rounded focus:ring-[#F58A3C] focus:ring-offset-0">
                        Đã triệt sản
                    </label>
                </div>

                <button class="w-full bg-[#F58A3C] hover:bg-orange-500 text-white font-black py-3.5 px-3 text-[13px] rounded-2xl transition flex items-center justify-center gap-2 shadow-[0_8px_20px_rgba(245,138,60,0.3)] hover:shadow-[0_8px_25px_rgba(245,138,60,0.4)] hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Áp dụng bộ lọc
                </button>
            </div>
        </aside>

        <!-- Center: Pet Grid -->
        <div class="flex-1 min-w-0 bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50">
            <div class="flex flex-row justify-between items-center mb-6">
                <p class="font-black text-[#1D2B53] text-[13px] md:text-sm">Tìm thấy <span class="text-[#F58A3C]">236</span> thú cưng</p>
                <div class="relative w-[160px] md:w-[190px]" x-data="{ open: false, selected: 'Sắp xếp: Mới nhất' }">
                    <button @click="open = !open" @click.away="open = false" type="button" class="w-full flex items-center justify-between bg-white border border-gray-100 rounded-lg px-4 py-2.5 text-[#1D2B53] font-bold text-[11px] md:text-xs focus:outline-none shadow-[0_2px_10px_rgb(0,0,0,0.02)] cursor-pointer transition-all">
                        <span x-text="selected"></span>
                        <svg class="w-4 h-4 text-[#1D2B53] transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute z-50 w-full mt-2 bg-white border border-gray-100 rounded-lg shadow-xl overflow-hidden py-1">
                        <button @click="selected = 'Sắp xếp: Mới nhất'; open = false" type="button" class="w-full text-left px-4 py-2.5 text-[11px] md:text-xs font-bold hover:bg-orange-50 transition-colors" :class="{'bg-orange-50 text-[#F58A3C]': selected === 'Sắp xếp: Mới nhất', 'text-[#1D2B53]': selected !== 'Sắp xếp: Mới nhất'}">Sắp xếp: Mới nhất</button>
                        <button @click="selected = 'Sắp xếp: Cũ nhất'; open = false" type="button" class="w-full text-left px-4 py-2.5 text-[11px] md:text-xs font-bold hover:bg-orange-50 transition-colors" :class="{'bg-orange-50 text-[#F58A3C]': selected === 'Sắp xếp: Cũ nhất', 'text-[#1D2B53]': selected !== 'Sắp xếp: Cũ nhất'}">Sắp xếp: Cũ nhất</button>
                    </div>
                </div>
            </div>

            <!-- Grid Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-5">
                
                @php
                    $dummyPets = [
                        ['name' => 'Lucky', 'type' => 'Chó', 'age' => '2 tuổi', 'gender' => 'Đực', 'size' => 'Lớn', 'location' => 'Hà Nội', 'status' => 'Đã tiêm phòng', 'img' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=500&h=400&fit=crop'],
                        ['name' => 'Corgi', 'type' => 'Chó', 'age' => '1 tuổi', 'gender' => 'Cái', 'size' => 'Trung bình', 'location' => 'TP. Hồ Chí Minh', 'status' => 'Đã tiêm phòng', 'img' => 'https://images.unsplash.com/photo-1517849845537-4d257902454a?w=500&h=400&fit=crop'],
                        ['name' => 'Mimi', 'type' => 'Mèo', 'age' => '8 tháng', 'gender' => 'Cái', 'size' => 'Nhỏ', 'location' => 'Đà Nẵng', 'status' => 'Đã triệt sản', 'img' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=500&h=400&fit=crop'],
                        ['name' => 'Max', 'type' => 'Chó', 'age' => '6 tháng', 'gender' => 'Đực', 'size' => 'Trung bình', 'location' => 'Hải Phòng', 'status' => 'Đã tiêm phòng', 'img' => 'https://images.unsplash.com/photo-1537151625747-768eb6cf92b2?w=500&h=400&fit=crop'],
                        ['name' => 'Luna', 'type' => 'Mèo', 'age' => '1 tuổi', 'gender' => 'Cái', 'size' => 'Nhỏ', 'location' => 'Hà Nội', 'status' => 'Đã triệt sản', 'img' => 'https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=500&h=400&fit=crop'],
                        ['name' => 'Bông', 'type' => 'Chó', 'age' => '3 tuổi', 'gender' => 'Cái', 'size' => 'Nhỏ', 'location' => 'Cần Thơ', 'status' => 'Đã tiêm phòng', 'img' => 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=500&h=400&fit=crop'],
                        ['name' => 'Tommy', 'type' => 'Chó', 'age' => '1.5 tuổi', 'gender' => 'Đực', 'size' => 'Lớn', 'location' => 'Đà Lạt', 'status' => 'Đã tiêm phòng', 'img' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=500&h=400&fit=crop'],
                        ['name' => 'Mèo Ú', 'type' => 'Mèo', 'age' => '5 tháng', 'gender' => 'Cái', 'size' => 'Nhỏ', 'location' => 'Huế', 'status' => 'Khỏe mạnh', 'img' => 'https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=500&h=400&fit=crop'],
                    ];
                @endphp

                @foreach($dummyPets as $pet)
                <!-- Pet Card -->
                <div class="bg-white rounded-[24px] overflow-hidden shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgb(0,0,0,0.08)] transition-all duration-300 border border-gray-100 flex flex-col hover:-translate-y-1">
                    <div class="relative h-44 sm:h-40 overflow-hidden">
                        <img src="{{ $pet['img'] }}" alt="{{ $pet['name'] }}" class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3 {{ $pet['type'] == 'Chó' ? 'bg-[#40C057]' : 'bg-[#FCC419]' }} text-white text-[11px] font-medium px-3 py-1 rounded-lg shadow-sm">
                            {{ $pet['type'] }}
                        </div>
                        <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-lg flex items-center justify-center text-red-500 border border-red-100 hover:bg-red-50 shadow-sm transition group">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </button>
                    </div>
                    
                    <div class="p-4 flex-1 flex flex-col">
                        <h4 class="font-bold text-[15px] text-[#1D2B53] mb-3">{{ $pet['name'] }}</h4>
                        
                        <div class="flex items-center justify-between text-[11px] font-medium text-gray-500 mb-4 gap-1">
                            <div class="flex items-center gap-1.5 truncate"><i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i> <span class="truncate">{{ $pet['age'] }}</span></div>
                            <div class="flex items-center gap-1.5 truncate"><i data-lucide="paw-print" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i> <span class="truncate">{{ $pet['gender'] }}</span></div>
                            <div class="flex items-center gap-1.5 truncate"><i data-lucide="box" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i> <span class="truncate">{{ $pet['size'] }}</span></div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div class="flex items-center gap-1 text-[11px] text-gray-500 font-medium truncate max-w-[50%]">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0"></i>
                                <span class="truncate">{{ $pet['location'] }}</span>
                            </div>
                            <div class="text-[10px] font-semibold text-emerald-700 bg-emerald-50/80 px-2.5 py-1.5 rounded-lg whitespace-nowrap tracking-wide">
                                {{ $pet['status'] }}
                            </div>
                        </div>

                        <button class="w-full mt-4 bg-[#FFF5EF] hover:bg-orange-100 text-[#F58A3C] font-semibold py-2.5 rounded-lg transition text-[12px]">
                            Xem chi tiết
                        </button>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-center gap-2 mt-12">
                <button class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-gray-400 flex items-center justify-center hover:bg-gray-50 hover:text-gray-600 transition shadow-sm"><svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg></button>
                <button class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-[#F58A3C] text-white font-black shadow-[0_4px_10px_rgba(245,138,60,0.3)] text-xs md:text-sm">1</button>
                <button class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-[#1D2B53] font-black hover:bg-gray-50 transition shadow-sm text-xs md:text-sm">2</button>
                <button class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-[#1D2B53] font-black hover:bg-gray-50 transition shadow-sm text-xs md:text-sm">3</button>
                <span class="text-gray-400 px-1 font-bold text-xs md:text-sm">...</span>
                <button class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-[#1D2B53] font-black hover:bg-gray-50 transition shadow-sm text-xs md:text-sm">12</button>
                <button class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-white border border-gray-100 text-gray-400 flex items-center justify-center hover:bg-gray-50 hover:text-gray-600 transition shadow-sm"><svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </div>

        <!-- Right Sidebar: Info & Support (Hidden on Mobile/Tablet) -->
        <aside class="hidden xl:block w-[280px] shrink-0 space-y-6">
            
            <!-- Adoption Process -->
            <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50">
                <h3 class="font-black text-[#1D2B53] text-sm mb-6">Quy trình nhận nuôi</h3>
                
                <div class="relative pl-6 space-y-6">
                    <!-- Timeline Line -->
                    <div class="absolute left-[11px] top-2 bottom-2 w-0.5 bg-gray-100"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative">
                        <div class="absolute -left-[32px] bg-[#FFF5EF] text-[#F58A3C] w-6 h-6 rounded-full flex items-center justify-center border-[3px] border-white z-10 shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h4 class="text-[12px] font-black text-[#1D2B53]">1. Tìm hiểu</h4>
                        <p class="text-[11px] font-bold text-gray-500 mt-1 leading-relaxed">Xem thông tin và chọn thú cưng phù hợp</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <div class="absolute -left-[32px] bg-[#FFF5EF] text-[#F58A3C] w-6 h-6 rounded-full flex items-center justify-center border-[3px] border-white z-10 shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="text-[12px] font-black text-[#1D2B53]">2. Gửi đơn</h4>
                        <p class="text-[11px] font-bold text-gray-500 mt-1 leading-relaxed">Điền thông tin và gửi đơn nhận nuôi</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative">
                        <div class="absolute -left-[32px] bg-emerald-50 text-emerald-500 w-6 h-6 rounded-full flex items-center justify-center border-[3px] border-white z-10 shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h4 class="text-[12px] font-black text-[#1D2B53]">3. Phỏng vấn</h4>
                        <p class="text-[11px] font-bold text-gray-500 mt-1 leading-relaxed">Chúng tôi sẽ liên hệ trao đổi với bạn</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative">
                        <div class="absolute -left-[32px] bg-emerald-500 text-white w-6 h-6 rounded-full flex items-center justify-center border-[3px] border-white z-10 shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h4 class="text-[12px] font-black text-[#1D2B53]">4. Nhận nuôi</h4>
                        <p class="text-[11px] font-bold text-gray-500 mt-1 leading-relaxed">Hoàn tất thủ tục và đón bé về nhà</p>
                    </div>
                </div>

                <button class="w-full mt-6 bg-[#F58A3C] hover:bg-orange-500 text-white font-black py-3 rounded-lg transition text-[12px] shadow-sm">
                    Xem chi tiết quy trình
                </button>
            </div>

            <!-- Support Box -->
            <div class="bg-white rounded-lg p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50 relative overflow-hidden">
                <h3 class="font-black text-[#1D2B53] text-sm mb-2">Cần hỗ trợ?</h3>
                <p class="text-[11px] font-bold text-gray-500 mb-5 leading-relaxed pr-10">Chúng tôi luôn sẵn sàng hỗ trợ bạn trong hành trình đón thành viên mới!</p>
                
                <div class="space-y-3 text-[11px] font-black text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        (+84) 123 456 789
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        support@petjam.com
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        T2 - CN: 8:00 - 20:00
                    </div>
                </div>

                <!-- Cute Dog Illustration -->
                <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=200&h=200&fit=crop" alt="Support Dog" class="absolute -bottom-4 -right-4 w-28 h-28 object-cover rounded-full border-[6px] border-white shadow-sm opacity-90 transform -scale-x-100">
            </div>

            <!-- Call to action -->
            <div class="bg-[#FFF5EF] rounded-3xl p-6 border border-orange-100 flex items-center justify-between gap-4">
                <div>
                    <h3 class="font-black text-[#1D2B53] text-[13px] mb-3 leading-tight pr-4">Bạn đã sẵn sàng để đón một bé thú cưng?</h3>
                    <button class="bg-white text-[#F58A3C] hover:bg-[#F58A3C] hover:text-white font-black py-2.5 px-4 rounded-lg text-[11px] shadow-sm transition border border-orange-200">
                        Gửi đơn ngay
                    </button>
                </div>
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm border border-orange-100">
                    <i data-lucide="heart" class="w-6 h-6 text-[#F58A3C] fill-current"></i>
                </div>
            </div>

        </aside>
    </main>
@endsection


