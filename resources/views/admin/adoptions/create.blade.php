<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.adoptions.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Đơn Nhận Nuôi</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-semibold">Thêm Đơn Mới</span>
    </x-slot>

    <div x-data="{ activeTab: 'details' }" class="max-w-7xl mx-auto space-y-6 lg:space-y-8 font-sans" x-cloak>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Thêm Đơn Nhận Nuôi Mới</h1>
                <p class="text-sm font-medium text-slate-500 mt-1">Tạo mới đơn yêu cầu nhận nuôi thú cưng</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.adoptions.index') }}" class="px-4 py-2 border border-slate-200 text-slate-600 font-medium text-sm rounded-[10px] hover:bg-slate-50 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
            </div>
        </div>

        <form action="{{ route('admin.adoptions.store') }}" method="POST" class="flex flex-col xl:flex-row gap-6 lg:gap-8 relative items-start">
            @csrf

            <!-- LEFT COLUMN (Tabs and Content) -->
            <div class="flex-1 space-y-6 min-w-0">
                
                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm font-medium border border-red-100">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Navigation Tabs -->
                <div class="flex flex-wrap items-center gap-6 border-b border-slate-200">
                    <button type="button" @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Thông tin chi tiết
                    </button>
                    <button type="button" @click="activeTab = 'survey'" :class="activeTab === 'survey' ? 'border-teal-600 text-teal-700 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Kết quả khảo sát
                    </button>
                </div>

                <!-- Tabs Content Container -->
                <div>
                    <!-- TAB 1: Thông tin chi tiết -->
                    <div x-show="activeTab === 'details'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">Đối tượng nhận nuôi</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Thú cưng <span class="text-red-500">*</span></label>
                                    <select id="pet-select" name="Ma_thu_cung" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800">
                                        <option value="">-- Chọn thú cưng --</option>
                                        @foreach($pets as $p)
                                            <option value="{{ $p->Ma_thu_cung }}" {{ old('Ma_thu_cung') == $p->Ma_thu_cung ? 'selected' : '' }}>
                                                {{ $p->Ten }} ({{ $p->Giong }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div x-data="{ userMode: '{{ old('user_mode', 'existing') }}' }">
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Tài khoản người dùng <span class="text-red-500">*</span></label>
                                    <div class="flex items-center gap-6 mb-3">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="user_mode" value="existing" x-model="userMode" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                            <span class="text-[13px] font-medium text-slate-700 group-hover:text-teal-700 transition-colors">Chọn có sẵn</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="user_mode" value="new" x-model="userMode" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                            <span class="text-[13px] font-medium text-slate-700 group-hover:text-teal-700 transition-colors">Tạo mới</span>
                                        </label>
                                    </div>

                                    <!-- Existing User Select -->
                                    <div x-show="userMode === 'existing'" x-transition>
                                        <select id="user-select" name="Ma_nguoi_dung" :required="userMode === 'existing'" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800">
                                            <option value="">-- Chọn người dùng --</option>
                                            @foreach($users as $u)
                                                <option value="{{ $u->Ma_nguoi_dung }}" {{ old('Ma_nguoi_dung') == $u->Ma_nguoi_dung ? 'selected' : '' }}>
                                                    {{ $u->Ho_ten }} ({{ $u->Email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- New User Fields -->
                                    <div x-show="userMode === 'new'" x-transition x-cloak class="grid grid-cols-1 gap-4 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                        <div>
                                            <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Email đăng nhập <span class="text-red-500">*</span></label>
                                            <input type="email" name="new_user_email" value="{{ old('new_user_email') }}" :required="userMode === 'new'" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-3 py-2 font-medium text-slate-800" placeholder="email@example.com">
                                        </div>
                                        <div x-data="{ showPassword: false }">
                                            <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Mật khẩu <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input :type="showPassword ? 'text' : 'password'" name="new_user_password" :required="userMode === 'new'" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-3 py-2 pr-10 font-medium text-slate-800" placeholder="Tối thiểu 6 ký tự">
                                                <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600 transition-colors focus:outline-none">
                                                    <!-- Eye icon -->
                                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    <!-- Eye off icon -->
                                                    <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-[11px] text-slate-500 mt-1">
                                            * Họ tên và SĐT sẽ tự động lấy từ "Thông tin liên hệ"
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin liên hệ -->
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">Thông tin liên hệ</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Họ và tên <span class="text-red-500">*</span></label>
                                    <input type="text" name="Ho_ten" value="{{ old('Ho_ten') }}" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Nhập họ và tên...">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Số điện thoại <span class="text-red-500">*</span></label>
                                    <input type="tel" name="So_dien_thoai" value="{{ old('So_dien_thoai') }}" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Nhập số điện thoại...">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Địa chỉ <span class="text-red-500">*</span></label>
                                    <input type="text" name="Dia_chi" value="{{ old('Dia_chi') }}" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Nhập địa chỉ đầy đủ...">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Nghề nghiệp</label>
                                    <input type="text" name="Nghe_nghiep" value="{{ old('Nghe_nghiep') }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Ví dụ: Nhân viên văn phòng">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Loại nhà ở</label>
                                    <select name="Loai_nha_o" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800">
                                        <option value="">-- Chọn loại nhà ở --</option>
                                        <option value="Chung cư" {{ old('Loai_nha_o') == 'Chung cư' ? 'selected' : '' }}>Chung cư</option>
                                        <option value="Nhà phố" {{ old('Loai_nha_o') == 'Nhà phố' ? 'selected' : '' }}>Nhà phố</option>
                                        <option value="Nhà trọ" {{ old('Loai_nha_o') == 'Nhà trọ' ? 'selected' : '' }}>Nhà trọ</option>
                                        <option value="Khác" {{ old('Loai_nha_o') == 'Khác' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 2: Khảo sát & Đánh giá -->
                    <div x-show="activeTab === 'survey'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-6">
                        
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">Kết quả khảo sát</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Kinh nghiệm chăm sóc thú cưng</label>
                                    <textarea name="Kinh_nghiem" rows="3" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-3 font-medium text-slate-800 resize-none" placeholder="Hãy mô tả kinh nghiệm (nếu có) của người nhận nuôi...">{{ old('Kinh_nghiem') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Lý do muốn nhận nuôi <span class="text-red-500">*</span></label>
                                    <textarea name="Ly_do_nhan_nuoi" required rows="4" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-3 font-medium text-slate-800 resize-none" placeholder="Vì sao họ lại muốn nhận nuôi thú cưng này?">{{ old('Ly_do_nhan_nuoi') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN (Actions) -->
            <div class="w-full xl:w-[320px] shrink-0 space-y-6">
                <!-- Action Box -->
                <div class="bg-white border border-slate-200 rounded-[10px] p-5 shadow-sm">
                    <h3 class="text-[13px] font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-100 pb-3">Thao tác tạo đơn</h3>
                    
                    <div class="space-y-4">
                        <!-- Trạng thái ẩn được set tự động trong Controller -->
                        
                        <div>
                            <label class="block text-[13px] font-medium text-slate-600 mb-2">Ghi chú (Nội bộ)</label>
                            <textarea name="Ghi_chu_admin" rows="3" class="w-full rounded-lg border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-3 py-2 font-medium text-slate-800 resize-none bg-slate-50" placeholder="Thêm ghi chú cho đơn này...">{{ old('Ghi_chu_admin') }}</textarea>
                        </div>

                        <div class="pt-4 border-t border-slate-100 space-y-2">
                            <button type="submit" class="w-full px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-medium text-sm rounded-[10px] transition-colors shadow-sm flex justify-center items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Lưu Đơn Nhận Nuôi
                            </button>
                            <a href="{{ route('admin.adoptions.index') }}" class="w-full block text-center px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-medium text-sm rounded-[10px] transition-colors">
                                Hủy bỏ
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(document.querySelector('#pet-select')){
                new TomSelect('#pet-select', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }
            
            if(document.querySelector('#user-select')){
                const userSelect = new TomSelect('#user-select', {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

                const usersData = @json($users->keyBy('Ma_nguoi_dung')->map(function($u) {
                    return [
                        'Ho_ten' => $u->Ho_ten,
                        'So_dien_thoai' => $u->So_dien_thoai
                    ];
                }));

                userSelect.on('change', function(value) {
                    if (value && usersData[value]) {
                        const nameInput = document.querySelector('input[name="Ho_ten"]');
                        const phoneInput = document.querySelector('input[name="So_dien_thoai"]');
                        
                        if(nameInput) nameInput.value = usersData[value].Ho_ten || '';
                        if(phoneInput) phoneInput.value = usersData[value].So_dien_thoai || '';
                    }
                });
            }
        });
    </script>
    <style>
        .ts-control {
            border-radius: 0.75rem !important; /* rounded-xl */
            border-color: #e2e8f0 !important;
            padding: 0.625rem 1rem !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            color: #1e293b !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            background-color: #fff !important;
        }
        .ts-control.focus {
            border-color: #14b8a6 !important;
            box-shadow: 0 0 0 1px #14b8a6 !important;
        }
        .ts-dropdown {
            border-radius: 0.75rem !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            font-size: 0.875rem !important;
            overflow: hidden;
            margin-top: 0.25rem !important;
        }
        .ts-dropdown .option {
            padding: 0.5rem 1rem !important;
        }
        .ts-dropdown .active {
            background-color: #f0fdfa !important;
            color: #0f766e !important;
        }
    </style>
    @endpush
</x-admin-layout>
