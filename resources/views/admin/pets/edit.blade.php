<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.pets.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Thú Cưng</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chỉnh sửa: {{ $pet->Ten }}</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6 pb-12">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Chỉnh sửa Thú Cưng</h2>
                <p class="text-sm text-slate-500">Cập nhật thông tin cho thú cưng {{ $pet->Ma_hien_thi }} - {{ $pet->Ten }}.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pets.show', $pet->Ma_thu_cung) }}" class="bg-white border border-slate-200 text-slate-700 px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-sm transition-all shadow-sm">
                    Hủy
                </a>
                <button type="submit" form="edit-pet-form" class="bg-teal-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Lưu Thay Đổi
                </button>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="edit-pet-form" action="{{ route('admin.pets.update', $pet->Ma_thu_cung) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- 1. Thông tin cơ bản -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Thông tin cơ bản</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tên thú cưng -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tên thú cưng <span class="text-red-500">*</span></label>
                        <input type="text" name="Ten" value="{{ old('Ten', $pet->Ten) }}" placeholder="Nhập tên thú cưng" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm @error('Ten') border-red-400 @enderror">
                    </div>
                    <!-- Loại -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Loại <span class="text-red-500">*</span></label>
                        <select name="Loai" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none @error('Loai') border-red-400 @enderror">
                            <option value="" disabled>Chọn loài thú cưng</option>
                            <option value="cho" {{ old('Loai', $pet->Loai) === 'cho' ? 'selected' : '' }}>Chó</option>
                            <option value="meo" {{ old('Loai', $pet->Loai) === 'meo' ? 'selected' : '' }}>Mèo</option>
                            <option value="khac" {{ old('Loai', $pet->Loai) === 'khac' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                    <!-- Màu lông -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Màu lông</label>
                        <input type="text" name="Mau_long" value="{{ old('Mau_long', $pet->Mau_long) }}" placeholder="VD: Vàng kem, Đen trắng..." class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm @error('Mau_long') border-red-400 @enderror">
                    </div>
                    <!-- Tính cách -->
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tính cách</label>
                        <input type="text" name="Tinh_cach" value="{{ old('Tinh_cach', $pet->Tinh_cach) }}" placeholder="Ví dụ: Thân thiện, Năng động, Hiền lành (Cách nhau bởi dấu phẩy)" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm @error('Tinh_cach') border-red-400 @enderror">
                    </div>
                    
                    <!-- Giới tính -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Giới tính <span class="text-red-500">*</span></label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="Gioi_tinh" value="duc" class="peer hidden" {{ old('Gioi_tinh', $pet->Gioi_tinh) === 'duc' ? 'checked' : '' }}>
                                <div class="w-full py-2.5 px-4 border border-blue-200 text-blue-500 bg-blue-50/30 rounded-xl text-center text-sm font-bold peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v4h-2zm0 6h2v2h-2z" transform="matrix(0 1 -1 0 24 0)"></path></svg>
                                    Đực
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="Gioi_tinh" value="cai" class="peer hidden" {{ old('Gioi_tinh', $pet->Gioi_tinh) === 'cai' ? 'checked' : '' }}>
                                <div class="w-full py-2.5 px-4 border border-rose-200 text-rose-500 bg-rose-50/30 rounded-xl text-center text-sm font-bold peer-checked:bg-rose-500 peer-checked:text-white peer-checked:border-rose-500 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v4h-2zm0 6h2v2h-2z"></path></svg>
                                    Cái
                                </div>
                            </label>
                        </div>
                    </div>
                    <!-- Ngày tiếp nhận -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Ngày tiếp nhận <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="date" name="Ngay_tiep_nhan" value="{{ old('Ngay_tiep_nhan', $pet->Ngay_tiep_nhan ? $pet->Ngay_tiep_nhan->format('Y-m-d') : date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 pr-10 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm @error('Ngay_tiep_nhan') border-red-400 @enderror">
                        </div>
                    </div>
                    <!-- Cân nặng -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Cân nặng</label>
                        <div class="relative flex items-center">
                            <input type="number" name="Can_nang" value="{{ old('Can_nang', $pet->Can_nang ? number_format($pet->Can_nang, 1) : '') }}" placeholder="Nhập cân nặng" step="0.1" min="0" class="w-full px-4 py-2.5 pr-10 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                            <div class="absolute right-3 text-sm font-bold text-slate-400">kg</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Hình ảnh -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Hình ảnh</h3>
                    <p class="text-[11px] text-slate-500 mt-1">Tải lên hình ảnh mới để thay thế ảnh hiện tại.</p>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-xs font-bold text-slate-700 mb-3">Ảnh đại diện <span class="text-red-500">*</span></h4>
                        <div class="flex flex-wrap gap-4">
                            <!-- Preview ảnh hiện tại (nếu có) -->
                            <div id="image-preview" class="w-40 h-40 rounded-2xl overflow-hidden relative group shadow-sm border border-slate-200">
                                <img id="preview-img" src="{{ $pet->Anh_dai_dien ?: $pet->anh_url }}" class="w-full h-full object-cover" alt="Preview">
                            </div>

                            <!-- Upload Zone (Cloudinary) -->
                            <label for="anh_upload" class="w-40 h-40 border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors flex flex-col items-center justify-center cursor-pointer group">
                                <svg class="w-8 h-8 text-slate-400 group-hover:text-teal-600 transition-colors mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <span class="text-xs font-medium text-slate-500 text-center">Đổi ảnh khác<br><span class="font-normal">Kéo thả hoặc</span></span>
                                <span class="mt-2 text-[11px] font-bold text-teal-700 bg-white border border-slate-200 px-3 py-1.5 rounded-lg shadow-sm">Chọn ảnh</span>
                                <input type="file" id="anh_upload" name="anh_upload" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewImage(this)">
                            </label>
                            
                            @error('anh_upload')
                                <p class="text-red-500 text-xs mt-1 w-full">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-700 mb-3">Thư viện ảnh phụ</h4>
                        <div class="flex flex-col gap-4">
                            <label for="thu_vien_anh_upload" class="w-full h-20 border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors flex flex-col items-center justify-center cursor-pointer group">
                                <span class="text-xs font-medium text-slate-500 text-center flex items-center gap-2">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-teal-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                                    Cập nhật thư viện ảnh phụ (Sẽ xóa ảnh cũ)
                                </span>
                                <input type="file" id="thu_vien_anh_upload" name="thu_vien_anh_upload[]" accept="image/jpeg,image/png,image/webp" multiple class="hidden" onchange="previewMultipleImages(this)">
                            </label>
                            
                            <div id="multiple-images-preview" class="flex flex-wrap gap-3 {{ empty($pet->Thu_vien_anh) ? 'empty:hidden' : '' }}">
                                @if(is_array($pet->Thu_vien_anh))
                                    @foreach($pet->Thu_vien_anh as $url)
                                        <div class="w-20 h-20 rounded-xl overflow-hidden shadow-sm border border-slate-200 relative group opacity-75">
                                            <img src="{{ $url }}" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @error('thu_vien_anh_upload.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Thông tin chi tiết -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Thông tin chi tiết</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Nhóm tuổi -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Nhóm tuổi <span class="text-red-500">*</span></label>
                        <select name="Nhom_tuoi" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none @error('Nhom_tuoi') border-red-400 @enderror">
                            <option value="" disabled>Chọn nhóm tuổi</option>
                            <option value="so_sinh" {{ old('Nhom_tuoi', $pet->Nhom_tuoi) === 'so_sinh' ? 'selected' : '' }}>Sơ sinh (< 3 tháng)</option>
                            <option value="nho" {{ old('Nhom_tuoi', $pet->Nhom_tuoi) === 'nho' ? 'selected' : '' }}>Nhỏ (3-12 tháng)</option>
                            <option value="truong_thanh" {{ old('Nhom_tuoi', $pet->Nhom_tuoi) === 'truong_thanh' ? 'selected' : '' }}>Trưởng thành (1-7 tuổi)</option>
                            <option value="gia" {{ old('Nhom_tuoi', $pet->Nhom_tuoi) === 'gia' ? 'selected' : '' }}>Già (> 7 tuổi)</option>
                        </select>
                    </div>
                    <!-- Tiêm phòng -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tiêm phòng</label>
                        <div class="flex items-center gap-3 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="Da_tiem_phong" value="1" {{ old('Da_tiem_phong', $pet->Da_tiem_phong) ? 'checked' : '' }} class="w-4 h-4 text-teal-600 rounded border-slate-300">
                                <span class="text-sm text-slate-700">Đã tiêm phòng</span>
                            </label>
                        </div>
                    </div>
                    <!-- Trạng thái -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Trạng thái <span class="text-red-500">*</span></label>
                        <select name="Trang_thai" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none @error('Trang_thai') border-red-400 @enderror">
                            <option value="san_sang" {{ old('Trang_thai', $pet->Trang_thai) === 'san_sang' ? 'selected' : '' }}>✅ Sẵn sàng nhận nuôi</option>
                            <option value="dang_cuu_ho" {{ old('Trang_thai', $pet->Trang_thai) === 'dang_cuu_ho' ? 'selected' : '' }}>🆘 Đang cứu hộ</option>
                            <option value="chua_san_sang" {{ old('Trang_thai', $pet->Trang_thai) === 'chua_san_sang' ? 'selected' : '' }}>⏳ Chưa sẵn sàng</option>
                            <option value="da_nhan_nuoi" {{ old('Trang_thai', $pet->Trang_thai) === 'da_nhan_nuoi' ? 'selected' : '' }}>🏠 Đã nhận nuôi</option>
                            <option value="da_mat" {{ old('Trang_thai', $pet->Trang_thai) === 'da_mat' ? 'selected' : '' }}>🕊️ Đã mất</option>
                        </select>
                        @if($pet->Trang_thai !== 'da_nhan_nuoi')
                            <p class="text-[10px] text-slate-500 mt-1">* Nếu đổi sang "Đã nhận nuôi", các đơn chờ duyệt sẽ tự động bị từ chối.</p>
                        @endif
                    </div>
                    
                    <!-- Đã triệt sản -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Đã triệt sản</label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="Da_triet_san" value="1" class="peer hidden" {{ old('Da_triet_san', $pet->Da_triet_san) == '1' ? 'checked' : '' }}>
                                <div class="w-full py-2.5 px-4 border border-slate-200 text-slate-600 bg-white rounded-xl text-center text-sm font-bold peer-checked:bg-teal-50 peer-checked:text-teal-700 peer-checked:border-teal-300 transition-all flex items-center justify-center gap-2 shadow-sm">
                                    Có
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="Da_triet_san" value="0" class="peer hidden" {{ old('Da_triet_san', $pet->Da_triet_san) == '0' ? 'checked' : '' }}>
                                <div class="w-full py-2.5 px-4 border border-slate-200 text-slate-600 bg-white rounded-xl text-center text-sm font-bold peer-checked:bg-teal-50 peer-checked:text-teal-700 peer-checked:border-teal-300 transition-all flex items-center justify-center gap-2 shadow-sm">
                                    Không
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Mô tả -->
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Mô tả</label>
                        <div class="relative">
                            <textarea rows="4" name="Mo_ta" placeholder="Nhập mô tả chi tiết về thú cưng..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm resize-none custom-scrollbar" maxlength="3000" oninput="updateCharCount(this, 'desc-count', 3000)">{{ old('Mo_ta', $pet->Mo_ta) }}</textarea>
                            <span id="desc-count" class="absolute bottom-3 right-3 text-[10px] font-medium text-slate-400">{{ strlen(old('Mo_ta', $pet->Mo_ta ?? '')) }}/3000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Vị trí & Thông tin bổ sung -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Vị trí & Thông tin bổ sung</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Vị trí hiện tại -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Vị trí hiện tại</label>
                        <select name="Vi_tri" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="">Chọn vị trí</option>
                            <option value="noi_tru" {{ old('Vi_tri', $pet->Vi_tri) === 'noi_tru' ? 'selected' : '' }}>Nội trú</option>
                            <option value="phong_kham" {{ old('Vi_tri', $pet->Vi_tri) === 'phong_kham' ? 'selected' : '' }}>Phòng khám</option>
                        </select>
                    </div>
                    <!-- Phí nhận nuôi -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Phí nhận nuôi (đ)</label>
                        <input type="number" name="Phi_nhan_nuoi" value="{{ old('Phi_nhan_nuoi', $pet->Phi_nhan_nuoi ? round($pet->Phi_nhan_nuoi) : '') }}" min="0" placeholder="0" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm">
                    </div>
                    <!-- Nổi bật -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Hiển thị nổi bật</label>
                        <label class="flex items-center gap-3 cursor-pointer mt-2">
                            <input type="checkbox" name="Noi_bat" value="1" {{ old('Noi_bat', $pet->Noi_bat) ? 'checked' : '' }} class="w-4 h-4 text-teal-600 rounded border-slate-300">
                            <span class="text-sm text-slate-700">Hiển thị trên trang chủ</span>
                        </label>
                    </div>
                    <!-- Người phụ trách -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Người phụ trách (Admin/Staff)</label>
                        <select name="Nguoi_phu_trach" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="">-- Không giao ai --</option>
                            @foreach($staffUsers as $user)
                                <option value="{{ $user->Ma_nguoi_dung }}" {{ old('Nguoi_phu_trach', $pet->Nguoi_phu_trach) == $user->Ma_nguoi_dung ? 'selected' : '' }}>
                                    {{ $user->Ho_ten }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- 5. Tính thân thiện -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Tính thân thiện & Chế độ ăn</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-3">Thân thiện với...</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="Than_thien_nguoi" value="1" {{ old('Than_thien_nguoi', $pet->Than_thien_nguoi) ? 'checked' : '' }} class="w-4 h-4 text-teal-600 rounded border-slate-300">
                                <span class="text-sm text-slate-700">👤 Người lớn & trẻ em</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="Than_thien_cho" value="1" {{ old('Than_thien_cho', $pet->Than_thien_cho) ? 'checked' : '' }} class="w-4 h-4 text-teal-600 rounded border-slate-300">
                                <span class="text-sm text-slate-700">🐕 Chó</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="Than_thien_meo" value="1" {{ old('Than_thien_meo', $pet->Than_thien_meo) ? 'checked' : '' }} class="w-4 h-4 text-teal-600 rounded border-slate-300">
                                <span class="text-sm text-slate-700">🐈 Mèo</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Chế độ ăn đặc biệt</label>
                        <textarea rows="2" name="Che_do_an_dac_biet" placeholder="Ví dụ: ăn mềm do vấn đề răng, dị ứng với gà..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm resize-none">{{ old('Che_do_an_dac_biet', $pet->Che_do_an_dac_biet) }}</textarea>
                    </div>

                    <!-- Thói quen -->
                    <div class="col-span-1 md:col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Thói quen</label>
                        <textarea rows="2" name="Thoi_quen" placeholder="VD: Đi vệ sinh đúng chỗ, ngủ nhiều..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm resize-none">{{ old('Thoi_quen', $pet->Thoi_quen) }}</textarea>
                    </div>
                    
                    <!-- Yêu thích -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Yêu thích / Sở thích</label>
                        <textarea rows="2" name="Yeu_thich" placeholder="VD: Thích chơi bóng, thích đi dạo..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm resize-none">{{ old('Yeu_thich', $pet->Yeu_thich) }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewMultipleImages(input) {
        const container = document.getElementById('multiple-images-preview');
        container.innerHTML = '';
        
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'w-20 h-20 rounded-xl overflow-hidden shadow-sm border border-slate-200 relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                    `;
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
