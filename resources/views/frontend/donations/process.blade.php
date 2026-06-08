@extends('layouts.frontend')
@section('title', 'Thực hiện ủng hộ - ' . config('app.name'))

@section('styles')
<style>
    /* Prevent flicker before alpine loads */
    [x-cloak] { display: none !important; }
    
    /* Custom inputs */
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        font-size: 14px;
        color: #1D2B53;
        transition: all 0.2s;
    }
    .form-input:focus {
        outline: none;
        border-color: #F58A3C;
        box-shadow: 0 0 0 3px rgba(245, 138, 60, 0.1);
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #1D2B53;
        margin-bottom: 6px;
    }
    .form-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #D1D5DB;
        color: #F58A3C;
        cursor: pointer;
    }
    .form-checkbox:checked {
        background-color: #F58A3C;
        border-color: #F58A3C;
    }
    
    /* Hide number input spinners */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection

@section('content')
{{-- Hidden FORM: sẽ được submit bởi Alpine.js khi user bấm nút VNPay --}}
<form id="vnpay-donation-form" method="POST" action="{{ route('frontend.donations.store') }}" style="display:none;">
    @csrf
    <input type="hidden" name="So_tien" id="form-amount">
    <input type="hidden" name="Ten_nguoi_ung_ho" id="form-name">
    <input type="hidden" name="An_danh" id="form-an-danh">
    <input type="hidden" name="Loi_nhan" id="form-loi-nhan">
    <input type="hidden" name="Email_nguoi_ung_ho" id="form-email">
    <input type="hidden" name="Ma_chien_dich" id="form-campaign-id" value="{{ $campaign->Ma_chien_dich ?? '' }}">
</form>

