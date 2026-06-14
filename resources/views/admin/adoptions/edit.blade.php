<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.adoptions.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Đơn Nhận Nuôi</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.adoptions.show', $application->Ma_don) }}" class="hover:text-teal-600 transition-colors text-slate-500">Chi Tiết</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-semibold">Chỉnh Sửa</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6 lg:space-y-8 font-sans">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Chỉnh Sửa Đơn Nhận Nuôi</h1>
                <p class="text-sm font-medium text-slate-500 mt-1">#{{ substr($application->Ma_don, 0, 8) }} - {{ $application->Ho_ten }}</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.adoptions.show', $application->Ma_don) }}" class="px-4 py-2 border border-slate-200 text-slate-600 font-medium text-sm rounded-[10px] hover:bg-slate-50 transition-colors flex items-center gap-2 active:scale-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
            </div>
        </div>

        <form action="{{ route('admin.adoptions.update', $application->Ma_don) }}" method="POST" class="flex flex-col xl:flex-row gap-6 lg:gap-8 relative items-start">
            @csrf
            @method('PUT')
            <input type="hidden" name="update_info" value="1">

            <!-- LEFT COLUMN (Content) -->
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

                <div class="space-y-6">
                        
                        <!-- Thông tin liên hệ -->
                        <div class="bg-white border border-slate-200 rounded-[10px] p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-slate-800 mb-6 border-b border-slate-100 pb-3">Thông tin liên hệ</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Họ và tên <span class="text-red-500">*</span></label>
                                    <input type="text" name="Ho_ten" value="{{ old('Ho_ten', $application->Ho_ten) }}" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Nhập họ và tên...">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Số điện thoại <span class="text-red-500">*</span></label>
                                    <input type="tel" name="So_dien_thoai" value="{{ old('So_dien_thoai', $application->So_dien_thoai) }}" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Nhập số điện thoại...">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Địa chỉ <span class="text-red-500">*</span></label>
                                    <input type="text" name="Dia_chi" value="{{ old('Dia_chi', $application->Dia_chi) }}" required class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Nhập địa chỉ đầy đủ...">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Nghề nghiệp</label>
                                    <input type="text" name="Nghe_nghiep" value="{{ old('Nghe_nghiep', $application->Nghe_nghiep) }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800" placeholder="Ví dụ: Nhân viên văn phòng">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-bold text-slate-600 mb-2">Loại nhà ở</label>
                                    <select name="Loai_nha_o" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800">
                                        <option value="">-- Chọn loại nhà ở --</option>
                                        <option value="Chung cư" {{ old('Loai_nha_o', $application->Loai_nha_o) == 'Chung cư' ? 'selected' : '' }}>Chung cư</option>
                                        <option value="Nhà phố" {{ old('Loai_nha_o', $application->Loai_nha_o) == 'Nhà phố' ? 'selected' : '' }}>Nhà phố</option>
                                        <option value="Nhà trọ" {{ old('Loai_nha_o', $application->Loai_nha_o) == 'Nhà trọ' ? 'selected' : '' }}>Nhà trọ</option>
                                        <option value="Khác" {{ old('Loai_nha_o', $application->Loai_nha_o) == 'Khác' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>

            </div>

            <!-- RIGHT COLUMN (Actions) -->
            <div class="w-full xl:w-[320px] shrink-0 space-y-6">
                <!-- Action Box -->
                <div class="bg-white border border-slate-200 rounded-[10px] p-5 shadow-sm">
                    <h3 class="text-[13px] font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-100 pb-3">Thao tác</h3>
                    
                    <div class="space-y-4">
                        <div class="pt-2 space-y-2">
                            <button type="submit" class="w-full px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-medium text-sm rounded-[10px] transition-colors shadow-sm flex justify-center items-center gap-2 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Cập Nhật Thông Tin
                            </button>
                            <a href="{{ route('admin.adoptions.show', $application->Ma_don) }}" class="w-full block text-center px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-medium text-sm rounded-[10px] transition-colors active:scale-95">
                                Hủy bỏ
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</x-admin-layout>
