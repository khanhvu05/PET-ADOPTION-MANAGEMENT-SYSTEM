<x-admin-layout>
    <x-slot name="header">
        <span class="text-slate-500">Hệ Thống</span>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-medium">Cài Đặt</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6" x-data="{ activeTab: 'general' }">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Cài Đặt Hệ Thống</h2>
                <p class="text-sm text-slate-500">Cấu hình các thông số cơ bản và tùy chỉnh hoạt động của hệ thống.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" form="settings-form" class="bg-teal-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Lưu Thay Đổi
                </button>
            </div>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-100 flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
                <button @click="show = false" type="button" class="text-emerald-600 hover:text-emerald-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Settings Sidebar -->
            <div class="w-full lg:w-64 shrink-0">
                <div class="bg-white border border-slate-200 rounded-xl shadow overflow-hidden">
                    <nav class="flex flex-col">
                        <a href="#general" @click.prevent="activeTab = 'general'" class="flex items-center gap-3 px-4 py-3.5 transition-colors border-l-4"
                           :class="activeTab === 'general' ? 'bg-teal-50 text-teal-700 border-teal-600 font-semibold' : 'text-slate-600 border-transparent hover:bg-slate-50 hover:text-slate-900 font-medium'">
                            <svg class="w-5 h-5" :class="activeTab === 'general' ? 'text-teal-700' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Thông tin chung
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content Form -->
            <div class="flex-1 space-y-6">
                <!-- General Info View -->
                <div x-show="activeTab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="space-y-6">
                    
                    <form id="settings-form" action="{{ route('admin.settings.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <!-- Basic Info Card -->
                            <div class="bg-white border border-slate-200 rounded-xl shadow p-6 lg:p-8">
                                <h3 class="text-lg font-bold text-slate-900 mb-6">Thông Tin Cơ Bản</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- System Name -->
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Tên Hệ Thống</label>
                                        <input type="text" name="system_name" value="{{ $settings['system_name'] ?? 'PetAdoption Admin' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-900">
                                    </div>

                                    <!-- Slogan -->
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Slogan / Mô tả ngắn</label>
                                        <input type="text" name="slogan" value="{{ $settings['slogan'] ?? 'Nền tảng quản lý nhận nuôi thú cưng hàng đầu' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-900">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Email Liên Hệ</label>
                                        <input type="email" name="email" value="{{ $settings['email'] ?? 'contact@petadoption.com' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-900">
                                    </div>

                                    <!-- Hotline -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Hotline</label>
                                        <input type="text" name="hotline" value="{{ $settings['hotline'] ?? '1900 1234' }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-900">
                                    </div>

                                    <!-- Address -->
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Địa Chỉ Trụ Sở</label>
                                        <textarea name="address" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-900 resize-none">{{ $settings['address'] ?? '123 Đường Xuân Thủy, Cầu Giấy, Hà Nội' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Regional Settings -->
                            <div class="bg-white border border-slate-200 rounded-xl shadow p-6 lg:p-8">
                                <h3 class="text-lg font-bold text-slate-900 mb-6">Khu Vực & Ngôn Ngữ</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Language -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Ngôn Ngữ Mặc Định</label>
                                        <select name="language" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-900">
                                            <option value="vi" {{ ($settings['language'] ?? 'vi') == 'vi' ? 'selected' : '' }}>Tiếng Việt (vi)</option>
                                            <option value="en" {{ ($settings['language'] ?? 'vi') == 'en' ? 'selected' : '' }}>English (en)</option>
                                        </select>
                                    </div>

                                    <!-- Timezone -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Múi Giờ</label>
                                        <select name="timezone" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-900">
                                            <option value="Asia/Ho_Chi_Minh" {{ ($settings['timezone'] ?? 'Asia/Ho_Chi_Minh') == 'Asia/Ho_Chi_Minh' ? 'selected' : '' }}>Asia/Ho_Chi_Minh (+07:00)</option>
                                            <option value="Asia/Bangkok" {{ ($settings['timezone'] ?? 'Asia/Ho_Chi_Minh') == 'Asia/Bangkok' ? 'selected' : '' }}>Asia/Bangkok (+07:00)</option>
                                        </select>
                                    </div>

                                    <!-- Date Format -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Định Dạng Ngày</label>
                                        <select name="date_format" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-900">
                                            <option value="DD/MM/YYYY" {{ ($settings['date_format'] ?? 'DD/MM/YYYY') == 'DD/MM/YYYY' ? 'selected' : '' }}>DD/MM/YYYY</option>
                                            <option value="MM/DD/YYYY" {{ ($settings['date_format'] ?? 'DD/MM/YYYY') == 'MM/DD/YYYY' ? 'selected' : '' }}>MM/DD/YYYY</option>
                                            <option value="YYYY-MM-DD" {{ ($settings['date_format'] ?? 'DD/MM/YYYY') == 'YYYY-MM-DD' ? 'selected' : '' }}>YYYY-MM-DD</option>
                                        </select>
                                    </div>

                                    <!-- Time Format -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Định Dạng Giờ</label>
                                        <select name="time_format" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-900">
                                            <option value="24" {{ ($settings['time_format'] ?? '24') == '24' ? 'selected' : '' }}>24 Giờ (14:30)</option>
                                            <option value="12" {{ ($settings['time_format'] ?? '24') == '12' ? 'selected' : '' }}>12 Giờ (02:30 PM)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Advanced Options -->
                            <div class="bg-white border border-slate-200 rounded-xl shadow p-6 lg:p-8">
                                <h3 class="text-lg font-bold text-slate-900 mb-6">Tùy Chọn Hoạt Động</h3>
                                
                                <div class="space-y-6">
                                    <!-- Toggle 1 -->
                                    @php $allowReg = isset($settings['allow_registration']) ? filter_var($settings['allow_registration'], FILTER_VALIDATE_BOOLEAN) : true; @endphp
                                    <div class="flex items-center justify-between" x-data="{ on: {{ $allowReg ? 'true' : 'false' }} }">
                                        <div>
                                            <h4 class="font-bold text-slate-900 mb-1">Cho phép Đăng ký Tài khoản mới</h4>
                                            <p class="text-sm text-slate-500">Mở cổng đăng ký tài khoản cho khách truy cập vãng lai.</p>
                                        </div>
                                        <input type="hidden" name="allow_registration" :value="on ? 'true' : 'false'">
                                        <button type="button" @click="on = !on" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2" :class="on ? 'bg-teal-500' : 'bg-slate-200'">
                                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="on ? 'translate-x-5' : 'translate-x-0'"></span>
                                        </button>
                                    </div>

                                    <hr class="border-slate-100">

                                    <!-- Toggle 2 -->
                                    @php $maintenance = isset($settings['maintenance_mode']) ? filter_var($settings['maintenance_mode'], FILTER_VALIDATE_BOOLEAN) : false; @endphp
                                    <div class="flex items-center justify-between" x-data="{ on: {{ $maintenance ? 'true' : 'false' }} }">
                                        <div>
                                            <h4 class="font-bold text-slate-900 mb-1">Chế Độ Bảo Trì</h4>
                                            <p class="text-sm text-slate-500">Tạm dừng tất cả giao dịch và hiển thị thông báo bảo trì cho người dùng ngoài Admin.</p>
                                        </div>
                                        <input type="hidden" name="maintenance_mode" :value="on ? 'true' : 'false'">
                                        <button type="button" @click="on = !on" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" :class="on ? 'bg-red-500' : 'bg-slate-200'">
                                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="on ? 'translate-x-5' : 'translate-x-0'"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