<div class="bg-[#FAFAFA] min-h-screen pt-24 pb-20" x-data="donationApp()">
    <div class="max-w-[1100px] mx-auto px-4 md:px-6">
        
        <!-- Top Progress Bar -->
        <div class="flex items-center justify-center w-full max-w-[800px] mx-auto mb-12 relative">
            <template x-for="(s, index) in steps" :key="s.id">
                <div class="flex items-center w-full">
                    <!-- Circle & Text -->
                    <div class="flex items-center gap-2.5 relative z-10 bg-[#FAFAFA] px-1 transition-all duration-300"
                         :class="step >= s.id ? 'text-teal-600' : 'text-gray-400'">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-[13px] transition-all duration-300 shadow-sm"
                             :class="step >= s.id ? (step === s.id ? 'bg-teal-500 text-white ring-4 ring-teal-50' : 'bg-teal-500 text-white') : 'bg-gray-100 border border-gray-200'">
                            <span x-show="step <= s.id" x-text="s.id"></span>
                            <i data-lucide="check" x-show="step > s.id" x-cloak class="w-4 h-4 text-white"></i>
                        </div>
                        <span class="font-bold text-[13px] hidden md:block whitespace-nowrap" x-text="s.title"></span>
                    </div>
                    
                    <!-- Dotted Line -->
                    <div x-show="index < steps.length - 1" class="flex-1 h-[2px] border-t-[2px] border-dashed mx-2 transition-all duration-300"
                         :class="step > s.id ? 'border-teal-400' : 'border-gray-200'"></div>
                </div>
            </template>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Left Column: Forms -->
            <div class="w-full lg:w-[65%]">
                
                <!-- STEP 1: CHỌN SỐ TIỀN -->
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100">
                    <h2 class="text-2xl md:text-[28px] font-black text-[#1D2B53] flex items-center gap-3 mb-3">
                        Ủng hộ để lan tỏa yêu thương
                        <i data-lucide="heart" class="w-7 h-7 text-[#F58A3C]"></i>
                    </h2>
                    <p class="text-gray-500 font-medium text-[14px] mb-8 leading-relaxed">
                        Mỗi đóng góp của bạn đều giúp chúng tôi chăm sóc tốt hơn cho các bé.<br class="hidden md:block">
                        Cảm ơn bạn vì đã lựa chọn đồng hành cùng chúng tôi!
                    </p>

                    <div class="space-y-8">
                        <!-- Chọn số tiền -->
                        <div>
                            <h3 class="font-bold text-[#1D2B53] mb-4 text-[15px]">1. Chọn số tiền ủng hộ</h3>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-4">
                                <template x-for="amt in suggestedAmounts" :key="amt">
                                    <button type="button" 
                                        @click="selectAmount(amt)"
                                        class="py-3 rounded-xl font-bold text-[14px] transition-all duration-200 border"
                                        :class="amount === amt && !customAmount ? 'bg-[#F58A3C] text-white border-[#F58A3C]' : 'bg-white text-[#1D2B53] border-gray-200 hover:border-[#F58A3C] hover:text-[#F58A3C]'">
                                        <span x-text="formatMoney(amt)"></span>
                                    </button>
                                </template>
                            </div>
                            <div class="relative">
                                <input type="number" x-model="customAmount" @input="amount = 0" placeholder="Nhập số tiền khác" class="form-input py-3.5 pl-4 pr-10 text-[15px] font-bold">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">đ</span>
                            </div>
                        </div>

                        <!-- Chọn mục đích / Chiến dịch -->
                        <template x-if="hasCampaign">
                            <div class="bg-teal-50 border border-teal-100 rounded-2xl p-5 mb-8 flex items-start gap-4 shadow-sm relative overflow-hidden">
                                <!-- Abstract shape -->
                                <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-500/10 rounded-full blur-xl"></div>
                                
                                <div class="w-12 h-12 rounded-xl bg-teal-500 text-white flex items-center justify-center shrink-0 shadow-md relative z-10">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <div class="relative z-10 flex-1">
                                    <h3 class="text-[12px] font-bold text-teal-600 mb-1 uppercase tracking-wider">Bạn đang ủng hộ cho chiến dịch</h3>
                                    <p class="text-[16px] font-black text-[#1D2B53] leading-tight mb-3" x-text="campaignName"></p>
                                    <button type="button" @click="hasCampaign = false; purpose = 'cham_soc'" class="text-[13px] font-bold text-gray-500 hover:text-[#F58A3C] transition-colors inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Hủy, tôi muốn đóng góp quỹ chung
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="!hasCampaign">
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="font-bold text-[#1D2B53] text-[15px]">2. Chọn mục đích ủng hộ <span class="text-gray-400 font-medium text-[13px]">(không bắt buộc)</span></h3>
                                        <p class="text-gray-500 text-[13px] mt-1">Khoản đóng góp của bạn sẽ được sử dụng đúng mục đích bạn chọn.</p>
                                    </div>
                                    <!-- Nút quay lại nếu trước đó là chiến dịch -->
                                    <button type="button" x-show="campaignName !== ''" @click="hasCampaign = true" class="hidden md:inline-flex items-center gap-1.5 text-[12px] font-bold text-teal-600 hover:text-teal-700 transition-colors bg-teal-50 px-3 py-1.5 rounded-lg border border-teal-100">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                        Trở lại chiến dịch
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <template x-for="purp in purposes" :key="purp.id">
                                        <div @click="purpose = purp.id" class="border rounded-xl p-4 text-center cursor-pointer transition-all duration-200 flex flex-col items-center justify-center relative bg-white group"
                                             :class="purpose === purp.id ? 'border-[#F58A3C] shadow-sm' : 'border-gray-200 hover:border-gray-300'">
                                            <div class="w-10 h-10 rounded-xl mb-3 flex items-center justify-center transition-colors"
                                                 :class="purpose === purp.id ? purp.activeBg : purp.bg">
                                                <span x-html="purp.icon" class="w-6 h-6" :class="purpose === purp.id ? purp.activeColor : purp.color"></span>
                                            </div>
                                            <h4 class="font-bold text-[13px] text-[#1D2B53] mb-1 leading-tight" x-text="purp.title"></h4>
                                            <p class="text-[11px] text-gray-500" x-text="purp.desc"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Lời nhắn -->
                        <div>
                            <h3 class="font-bold text-[#1D2B53] mb-3 text-[15px]">3. Lời nhắn yêu thương <span class="text-gray-400 font-medium text-[13px]">(không bắt buộc)</span></h3>
                            <div class="relative">
                                <textarea x-model="message" rows="3" placeholder="Gửi lời nhắn hoặc lời chúc đến các bé..." class="form-input resize-none" maxlength="200"></textarea>
                                <div class="absolute bottom-3 right-3 text-[11px] text-gray-400 font-bold"><span x-text="message.length"></span>/200</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center">
                        <button @click="nextStep()" :disabled="!getCurrentAmount()" class="bg-[#F58A3C] hover:bg-[#E07930] text-white px-10 py-3.5 rounded-xl font-bold flex items-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300 disabled:opacity-50 disabled:hover:translate-y-0 disabled:cursor-not-allowed">
                            Tiếp tục
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: THÔNG TIN NGƯỜI ỦNG HỘ -->
                <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100">
                    <h2 class="text-2xl md:text-[28px] font-black text-[#1D2B53] flex items-center gap-3 mb-3">
                        Thông tin người ủng hộ
                        <i data-lucide="heart" class="w-6 h-6 text-[#F58A3C]"></i>
                    </h2>
                    <p                    <div class="space-y-8">

                        <!-- Toggle Ẩn danh - Lên đầu tiên -->
                        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-orange-50 to-amber-50 rounded-2xl border-2 cursor-pointer transition-all duration-200"
                             :class="isAnonymous ? 'border-[#F58A3C] shadow-sm' : 'border-orange-100 hover:border-orange-200'"
                             @click="isAnonymous = !isAnonymous">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-colors"
                                     :class="isAnonymous ? 'bg-[#F58A3C] text-white' : 'bg-orange-100 text-[#F58A3C]'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-[#1D2B53] text-[15px]" :class="isAnonymous ? 'text-[#F58A3C]' : ''">Tôi muốn ủng hộ ẩn danh</p>
                                    <p class="text-[12px] text-gray-500">Tên của bạn sẽ không hiển thị trên danh sách quyên góp công khai</p>
                                </div>
                            </div>
                            <!-- Toggle Switch -->
                            <button type="button"
                                    class="relative inline-flex flex-shrink-0 cursor-pointer rounded-full focus:outline-none"
                                    :style="isAnonymous ? 'width: 44px; height: 24px; background-color: #F58A3C; transition: background-color 0.2s;' : 'width: 44px; height: 24px; background-color: #e5e7eb; transition: background-color 0.2s;'">
                                <span class="pointer-events-none inline-block rounded-full bg-white shadow"
                                      :style="isAnonymous ? 'width: 18px; height: 18px; margin-top: 3px; transform: translateX(23px); transition: transform 0.2s;' : 'width: 18px; height: 18px; margin-top: 3px; transform: translateX(3px); transition: transform 0.2s;'"></span>
                            </button>
                        </div>

                        <!-- Thông tin cá nhân - chỉ hiện khi không ẩn danh -->
                        <div x-show="!isAnonymous" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
                            <h3 class="font-bold text-[#1D2B53] mb-5 text-[15px]">Thông tin cá nhân</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="form-label">Họ và tên <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="name" placeholder="Nhập họ và tên" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Email <span class="text-red-500">*</span></label>
                                    <input type="email" x-model="email" placeholder="Nhập email của bạn" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="tel" x-model="phone" placeholder="Nhập số điện thoại" class="form-input">
                                </div>
                            </div>
                        </div>



                    <div class="mt-10 flex gap-4">
                        <button @click="prevStep()" class="bg-gray-100 hover:bg-gray-200 text-[#1D2B53] px-6 py-3.5 rounded-xl font-bold flex items-center justify-center transition-colors">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </button>
                        <button @click="submitVNPay()" :disabled="!isAnonymous && !name" class="flex-1 bg-[#F58A3C] hover:bg-[#E07930] text-white px-10 py-3.5 rounded-xl font-bold flex items-center justify-center gap-2.5 shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300 disabled:opacity-50 disabled:hover:translate-y-0 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="6" fill="white" fill-opacity="0.2"/><text x="50%" y="56%" dominant-baseline="middle" text-anchor="middle" font-size="11" font-weight="900" fill="white">VN</text></svg>
                            Thanh toán qua VNPay
                        </button>
                    </div>

                    <div class="mt-4 flex items-center gap-2 justify-center text-[12px] text-gray-400">
                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i>
                        <span>Bảo mật bởi <strong class="text-gray-600">VNPay</strong> &amp; mã hóa <strong class="text-gray-600">SSL 256-bit</strong></span>
                    </div>
                </div>

            </div>

            <!-- Right Column: Summary Sidebar -->
            <div class="w-full lg:w-[35%] lg:sticky lg:top-24">
                <div class="bg-[#FFF9F5] rounded-2xl p-6 shadow-sm border border-orange-100 overflow-hidden relative">
                    
                    <!-- Content changes based on step -->
                    <div x-show="step <= 2" x-transition>
                        <h3 class="text-[18px] font-black text-[#1D2B53] flex items-center gap-2 mb-6">
                            Thông tin ủng hộ
                            <i data-lucide="heart" class="w-5 h-5 text-[#F58A3C]"></i>
                        </h3>
                        
                        <div class="space-y-5">
                            <div>
                                <p class="text-[12px] font-bold text-gray-500 mb-1">Số tiền ủng hộ</p>
                                <p class="text-3xl font-black text-[#F58A3C]" x-text="formatMoney(getCurrentAmount())"></p>
                            </div>
                            
                            <div class="border-t border-orange-200/50 pt-5">
                                <p class="text-[12px] font-bold text-gray-500 mb-1">Mục đích ủng hộ</p>
                                <p class="text-[14px] font-bold text-[#1D2B53]" x-text="getPurposeTitle()"></p>
                            </div>

                            <div class="border-t border-orange-200/50 pt-5">
                                <p class="text-[12px] font-bold text-gray-500 mb-1">Lời nhắn</p>
                                <p class="text-[14px] font-bold text-[#1D2B53]" x-text="message || 'Chưa có lời nhắn'"></p>
                            </div>
                        </div>

                        <div class="mt-8 bg-orange-50 rounded-xl p-4 border border-orange-100 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-orange-100 text-[#F58A3C] flex items-center justify-center shrink-0">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-[12px] font-bold text-[#1D2B53] mb-1">Thông tin của bạn được bảo mật tuyệt đối</p>
                                <p class="text-[10px] text-gray-500 font-medium leading-relaxed">Chúng tôi cam kết bảo vệ thông tin cá nhân và sử dụng khoản đóng góp minh bạch, hiệu quả.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Illustration and Contact -->
                    <div class="mt-8 relative z-0 pb-16">
                        <!-- We reuse hero-img but position it at the bottom to look like the wireframe -->
                        <div class="absolute -bottom-6 -right-6 -left-6 h-[250px] overflow-hidden pointer-events-none opacity-90 z-0">
                             <img src="{{ asset('images/hero-img.png') }}" class="w-full h-full object-cover object-bottom" alt="Pets">
                        </div>
                        
                        <!-- Contact info sitting above image slightly -->
                        <div class="relative z-10 bg-white/80 backdrop-blur-md rounded-2xl p-4 shadow-sm border border-white">
                            <h4 class="font-bold text-[12px] text-[#1D2B53] mb-3">Cần hỗ trợ?</h4>
                            <div class="flex flex-col gap-2">
                                <a href="mailto:hotro@traoyeuthuong.vn" class="flex items-center gap-2 text-[11px] font-medium text-gray-600 hover:text-[#F58A3C] transition-colors">
                                    <i data-lucide="mail" class="w-3.5 h-3.5 text-[#F58A3C]"></i>
                                    Email: hotro@traoyeuthuong.vn
                                </a>
                                <a href="tel:19001234" class="flex items-center gap-2 text-[11px] font-medium text-gray-600 hover:text-[#F58A3C] transition-colors">
                                    <i data-lucide="phone" class="w-3.5 h-3.5 text-[#F58A3C]"></i>
                                    Hotline: 1900 1234
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function donationApp() {
        return {
            step: 1,
            steps: [
                { id: 1, title: 'Chọn số tiền' },
                { id: 2, title: 'Thông tin ủng hộ' },
            ],
            
            // Step 1 Data
            hasCampaign: {{ $campaign ? 'true' : 'false' }},
            campaignId: '{{ $campaign->Ma_chien_dich ?? '' }}',
            campaignName: '{{ $campaign->Tieu_de ?? '' }}',
            
            suggestedAmounts: [50000, 100000, 200000, 500000, 1000000],
            amount: 100000,
            customAmount: '',
            purpose: 'cham_soc',
            message: '',
            purposes: [
                { id: 'cham_soc', title: 'Chăm sóc thú cưng', desc: 'Thức ăn, y tế, nơi ở', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>', bg: 'bg-orange-50', color: 'text-[#F58A3C]', activeBg: 'bg-[#F58A3C]', activeColor: 'text-white' },
                { id: 'cuu_tro', title: 'Cứu trợ khẩn cấp', desc: 'Điều trị, giải cứu', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>', bg: 'bg-teal-50', color: 'text-teal-500', activeBg: 'bg-teal-500', activeColor: 'text-white' },
                { id: 'xay_dung', title: 'Xây dựng & cải thiện', desc: 'Chuồng trại, cơ sở vật chất', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>', bg: 'bg-blue-50', color: 'text-blue-500', activeBg: 'bg-blue-500', activeColor: 'text-white' },
                { id: 'khac', title: 'Chương trình khác', desc: 'Giáo dục, truyền thông', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>', bg: 'bg-emerald-50', color: 'text-emerald-500', activeBg: 'bg-emerald-500', activeColor: 'text-white' }
            ],
            
            // Step 2 Data
            name: '{{ Auth::user()?->Ho_ten ?? '' }}',
            email: '{{ Auth::user()?->Email ?? Auth::user()?->email ?? '' }}',
            phone: '{{ Auth::user()?->So_dien_thoai ?? '' }}',
            isAnonymous: false,
            
            // Step 3 Data
            paymentMethod: 'QR Banking',
            isPaid: false,
            
            // Methods
            selectAmount(val) {
                this.amount = val;
                this.customAmount = '';
            },
            
            getCurrentAmount() {
                if (this.customAmount && parseInt(this.customAmount) > 0) {
                    return parseInt(this.customAmount);
                }
                return this.amount;
            },
            
            formatMoney(val) {
                if (!val) return '0đ';
                return new Intl.NumberFormat('vi-VN').format(val) + 'đ';
            },
            
            getPurposeTitle() {
                if (this.hasCampaign) {
                    return this.campaignName;
                }
                let p = this.purposes.find(x => x.id === this.purpose);
                return p ? p.title : '';
            },
            
            submitVNPay() {
                const amount = this.getCurrentAmount();
                if (amount < 10000) {
                    alert('Số tiền ủng hộ tối thiểu là 10.000đ.');
                    return;
                }
                if (!this.isAnonymous && !this.name.trim()) {
                    alert('Vui lòng nhập tên của bạn hoặc chọn ủng hộ ẩn danh.');
                    return;
                }
                // Điền vào form ẩn rồi submit
                document.getElementById('form-amount').value = amount;
                document.getElementById('form-name').value = this.isAnonymous ? 'Nhà hảo tâm ẩn danh' : this.name;
                document.getElementById('form-an-danh').value = this.isAnonymous ? '1' : '0';
                document.getElementById('form-loi-nhan').value = this.message || '';
                document.getElementById('form-email').value = this.email || '';
                document.getElementById('vnpay-donation-form').submit();
            },
            
            nextStep() {
                if (this.step < 2) {
                    this.step++;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    setTimeout(() => {
                        if (window.lucide) {
                            lucide.createIcons();
                        }
                    }, 50);
                }
            },
            
            prevStep() {
                if (this.step > 1) {
                    this.step--;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    setTimeout(() => {
                        if (window.lucide) {
                            lucide.createIcons();
                        }
                    }, 50);
                }
            }
        }
    }
</script>
@endsection
