<x-admin-layout>
    @php
        $isEdit = isset($campaign);
        $title = $isEdit ? 'Cập nhật chiến dịch' : 'Tạo mới chiến dịch';
        $action = $isEdit ? route('admin.donation_campaigns.update', $campaign->Ma_chien_dich) : route('admin.donation_campaigns.store');
    @endphp

    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.donation_campaigns.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Chiến dịch</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">{{ $title }}</span>
    </x-slot>

    <div class="mb-6 flex items-center gap-3">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $isEdit ? ($campaign->Tieu_de ?? 'Cập nhật chiến dịch') : 'Tạo chiến dịch mới' }}</h1>
        @if($isEdit)
            <span class="bg-emerald-100 text-emerald-700 text-[11px] font-bold px-2.5 py-1 rounded-md">Đang hoạt động</span>
        @endif
    </div>

    <div class="flex flex-col lg:flex-row gap-6 items-start">
        <!-- Cột Trái: Form nhập liệu -->
        <div class="flex-1 min-w-0 space-y-6">
            <form id="campaignForm" method="POST" action="{{ $action }}" class="space-y-6">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <!-- 1. Thông tin cơ bản -->
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">1. Thông tin cơ bản</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Tên chiến dịch -->
                        <div>
                            <x-input-label for="Tieu_de" value="Tên chiến dịch *" />
                            <x-text-input id="Tieu_de" class="block mt-1.5 w-full border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm" type="text" name="Tieu_de" value="{{ old('Tieu_de', $campaign->Tieu_de ?? '') }}" placeholder="Ví dụ: Cứu trợ Lucky bị viêm phổi nặng" required style="padding: 10px 16px;" />
                            <x-input-error :messages="$errors->get('Tieu_de')" class="mt-2" />
                        </div>

                        <!-- Thú cưng (Mockup) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label value="Thú cưng *" />
                                <div class="relative mt-1.5">
                                    <select class="block w-full border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm text-sm text-slate-700 h-11 appearance-none" style="padding: 10px 32px 10px 44px;">
                                        <option value="" disabled selected>-- Chọn thú cưng --</option>
                                        <option>Lucky - Golden Retriever (2 tuổi)</option>
                                        <option>Bông - Mèo ta (3 tháng)</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <div class="w-6 h-6 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 overflow-hidden shadow-sm">
                                            <svg class="w-3.5 h-3.5 mt-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Danh mục (Mockup) -->
                            <div>
                                <x-input-label value="Danh mục *" />
                                <div class="relative mt-1.5">
                                    <select class="block w-full border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm text-sm text-slate-700 h-11 appearance-none" style="padding: 10px 32px 10px 16px;">
                                        <option value="" disabled selected>-- Chọn danh mục --</option>
                                        <option>Chi phí y tế</option>
                                        <option>Thức ăn & Lưu chuồng</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mục tiêu gây quỹ -->
                        <div>
                            <x-input-label for="So_tien_muc_tieu" value="Mục tiêu gây quỹ *" />
                            <div class="relative mt-1.5 w-full md:w-1/2">
                                <x-text-input id="So_tien_muc_tieu" class="block w-full pr-12 font-bold text-slate-700 border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm h-11" type="number" name="So_tien_muc_tieu" value="{{ old('So_tien_muc_tieu', $campaign->So_tien_muc_tieu ?? '') }}" min="0" required style="padding: 10px 48px 10px 16px;" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500 font-bold">VNĐ</div>
                            </div>
                            <x-input-error :messages="$errors->get('So_tien_muc_tieu')" class="mt-2" />
                        </div>

                        <!-- Mô tả ngắn -->
                        <div>
                            <div class="flex justify-between items-end mb-1.5">
                                <x-input-label for="Mo_ta" value="Mô tả ngắn *" />
                                <span class="text-xs text-slate-400">0/200</span>
                            </div>
                            <textarea id="Mo_ta" name="Mo_ta" rows="3" class="block w-full border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm text-sm" required style="padding: 10px 16px;">{{ old('Mo_ta', $campaign->Mo_ta ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('Mo_ta')" class="mt-2" />
                        </div>

                        <!-- Mô tả chi tiết -->
                        <div>
                            <x-input-label value="Mô tả chi tiết *" class="mb-1.5" />
                            <textarea rows="6" class="block w-full border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm text-sm" style="padding: 10px 16px;" placeholder="Nhập mô tả chi tiết của chiến dịch...">Lucky được phát hiện mắc viêm phổi nặng và cần được điều trị gấp. Chi phí điều trị, thuốc men và chăm sóc hậu phẫu dự kiến khoảng 50.000.000đ.

Chúng tôi rất mong nhận được sự chung tay giúp đỡ từ cộng đồng để Lucky sớm khỏe mạnh và tìm được một mái ấm yêu thương.</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. Hình ảnh -->
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">2. Hình ảnh</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <x-input-label for="Anh_dai_dien" value="Ảnh đại diện *" class="mb-1.5" />
                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="rounded-xl border border-slate-200 overflow-hidden relative group" style="width: 200px; height: 140px;">
                                    <img src="{{ old('Anh_dai_dien', $campaign->Anh_dai_dien ?? 'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&q=80') }}" class="w-full h-full object-cover">
                                    <div class="absolute top-2 left-2 bg-orange-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md">Ảnh đại diện</div>
                                </div>
                                <button type="button" class="rounded-xl border border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 hover:bg-slate-50 hover:border-teal-500 hover:text-teal-600 transition-colors" style="width: 120px; height: 140px;">
                                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    <span class="text-xs font-medium">Thêm ảnh</span>
                                </button>
                            </div>
                            <!-- Hidden input for real logic if needed, but for mockup we use text -->
                            <x-text-input id="Anh_dai_dien" class="mt-3 w-full border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm text-sm" type="url" name="Anh_dai_dien" value="{{ old('Anh_dai_dien', $campaign->Anh_dai_dien ?? '') }}" placeholder="URL Ảnh đại diện..." style="padding: 10px 16px;" />
                        </div>

                        <div>
                            <x-input-label value="Thư viện ảnh" class="mb-1.5" />
                            <div class="flex flex-wrap gap-3">
                                @for($i = 1; $i <= 4; $i++)
                                <div class="rounded-xl border border-slate-200 overflow-hidden relative group" style="width: 80px; height: 80px;">
                                    <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&q=80&w=150" class="w-full h-full object-cover">
                                    <button type="button" class="absolute top-1 right-1 w-5 h-5 bg-white/90 rounded-full flex items-center justify-center text-slate-600 hover:text-red-500 shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                @endfor
                                <button type="button" class="rounded-xl border border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 hover:bg-slate-50 hover:border-teal-500 hover:text-teal-600 transition-colors" style="width: 80px; height: 80px;">
                                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    <span class="text-[10px] font-medium">Thêm ảnh</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Thời gian -->
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">3. Thời gian</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="Ngay_bat_dau" value="Ngày bắt đầu *" />
                                <x-text-input id="Ngay_bat_dau" class="block mt-1.5 w-full border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm h-11" type="date" name="Ngay_bat_dau" value="{{ old('Ngay_bat_dau', isset($campaign) ? \Carbon\Carbon::parse($campaign->Ngay_bat_dau)->format('Y-m-d') : date('Y-m-d')) }}" required style="padding: 10px 16px;" />
                                <x-input-error :messages="$errors->get('Ngay_bat_dau')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="Ngay_ket_thuc" value="Ngày kết thúc *" />
                                <x-text-input id="Ngay_ket_thuc" class="block mt-1.5 w-full border-slate-200 rounded-xl focus:border-teal-500 focus:ring-teal-500 shadow-sm h-11" type="date" name="Ngay_ket_thuc" value="{{ old('Ngay_ket_thuc', isset($campaign) && $campaign->Ngay_ket_thuc ? \Carbon\Carbon::parse($campaign->Ngay_ket_thuc)->format('Y-m-d') : '') }}" style="padding: 10px 16px;" />
                                <span class="text-xs text-slate-400 mt-1.5 block">Chiến dịch sẽ tự động kết thúc vào 23:59 của ngày này.</span>
                                <x-input-error :messages="$errors->get('Ngay_ket_thuc')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Cài đặt nâng cao -->
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">4. Cài đặt nâng cao</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Toggle 1 -->
                            <div class="flex items-start gap-3" x-data="{ public: true }">
                                <button type="button" @click="public = !public" :style="(public ? 'background-color: #f97316;' : 'background-color: #cbd5e1;') + ' width: 40px; height: 24px;'" class="rounded-full relative shrink-0 transition-colors">
                                    <div class="rounded-full absolute shadow-sm" :style="(public ? 'transform: translateX(16px);' : 'transform: translateX(0);') + ' background-color: white; width: 16px; height: 16px; top: 4px; left: 4px; transition: transform 0.2s;'"></div>
                                </button>
                                <div class="cursor-pointer" @click="public = !public">
                                    <p class="text-sm font-bold text-slate-800">Hiển thị công khai *</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Cho phép hiển thị chiến dịch trên trang gây quỹ</p>
                                </div>
                            </div>
                            <!-- Toggle 2 -->
                            <div class="flex items-start gap-3" x-data="{ anonymous: true }">
                                <button type="button" @click="anonymous = !anonymous" :style="(anonymous ? 'background-color: #0d9488;' : 'background-color: #cbd5e1;') + ' width: 40px; height: 24px;'" class="rounded-full relative shrink-0 transition-colors">
                                    <div class="rounded-full absolute shadow-sm" :style="(anonymous ? 'transform: translateX(16px);' : 'transform: translateX(0);') + ' background-color: white; width: 16px; height: 16px; top: 4px; left: 4px; transition: transform 0.2s;'"></div>
                                </button>
                                <div class="cursor-pointer" @click="anonymous = !anonymous">
                                    <p class="text-sm font-bold text-slate-800">Cho phép đóng góp ẩn danh</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Donor có thể chọn ẩn danh khi ủng hộ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-4 pt-2">
                    <a href="{{ route('admin.donation_campaigns.index') }}" style="flex: 1;" class="flex justify-center items-center h-12 bg-white border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition-colors shadow-sm">
                        Hủy
                    </a>
                    <button type="submit" style="flex: 2;" class="flex justify-center items-center h-12 bg-orange-brand text-white rounded-xl font-bold hover:bg-orange-600 transition-colors shadow-sm">
                        Lưu chiến dịch
                    </button>
                </div>
            </form>
        </div>

        <!-- Cột Phải: Preview & Thống kê -->
        <div class="w-full shrink-0 space-y-6 lg:sticky lg:top-6" style="max-width: 400px;">
            <!-- Card Preview -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <!-- Toggle Preview -->
                <div class="p-3 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                    <span class="text-xs font-bold text-slate-600 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Xem trước chiến dịch
                    </span>
                    <button class="text-slate-400 hover:text-teal-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                </div>
                
                <div class="p-5">
                    <div class="w-full bg-slate-100 rounded-xl overflow-hidden mb-4 relative" style="height: 180px;">
                        <img src="{{ old('Anh_dai_dien', $campaign->Anh_dai_dien ?? 'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&q=80&w=600') }}" class="w-full h-full object-cover">
                        <span class="absolute top-2 left-2 bg-teal-600 text-white text-[10px] font-bold px-2 py-1 rounded-lg shadow-sm">Đang hoạt động</span>
                    </div>
                    
                    <h4 class="text-lg font-black text-slate-800 leading-tight mb-2">Cứu trợ Lucky bị viêm phổi nặng</h4>
                    <p class="text-sm text-slate-500 mb-6 line-clamp-2">Giúp Lucky có cơ hội điều trị và khỏe mạnh trở lại.</p>

                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="text-lg font-black text-slate-800 block leading-none mb-1">32.450.000đ</span>
                            <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wide">đã gây quỹ</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-slate-800 block leading-none mb-1">50.000.000đ</span>
                            <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wide">mục tiêu</span>
                        </div>
                    </div>

                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden mb-2">
                        <div class="h-full bg-teal-600 rounded-full" style="width: 64.9%"></div>
                    </div>
                    <div class="text-right text-xs font-bold text-teal-700 mb-6">64.9%</div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 mb-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-800 flex items-center gap-1.5"><svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> 128</span>
                            <span class="text-[11px] text-slate-500 mt-0.5">Lượt ủng hộ</span>
                        </div>
                        <div class="flex flex-col text-right">
                            <span class="text-sm font-bold text-slate-800 flex items-center justify-end gap-1.5"><svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 10/06/2026</span>
                            <span class="text-[11px] text-slate-500 mt-0.5">Ngày kết thúc</span>
                        </div>
                    </div>

                    <button type="button" class="w-full h-11 bg-orange-brand text-white rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-orange-600 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        Chia sẻ chiến dịch
                    </button>
                </div>
            </div>

            <!-- Card Gợi ý -->
            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-5">
                <h4 class="font-bold text-emerald-800 mb-3 flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Gợi ý để chiến dịch hiệu quả hơn
                </h4>
                <ul class="space-y-2.5">
                    <li class="flex items-start gap-2 text-[13px] text-emerald-700">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sử dụng hình ảnh rõ nét, cảm xúc
                    </li>
                    <li class="flex items-start gap-2 text-[13px] text-emerald-700">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Mô tả chi tiết và minh bạch mục đích
                    </li>
                    <li class="flex items-start gap-2 text-[13px] text-emerald-700/60">
                        <div class="w-4 h-4 rounded border border-emerald-300 shrink-0 mt-0.5 bg-white"></div>
                        Đặt mục tiêu hợp lý và khả thi
                    </li>
                    <li class="flex items-start gap-2 text-[13px] text-emerald-700/60">
                        <div class="w-4 h-4 rounded border border-emerald-300 shrink-0 mt-0.5 bg-white"></div>
                        Cập nhật tiến trình thường xuyên
                    </li>
                </ul>
            </div>

            <!-- Card Thống kê nhanh (If Edit) -->
            @if($isEdit)
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5">
                <h4 class="font-bold text-slate-800 mb-4 text-sm">Thống kê nhanh</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <div class="w-7 h-7 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            Lượt truy cập
                        </div>
                        <span class="font-bold text-slate-800">1.842</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <div class="w-7 h-7 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </div>
                            Lượt chia sẻ
                        </div>
                        <span class="font-bold text-slate-800">236</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <div class="w-7 h-7 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            Lượt quyên góp
                        </div>
                        <span class="font-bold text-slate-800">128</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <div class="w-7 h-7 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            Số tiền trung bình/lượt
                        </div>
                        <span class="font-bold text-slate-800">253.516đ</span>
                    </div>
                </div>
            </div>
            
            <!-- Card History -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5">
                <h4 class="font-bold text-slate-800 mb-5 text-sm">Lịch sử hoạt động</h4>
                <div class="relative pl-4 space-y-6">
                    <!-- Line -->
                    <div class="absolute left-[7px] top-2 bottom-2 w-px bg-slate-200"></div>
                    
                    <div class="relative">
                        <div class="absolute -left-5 top-1 w-3 h-3 bg-white border-2 border-teal-500 rounded-full z-10"></div>
                        <p class="text-xs font-bold text-slate-500 mb-0.5">10/05/2026 09:15</p>
                        <p class="text-sm font-bold text-slate-800">Tạo chiến dịch</p>
                        <p class="text-xs text-slate-500 mt-1">Nguyễn Thị Mai</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-5 top-1 w-3 h-3 bg-white border-2 border-slate-300 rounded-full z-10"></div>
                        <p class="text-xs font-bold text-slate-500 mb-0.5">10/05/2026 09:30</p>
                        <p class="text-sm font-bold text-slate-800">Cập nhật thông tin chiến dịch</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-5 top-1 w-4 h-4 bg-teal-50 -ml-0.5 border border-teal-200 text-teal-600 rounded-full z-10 flex items-center justify-center">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-slate-500 mb-0.5">10/05/2026 10:00</p>
                        <p class="text-sm font-bold text-slate-800">Đăng chiến dịch</p>
                        <p class="text-xs text-slate-500 mt-1">Chiến dịch đã được công khai</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
