<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.pets.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Thú Cưng</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Thêm Thú Cưng</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6 pb-12">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Thêm Thú Cưng</h2>
                <p class="text-sm text-slate-500">Điền đầy đủ thông tin để thêm thú cưng mới vào hệ thống.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pets.index') }}" class="bg-white border border-slate-200 text-slate-700 px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-sm transition-all shadow-sm">
                    Hủy
                </a>
                <button type="submit" form="create-pet-form" class="bg-teal-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Lưu Thú Cưng
                </button>
            </div>
        </div>

        <form id="create-pet-form" class="space-y-6">
            <!-- 1. Thông tin cơ bản -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Thông tin cơ bản</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tên thú cưng -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tên thú cưng <span class="text-red-500">*</span></label>
                        <input type="text" placeholder="Nhập tên thú cưng" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                    </div>
                    <!-- Loại -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Loại <span class="text-red-500">*</span></label>
                        <select class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="" disabled selected>Chọn loài thú cưng</option>
                            <option value="dog">Chó</option>
                            <option value="cat">Mèo</option>
                        </select>
                    </div>
                    <!-- Giống loài -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Giống loài</label>
                        <input type="text" placeholder="Nhập giống loài" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                    </div>
                    
                    <!-- Giới tính -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Giới tính <span class="text-red-500">*</span></label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="gender" class="peer hidden" checked>
                                <div class="w-full py-2.5 px-4 border border-blue-200 text-blue-500 bg-blue-50/30 rounded-xl text-center text-sm font-bold peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v4h-2zm0 6h2v2h-2z" transform="matrix(0 1 -1 0 24 0)"></path></svg>
                                    Đực
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="gender" class="peer hidden">
                                <div class="w-full py-2.5 px-4 border border-rose-200 text-rose-500 bg-rose-50/30 rounded-xl text-center text-sm font-bold peer-checked:bg-rose-500 peer-checked:text-white peer-checked:border-rose-500 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v4h-2zm0 6h2v2h-2z"></path></svg>
                                    Cái
                                </div>
                            </label>
                        </div>
                    </div>
                    <!-- Ngày sinh / Tuổi -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Ngày sinh / Tuổi <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" placeholder="dd/mm/yyyy" class="w-full px-4 py-2.5 pr-10 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <!-- Cân nặng -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Cân nặng <span class="text-red-500">*</span></label>
                        <div class="relative flex items-center">
                            <input type="text" placeholder="Nhập cân nặng" class="w-full px-4 py-2.5 pr-10 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                            <div class="absolute right-3 text-sm font-bold text-slate-400">kg</div>
                        </div>
                    </div>

                    <!-- Màu lông -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Màu lông</label>
                        <input type="text" placeholder="Nhập màu lông" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                    </div>
                    <!-- Đặc điểm nổi bật -->
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Đặc điểm nổi bật</label>
                        <input type="text" placeholder="Nhập đặc điểm nổi bật (Ví dụ: thân thiện, năng động...)" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                    </div>
                </div>
            </div>

            <!-- 2. Hình ảnh -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Hình ảnh</h3>
                    <p class="text-[11px] text-slate-500 mt-1">Tải lên hình ảnh rõ nét để tăng cơ hội được nhận nuôi.</p>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap gap-4">
                        <!-- Upload Zone -->
                        <div class="w-40 h-40 border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors flex flex-col items-center justify-center cursor-pointer group">
                            <svg class="w-8 h-8 text-slate-400 group-hover:text-teal-600 transition-colors mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <span class="text-xs font-medium text-slate-500 text-center">Kéo thả ảnh vào đây<br><span class="font-normal">hoặc</span></span>
                            <span class="mt-2 text-[11px] font-bold text-teal-700 bg-white border border-slate-200 px-3 py-1.5 rounded-lg shadow-sm">Chọn ảnh</span>
                        </div>
                        
                        <!-- Dummy Image 1 -->
                        <div class="w-40 h-40 rounded-2xl overflow-hidden relative group shadow-sm border border-slate-200">
                            <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1" class="w-full h-full object-cover" alt="Pet">
                            <button class="absolute top-2 right-2 w-6 h-6 bg-black/50 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-500">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <!-- Dummy Image 2 -->
                        <div class="w-40 h-40 rounded-2xl overflow-hidden relative group shadow-sm border border-slate-200">
                            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba" class="w-full h-full object-cover" alt="Pet">
                            <button class="absolute top-2 right-2 w-6 h-6 bg-black/50 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-500">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <!-- Extra action button -->
                        <div class="w-40 h-40 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 hover:text-teal-600 hover:border-teal-300 transition-colors cursor-pointer">
                            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="text-xs font-medium">Thêm ảnh</span>
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
                    <!-- Tính cách -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tính cách</label>
                        <input type="text" placeholder="Nhập tính cách của thú cưng" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                    </div>
                    <!-- Tình trạng sức khỏe -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tình trạng sức khỏe</label>
                        <select class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="" disabled selected>Chọn tình trạng sức khỏe</option>
                            <option value="good">Tốt</option>
                            <option value="fair">Khá</option>
                            <option value="poor">Yếu</option>
                        </select>
                    </div>
                    <!-- Tiêm phòng -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Tiêm phòng</label>
                        <select class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="" disabled selected>Chọn tình trạng tiêm phòng</option>
                            <option value="fully">Đã tiêm đầy đủ</option>
                            <option value="partial">Chưa đủ mũi</option>
                            <option value="none">Chưa tiêm</option>
                        </select>
                    </div>
                    
                    <!-- Đã triệt sản -->
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Đã triệt sản</label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="spayed" class="peer hidden">
                                <div class="w-full py-2.5 px-4 border border-slate-200 text-slate-600 bg-white rounded-xl text-center text-sm font-bold peer-checked:bg-teal-50 peer-checked:text-teal-700 peer-checked:border-teal-300 transition-all flex items-center justify-center gap-2 shadow-sm">
                                    Có
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="spayed" class="peer hidden" checked>
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
                            <textarea rows="4" placeholder="Nhập mô tả chi tiết về thú cưng..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm resize-none custom-scrollbar"></textarea>
                            <span class="absolute bottom-3 right-3 text-[10px] font-medium text-slate-400">0/500</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Vị trí & Trạng thái -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Vị trí & Trạng thái</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Vị trí hiện tại -->
                    <div class="col-span-1 md:col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Vị trí hiện tại <span class="text-red-500">*</span></label>
                        <select class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="" disabled selected>Chọn vị trí</option>
                            <option value="hn">Hà Nội</option>
                            <option value="hcm">TP. Hồ Chí Minh</option>
                        </select>
                    </div>
                    
                    <!-- Trạng thái -->
                    <div class="col-span-1 md:col-span-3">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Trạng thái <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="status" class="peer hidden" checked>
                                <div class="py-2.5 px-4 border border-green-200 text-green-700 bg-green-50/50 rounded-xl text-sm font-bold peer-checked:bg-green-100 peer-checked:border-green-400 transition-all flex items-center gap-2 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Có sẵn
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="status" class="peer hidden">
                                <div class="py-2.5 px-4 border border-orange-200 text-orange-700 bg-orange-50/50 rounded-xl text-sm font-bold peer-checked:bg-orange-100 peer-checked:border-orange-400 transition-all flex items-center gap-2 shadow-sm opacity-60 peer-checked:opacity-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Đang chờ duyệt
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="status" class="peer hidden">
                                <div class="py-2.5 px-4 border border-blue-200 text-blue-700 bg-blue-50/50 rounded-xl text-sm font-bold peer-checked:bg-blue-100 peer-checked:border-blue-400 transition-all flex items-center gap-2 shadow-sm opacity-60 peer-checked:opacity-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Đã được nhận nuôi
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="status" class="peer hidden">
                                <div class="py-2.5 px-4 border border-red-200 text-red-700 bg-red-50/50 rounded-xl text-sm font-bold peer-checked:bg-red-100 peer-checked:border-red-400 transition-all flex items-center gap-2 shadow-sm opacity-60 peer-checked:opacity-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Không khả dụng
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Thông tin bổ sung -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800">Thông tin bổ sung</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Thẻ (Tag)</label>
                        <input type="text" placeholder="Nhập thẻ và nhấn Enter" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Nguồn</label>
                        <select class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 shadow-sm appearance-none">
                            <option value="" disabled selected>Chọn nguồn</option>
                            <option value="rescue">Trung tâm cứu hộ</option>
                            <option value="user">Người dùng tặng</option>
                        </select>
                    </div>
                    <div class="col-span-1 md:col-span-1">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Ghi chú</label>
                        <textarea rows="2" placeholder="Nhập ghi chú (nếu có)" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-700 placeholder-slate-400 transition-colors shadow-sm resize-none custom-scrollbar"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
