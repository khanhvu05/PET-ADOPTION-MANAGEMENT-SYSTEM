<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        @if(request('from') === 'pet')
            <a href="{{ route('admin.pets.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Thú Cưng</a>
            <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('admin.pets.show', request('pet_id', 1)) }}" class="hover:text-teal-600 transition-colors text-slate-500">Chi Tiết Thú Cưng</a>
        @else
            <a href="{{ route('admin.adoptions.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Đơn Nhận Nuôi</a>
        @endif
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-orange-brand font-bold">Thêm Đơn Mới</span>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6 lg:space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">Thêm Đơn Nhận Nuôi Mới</h1>
                <p class="text-sm text-slate-500 mt-1">Tạo mới đơn yêu cầu nhận nuôi thú cưng</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.adoptions.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-xl hover:bg-slate-50 transition-colors flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại
                </a>
                <button class="px-5 py-2 bg-teal-700 text-white font-bold text-sm rounded-xl hover:bg-teal-800 transition-colors shadow-sm shadow-teal-700/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Lưu Đơn
                </button>
            </div>
        </div>

        <form action="#" method="POST" class="space-y-6">
            <!-- 1. Thông tin thú cưng -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">1</div>
                    <h3 class="text-base font-bold text-slate-800">Thông tin thú cưng</h3>
                </div>
                
                <div>
                    <label class="block text-[13px] font-medium text-slate-600 mb-2">Chọn thú cưng <span class="text-slate-400">*</span></label>
                    
                    <!-- Custom Select using Alpine -->
                    <div x-data="{ open: false, selected: true }" class="relative">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 flex items-center justify-between focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                    <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1" class="w-full h-full object-cover" alt="Lucky">
                                </div>
                                <div class="text-left">
                                    <h4 class="text-sm font-bold text-slate-900 mb-1">Lucky</h4>
                                    <div class="flex items-center flex-wrap gap-2 text-xs text-slate-500">
                                        <span>#PET-001</span>
                                        <span>&bull;</span>
                                        <span>Golden Retriever</span>
                                        <span>&bull;</span>
                                        <span>2 tuổi 3 tháng</span>
                                        <span class="bg-green-50 text-green-600 font-bold px-2 py-0.5 rounded-full border border-green-100">Có sẵn</span>
                                    </div>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 shrink-0 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Dropdown Options (Hidden by default) -->
                        <div x-show="open" x-transition class="absolute z-10 w-full mt-2 bg-white border border-slate-200 rounded-xl shadow-lg max-h-60 overflow-y-auto hidden">
                            <!-- Options would go here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Thông tin người nhận nuôi -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">2</div>
                    <h3 class="text-base font-bold text-slate-800">Thông tin người nhận nuôi</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-8">
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Họ và tên <span class="text-slate-400">*</span></label>
                        <input type="text" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="Trần Quang Huy">
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Email <span class="text-slate-400">*</span></label>
                        <input type="email" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="quanghuy@gmail.com">
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Số điện thoại <span class="text-slate-400">*</span></label>
                        <input type="tel" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="0932 345 678">
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Ngày sinh</label>
                        <div class="relative">
                            <input type="text" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="14/06/1994">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Giới tính</label>
                        <select class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-500">
                            <option value="" disabled selected>Nam</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">CMND/CCCD <span class="text-slate-400">*</span></label>
                        <input type="text" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="123456789012">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Địa chỉ <span class="text-slate-400">*</span></label>
                        <input type="text" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="123 Nguyễn Văn Cừ, Quận 5, TP. Hồ Chí Minh">
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Nghề nghiệp</label>
                        <input type="text" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-800 placeholder-slate-400" placeholder="Nhân viên văn phòng">
                    </div>
                </div>
            </div>

            <!-- 3. Thông tin bổ sung -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">3</div>
                    <h3 class="text-base font-bold text-slate-800">Thông tin bổ sung</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Bạn đã biết đến chúng tôi từ đâu?</label>
                        <select class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-500">
                            <option value="" disabled selected>Facebook</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Tiktok">Tiktok</option>
                            <option value="Bạn bè">Bạn bè giới thiệu</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-3">Bạn đã từng nuôi thú cưng trước đây chưa?</label>
                        <div class="flex items-center gap-8 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="had_pet" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                <span class="text-sm font-medium text-slate-700 group-hover:text-teal-700 transition-colors">Có</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="had_pet" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                <span class="text-sm font-medium text-slate-700 group-hover:text-teal-700 transition-colors">Chưa</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Vì sao bạn muốn nhận nuôi?</label>
                        <div class="relative">
                            <textarea rows="3" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-3 font-medium text-slate-800 placeholder-slate-400 resize-none" placeholder="Tôi yêu động vật và mong muốn có một người bạn đồng hành."></textarea>
                            <span class="absolute bottom-3 right-4 text-xs font-bold text-slate-400">0/500</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-3">Bạn có sẵn sàng chi trả cho các chi phí chăm sóc thú cưng không?</label>
                        <div class="flex items-center gap-8 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="can_pay" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                <span class="text-sm font-medium text-slate-700 group-hover:text-teal-700 transition-colors">Có, tôi sẵn sàng</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="can_pay" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                <span class="text-sm font-medium text-slate-700 group-hover:text-teal-700 transition-colors">Không</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Bạn có nhà riêng hay ở chung cư?</label>
                        <select class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-500">
                            <option value="" disabled selected>Chung cư</option>
                            <option value="Chung cư">Chung cư</option>
                            <option value="Nhà phố">Nhà phố</option>
                            <option value="Nhà trọ">Nhà trọ</option>
                        </select>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-[13px] font-medium text-slate-600 mb-2">Bạn có thời gian chăm sóc thú cưng mỗi ngày?</label>
                        <select class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2.5 font-medium text-slate-500">
                            <option value="" disabled selected>2 - 4 giờ</option>
                            <option value="2-4 giờ">2 - 4 giờ</option>
                            <option value="1-2 giờ">1 - 2 giờ</option>
                            <option value="Dưới 1 giờ">Dưới 1 giờ</option>
                            <option value="Trên 4 giờ">Trên 4 giờ</option>
                        </select>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="relative">
                            <textarea rows="2" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-3 font-medium text-slate-800 placeholder-slate-400 resize-none" placeholder="Tôi sẽ sắp xếp thời gian làm việc tại nhà để chăm sóc bé."></textarea>
                            <span class="absolute bottom-3 right-4 text-xs font-bold text-slate-400">0/500</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Tài liệu đính kèm -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">4</div>
                    <h3 class="text-base font-bold text-slate-800">Tài liệu đính kèm <span class="text-slate-400 font-medium">(tùy chọn)</span></h3>
                </div>
                <p class="text-sm font-medium text-slate-500 pl-9 mb-6">Bạn có thể tải lên các tài liệu để tăng khả năng duyệt.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Uploaded File 1 -->
                    <div class="border border-slate-200 rounded-xl p-3 flex items-start gap-3 bg-slate-50 relative group">
                        <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1" class="w-full h-full object-cover opacity-50" alt="Doc">
                        </div>
                        <div class="flex-1 min-w-0 pr-6">
                            <p class="text-[11px] font-bold text-slate-500 truncate mb-0.5">Ảnh căn cước công dân</p>
                            <p class="text-sm font-bold text-slate-800 truncate mb-0.5">cccd_front.jpg</p>
                            <p class="text-[11px] font-medium text-slate-400">1.2 MB</p>
                        </div>
                        <button type="button" class="absolute right-2 top-2 p-1.5 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <!-- Uploaded File 2 -->
                    <div class="border border-slate-200 rounded-xl p-3 flex items-start gap-3 bg-slate-50 relative group">
                        <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a" class="w-full h-full object-cover opacity-50" alt="Doc">
                        </div>
                        <div class="flex-1 min-w-0 pr-6">
                            <p class="text-[11px] font-bold text-slate-500 truncate mb-0.5">Ảnh không gian sống</p>
                            <p class="text-sm font-bold text-slate-800 truncate mb-0.5">nha_o.jpg</p>
                            <p class="text-[11px] font-medium text-slate-400">2.4 MB</p>
                        </div>
                        <button type="button" class="absolute right-2 top-2 p-1.5 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <!-- Add New File Button -->
                    <button type="button" class="border-2 border-dashed border-slate-200 rounded-xl p-4 flex flex-col items-center justify-center text-slate-500 hover:bg-teal-50 hover:border-teal-200 hover:text-teal-700 transition-colors h-full min-h-[90px]">
                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span class="text-sm font-bold">Thêm tệp khác</span>
                        <span class="text-[10px] font-medium mt-0.5">JPG, PNG, PDF (Tối đa 5MB)</span>
                    </button>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.adoptions.index') }}" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                    Hủy bỏ
                </a>
                <button type="submit" class="px-8 py-2.5 bg-teal-700 text-white font-bold text-sm rounded-xl hover:bg-teal-800 transition-colors shadow-sm shadow-teal-700/20">
                    Lưu Đơn
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
