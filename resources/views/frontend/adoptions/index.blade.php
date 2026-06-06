@extends('layouts.frontend')
@section('title', 'Nhận nuôi')
@section('content')
    <!-- Hero Banner -->
    <section class="w-full max-w-[1500px] mx-auto px-4 md:px-6 pt-20 md:pt-24 pb-4 md:pb-6 flex justify-center">
        <img src="{{ asset('images/bg-nhanuoi.png') }}" alt="Trao yêu thương Nhận lại hạnh phúc" class="w-full h-auto object-contain">
    </section>


    <!-- Main Content -->
    <main class="max-w-[1500px] mx-auto px-4 md:px-6 pb-32 md:pb-20 flex flex-col xl:flex-row gap-6">
        
        <!-- Left Sidebar: Filters -->
        <aside class="w-full xl:w-[260px] shrink-0">
            <form id="filter-form" action="{{ route('frontend.adoptions.index') }}" method="GET" class="bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-bold text-[#1D2B53] text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        Bộ lọc tìm kiếm
                    </h3>
                    <a href="{{ route('frontend.adoptions.index') }}" class="text-[#F58A3C] text-[11px] font-medium hover:underline">Xóa bộ lọc</a>
                </div>

                <!-- Pet Type -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-3">Loại thú cưng</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="loai" value="cho" class="peer hidden" {{ request('loai') == 'cho' ? 'checked' : '' }}>
                            <div class="border-[1.5px] border-gray-100 peer-checked:border-[#F58A3C] peer-checked:bg-[#FFF5EF] peer-checked:text-[#F58A3C] text-gray-500 rounded-lg py-3 flex flex-col items-center gap-1.5 font-medium transition bg-white hover:border-gray-200">
                                <i data-lucide="dog" class="w-7 h-7 mb-0.5"></i>
                                <span class="text-[11px]">Chó</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="loai" value="meo" class="peer hidden" {{ request('loai') == 'meo' ? 'checked' : '' }}>
                            <div class="border-[1.5px] border-gray-100 peer-checked:border-[#F58A3C] peer-checked:bg-[#FFF5EF] peer-checked:text-[#F58A3C] text-gray-500 rounded-lg py-3 flex flex-col items-center gap-1.5 font-medium transition bg-white hover:border-gray-200">
                                <i data-lucide="cat" class="w-7 h-7 mb-0.5"></i>
                                <span class="text-[11px]">Mèo</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="loai" value="khac" class="peer hidden" {{ request('loai') == 'khac' ? 'checked' : '' }}>
                            <div class="border-[1.5px] border-gray-100 peer-checked:border-[#F58A3C] peer-checked:bg-[#FFF5EF] peer-checked:text-[#F58A3C] text-gray-500 rounded-lg py-3 flex flex-col items-center gap-1.5 font-medium transition bg-white hover:border-gray-200">
                                <i data-lucide="paw-print" class="w-7 h-7 mb-0.5"></i>
                                <span class="text-[11px]">Khác</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Age Dropdown -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Độ tuổi</label>
                    <select name="nhom_tuoi" class="w-full bg-white border border-gray-200 text-[#1D2B53] rounded-lg px-4 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-[#F58A3C] font-medium transition-all appearance-none cursor-pointer">
                        <option value="">Tất cả độ tuổi</option>
                        <option value="so_sinh" {{ request('nhom_tuoi') == 'so_sinh' ? 'selected' : '' }}>Sơ sinh</option>
                        <option value="nho" {{ request('nhom_tuoi') == 'nho' ? 'selected' : '' }}>Nhỏ</option>
                        <option value="truong_thanh" {{ request('nhom_tuoi') == 'truong_thanh' ? 'selected' : '' }}>Trưởng thành</option>
                        <option value="gia" {{ request('nhom_tuoi') == 'gia' ? 'selected' : '' }}>Già</option>
                    </select>
                </div>

                <!-- Size Chips -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Kích thước</label>
                    <div class="flex flex-wrap gap-2">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="kich_thuoc" value="nho" class="peer hidden" {{ request('kich_thuoc') == 'nho' ? 'checked' : '' }}>
                            <div class="bg-white border border-gray-100 text-gray-500 peer-checked:border-[#F58A3C] peer-checked:text-[#F58A3C] peer-checked:bg-[#FFF5EF] font-medium py-2 rounded-lg text-xs transition text-center hover:border-[#F58A3C] hover:text-[#F58A3C]">
                                Nhỏ
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="kich_thuoc" value="trung_binh" class="peer hidden" {{ request('kich_thuoc') == 'trung_binh' ? 'checked' : '' }}>
                            <div class="bg-white border border-gray-100 text-gray-500 peer-checked:border-[#F58A3C] peer-checked:text-[#F58A3C] peer-checked:bg-[#FFF5EF] font-medium py-2 rounded-lg text-xs transition text-center hover:border-[#F58A3C] hover:text-[#F58A3C]">
                                Trung bình
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="kich_thuoc" value="lon" class="peer hidden" {{ request('kich_thuoc') == 'lon' ? 'checked' : '' }}>
                            <div class="bg-white border border-gray-100 text-gray-500 peer-checked:border-[#F58A3C] peer-checked:text-[#F58A3C] peer-checked:bg-[#FFF5EF] font-medium py-2 rounded-lg text-xs transition text-center hover:border-[#F58A3C] hover:text-[#F58A3C]">
                                Lớn
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Gender Chips -->
                <div class="mb-6">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Giới tính</label>
                    <div class="flex flex-wrap gap-2">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="gioi_tinh" value="duc" class="peer hidden" {{ request('gioi_tinh') == 'duc' ? 'checked' : '' }}>
                            <div class="bg-white border border-gray-100 text-gray-500 peer-checked:border-[#F58A3C] peer-checked:text-[#F58A3C] peer-checked:bg-[#FFF5EF] font-medium py-2 rounded-[14px] text-xs transition text-center hover:border-[#F58A3C] hover:text-[#F58A3C]">
                                Đực
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="gioi_tinh" value="cai" class="peer hidden" {{ request('gioi_tinh') == 'cai' ? 'checked' : '' }}>
                            <div class="bg-white border border-gray-100 text-gray-500 peer-checked:border-[#F58A3C] peer-checked:text-[#F58A3C] peer-checked:bg-[#FFF5EF] font-medium py-2 rounded-[14px] text-xs transition text-center hover:border-[#F58A3C] hover:text-[#F58A3C]">
                                Cái
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Health Status -->
                <div class="mb-6 space-y-3">
                    <label class="block text-[12px] font-bold text-[#1D2B53] mb-2">Tình trạng sức khỏe</label>
                    <label class="flex items-center gap-3 text-gray-600 text-xs font-medium cursor-pointer hover:text-[#F58A3C] transition">
                        <input type="checkbox" name="da_tiem_phong" value="1" class="w-4 h-4 text-[#F58A3C] border-gray-200 rounded focus:ring-[#F58A3C] focus:ring-offset-0" {{ request('da_tiem_phong') ? 'checked' : '' }}>
                        Đã tiêm phòng
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 text-xs font-medium cursor-pointer hover:text-[#F58A3C] transition">
                        <input type="checkbox" name="da_triet_san" value="1" class="w-4 h-4 text-[#F58A3C] border-gray-200 rounded focus:ring-[#F58A3C] focus:ring-offset-0" {{ request('da_triet_san') ? 'checked' : '' }}>
                        Đã triệt sản
                    </label>
                </div>

                <input type="hidden" name="sap_xep" value="{{ request('sap_xep', 'moi_nhat') }}">

            </form>
        </aside>

        <!-- Center: Pet Grid -->
        <div id="pet-grid-container" class="flex-1 min-w-0 bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50 relative flex flex-col">
            
            <!-- Optional: Loading overlay (hidden by default) -->
            <div id="loading-overlay" class="absolute inset-0 bg-white/60 backdrop-blur-sm z-10 hidden flex items-center justify-center rounded-2xl">
                <div class="w-10 h-10 border-4 border-[#F58A3C] border-t-transparent rounded-full animate-spin"></div>
            </div>

            <div class="flex flex-row justify-between items-center mb-6">
                <p class="font-black text-[#1D2B53] text-[13px] md:text-sm">Tìm thấy <span class="text-[#F58A3C]">{{ $pets->total() }}</span> thú cưng</p>
                
                <div class="relative w-[160px] md:w-[190px]">
                    <select id="sort-select" name="sap_xep" class="w-full bg-white border border-gray-100 rounded-lg px-4 py-2.5 text-[#1D2B53] font-bold text-[11px] md:text-xs focus:outline-none focus:ring-1 focus:ring-[#F58A3C] shadow-[0_2px_10px_rgb(0,0,0,0.02)] cursor-pointer transition-all appearance-none">
                        <option value="moi_nhat" {{ request('sap_xep', 'moi_nhat') == 'moi_nhat' ? 'selected' : '' }}>Sắp xếp: Mới nhất</option>
                        <option value="cu_nhat" {{ request('sap_xep') == 'cu_nhat' ? 'selected' : '' }}>Sắp xếp: Cũ nhất</option>
                    </select>
                    <svg class="w-4 h-4 text-[#1D2B53] absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5">
                
                @forelse($pets as $pet)
                <!-- Pet Card -->
                <div class="bg-white rounded-[24px] overflow-hidden shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgb(0,0,0,0.08)] transition-all duration-300 border border-gray-100 flex flex-col hover:-translate-y-1">
                    <div class="relative h-44 sm:h-40 overflow-hidden">
                        <img src="{{ $pet->AnhUrl }}" alt="{{ $pet->Ten }}" class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3 {{ $pet->Loai == 'cho' ? 'bg-[#40C057]' : ($pet->Loai == 'meo' ? 'bg-[#FCC419]' : 'bg-[#0AA5C0]') }} text-white text-[11px] font-medium px-3 py-1 rounded-lg shadow-sm">
                            {{ $pet->LoaiLabel }}
                        </div>
                        <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-lg flex items-center justify-center text-red-500 border border-red-100 hover:bg-red-50 shadow-sm transition group">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </button>
                    </div>
                    
                    <div class="p-4 flex-1 flex flex-col">
                        <h4 class="font-bold text-[15px] text-[#1D2B53] mb-3">{{ $pet->Ten }}</h4>
                        
                        <div class="flex items-center justify-between text-[11px] font-medium text-gray-500 mb-4 gap-1">
                            <div class="flex items-center gap-1.5 truncate"><i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i> <span class="truncate">{{ $pet->NhomTuoiLabel }}</span></div>
                            <div class="flex items-center gap-1.5 truncate"><i data-lucide="paw-print" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i> <span class="truncate">{{ $pet->GioiTinhLabel }}</span></div>
                            <div class="flex items-center gap-1.5 truncate"><i data-lucide="box" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i> 
                                <span class="truncate">
                                    {{ $pet->Can_nang < 5 ? 'Nhỏ' : ($pet->Can_nang > 15 ? 'Lớn' : 'Trung bình') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div class="flex items-center gap-1 text-[11px] text-gray-500 font-medium truncate max-w-[50%]">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0"></i>
                                <span class="truncate">{{ $pet->ViTriLabel }}</span>
                            </div>
                            <div class="flex gap-1 overflow-hidden">
                                @if($pet->Da_tiem_phong)
                                    <div class="text-[10px] font-semibold text-emerald-700 bg-emerald-50/80 px-2.5 py-1.5 rounded-lg whitespace-nowrap tracking-wide">
                                        Đã tiêm phòng
                                    </div>
                                @endif
                                @if($pet->Da_triet_san)
                                    <div class="text-[10px] font-semibold text-emerald-700 bg-emerald-50/80 px-2.5 py-1.5 rounded-lg whitespace-nowrap tracking-wide">
                                        Đã triệt sản
                                    </div>
                                @endif
                                @if(!$pet->Da_tiem_phong && !$pet->Da_triet_san)
                                    <div class="text-[10px] font-semibold text-emerald-700 bg-emerald-50/80 px-2.5 py-1.5 rounded-lg whitespace-nowrap tracking-wide">
                                        Khỏe mạnh
                                    </div>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('frontend.adoptions.show', $pet->Ma_thu_cung) }}" class="w-full mt-4 bg-[#FFF5EF] hover:bg-orange-100 text-[#F58A3C] font-semibold py-2.5 rounded-lg transition text-[12px] text-center block">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-1 sm:col-span-2 md:col-span-3 xl:col-span-4 text-center py-10 mb-10">
                    <img src="{{ asset('images/no-data.png') }}" alt="Không tìm thấy kết quả" class="w-32 h-32 object-contain mx-auto mb-4 opacity-50">
                    <p class="text-gray-500 font-medium text-sm">Không tìm thấy thú cưng nào phù hợp với bộ lọc.</p>
                </div>
                @endforelse

            </div>

            <!-- Pagination -->
            <div class="mt-auto border-t border-gray-50 pt-8">
                {{ $pets->appends(request()->query())->links('frontend.pagination.custom') }}
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const container = document.getElementById('pet-grid-container');

    function fetchResults(url) {
        const loading = document.getElementById('loading-overlay');
        if (loading) loading.classList.remove('hidden');

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContainer = doc.getElementById('pet-grid-container');
                if (newContainer) {
                    container.innerHTML = newContainer.innerHTML;
                    if (window.lucide) {
                        lucide.createIcons();
                    }
                }
            })
            .catch(err => console.error(err))
            .finally(() => {
                const loadingNow = document.getElementById('loading-overlay');
                if (loadingNow) loadingNow.classList.add('hidden');
            });
    }

    // Lắng nghe sự kiện change trên toàn bộ form lọc
    filterForm.addEventListener('change', function(e) {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);
        const url = `${filterForm.action}?${params.toString()}`;
        
        fetchResults(url);
        window.history.pushState({}, '', url);
    });

    // Event delegation cho sort-select (vì nó bị thay thế khi AJAX load)
    document.addEventListener('change', function(e) {
        if (e.target.matches('#sort-select')) {
            const sap_xep = e.target.value;
            const formData = new FormData(filterForm);
            formData.set('sap_xep', sap_xep);
            
            // Cập nhật hidden input trong filterForm
            const hiddenSort = filterForm.querySelector('input[name="sap_xep"]');
            if (hiddenSort) hiddenSort.value = sap_xep;

            const params = new URLSearchParams(formData);
            const url = `${filterForm.action}?${params.toString()}`;
            
            fetchResults(url);
            window.history.pushState({}, '', url);
        }
    });

    // Intercept pagination clicks
    document.addEventListener('click', function(e) {
        const link = e.target.closest('#pet-grid-container nav a'); // 'nav a' is usually the pagination links
        if (link) {
            e.preventDefault();
            fetchResults(link.href);
            window.history.pushState({}, '', link.href);
            
            // Optional: scroll to top of grid
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        fetchResults(window.location.href);
        // We'd also ideally update form inputs to match the URL, 
        // but since reloading the container might be enough for now.
    });
});
</script>
@endsection
