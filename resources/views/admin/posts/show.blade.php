<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.posts.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Bài Viết</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Chi Tiết Bài Viết</span>
    </x-slot>

    <div x-data="{ activeTab: 'details' }" class="max-w-7xl mx-auto space-y-6 lg:space-y-8" x-cloak>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">Chi Tiết Bài Viết</h1>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 border border-green-200 gap-1 mt-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Đã đăng
                    </span>
                </div>
                <p class="text-sm font-medium text-slate-400">#POST-00125</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
                <button class="px-5 py-2 bg-orange-500 text-white font-semibold text-sm rounded-xl hover:bg-orange-600 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Chỉnh sửa
                </button>
                <button class="px-4 py-2 border border-red-200 text-red-600 font-semibold text-sm rounded-xl hover:bg-red-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Xóa
                </button>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-8 border-b border-slate-200">
            <button @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Thông tin chung
            </button>
            <button @click="activeTab = 'seo'" :class="activeTab === 'seo' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                SEO & Hiển thị
            </button>
            <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Lịch sử chỉnh sửa
            </button>
            <button @click="activeTab = 'notes'" :class="activeTab === 'notes' ? 'border-teal-600 text-teal-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 font-medium'" class="pb-3 border-b-2 transition-colors flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Ghi chú
            </button>
        </div>

        <!-- Tabs Content -->
        <div>
            <!-- TAB 1: Thông tin chung -->
            <div x-show="activeTab === 'details'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Thông tin bài viết & Nội dung -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin bài viết</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Tiêu đề</span>
                                <span class="text-[13px] font-bold text-slate-800 max-w-sm text-right">5 cách giúp thú cưng vượt qua mùa hè nắng nóng</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Danh mục</span>
                                <span class="inline-flex items-center text-[13px] font-medium text-teal-700">Chăm sóc</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Tác giả</span>
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-6 h-6 rounded-full" alt="Author">
                                    <span class="text-[13px] font-bold text-slate-800">Admin</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Ngày đăng</span>
                                <span class="text-[13px] font-medium text-slate-800">15/06/2024 10:30</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Trạng thái</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-green-100 text-green-700">Đã đăng</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Lượt xem</span>
                                <span class="text-[13px] font-medium text-slate-800">1,234</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Trạng thái bình luận</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-green-50 text-green-600 border border-green-200">Bật</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Bài viết nổi bật</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-[13px] font-bold text-slate-800">Có</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-[13px] text-slate-500">Mô tả ngắn</span>
                                <span class="text-[13px] font-medium text-slate-600 text-right max-w-sm leading-relaxed">Những mẹo đơn giản nhưng hiệu quả giúp thú cưng của bạn luôn mát mẻ và khỏe mạnh trong những ngày hè oi bức.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Nội dung bài viết -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Nội dung bài viết</h3>
                        
                        <div class="prose prose-sm max-w-none text-slate-600 leading-relaxed">
                            <img src="https://images.unsplash.com/photo-1537151625747-768eb6cf92b2?w=800&h=400&fit=crop" class="w-full h-auto rounded-xl mb-6" alt="Post Content Image">
                            
                            <p class="mb-4">Mùa hè có thể là thời điểm khó chịu đối với thú cưng. Nhiệt độ cao có thể khiến chúng bị mất nước, kiệt sức và thậm chí là sốc nhiệt.</p>
                            <p>Dưới đây là 5 cách đơn giản nhưng hiệu quả giúp thú cưng của bạn luôn mát mẻ, khỏe mạnh và vui vẻ suốt mùa hè:</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Ảnh & Hiển thị -->
                <div class="space-y-6">
                    <!-- Ảnh đại diện -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Ảnh đại diện</h3>
                        
                        <div class="space-y-3">
                            <div class="w-full aspect-video rounded-xl overflow-hidden border border-slate-200">
                                <img src="https://images.unsplash.com/photo-1537151625747-768eb6cf92b2?w=600&h=400&fit=crop" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <div class="aspect-square rounded-lg overflow-hidden border-2 border-teal-500 opacity-100 cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1537151625747-768eb6cf92b2?w=150&h=150&fit=crop" class="w-full h-full object-cover" alt="Thumb 1">
                                </div>
                                <div class="aspect-square rounded-lg overflow-hidden border border-slate-200 opacity-60 hover:opacity-100 cursor-pointer transition-opacity">
                                    <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=150&h=150&fit=crop" class="w-full h-full object-cover" alt="Thumb 2">
                                </div>
                                <div class="aspect-square rounded-lg overflow-hidden border border-slate-200 opacity-60 hover:opacity-100 cursor-pointer transition-opacity">
                                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=150&h=150&fit=crop" class="w-full h-full object-cover" alt="Thumb 3">
                                </div>
                                <div class="aspect-square rounded-lg border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 hover:text-teal-600 hover:border-teal-200 cursor-pointer transition-colors bg-slate-50 hover:bg-slate-50/50">
                                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    <span class="text-[10px] font-bold">Thêm ảnh</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin hiển thị -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-6">Thông tin hiển thị</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Hiển thị trên trang chủ</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-green-50 text-green-600 border border-green-200">Hiển thị</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                                <span class="text-[13px] text-slate-500">Thời gian hiển thị</span>
                                <span class="text-[13px] font-medium text-slate-800">15/06/2024 10:30</span>
                            </div>
                        </div>

                        <div>
                            <p class="text-[13px] text-slate-500 font-medium mb-3">Bài viết liên quan</p>
                            <div class="space-y-3">
                                <!-- Article 1 -->
                                <div class="flex items-center gap-3 group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1544568100-847a948585b9?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Related">
                                    <div>
                                        <p class="text-[12px] font-bold text-slate-800 group-hover:text-teal-600 transition-colors line-clamp-1">Dấu hiệu nhận biết thú cưng bị stress</p>
                                        <p class="text-[11px] text-slate-400">Chăm sóc</p>
                                    </div>
                                </div>
                                <!-- Article 2 -->
                                <div class="flex items-center gap-3 group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Related">
                                    <div>
                                        <p class="text-[12px] font-bold text-slate-800 group-hover:text-teal-600 transition-colors line-clamp-1">Cách tắm cho chó mèo đúng cách</p>
                                        <p class="text-[11px] text-slate-400">Chăm sóc</p>
                                    </div>
                                </div>
                                <!-- Article 3 -->
                                <div class="flex items-center gap-3 group cursor-pointer">
                                    <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=100&h=100&fit=crop" class="w-10 h-10 rounded-lg object-cover border border-slate-200" alt="Related">
                                    <div>
                                        <p class="text-[12px] font-bold text-slate-800 group-hover:text-teal-600 transition-colors line-clamp-1">Chế độ dinh dưỡng mùa hè cho thú cưng</p>
                                        <p class="text-[11px] text-slate-400">Dinh dưỡng</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: SEO & Hiển thị -->
            <div x-show="activeTab === 'seo'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Thông số SEO -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-base font-bold text-slate-800">Thông tin SEO</h3>
                            <button class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[12px] font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                                Chỉnh sửa
                            </button>
                        </div>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[13px] text-slate-500 mb-1.5">URL thân thiện</label>
                                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 flex items-center justify-between">
                                    <div class="flex items-center truncate">
                                        <span class="text-slate-400">petadoption.vn/bai-viet/</span>
                                        <span class="text-teal-700 font-bold truncate">5-cach-giup-thu-cung-vuot-qua-mua-he</span>
                                    </div>
                                    <button class="text-slate-400 hover:text-teal-600 ml-2" title="Sao chép">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-[13px] text-slate-500 mb-1.5">Mô tả SEO</label>
                                <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl text-[13px] leading-relaxed text-slate-700">
                                    Những mẹo đơn giản nhưng hiệu quả giúp thú cưng của bạn luôn mát mẻ và khỏe mạnh trong những ngày hè oi bức. Hãy cùng tìm hiểu 5 cách chăm sóc thú cưng vào mùa hè.
                                </div>
                            </div>

                            <div>
                                <label class="block text-[13px] text-slate-500 mb-2">Từ khóa (SEO)</label>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[12px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        thú cưng mùa hè
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[12px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        chăm sóc chó mèo
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[12px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        sức khỏe thú cưng
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[12px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        mẹo nuôi thú cưng
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Xem trước kết quả tìm kiếm -->
                <div class="space-y-6">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-base font-bold text-slate-800 mb-4">Xem trước kết quả tìm kiếm</h3>
                        
                        <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[13px] font-medium text-slate-800 line-clamp-1">Pet Adoption VN</span>
                                    <span class="text-[11px] text-slate-500 line-clamp-1">https://petadoption.vn › bai-viet › 5-cach-giup-thu-cun...</span>
                                </div>
                            </div>
                            <h4 class="text-[17px] text-[#1a0dab] font-medium mb-1 line-clamp-1 hover:underline cursor-pointer">5 cách giúp thú cưng vượt qua mùa hè nắng nóng</h4>
                            <p class="text-[13px] text-[#4d5156] line-clamp-2 leading-snug">Những mẹo đơn giản nhưng hiệu quả giúp thú cưng của bạn luôn mát mẻ và khỏe mạnh trong những ngày hè oi bức. Hãy cùng tìm hiểu 5 cách chăm sóc thú cưng...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: Lịch sử chỉnh sửa -->
            <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="divide-y divide-slate-100">
                        <!-- History Item 1 -->
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full shrink-0" alt="Avatar">
                                <div>
                                    <p class="text-[13px] font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-400">15/06/2024 16:45</p>
                                </div>
                            </div>
                            <div class="flex-1 sm:px-8">
                                <p class="text-[13px] font-bold text-slate-800 mb-0.5">Cập nhật bài viết</p>
                                <p class="text-[13px] font-medium text-slate-600">Cập nhật nội dung bài viết và thay đổi ảnh đại diện.</p>
                            </div>
                            <button class="shrink-0 px-4 py-2 border border-slate-200 text-teal-700 font-bold text-[12px] rounded-xl hover:bg-teal-50 hover:border-teal-200 transition-colors bg-white shadow-sm">
                                Xem chi tiết
                            </button>
                        </div>
                        
                        <!-- History Item 2 -->
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full shrink-0" alt="Avatar">
                                <div>
                                    <p class="text-[13px] font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-400">15/06/2024 11:20</p>
                                </div>
                            </div>
                            <div class="flex-1 sm:px-8">
                                <p class="text-[13px] font-bold text-slate-800 mb-0.5">Cập nhật bài viết</p>
                                <p class="text-[13px] font-medium text-slate-600">Thêm 2 ảnh vào nội dung bài viết.</p>
                            </div>
                            <button class="shrink-0 px-4 py-2 border border-slate-200 text-teal-700 font-bold text-[12px] rounded-xl hover:bg-teal-50 hover:border-teal-200 transition-colors bg-white shadow-sm">
                                Xem chi tiết
                            </button>
                        </div>

                        <!-- History Item 3 -->
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full shrink-0" alt="Avatar">
                                <div>
                                    <p class="text-[13px] font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-400">11/06/2024 10:30</p>
                                </div>
                            </div>
                            <div class="flex-1 sm:px-8">
                                <p class="text-[13px] font-bold text-slate-800 mb-0.5">Đăng bài viết</p>
                                <p class="text-[13px] font-medium text-slate-600">Bài viết được xuất bản.</p>
                            </div>
                            <button class="shrink-0 px-4 py-2 border border-slate-200 text-teal-700 font-bold text-[12px] rounded-xl hover:bg-teal-50 hover:border-teal-200 transition-colors bg-white shadow-sm">
                                Xem chi tiết
                            </button>
                        </div>

                        <!-- History Item 4 -->
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full shrink-0" alt="Avatar">
                                <div>
                                    <p class="text-[13px] font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-400">11/06/2024 10:10</p>
                                </div>
                            </div>
                            <div class="flex-1 sm:px-8">
                                <p class="text-[13px] font-bold text-slate-800 mb-0.5">Cập nhật bài viết</p>
                                <p class="text-[13px] font-medium text-slate-600">Chỉnh sửa tiêu đề và mô tả ngắn.</p>
                            </div>
                            <button class="shrink-0 px-4 py-2 border border-slate-200 text-teal-700 font-bold text-[12px] rounded-xl hover:bg-teal-50 hover:border-teal-200 transition-colors bg-white shadow-sm">
                                Xem chi tiết
                            </button>
                        </div>

                        <!-- History Item 5 -->
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full shrink-0" alt="Avatar">
                                <div>
                                    <p class="text-[13px] font-bold text-slate-900">Admin</p>
                                    <p class="text-[12px] font-medium text-slate-400">10/06/2024 14:30</p>
                                </div>
                            </div>
                            <div class="flex-1 sm:px-8">
                                <p class="text-[13px] font-bold text-slate-800 mb-0.5">Tạo bản nháp</p>
                                <p class="text-[13px] font-medium text-slate-600">Bài viết được tạo bản nháp.</p>
                            </div>
                            <button class="shrink-0 px-4 py-2 border border-slate-200 text-teal-700 font-bold text-[12px] rounded-xl hover:bg-teal-50 hover:border-teal-200 transition-colors bg-white shadow-sm">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: Ghi chú -->
            <div x-show="activeTab === 'notes'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Placeholder for Ghi chú content based on design style -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-base font-bold text-slate-800 mb-4 px-2">Danh sách ghi chú</h3>
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <p class="text-[13px] text-slate-500">Chưa có ghi chú nào cho bài viết này.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800 mb-4 px-2">Thêm ghi chú mới</h3>
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                        <div>
                            <textarea rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-[13px] font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-none" placeholder="Nhập nội dung ghi chú..."></textarea>
                            <p class="text-right text-[11px] text-slate-400 mt-1 font-medium">0/500</p>
                        </div>
                        <button class="w-full bg-teal-700 text-white font-bold text-sm rounded-xl py-3 hover:bg-teal-800 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Thêm ghi chú
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
