@extends('layouts.frontend')
@section('title', 'Đăng ký nhận nuôi - ' . $pet->Ten)
@section('content')

<div class="bg-[#FCFBFA] min-h-screen pt-24 pb-20">
    <div class="max-w-[1200px] mx-auto px-4 md:px-6" x-data="{ 
        step: {{ $errors->has('Cam_ket') ? 3 : ($errors->hasAny(['Ly_do_nhan_nuoi']) || collect($errors->keys())->contains(fn($k) => str_starts_with($k, 'answers.')) ? 2 : 1) }},
        familyCount: 4,
        form: {
            name: '{{ old('Ho_ten', Auth::user()->Ho_ten ?? '') }}',
            email: '{{ Auth::user()->Email ?? '' }}',
            phone: '{{ old('So_dien_thoai', Auth::user()->So_dien_thoai ?? '') }}',
            job: '{{ old('Nghe_nghiep', '') }}',
            address: '{{ old('Dia_chi', Auth::user()->Dia_chi ?? '') }}',
            housing: '{{ old('Loai_nha_o', 'Nhà riêng') }}',
            space: 'Có',
            otherPets: 'Không',
            kids: 'Không',
            reason: '{{ old('Ly_do_nhan_nuoi', '') }}'
        }
    }">
        
        <!-- Back Button -->
        <a href="{{ route('frontend.adoptions.show', $pet->Ma_thu_cung) }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#F58A3C] transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Quay lại trang chi tiết
        </a>

        <!-- Tiêu đề -->
        <h1 class="text-3xl font-black text-[#1D2B53] mb-8 flex items-center gap-3">
            Gửi đơn nhận nuôi {{ $pet->Ten }}
            <svg class="w-6 h-6 text-[#F58A3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </h1>

        <!-- Hiển thị lỗi chung nếu có -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <div class="flex items-center gap-2 mb-2 text-red-600 font-bold">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                    Vui lòng kiểm tra lại các thông tin sau:
                </div>
                <ul class="list-disc list-inside text-sm text-red-500 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <!-- LEFT COLUMN (Main Form) -->
            <div class="w-full lg:w-[68%]">
                
                <!-- Thanh tiến trình (Progress Bar) -->
                <div class="flex items-center justify-between relative mb-12">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-gray-200 z-0"></div>
                    
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-emerald-500 z-0 transition-all duration-500"
                         :style="`width: ${step === 1 ? '0%' : (step === 2 ? '50%' : '100%')}`"></div>

                    <div class="relative z-10 flex items-center gap-2 bg-[#FCFBFA] px-2" :class="step >= 1 ? 'cursor-pointer' : ''" @click="if(step > 1) step = 1">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition-colors shadow-sm"
                             :class="step > 1 ? 'bg-emerald-500 text-white' : 'bg-teal-600 text-white'">
                            <span x-show="step === 1">1</span>
                            <svg x-show="step > 1" style="display:none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs font-bold" :class="step >= 1 ? 'text-[#1D2B53]' : 'text-gray-400'">Hồ sơ nhận nuôi</span>
                    </div>

                    <div class="relative z-10 flex items-center gap-2 bg-[#FCFBFA] px-2" :class="step >= 2 ? 'cursor-pointer' : ''" @click="if(step > 2) step = 2">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition-colors shadow-sm"
                             :class="step > 2 ? 'bg-emerald-500 text-white' : (step === 2 ? 'bg-teal-600 text-white' : 'bg-white border border-gray-200 text-gray-400')">
                            <span x-show="step <= 2">2</span>
                            <svg x-show="step > 2" style="display:none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs font-bold" :class="step >= 2 ? 'text-[#1D2B53]' : 'text-gray-400'">Khảo sát đánh giá</span>
                    </div>

                    <div class="relative z-10 flex items-center gap-2 bg-[#FCFBFA] px-2">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition-colors shadow-sm"
                             :class="step === 3 ? 'bg-teal-600 text-white' : 'bg-white border border-gray-200 text-gray-400'">
                            <span>3</span>
                        </div>
                        <span class="text-xs font-bold" :class="step === 3 ? 'text-[#1D2B53]' : 'text-gray-400'">Xác nhận & gửi đơn</span>
                    </div>
                </div>

                <form action="{{ route('frontend.adoptions.store', $pet->Ma_thu_cung) }}" method="POST" class="bg-white rounded-[24px] p-6 md:p-8 shadow-sm border border-gray-100 mb-8" id="adoptionForm">
                    @csrf
                    
                    <!-- Hidden input gộp kinh nghiệm -->
                    <input type="hidden" name="Kinh_nghiem" :value="`Không gian riêng: ${form.space}, Số người: ${familyCount}, Thú cưng khác: ${form.otherPets}, Trẻ nhỏ: ${form.kids}`">
                    
                    <input type="hidden" name="Ly_do_nhan_nuoi" x-model="form.reason">

                    <!-- BƯỚC 1: HỒ SƠ NHẬN NUÔI -->
                    <div x-show="step === 1" x-transition.opacity.duration.300ms>
                        <div class="mb-8">
                            <h2 class="text-lg font-black text-[#1D2B53] mb-1">Thông tin cá nhân & nơi ở</h2>
                            <p class="text-xs font-bold text-gray-500">Vui lòng cung cấp thông tin chính xác để chúng tôi có thể liên hệ và hỗ trợ bạn.</p>
                        </div>

                        <!-- 1. Thông tin cá nhân -->
                        <div class="mb-8">
                            <h3 class="text-sm font-black text-[#1D2B53] mb-4">1. Thông tin cá nhân</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1.5">Họ và tên <span class="text-red-500">*</span></label>
                                    <input type="text" name="Ho_ten" x-model="form.name" placeholder="Nhập họ và tên" class="w-full h-11 px-4 bg-white border @error('Ho_ten') border-red-500 @else border-gray-200 @enderror rounded-xl text-sm font-medium focus:outline-none focus:border-[#F58A3C] focus:ring-1 focus:ring-[#F58A3C] text-[#1D2B53]">
                                    @error('Ho_ten')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1.5">Email (không đổi) <span class="text-red-500">*</span></label>
                                    <input type="email" readonly x-model="form.email" class="w-full h-11 px-4 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-500 cursor-not-allowed">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1.5">Số điện thoại <span class="text-red-500">*</span></label>
                                    <input type="tel" name="So_dien_thoai" x-model="form.phone" placeholder="Nhập số điện thoại" class="w-full h-11 px-4 bg-white border @error('So_dien_thoai') border-red-500 @else border-gray-200 @enderror rounded-xl text-sm font-medium focus:outline-none focus:border-[#F58A3C] focus:ring-1 focus:ring-[#F58A3C] text-[#1D2B53]">
                                    @error('So_dien_thoai')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1.5">Nghề nghiệp</label>
                                    <input type="text" name="Nghe_nghiep" x-model="form.job" placeholder="Sinh viên, Nhân viên VP..." class="w-full h-11 px-4 bg-white border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#F58A3C] focus:ring-1 focus:ring-[#F58A3C] text-[#1D2B53]">
                                </div>
                            </div>
                        </div>

                        <!-- 2. Thông tin nơi ở -->
                        <div class="mb-8">
                            <h3 class="text-sm font-black text-[#1D2B53] mb-4">2. Thông tin nơi ở</h3>
                            <div class="mb-4">
                                <label class="block text-[11px] font-bold text-gray-600 mb-1.5">Địa chỉ hiện tại <span class="text-red-500">*</span></label>
                                <input type="text" name="Dia_chi" x-model="form.address" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành..." class="w-full h-11 px-4 bg-white border @error('Dia_chi') border-red-500 @else border-gray-200 @enderror rounded-xl text-sm font-medium focus:outline-none focus:border-[#F58A3C] focus:ring-1 focus:ring-[#F58A3C] text-[#1D2B53]">
                                @error('Dia_chi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <label class="block text-[11px] font-bold text-gray-600 mb-2">Loại hình nhà ở <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-2">
                                @php
                                    $housingTypes = [
                                        'Nhà riêng' => 'home',
                                        'Chung cư' => 'building',
                                        'Nhà thuê' => 'key',
                                        'Ký túc xá' => 'users',
                                        'Khác' => 'more-horizontal'
                                    ];
                                @endphp
                                @foreach($housingTypes as $type => $icon)
                                <label class="cursor-pointer">
                                    <input type="radio" name="Loai_nha_o" value="{{ $type }}" class="peer hidden" x-model="form.housing">
                                    <div class="border border-gray-200 rounded-xl p-3 flex flex-col items-center gap-2 transition-all peer-checked:border-[#F58A3C] peer-checked:bg-orange-50 peer-checked:text-[#F58A3C] text-gray-400 hover:border-gray-300">
                                        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                                        <span class="text-[11px] font-bold">{{ $type }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- 3. Điều kiện nuôi -->
                        <div class="mb-6">
                            <h3 class="text-sm font-black text-[#1D2B53] mb-4">3. Điều kiện nuôi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-2">Bạn có không gian riêng cho thú cưng? <span class="text-red-500">*</span></label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" value="Có" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" x-model="form.space">
                                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#F58A3C]">Có</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" value="Không" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" x-model="form.space">
                                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#F58A3C]">Không</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-2">Số người trong gia đình <span class="text-red-500">*</span></label>
                                    <div class="flex items-center w-[120px] h-10 bg-white border border-gray-200 rounded-xl overflow-hidden">
                                        <button type="button" class="w-10 h-full flex items-center justify-center text-gray-500 hover:bg-gray-50 transition" @click="if(familyCount > 1) familyCount--">-</button>
                                        <input type="text" x-model="familyCount" class="w-full h-full text-center text-sm font-bold text-[#1D2B53] border-none focus:ring-0 p-0" readonly>
                                        <button type="button" class="w-10 h-full flex items-center justify-center text-gray-500 hover:bg-gray-50 transition" @click="familyCount++">+</button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-2">Hiện tại bạn có nuôi thú cưng khác không? <span class="text-red-500">*</span></label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" value="Có" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" x-model="form.otherPets">
                                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#F58A3C]">Có</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" value="Không" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" x-model="form.otherPets">
                                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#F58A3C]">Không</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-2">Bạn có trẻ nhỏ trong gia đình không?</label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" value="Có" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" x-model="form.kids">
                                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#F58A3C]">Có</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" value="Không" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" x-model="form.kids">
                                            <span class="text-xs font-bold text-gray-600 group-hover:text-[#F58A3C]">Không</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex justify-end">
                            <button type="button" @click="step = 2" class="bg-[#F58A3C] hover:bg-orange-500 text-white font-black py-3 px-8 rounded-xl transition-all flex items-center justify-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.2)] hover:-translate-y-0.5 text-[13px] w-full sm:w-auto">
                                Tiếp tục <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BƯỚC 2: KHẢO SÁT ĐÁNH GIÁ -->
                    <div x-show="step === 2" x-transition.opacity.duration.300ms style="display:none;">
                        
                        <div class="flex items-end justify-between mb-8 pb-4 border-b border-gray-100">
                            <div>
                                <h2 class="text-lg font-black text-[#1D2B53] mb-1">Khảo sát đánh giá</h2>
                                <p class="text-xs font-bold text-gray-500">Vui lòng trả lời trung thực để chúng tôi có thể đảm bảo môi trường tốt nhất cho {{ $pet->Ten }}.</p>
                            </div>
                        </div>

                        <div class="space-y-8 mb-10">
                            @foreach($questions as $index => $q)
                                <div class="survey-question">
                                    <label class="block text-[13px] font-bold text-[#1D2B53] mb-3 leading-relaxed">
                                        {{ $index + 1 }}. {{ $q->Noi_dung }} @if($q->Bat_buoc)<span class="text-red-500">*</span>@endif
                                    </label>

                                    @php
                                        $options = [];
                                        if (is_array($q->Cac_lua_chon)) {
                                            $options = $q->Cac_lua_chon;
                                        } elseif (is_string($q->Cac_lua_chon) && !empty($q->Cac_lua_chon)) {
                                            $decoded = json_decode($q->Cac_lua_chon, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                $options = $decoded;
                                            } else {
                                                // Fallback to comma separated
                                                $options = array_map('trim', explode(',', $q->Cac_lua_chon));
                                            }
                                        }
                                    @endphp

                                    @if($q->Loai_cau_tra_loi == 'single_choice' || $q->Loai_cau_tra_loi == 'single_choice_horizontal')
                                        <div class="space-y-2.5 pl-1">
                                            @foreach($options as $option)
                                                <label class="flex items-center gap-3 cursor-pointer group w-fit">
                                                    <input type="radio" name="answers[{{ $q->Ma_cau_hoi }}]" value="{{ $option }}" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#F58A3C] checked:border-[5px] transition-all bg-white" {{ old('answers.'.$q->Ma_cau_hoi) == $option ? 'checked' : '' }}>
                                                    <span class="text-xs font-bold text-gray-600 peer-checked:text-[#F58A3C] transition-colors">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('answers.'.$q->Ma_cau_hoi)
                                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                        @enderror
                                    @elseif($q->Loai_cau_tra_loi == 'multiple_choice')
                                        <div class="space-y-2.5 pl-1">
                                            @foreach($options as $option)
                                                <label class="flex items-center gap-3 cursor-pointer group w-fit">
                                                    <input type="checkbox" name="answers[{{ $q->Ma_cau_hoi }}][]" value="{{ $option }}" class="peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-sm checked:border-[#F58A3C] checked:bg-[#F58A3C] transition-all bg-white" {{ is_array(old('answers.'.$q->Ma_cau_hoi)) && in_array($option, old('answers.'.$q->Ma_cau_hoi)) ? 'checked' : '' }}>
                                                    <span class="text-xs font-bold text-gray-600 peer-checked:text-[#F58A3C] transition-colors">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('answers.'.$q->Ma_cau_hoi)
                                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                        @enderror
                                    @elseif($q->Loai_cau_tra_loi == 'text')
                                        <div class="relative">
                                            <textarea name="answers[{{ $q->Ma_cau_hoi }}]" rows="3" placeholder="Nhập câu trả lời của bạn..." class="w-full p-4 bg-slate-50 border @error('answers.'.$q->Ma_cau_hoi) border-red-500 @else border-gray-200 @enderror rounded-xl text-sm font-medium focus:outline-none focus:border-[#F58A3C] focus:bg-white focus:ring-1 focus:ring-[#F58A3C] transition text-[#1D2B53]">{{ old('answers.'.$q->Ma_cau_hoi) }}</textarea>
                                        </div>
                                        @error('answers.'.$q->Ma_cau_hoi)
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    @endif
                                </div>
                            @endforeach
                            
                            <!-- Lý do nhận nuôi (Required by DB Application table) -->
                            <div class="survey-question">
                                <label class="block text-[13px] font-bold text-[#1D2B53] mb-3 leading-relaxed">
                                    Lý do bạn muốn nhận nuôi bé {{ $pet->Ten }}? <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <textarea rows="4" x-model="form.reason" placeholder="Chia sẻ lý do bạn muốn nhận nuôi bé..." 
                                              :class="{
                                                'border-red-500 focus:border-red-500 focus:ring-red-500': form.reason.length > 0 && form.reason.length < 30, 
                                                'border-gray-200 focus:border-[#F58A3C] focus:ring-[#F58A3C]': form.reason.length === 0 || form.reason.length >= 30
                                              }"
                                              class="w-full p-4 bg-slate-50 border @error('Ly_do_nhan_nuoi') border-red-500 @enderror rounded-xl text-sm font-medium focus:outline-none focus:bg-white focus:ring-1 transition text-[#1D2B53]"></textarea>
                                    <div class="absolute bottom-3 right-4 text-[11px] font-bold" 
                                         :class="form.reason.length > 0 && form.reason.length < 30 ? 'text-red-500' : 'text-gray-400'">
                                        <span x-text="form.reason.length"></span> ký tự (tối thiểu 30)
                                    </div>
                                </div>
                                @error('Ly_do_nhan_nuoi')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-between items-center border-t border-gray-100 pt-6">
                            <button type="button" @click="step = 1" class="bg-white hover:bg-gray-50 text-gray-600 font-bold py-3 px-6 rounded-xl border border-gray-200 transition-all flex items-center justify-center gap-2 text-[13px]">
                                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
                            </button>
                            <button type="button" @click="step = 3" class="bg-[#F58A3C] hover:bg-orange-500 text-white font-black py-3 px-8 rounded-xl transition-all flex items-center justify-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.2)] hover:-translate-y-0.5 text-[13px]">
                                Tiếp tục <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BƯỚC 3: XÁC NHẬN & GỬI ĐƠN -->
                    <div x-show="step === 3" x-transition.opacity.duration.300ms style="display:none;">
                        
                        <div class="mb-8 border-b border-gray-100 pb-4">
                            <h2 class="text-lg font-black text-[#1D2B53] mb-1">Xác nhận thông tin</h2>
                            <p class="text-xs font-bold text-gray-500">Vui lòng kiểm tra lại thông tin trước khi gửi đơn nhận nuôi.</p>
                        </div>

                        <!-- Card 1: Thông tin cá nhân -->
                        <div class="mb-6 relative">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-black text-[#1D2B53]">Thông tin cá nhân & nơi ở</h3>
                                <button type="button" @click="step = 1" class="text-[11px] font-bold text-[#F58A3C] hover:underline flex items-center gap-1">
                                    <i data-lucide="edit-3" class="w-3 h-3"></i> Chỉnh sửa
                                </button>
                            </div>
                            <div class="bg-[#FAFAFA] border border-gray-100 rounded-[20px] p-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    <div class="flex gap-3">
                                        <i data-lucide="user" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[100px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Họ và tên</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.name"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <i data-lucide="mail" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[100px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Email</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.email"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <i data-lucide="phone" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[100px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Số điện thoại</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.phone"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <i data-lucide="briefcase" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[100px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Nghề nghiệp</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.job"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 md:col-span-2">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[100px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Địa chỉ</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.address"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-span-1 md:col-span-2 h-px bg-gray-200 my-2"></div>

                                    <div class="flex gap-3">
                                        <i data-lucide="home" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[130px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Loại nhà ở</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.housing"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <i data-lucide="maximize" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[130px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Không gian riêng</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.space"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 md:col-span-2">
                                        <i data-lucide="cat" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[130px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Thú cưng khác</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.otherPets"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <i data-lucide="users" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[130px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Số người trong GĐ</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="familyCount + ' người'"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <i data-lucide="baby" class="w-4 h-4 text-gray-400 shrink-0 mt-0.5"></i>
                                        <div class="grid grid-cols-[130px_1fr] w-full text-xs">
                                            <span class="font-bold text-gray-500">Trẻ nhỏ trong gia đình</span>
                                            <span class="font-bold text-[#1D2B53]" x-text="form.kids"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cam kết -->
                        <div class="mb-8">
                            <h3 class="text-sm font-black text-[#1D2B53] mb-4">Cam kết của bạn <span class="text-red-500">*</span></h3>
                            <div class="space-y-3">
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center shrink-0 mt-0.5">
                                        <input type="checkbox" name="Cam_ket" value="1" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-md checked:border-[#F58A3C] checked:bg-[#F58A3C] transition-all bg-white" {{ old('Cam_ket') ? 'checked' : '' }}>
                                        <i data-lucide="check" class="absolute w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                    </div>
                                    <span class="text-xs font-bold text-gray-600 leading-relaxed group-hover:text-gray-800">Tôi cam kết chăm sóc thú cưng với trách nhiệm và tình yêu thương, và không mua bán trao đổi vì mục đích thương mại.</span>
                                </label>
                                @error('Cam_ket')
                                    <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-between items-center border-t border-gray-100 pt-6">
                            <button type="button" @click="step = 2" class="bg-white hover:bg-gray-50 text-gray-600 font-bold py-3 px-6 rounded-xl border border-gray-200 transition-all flex items-center justify-center gap-2 text-[13px]">
                                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
                            </button>
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-black py-3 px-8 rounded-xl transition-all flex items-center justify-center gap-2 shadow-[0_4px_15px_rgba(16,185,129,0.3)] hover:-translate-y-0.5 text-[13px]">
                                Gửi đơn ngay <i data-lucide="check-circle" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- RIGHT COLUMN (Pet Summary) -->
            <div class="w-full lg:w-[32%] sticky top-28">
                <div class="bg-white rounded-[24px] overflow-hidden shadow-sm border border-gray-100 mb-6">
                    <div class="h-48 relative">
                        <img src="{{ $pet->AnhUrl }}" alt="{{ $pet->Ten }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-5 text-white">
                            <h3 class="text-xl font-black mb-1">{{ $pet->Ten }}</h3>
                            <div class="flex items-center gap-2 text-xs font-bold opacity-90">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> Trạm cứu hộ PetJam
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-3 mb-5">
                            <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm text-gray-500">
                                    <i data-lucide="tag" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400">Giống</p>
                                    <p class="text-[11px] font-black text-[#1D2B53]">{{ $pet->Giong }}</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm text-gray-500">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400">Tuổi</p>
                                    <p class="text-[11px] font-black text-[#1D2B53]">{{ $pet->Tuoi }} tuổi</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm text-gray-500">
                                    <i data-lucide="scale" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400">Cân nặng</p>
                                    <p class="text-[11px] font-black text-[#1D2B53]">{{ $pet->Can_nang }} kg</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm text-gray-500">
                                    @if($pet->Gioi_tinh === 'duc')
                                        <i data-lucide="mars" class="w-4 h-4 text-blue-500"></i>
                                    @else
                                        <i data-lucide="venus" class="w-4 h-4 text-pink-500"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400">Giới tính</p>
                                    <p class="text-[11px] font-black text-[#1D2B53]">{{ $pet->Gioi_tinh === 'duc' ? 'Đực' : 'Cái' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs text-gray-600 font-medium leading-relaxed">
                            <span class="font-bold text-[#1D2B53]">Tính cách: </span>
                            {{ $pet->Tinh_cach }}
                        </div>
                    </div>
                </div>

                <!-- Assistance Card -->
                <div class="bg-[#1D2B53] rounded-[24px] p-6 text-white relative overflow-hidden shadow-xl shadow-blue-900/20">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                    <div class="relative z-10">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-4">
                            <i data-lucide="help-circle" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-black text-lg mb-2">Bạn cần hỗ trợ?</h3>
                        <p class="text-xs text-gray-300 mb-6 leading-relaxed">Nếu gặp khó khăn trong quá trình điền đơn, đừng ngần ngại liên hệ với PETJAM.</p>
                        <div class="space-y-3">
                            <a href="tel:19001234" class="flex items-center gap-3 text-sm font-bold bg-white/10 hover:bg-white/20 p-3 rounded-xl transition">
                                <i data-lucide="phone" class="w-4 h-4 text-[#F58A3C]"></i> 1900 1234
                            </a>
                            <a href="mailto:support@petjam.vn" class="flex items-center gap-3 text-sm font-bold bg-white/10 hover:bg-white/20 p-3 rounded-xl transition">
                                <i data-lucide="mail" class="w-4 h-4 text-[#F58A3C]"></i> support@petjam.vn
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
