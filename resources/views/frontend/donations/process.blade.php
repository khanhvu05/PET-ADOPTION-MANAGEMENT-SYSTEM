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
                    <p class="text-gray-500 font-medium text-[14px] mb-8 leading-relaxed">
                        Vui lòng cung cấp thông tin để chúng tôi gửi xác nhận<br class="hidden md:block">
                        và cập nhật dự án cho bạn.
                    </p>

                    <div class="space-y-8">
                        <div>
                            <h3 class="font-bold text-[#1D2B53] mb-5 text-[15px]">1. Thông tin cá nhân</h3>
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
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 mt-6 cursor-pointer hover:border-orange-200 transition-colors" @click="isAnonymous = !isAnonymous">
                                    <div>
                                        <p class="font-bold text-[#1D2B53] text-[14px] mb-0.5" :class="isAnonymous ? 'text-[#F58A3C]' : ''">Ủng hộ ẩn danh</p>
                                        <p class="text-[12px] text-gray-500">Tên của bạn sẽ không hiển thị công khai trên danh sách quyên góp</p>
                                    </div>
                                    <!-- Toggle Switch -->
                                    <button type="button" 
                                            class="relative inline-flex flex-shrink-0 cursor-pointer rounded-full focus:outline-none"
                                            :style="isAnonymous ? 'width: 44px; height: 24px; background-color: #F58A3C; transition: background-color 0.2s;' : 'width: 44px; height: 24px; background-color: #e5e7eb; transition: background-color 0.2s;'">
                                        <span class="pointer-events-none inline-block rounded-full bg-white shadow"
                                              :style="isAnonymous ? 'width: 18px; height: 18px; margin-top: 3px; transform: translateX(23px); transition: transform 0.2s;' : 'width: 18px; height: 18px; margin-top: 3px; transform: translateX(3px); transition: transform 0.2s;'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold text-[#1D2B53] mb-5 text-[15px]">2. Địa chỉ <span class="text-gray-400 font-medium text-[13px]">(không bắt buộc)</span></h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="form-label">Tỉnh / Thành phố</label>
                                    <select x-model="province" class="form-input appearance-none bg-white">
                                        <option value="">Chọn tỉnh / thành phố</option>
                                        <option value="Hà Nội">Hà Nội</option>
                                        <option value="TP.Hồ Chí Minh">TP. Hồ Chí Minh</option>
                                        <option value="Đà Nẵng">Đà Nẵng</option>
                                        <option value="Khác">Khác</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Lời nhắn thêm cho dự án <span class="text-gray-400 font-medium text-[13px]">(không bắt buộc)</span></label>
                                    <div class="relative">
                                        <textarea x-model="extraMessage" rows="3" placeholder="Gửi lời động viên đến các bé..." class="form-input resize-none" maxlength="200"></textarea>
                                        <div class="absolute bottom-3 right-3 text-[11px] text-gray-400 font-bold"><span x-text="extraMessage.length"></span>/200</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex gap-4">
                        <button @click="prevStep()" class="bg-gray-100 hover:bg-gray-200 text-[#1D2B53] px-6 py-3.5 rounded-xl font-bold flex items-center justify-center transition-colors">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </button>
                        <button @click="nextStep()" :disabled="!name || !email" class="flex-1 bg-[#F58A3C] hover:bg-[#E07930] text-white px-10 py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300 disabled:opacity-50 disabled:hover:translate-y-0 disabled:cursor-not-allowed">
                            Tiếp tục
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: THANH TOÁN -->
                <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100">
                    <h2 class="text-2xl md:text-[28px] font-black text-[#1D2B53] flex items-center gap-3 mb-3">
                        Thanh toán
                    </h2>
                    <p class="text-gray-500 font-medium text-[14px] mb-8 leading-relaxed">
                        Vui lòng chọn phương thức thanh toán phù hợp<br class="hidden md:block">
                        để hoàn tất khoản ủng hộ.
                    </p>

                    <div class="space-y-8">
                        <div>
                            <h3 class="font-bold text-[#1D2B53] mb-4 text-[15px]">1. Chọn phương thức thanh toán</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- QR Banking -->
                                <div @click="paymentMethod = 'QR Banking'" class="border rounded-xl p-4 text-center cursor-pointer transition-all duration-200 flex flex-col items-center justify-center relative bg-white group"
                                     :class="paymentMethod === 'QR Banking' ? 'border-teal-500 shadow-sm bg-teal-50/10' : 'border-gray-200 hover:border-gray-300'">
                                    <div class="w-12 h-12 rounded-xl mb-2 flex items-center justify-center bg-teal-50 text-teal-600">
                                        <i data-lucide="qr-code" class="w-6 h-6"></i>
                                    </div>
                                    <h4 class="font-bold text-[13px] text-[#1D2B53] mb-1">QR Banking</h4>
                                    <p class="text-[11px] text-gray-400 font-medium">Quét mã QR</p>
                                    <div x-show="paymentMethod === 'QR Banking'" class="absolute top-2 right-2 w-5 h-5 bg-teal-500 rounded-full flex items-center justify-center text-white"><i data-lucide="check" class="w-3 h-3"></i></div>
                                </div>
                                <!-- Momo -->
                                <div @click="paymentMethod = 'MoMo'" class="border rounded-xl p-4 text-center cursor-pointer transition-all duration-200 flex flex-col items-center justify-center relative bg-white group"
                                     :class="paymentMethod === 'MoMo' ? 'border-pink-500 shadow-sm bg-pink-50/10' : 'border-gray-200 hover:border-gray-300'">
                                    <div class="w-12 h-12 rounded-xl mb-2 flex items-center justify-center bg-pink-50 text-pink-600 font-black text-xs">MoMo</div>
                                    <h4 class="font-bold text-[13px] text-[#1D2B53] mb-1">Ví MoMo</h4>
                                    <p class="text-[11px] text-gray-400 font-medium">Thanh toán qua ví</p>
                                    <div x-show="paymentMethod === 'MoMo'" class="absolute top-2 right-2 w-5 h-5 bg-pink-500 rounded-full flex items-center justify-center text-white"><i data-lucide="check" class="w-3 h-3"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- QR Box (Simulated for QR Banking) -->
                        <div x-show="paymentMethod === 'QR Banking'" x-collapse>
                            <h3 class="font-bold text-[#1D2B53] mb-4 text-[15px]">2. Quét mã QR để thanh toán</h3>
                            <div class="border border-gray-200 rounded-2xl p-6 bg-gray-50/50 flex flex-col items-center">
                                <div class="w-48 h-48 bg-white border-4 border-white shadow-md rounded-xl mb-6 p-2 relative flex items-center justify-center">
                                    <div class="w-full h-full" style="background-image: radial-gradient(circle, #111 2px, transparent 2px), radial-gradient(circle, #111 2px, transparent 2px); background-size: 8px 8px; background-position: 0 0, 4px 4px;"></div>
                                    <div class="absolute inset-0 m-auto w-10 h-10 bg-white rounded-lg flex items-center justify-center border shadow-sm text-xs font-bold text-blue-600">MB</div>
                                </div>

                                <div class="w-full max-w-sm space-y-3 text-sm">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200 border-dashed">
                                        <span class="text-gray-500 font-medium">Ngân hàng</span>
                                        <span class="font-bold text-[#1D2B53]">MB Bank</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200 border-dashed">
                                        <span class="text-gray-500 font-medium">Số tài khoản</span>
                                        <span class="font-bold text-[#1D2B53] text-[16px]">0000 1234 5678</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200 border-dashed">
                                        <span class="text-gray-500 font-medium">Chủ tài khoản</span>
                                        <span class="font-bold text-[#1D2B53]">QUỸ TRAO YÊU THƯƠNG</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-500 font-medium">Nội dung chuyển khoản <span class="text-xs text-gray-400 block">(không bắt buộc)</span></span>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-[#1D2B53]">ung ho cham soc thu cung</span>
                                            <button class="text-gray-400 hover:text-teal-600"><i data-lucide="copy" class="w-4 h-4"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <label class="flex items-center gap-3 cursor-pointer group mt-6">
                            <input type="checkbox" x-model="isPaid" class="form-checkbox">
                            <span class="font-bold text-[#1D2B53] text-[14px]">Tôi xác nhận đã hoàn tất thanh toán</span>
                        </label>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <button @click="prevStep()" class="bg-gray-100 hover:bg-gray-200 text-[#1D2B53] px-6 py-3.5 rounded-xl font-bold flex items-center justify-center transition-colors">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </button>
                        <button @click="nextStep()" :disabled="!isPaid" class="flex-1 bg-[#F58A3C] hover:bg-[#E07930] text-white px-10 py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300 disabled:opacity-50 disabled:hover:translate-y-0 disabled:cursor-not-allowed">
                            Tôi đã thanh toán
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 4: HOÀN TẤT -->
                <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100 text-center">
                    
                    <div class="w-20 h-20 rounded-full bg-orange-100 text-[#F58A3C] flex items-center justify-center mx-auto mb-6 shadow-inner relative">
                        <div class="absolute inset-0 bg-[#F58A3C] opacity-20 rounded-full animate-ping"></div>
                        <div class="w-14 h-14 rounded-full bg-[#F58A3C] text-white flex items-center justify-center z-10 shadow-lg">
                            <i data-lucide="check" class="w-8 h-8"></i>
                        </div>
                    </div>
                    
                    <h2 class="text-3xl font-black text-[#1D2B53] mb-3">
                        Cảm ơn bạn rất nhiều! 🎉
                    </h2>
                    <p class="text-gray-500 font-medium text-[15px] mb-10">
                        Khoản đóng góp <span class="font-bold text-[#F58A3C]" x-text="formatMoney(getCurrentAmount())"></span> đã được ghi nhận thành công.
                    </p>

                    <!-- Transaction Info -->
                    <div class="text-left bg-gray-50/50 rounded-2xl p-6 md:p-8 border border-gray-100 max-w-lg mx-auto mb-10">
                        <h3 class="font-bold text-[#1D2B53] mb-5 text-[15px]">Thông tin giao dịch</h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-1 border-b border-gray-200 border-dashed pb-3">
                                <span class="text-gray-500 font-medium">Mã giao dịch</span>
                                <span class="font-bold text-[#1D2B53]">DONATE-2025-000145</span>
                            </div>
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-1 border-b border-gray-200 border-dashed pb-3">
                                <span class="text-gray-500 font-medium">Thời gian</span>
                                <span class="font-bold text-[#1D2B53]">28/05/2025 14:30:25</span>
                            </div>
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-1 border-b border-gray-200 border-dashed pb-3">
                                <span class="text-gray-500 font-medium">Phương thức thanh toán</span>
                                <span class="font-bold text-[#1D2B53]" x-text="paymentMethod"></span>
                            </div>
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-1 pt-1">
                                <span class="text-gray-500 font-medium">Trạng thái</span>
                                <span class="inline-flex px-3 py-1 bg-teal-100 text-teal-700 font-bold text-xs rounded-full">Thành công</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 max-w-sm mx-auto">
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-3 text-left">
                            <input type="checkbox" checked class="form-checkbox mt-1 shrink-0">
                            <div>
                                <p class="font-bold text-[13px] text-[#1D2B53]">Gửi email cập nhật định kỳ về dự án bạn đã ủng hộ</p>
                                <p class="text-[11px] text-gray-500 mt-1">Bạn có thể thay đổi tùy chọn này bất cứ lúc nào.</p>
                            </div>
                        </div>

                        <a href="{{ route('frontend.donations.index') }}" class="w-full block bg-[#F58A3C] hover:bg-[#E07930] text-white px-8 py-3.5 rounded-xl font-bold text-center shadow-[0_4px_15px_rgba(245,138,60,0.3)] hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center justify-center gap-2">
                                <i data-lucide="gift" class="w-5 h-5"></i>
                                Xem dự án đã ủng hộ
                            </div>
                        </a>
                        
                        <button class="w-full bg-white border border-teal-500 text-teal-600 px-8 py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-teal-50 transition-colors">
                            <i data-lucide="share-2" class="w-4 h-4"></i>
                            Chia sẻ yêu thương
                        </button>
                    </div>
                </div>

            </div>

            <!-- Right Column: Summary Sidebar -->
            <div class="w-full lg:w-[35%] lg:sticky lg:top-24">
                <div class="bg-[#FFF9F5] rounded-2xl p-6 shadow-sm border border-orange-100 overflow-hidden relative">
                    
                    <!-- Content changes based on step -->
                    <div x-show="step < 3" x-transition>
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

                    <div x-show="step === 3" x-cloak x-transition>
                        <h3 class="text-[18px] font-black text-[#1D2B53] flex items-center gap-2 mb-6">
                            Tóm tắt đơn ủng hộ
                            <i data-lucide="heart" class="w-5 h-5 text-[#F58A3C]"></i>
                        </h3>
                        
                        <div class="space-y-4 text-[13px]">
                            <div class="flex justify-between items-start border-b border-orange-200/50 pb-4">
                                <span class="font-bold text-gray-500">Số tiền ủng hộ</span>
                                <span class="font-black text-[#F58A3C] text-xl" x-text="formatMoney(getCurrentAmount())"></span>
                            </div>
                            <div class="flex justify-between items-start border-b border-orange-200/50 pb-4">
                                <span class="font-bold text-gray-500">Mục đích</span>
                                <span class="font-bold text-[#1D2B53] text-right max-w-[150px]" x-text="getPurposeTitle()"></span>
                            </div>
                            <div class="flex justify-between items-start border-b border-orange-200/50 pb-4">
                                <span class="font-bold text-gray-500">Phương thức</span>
                                <span class="font-bold text-[#1D2B53]" x-text="paymentMethod"></span>
                            </div>
                            <div class="flex justify-between items-start pb-2">
                                <span class="font-bold text-gray-500">Email nhận biên nhận</span>
                                <span class="font-bold text-[#1D2B53] text-right truncate max-w-[150px]" x-text="email || 'Chưa nhập'"></span>
                            </div>
                        </div>

                        <div class="mt-6 bg-orange-50 rounded-xl p-4 border border-orange-100 flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-100 text-[#F58A3C] flex items-center justify-center shrink-0">
                                <i data-lucide="lock" class="w-3 h-3"></i>
                            </div>
                            <div>
                                <p class="text-[12px] font-bold text-[#1D2B53] mb-0.5">Giao dịch an toàn</p>
                                <p class="text-[10px] text-gray-500 font-medium leading-relaxed">Mọi giao dịch đều được mã hóa và bảo mật SSL 256-bit.</p>
                            </div>
                        </div>
                    </div>

                    <div x-show="step === 4" x-cloak x-transition>
                        <h3 class="text-[18px] font-black text-[#1D2B53] text-center mb-4">
                            Bé Mít gửi lời cảm ơn đến bạn! ❤️
                        </h3>
                        <p class="text-[13px] font-bold text-[#F58A3C] text-center italic mb-6 px-4">
                            "Nhờ bạn mà mình có cơ hội được chăm sóc tốt hơn mỗi ngày."
                        </p>
                        
                        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mt-4 relative z-10">
                            <h4 class="font-bold text-[13px] text-[#1D2B53] mb-4">Khoản đóng góp của bạn sẽ giúp</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-lg bg-orange-50 text-[#F58A3C] flex items-center justify-center shrink-0"><i data-lucide="utensils" class="w-3.5 h-3.5"></i></div>
                                    <span class="text-[12px] font-medium text-gray-600">10 bữa ăn dinh dưỡng cho thú cưng</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-lg bg-teal-50 text-teal-500 flex items-center justify-center shrink-0"><i data-lucide="briefcase-medical" class="w-3.5 h-3.5"></i></div>
                                    <span class="text-[12px] font-medium text-gray-600">Hỗ trợ thuốc và chi phí điều trị</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center shrink-0"><i data-lucide="stethoscope" class="w-3.5 h-3.5"></i></div>
                                    <span class="text-[12px] font-medium text-gray-600">Chi phí chăm sóc sức khỏe và tiêm phòng</span>
                                </li>
                            </ul>
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
                { id: 3, title: 'Thanh toán' },
                { id: 4, title: 'Hoàn tất' }
            ],
            
            // Step 1 Data
            hasCampaign: {{ request('campaign_id') ? 'true' : 'false' }},
            campaignId: '{{ request('campaign_id') ?? '' }}',
            campaignName: 'Cứu trợ Lucky bị viêm phổi nặng', // Tạm thời mockup tên chiến dịch khi có ID
            
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
            name: '',
            email: '',
            phone: '',
            isAnonymous: false,
            province: '',
            extraMessage: '',
            
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
            
            nextStep() {
                if (this.step < 4) {
                    this.step++;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    // Re-init lucide icons for newly visible elements
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
