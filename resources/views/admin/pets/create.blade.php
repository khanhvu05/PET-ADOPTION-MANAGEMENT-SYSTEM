<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-sidebar-blue transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <a href="{{ route('admin.pets.index') }}" class="hover:text-sidebar-blue transition-colors text-slate-500">Thú Cưng</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <span class="text-slate-800 font-semibold">Thêm Thú Cưng</span>
    </x-slot>

    <div class="max-w-6xl mx-auto space-y-8 pb-16">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800 tracking-tight">Thêm Thú Cưng Mới</h2>
                <p class="text-sm text-slate-500 mt-1">Cung cấp chi tiết hồ sơ cho thú cưng đang chờ nhận nuôi.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pets.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    Hủy
                </a>
                <button type="submit" form="create-pet-form" class="px-5 py-2.5 text-sm font-medium text-white bg-sidebar-blue border border-transparent rounded-xl hover:opacity-90 transition-all shadow-[0_2px_8px_-2px_rgba(63,137,154,0.4)] flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Lưu Thú Cưng
                </button>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50/80 border border-red-100 rounded-2xl p-4 flex gap-3 items-start">
                <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="create-pet-form" action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            
            <!-- 1. Thông tin cơ bản -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10 border-b border-slate-200/60">
                <div class="lg:col-span-1">
                    <h3 class="text-base font-semibold text-slate-800">Thông tin cơ bản</h3>
                    <p class="text-[13.5px] text-slate-500 mt-2 leading-relaxed">Tên, giống loài và các đặc điểm nhận dạng chính. Thông tin này sẽ hiển thị nổi bật trên thẻ thú cưng.</p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Tên -->
                            <div class="sm:col-span-2">
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Tên thú cưng <span class="text-red-500">*</span></label>
                                <input type="text" name="Ten" value="{{ old('Ten') }}" placeholder="VD: Bò Sữa, Lu, Max..." class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 placeholder-slate-400 transition-all @error('Ten') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                            </div>
                            <!-- Loại -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Loài <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="Loai" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 appearance-none transition-all @error('Loai') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                        <option value="" disabled {{ old('Loai') ? '' : 'selected' }}>Chọn loài</option>
                                        <option value="cho" {{ old('Loai') === 'cho' ? 'selected' : '' }}>Chó</option>
                                        <option value="meo" {{ old('Loai') === 'meo' ? 'selected' : '' }}>Mèo</option>
                                        <option value="khac" {{ old('Loai') === 'khac' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                    <svg class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </div>
                            </div>
                            <!-- Giống loài -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Giống loài</label>
                                <input type="text" name="Giong" value="{{ old('Giong') }}" placeholder="VD: Corgi, Mèo mướp..." class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 placeholder-slate-400 transition-all">
                            </div>
                            <!-- Giới tính -->
                            <div class="sm:col-span-2">
                                <label class="block text-[13px] font-medium text-slate-700 mb-2">Giới tính <span class="text-red-500">*</span></label>
                                <div class="flex p-1 bg-slate-100/70 rounded-xl w-full sm:w-80">
                                    <label class="flex-1 text-center relative">
                                        <input type="radio" name="Gioi_tinh" value="duc" class="peer sr-only" {{ old('Gioi_tinh', 'duc') === 'duc' ? 'checked' : '' }}>
                                        <div class="py-2 text-sm font-medium text-slate-500 rounded-lg cursor-pointer transition-all peer-checked:bg-white peer-checked:text-sidebar-blue peer-checked:shadow-[0_1px_3px_rgba(0,0,0,0.05)] flex items-center justify-center gap-2">
                                            Đực
                                        </div>
                                    </label>
                                    <label class="flex-1 text-center relative">
                                        <input type="radio" name="Gioi_tinh" value="cai" class="peer sr-only" {{ old('Gioi_tinh') === 'cai' ? 'checked' : '' }}>
                                        <div class="py-2 text-sm font-medium text-slate-500 rounded-lg cursor-pointer transition-all peer-checked:bg-white peer-checked:text-rose-500 peer-checked:shadow-[0_1px_3px_rgba(0,0,0,0.05)] flex items-center justify-center gap-2">
                                            Cái
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Đặc điểm & Tình trạng -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10 border-b border-slate-200/60">
                <div class="lg:col-span-1">
                    <h3 class="text-base font-semibold text-slate-800">Đặc điểm & Tình trạng</h3>
                    <p class="text-[13.5px] text-slate-500 mt-2 leading-relaxed">Tuổi, cân nặng, tiêm phòng và trạng thái sức khỏe hiện tại.</p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Ngày sinh -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Ngày sinh / Tuổi <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="date" name="Ngay_tiep_nhan" value="{{ old('Ngay_tiep_nhan', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 transition-all @error('Ngay_tiep_nhan') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                </div>
                            </div>
                            <!-- Nhóm tuổi -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Nhóm tuổi <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="Nhom_tuoi" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 appearance-none transition-all @error('Nhom_tuoi') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                        <option value="" disabled {{ old('Nhom_tuoi') ? '' : 'selected' }}>Chọn nhóm</option>
                                        <option value="so_sinh" {{ old('Nhom_tuoi') === 'so_sinh' ? 'selected' : '' }}>Sơ sinh (< 3 tháng)</option>
                                        <option value="nho" {{ old('Nhom_tuoi') === 'nho' ? 'selected' : '' }}>Nhỏ (3-12 tháng)</option>
                                        <option value="truong_thanh" {{ old('Nhom_tuoi') === 'truong_thanh' ? 'selected' : '' }}>Trưởng thành (1-7 tuổi)</option>
                                        <option value="gia" {{ old('Nhom_tuoi') === 'gia' ? 'selected' : '' }}>Già (> 7 tuổi)</option>
                                    </select>
                                    <svg class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6-6-6"/></svg>
                                </div>
                            </div>
                            <!-- Cân nặng -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Cân nặng <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="number" name="Can_nang" value="{{ old('Can_nang') }}" placeholder="0.0" step="0.1" min="0" class="w-full px-4 py-2.5 pr-10 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 transition-all">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[13px] font-medium text-slate-400 pointer-events-none">kg</span>
                                </div>
                            </div>
                            <!-- Màu lông -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Màu lông</label>
                                <input type="text" name="Mau_long" value="{{ old('Mau_long') }}" placeholder="VD: Vàng kem, Tam thể..." class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 transition-all">
                            </div>
                            
                            <!-- Triệt sản -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-2">Đã triệt sản?</label>
                                <div class="flex p-1 bg-slate-100/70 rounded-xl w-full">
                                    <label class="flex-1 text-center relative">
                                        <input type="radio" name="Da_triet_san" value="1" class="peer sr-only" {{ old('Da_triet_san') == '1' ? 'checked' : '' }}>
                                        <div class="py-2 text-sm font-medium text-slate-500 rounded-lg cursor-pointer transition-all peer-checked:bg-white peer-checked:text-emerald-600 peer-checked:shadow-[0_1px_3px_rgba(0,0,0,0.05)] flex items-center justify-center gap-2">
                                            Có
                                        </div>
                                    </label>
                                    <label class="flex-1 text-center relative">
                                        <input type="radio" name="Da_triet_san" value="0" class="peer sr-only" {{ old('Da_triet_san', '0') == '0' ? 'checked' : '' }}>
                                        <div class="py-2 text-sm font-medium text-slate-500 rounded-lg cursor-pointer transition-all peer-checked:bg-white peer-checked:text-slate-800 peer-checked:shadow-[0_1px_3px_rgba(0,0,0,0.05)] flex items-center justify-center gap-2">
                                            Chưa
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Tiêm phòng -->
                            <div class="flex items-center">
                                <label class="flex items-center gap-3 cursor-pointer mt-5 p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors w-full">
                                    <input type="checkbox" name="Da_tiem_phong" value="1" {{ old('Da_tiem_phong') ? 'checked' : '' }} class="w-4 h-4 text-sidebar-blue bg-slate-50 border-slate-300 rounded focus:ring-sidebar-blue/30 focus:ring-offset-0">
                                    <span class="text-[13px] font-medium text-slate-700">Đã tiêm phòng đầy đủ</span>
                                </label>
                            </div>
                            
                            <!-- Trạng thái -->
                            <div class="sm:col-span-2">
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Trạng thái hiện tại <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="Trang_thai" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 appearance-none transition-all @error('Trang_thai') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                        <option value="san_sang" {{ old('Trang_thai', 'san_sang') === 'san_sang' ? 'selected' : '' }}>Sẵn sàng nhận nuôi</option>

                                        <option value="chua_san_sang" {{ old('Trang_thai') === 'chua_san_sang' ? 'selected' : '' }}>Chưa sẵn sàng</option>
                                    </select>
                                    <svg class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6-6-6"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Hình ảnh -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10 border-b border-slate-200/60">
                <div class="lg:col-span-1">
                    <h3 class="text-base font-semibold text-slate-800">Hình ảnh</h3>
                    <p class="text-[13.5px] text-slate-500 mt-2 leading-relaxed">Tải lên hình ảnh rõ nét, ánh sáng tốt để thu hút sự chú ý của người nhận nuôi.</p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 p-6 sm:p-8 space-y-8">
                        <div>
                            <h4 class="text-[13px] font-medium text-slate-700 mb-3">Ảnh đại diện chính <span class="text-red-500">*</span></h4>
                            <div class="flex flex-wrap items-end gap-5">
                                <!-- Preview & Upload Zone -->
                                <div class="relative w-36 h-36 shrink-0 group">
                                    <input type="file" id="anh_upload" name="anh_upload" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewImage(this)">
                                    <label for="anh_upload" id="upload-zone" class="absolute inset-0 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 bg-slate-50 rounded-2xl cursor-pointer hover:bg-slate-100 hover:border-sidebar-blue/50 transition-all z-10">
                                        <svg class="w-8 h-8 text-slate-400 mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                                        <span class="text-xs font-medium text-slate-500">Tải ảnh lên</span>
                                    </label>
                                    
                                    <div id="image-preview" class="hidden absolute inset-0 rounded-2xl overflow-hidden shadow-sm border border-slate-200 z-20">
                                        <img id="preview-img" src="" class="w-full h-full object-cover" alt="Preview">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                            <label for="anh_upload" class="p-2 bg-white/20 hover:bg-white text-white hover:text-slate-900 rounded-full cursor-pointer backdrop-blur-sm transition-colors">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                            </label>
                                            <button type="button" onclick="clearImage()" class="p-2 bg-white/20 hover:bg-red-500 text-white rounded-full cursor-pointer backdrop-blur-sm transition-colors">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-slate-500 leading-relaxed mb-2">Hỗ trợ định dạng JPG, PNG, WEBP. Kích thước tối đa 2MB. Ảnh vuông (1:1) sẽ hiển thị đẹp nhất.</p>
                                    @error('anh_upload')
                                        <p class="text-red-500 text-xs mt-1 w-full">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[13px] font-medium text-slate-700 mb-3">Thư viện ảnh phụ (Hiển thị chi tiết)</h4>
                            <div class="flex flex-col gap-4">
                                <label for="thu_vien_anh_upload" class="w-full py-6 border-2 border-dashed border-slate-200 bg-slate-50 rounded-2xl cursor-pointer hover:bg-slate-100 hover:border-sidebar-blue/50 transition-all flex flex-col items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-400 mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <span class="text-[13px] font-medium text-slate-600">Click để chọn nhiều ảnh phụ</span>
                                    <span class="text-xs text-slate-400 mt-1">Giúp hiển thị đa góc độ của thú cưng</span>
                                    <input type="file" id="thu_vien_anh_upload" name="thu_vien_anh_upload[]" accept="image/jpeg,image/png,image/webp" multiple class="hidden" onchange="previewMultipleImages(this)">
                                </label>
                                
                                <div id="multiple-images-preview" class="flex flex-wrap gap-3 empty:hidden mt-2">
                                </div>
                                @error('thu_vien_anh_upload.*')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Mô tả chi tiết & Tính cách -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10 border-b border-slate-200/60">
                <div class="lg:col-span-1">
                    <h3 class="text-base font-semibold text-slate-800">Tính cách & Mô tả</h3>
                    <p class="text-[13.5px] text-slate-500 mt-2 leading-relaxed">Chia sẻ tính cách, thói quen sinh hoạt và viết đoạn giới thiệu thu hút người nhận nuôi.</p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Tính cách -->
                            <div class="sm:col-span-2">
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Từ khóa tính cách</label>
                                <input type="text" name="Tinh_cach" value="{{ old('Tinh_cach') }}" placeholder="VD: Năng động, Quấn người, Hiền lành..." class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 placeholder-slate-400 transition-all">
                                <p class="text-xs text-slate-400 mt-1.5">Cách nhau bởi dấu phẩy.</p>
                            </div>
                            
                            <!-- Thân thiện -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-3">Thân thiện với</label>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" name="Than_thien_nguoi" value="1" {{ old('Than_thien_nguoi') ? 'checked' : '' }} class="w-4 h-4 text-sidebar-blue bg-slate-50 border-slate-300 rounded focus:ring-sidebar-blue/30 focus:ring-offset-0">
                                        <span class="text-[13px] text-slate-600 group-hover:text-slate-900 transition-colors">Người lớn & trẻ em</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" name="Than_thien_cho" value="1" {{ old('Than_thien_cho') ? 'checked' : '' }} class="w-4 h-4 text-sidebar-blue bg-slate-50 border-slate-300 rounded focus:ring-sidebar-blue/30 focus:ring-offset-0">
                                        <span class="text-[13px] text-slate-600 group-hover:text-slate-900 transition-colors">Chó khác</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" name="Than_thien_meo" value="1" {{ old('Than_thien_meo') ? 'checked' : '' }} class="w-4 h-4 text-sidebar-blue bg-slate-50 border-slate-300 rounded focus:ring-sidebar-blue/30 focus:ring-offset-0">
                                        <span class="text-[13px] text-slate-600 group-hover:text-slate-900 transition-colors">Mèo khác</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Sở thích / Thói quen -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Thói quen nổi bật</label>
                                    <input type="text" name="Thoi_quen" value="{{ old('Thoi_quen') }}" placeholder="VD: Ngủ ngày, Thích tắm nắng..." class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 placeholder-slate-400 transition-all">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Sở thích</label>
                                    <input type="text" name="Yeu_thich" value="{{ old('Yeu_thich') }}" placeholder="VD: Thích gãi bụng, Ăn pate..." class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 placeholder-slate-400 transition-all">
                                </div>
                            </div>

                            <!-- Mô tả -->
                            <div class="sm:col-span-2">
                                <div class="flex justify-between items-end mb-1.5">
                                    <label class="block text-[13px] font-medium text-slate-700">Đoạn văn mô tả chung</label>
                                    <span id="desc-count" class="text-[11px] font-medium text-slate-400">0/3000</span>
                                </div>
                                <textarea rows="5" name="Mo_ta" placeholder="Hãy kể một câu chuyện ngắn về hoàn cảnh cứu hộ hoặc điểm đáng yêu nhất của bé..." class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 placeholder-slate-400 transition-all resize-none custom-scrollbar leading-relaxed" maxlength="3000" oninput="updateCharCount(this, 'desc-count', 3000)">{{ old('Mo_ta') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Hành chính & Nội bộ -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <h3 class="text-base font-semibold text-slate-800">Thông vị trí nội bộ</h3>
                    <p class="text-[13.5px] text-slate-500 mt-2 leading-relaxed">Vị trí lưu trú, phí hỗ trợ nhận nuôi và phân công nhân viên quản lý hồ sơ này.</p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Vị trí -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Vị trí hiện tại</label>
                                <div class="relative">
                                    <select name="Vi_tri" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 appearance-none transition-all">
                                        <option value="">Chưa xác định</option>
                                        <option value="noi_tru" {{ old('Vi_tri') === 'noi_tru' ? 'selected' : '' }}>Trạm cứu hộ (Nội trú)</option>
                                        <option value="phong_kham" {{ old('Vi_tri') === 'phong_kham' ? 'selected' : '' }}>Phòng khám thú y</option>
                                    </select>
                                    <svg class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6-6-6"/></svg>
                                </div>
                            </div>
                            <!-- Phí -->
                            <div>
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Phí hỗ trợ nhận nuôi</label>
                                <div class="relative">
                                    <input type="number" name="Phi_nhan_nuoi" value="{{ old('Phi_nhan_nuoi', 0) }}" min="0" placeholder="0" class="w-full px-4 py-2.5 pr-10 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 transition-all">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[13px] font-medium text-slate-400 pointer-events-none">VNĐ</span>
                                </div>
                            </div>
                            <!-- Nổi bật -->
                            <div class="sm:col-span-2 p-4 bg-slate-50 rounded-xl border border-slate-100 flex items-start gap-3">
                                <div class="pt-0.5">
                                    <input type="checkbox" id="Noi_bat" name="Noi_bat" value="1" {{ old('Noi_bat') ? 'checked' : '' }} class="w-4 h-4 text-sidebar-blue bg-white border-slate-300 rounded focus:ring-sidebar-blue/30 focus:ring-offset-0 cursor-pointer">
                                </div>
                                <div>
                                    <label for="Noi_bat" class="block text-[13.5px] font-medium text-slate-800 cursor-pointer">Hiển thị nổi bật trên trang chủ</label>
                                    <p class="text-xs text-slate-500 mt-0.5">Đánh dấu nếu đây là trường hợp cần ưu tiên tìm chủ gấp.</p>
                                </div>
                            </div>
                            <!-- Nhân viên -->
                            <div class="sm:col-span-2 pt-2 border-t border-slate-100">
                                <label class="block text-[13px] font-medium text-slate-700 mb-1.5">Người phụ trách hồ sơ</label>
                                <div class="relative max-w-sm">
                                    <select name="Nguoi_phu_trach" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200/80 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-sidebar-blue/20 focus:border-sidebar-blue text-slate-800 appearance-none transition-all">
                                        <option value="">-- Không giao cụ thể --</option>
                                        @foreach($staffUsers as $user)
                                            <option value="{{ $user->Ma_nguoi_dung }}" {{ old('Nguoi_phu_trach') == $user->Ma_nguoi_dung ? 'selected' : '' }}>
                                                {{ $user->Ho_ten }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6-6-6"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-3 pt-6">
                <button type="submit" form="create-pet-form" class="px-6 py-2.5 text-sm font-medium text-white bg-sidebar-blue border border-transparent rounded-xl hover:opacity-90 transition-all shadow-[0_2px_8px_-2px_rgba(63,137,154,0.4)] flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Xác nhận Lưu
                </button>
            </div>
        </form>
    </div>

    <script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('upload-zone').classList.add('opacity-0');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearImage() {
        document.getElementById('anh_upload').value = '';
        document.getElementById('image-preview').classList.add('hidden');
        document.getElementById('upload-zone').classList.remove('opacity-0');
    }

    function previewMultipleImages(input) {
        const container = document.getElementById('multiple-images-preview');
        container.innerHTML = '';
        
        if (input.files) {
            Array.from(input.files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'w-16 h-16 rounded-xl overflow-hidden shadow-sm border border-slate-200';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function updateCharCount(textarea, countId, max) {
        document.getElementById(countId).textContent = textarea.value.length + '/' + max;
    }
    </script>
</x-admin-layout>
