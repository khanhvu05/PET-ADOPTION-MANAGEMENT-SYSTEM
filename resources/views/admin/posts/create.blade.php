<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-1.5 text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Tổng Quan
            </a>
            <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('admin.posts.index') }}" class="hover:text-teal-600 transition-colors">
                Bài Viết
            </a>
            <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-orange-brand font-medium">Thêm Bài Viết</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6 lg:space-y-8" x-data="{ title: '', slug: '', activeStatus: 'published', publishMode: 'now' }">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Thêm Bài Viết</h2>
                <p class="text-sm text-slate-500 mt-1">Tạo bài viết mới để chia sẻ thông tin và lan tỏa yêu thương đến cộng đồng.</p>
            </div>
            
            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    Hủy bỏ
                </a>
                <button class="px-5 py-2.5 bg-teal-600 border border-transparent rounded-xl text-sm font-semibold text-white hover:bg-teal-700 transition-all shadow-sm shadow-teal-600/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Lưu bài viết
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Thông tin bài viết -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-[15px] font-bold text-slate-800">Thông tin bài viết</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Tiêu đề -->
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <label class="block text-sm font-bold text-slate-700">Tiêu đề <span class="text-red-500">*</span></label>
                            </div>
                            <div class="relative">
                                <input type="text" x-model="title" @input="slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '')" placeholder="Nhập tiêu đề bài viết hấp dẫn..." class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm placeholder-slate-400">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-[11px] font-medium text-slate-400" x-text="title.length + '/120'">0/120</span>
                                </div>
                            </div>
                        </div>

                        <!-- Danh mục -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Danh mục <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-500">
                                    <option value="" disabled selected>Chọn danh mục bài viết</option>
                                    <option value="1">Tin tức hoạt động</option>
                                    <option value="2">Kinh nghiệm chăm sóc</option>
                                    <option value="3">Câu chuyện cảm động</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Tóm tắt -->
                        <div x-data="{ excerpt: '' }">
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Tóm tắt</label>
                            <div class="relative">
                                <textarea x-model="excerpt" rows="3" placeholder="Nhập tóm tắt ngắn gọn về nội dung bài viết..." class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm placeholder-slate-400 resize-none"></textarea>
                                <div class="absolute bottom-3 right-3 pointer-events-none">
                                    <span class="text-[11px] font-medium text-slate-400" x-text="excerpt.length + '/250'">0/250</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nội dung bài viết -->
                        <div class="relative" x-data="{ initTinyMCE: false }">
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Nội dung bài viết <span class="text-red-500">*</span></label>
                            <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm bg-white" wire:ignore>
                                <textarea id="post-content" name="content" class="w-full h-[400px] border-none outline-none resize-none opacity-0" placeholder="Nhập nội dung chi tiết cho bài viết..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ảnh đại diện -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-[15px] font-bold text-slate-800">Ảnh đại diện</h3>
                        <p class="text-xs text-slate-500 mt-1">Ảnh này sẽ hiển thị trên trang danh sách bài viết</p>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Upload Zone -->
                        <div class="border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 flex flex-col items-center justify-center p-8 text-center hover:bg-slate-100 hover:border-teal-400 transition-all cursor-pointer group">
                            <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 group-hover:text-teal-500 group-hover:shadow transition-all mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700 mb-1">Kéo thả ảnh vào đây hoặc</p>
                            <button type="button" class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-colors shadow-sm mb-3">
                                Chọn ảnh
                            </button>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WEBP. Kích thước đề xuất: 1200x630px (tối đa 5MB)</p>
                        </div>
                        
                        <!-- Preview Box -->
                        <div>
                            <h4 class="text-xs font-bold text-slate-700 mb-2">Xem trước</h4>
                            <div class="border border-slate-100 bg-slate-50 rounded-xl p-3 flex gap-3 h-[120px]">
                                <div class="w-24 h-full bg-slate-200/70 rounded-lg flex items-center justify-center text-slate-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="flex flex-col gap-2 w-full pt-1">
                                    <div class="h-3 w-3/4 bg-slate-200 rounded-full"></div>
                                    <div class="h-2 w-full bg-slate-100 rounded-full"></div>
                                    <div class="h-2 w-5/6 bg-slate-100 rounded-full"></div>
                                    <div class="h-2 w-1/2 bg-slate-100 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Cài đặt hiển thị -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="text-[15px] font-bold text-slate-800">Cài đặt hiển thị</h3>
                        <button class="flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 text-[11px] font-semibold text-slate-600 rounded-lg hover:bg-slate-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Xem trước
                        </button>
                    </div>
                    
                    <div class="p-5 space-y-6">
                        <!-- Trạng thái -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Trạng thái <span class="text-red-500">*</span></label>
                            <div class="space-y-2">
                                <!-- Option 1 -->
                                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all" :class="activeStatus === 'published' ? 'border-teal-500 bg-teal-50/30' : 'border-slate-100 hover:border-slate-200 bg-white'">
                                    <input type="radio" name="status" value="published" x-model="activeStatus" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-600 hidden">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0" :class="activeStatus === 'published' ? 'bg-teal-100 text-teal-600' : 'bg-slate-100 text-slate-400'">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div class="flex flex-col ml-1">
                                        <span class="text-sm font-bold" :class="activeStatus === 'published' ? 'text-teal-900' : 'text-slate-700'">Đã đăng</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5">Bài viết sẽ được công khai</span>
                                    </div>
                                </label>
                                <!-- Option 2 -->
                                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all" :class="activeStatus === 'draft' ? 'border-orange-400 bg-orange-50/30' : 'border-slate-100 hover:border-slate-200 bg-white'">
                                    <input type="radio" name="status" value="draft" x-model="activeStatus" class="w-4 h-4 text-orange-500 border-slate-300 focus:ring-orange-500 hidden">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0" :class="activeStatus === 'draft' ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-400'">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="flex flex-col ml-1">
                                        <span class="text-sm font-bold" :class="activeStatus === 'draft' ? 'text-orange-900' : 'text-slate-700'">Bản nháp</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5">Chỉ bạn có thể xem</span>
                                    </div>
                                </label>
                                <!-- Option 3 -->
                                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all" :class="activeStatus === 'scheduled' ? 'border-indigo-400 bg-indigo-50/30' : 'border-slate-100 hover:border-slate-200 bg-white'">
                                    <input type="radio" name="status" value="scheduled" x-model="activeStatus" class="w-4 h-4 text-indigo-500 border-slate-300 focus:ring-indigo-500 hidden">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0" :class="activeStatus === 'scheduled' ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400'">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="flex flex-col ml-1">
                                        <span class="text-sm font-bold" :class="activeStatus === 'scheduled' ? 'text-indigo-900' : 'text-slate-700'">Đã lên lịch</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5">Bài viết sẽ tự động đăng vào thời gian đã chọn</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Thời gian đăng -->
                        <div class="border-t border-slate-100 pt-5">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Thời gian đăng</label>
                            <div class="space-y-3">
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="radio" name="publish_mode" value="now" x-model="publishMode" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-600">
                                    <span class="text-sm font-medium text-slate-700">Đăng ngay</span>
                                </label>
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="radio" name="publish_mode" value="schedule" x-model="publishMode" class="w-4 h-4 text-slate-400 border-slate-300 focus:ring-slate-400">
                                    <span class="text-sm font-medium text-slate-400">Đặt lịch đăng</span>
                                </label>
                                
                                <div class="grid grid-cols-2 gap-3 mt-3" :class="publishMode === 'now' ? 'opacity-50 pointer-events-none' : ''">
                                    <div class="relative">
                                        <input type="text" placeholder="16/06/2024" class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 shadow-sm text-slate-700">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <input type="text" placeholder="10:30" class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 shadow-sm text-slate-700">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO & Hiển thị -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-5 border-b border-slate-100">
                        <h3 class="text-[15px] font-bold text-slate-800">SEO & Hiển thị</h3>
                    </div>
                    
                    <div class="p-5 space-y-5" x-data="{ seoDesc: '' }">
                        <!-- URL Thân thiện -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">URL thân thiện</label>
                            <div class="flex items-stretch shadow-sm rounded-xl overflow-hidden border border-slate-200 focus-within:border-teal-500 focus-within:ring-1 focus-within:ring-teal-500 transition-colors">
                                <span class="flex items-center px-3 bg-slate-50 text-slate-500 text-xs border-r border-slate-200">
                                    petadoption.vn/bai-viet/
                                </span>
                                <input type="text" x-model="slug" placeholder="nhap-slug-bai-viet" class="w-full px-3 py-2.5 bg-white text-sm focus:outline-none text-slate-700">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1.5">URL chỉ chứa chữ thường, số và dấu gạch ngang.</p>
                        </div>

                        <!-- Mô tả SEO -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Mô tả SEO</label>
                            <div class="relative">
                                <textarea x-model="seoDesc" rows="3" placeholder="Nhập mô tả ngắn gọn cho SEO (tối đa 160 ký tự)..." class="w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm placeholder-slate-400 resize-none"></textarea>
                                <div class="absolute bottom-2.5 right-3 pointer-events-none">
                                    <span class="text-[11px] font-medium text-slate-400" x-text="seoDesc.length + '/160'">0/160</span>
                                </div>
                            </div>
                        </div>

                        <!-- Từ khóa -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1.5">Từ khóa (SEO)</label>
                            <input type="text" placeholder="Nhập từ khóa và nhấn Enter..." class="w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm placeholder-slate-400">
                            <p class="text-[10px] text-slate-400 mt-1.5">Nhập các từ khóa liên quan, tối đa 10 từ khóa.</p>
                        </div>
                    </div>
                </div>

                <!-- Tùy chọn khác -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-5 border-b border-slate-100">
                        <h3 class="text-[15px] font-bold text-slate-800">Tùy chọn khác</h3>
                    </div>
                    
                    <div class="p-5 space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" checked class="w-5 h-5 appearance-none border-2 border-slate-200 rounded-md checked:bg-teal-600 checked:border-teal-600 focus:ring-0 transition-colors cursor-pointer">
                                <svg class="w-3.5 h-3.5 text-white absolute pointer-events-none opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="opacity: 1;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Cho phép bình luận</span>
                        </label>
                        
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" class="w-5 h-5 appearance-none border-2 border-slate-200 rounded-md checked:bg-teal-600 checked:border-teal-600 focus:ring-0 transition-colors cursor-pointer">
                                <svg class="w-3.5 h-3.5 text-white absolute pointer-events-none opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Ghim bài viết</span>
                        </label>
                        
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" class="w-5 h-5 appearance-none border-2 border-slate-200 rounded-md checked:bg-teal-600 checked:border-teal-600 focus:ring-0 transition-colors cursor-pointer">
                                <svg class="w-3.5 h-3.5 text-white absolute pointer-events-none opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Hiển thị trên trang chủ</span>
                        </label>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <style>
        /* Add CSS for checkboxes inside this block */
        input[type="checkbox"]:checked + svg {
            opacity: 1 !important;
        }
    </style>
</x-admin-layout>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#post-content',
            height: 400,
            menubar: false,
            skin: 'oxide',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'blocks | ' +
            'bold italic underline strikethrough | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'link image media | removeformat | help',
            content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:14px; color: #334155; } p { margin-bottom: 0.5rem; }',
            placeholder: 'Nhập nội dung chi tiết cho bài viết...',
            branding: true,
            promotion: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    });
</script>
@endpush
