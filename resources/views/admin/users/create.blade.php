<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.users.index') }}" class="hover:text-teal-600 transition-colors text-slate-500">Người Dùng</a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Thêm Mới</span>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Thêm Người Dùng Mới</h2>
                <p class="text-sm text-slate-500">Điền thông tin bên dưới để tạo tài khoản mới trong hệ thống.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl font-semibold hover:bg-slate-50 transition-colors shadow-sm text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Quay lại
            </a>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 md:p-8">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-sm border border-red-100">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Họ tên -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Họ và tên <span class="text-red-500">*</span></label>
                        <input type="text" name="Ho_ten" value="{{ old('Ho_ten') }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors"
                            placeholder="Nhập họ và tên...">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="Email" value="{{ old('Email') }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors"
                            placeholder="example@domain.com">
                    </div>

                    <!-- Điện thoại -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Số điện thoại</label>
                        <input type="text" name="So_dien_thoai" value="{{ old('So_dien_thoai') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors"
                            placeholder="Nhập số điện thoại...">
                    </div>

                    <!-- Mật khẩu -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Mật khẩu <span class="text-red-500">*</span></label>
                        <input type="password" name="Mat_khau_hash" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors"
                            placeholder="Tối thiểu 8 ký tự...">
                    </div>

                    <!-- Nhập lại Mật khẩu -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nhập lại Mật khẩu <span class="text-red-500">*</span></label>
                        <input type="password" name="Mat_khau_hash_confirmation" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors"
                            placeholder="Nhập lại mật khẩu...">
                    </div>

                    <!-- Vai trò -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Vai trò <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- User -->
                            <label class="relative flex items-start p-4 cursor-pointer rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center h-5">
                                    <input name="role" type="radio" value="user" checked class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                </div>
                                <div class="ml-3 flex flex-col">
                                    <span class="text-sm font-bold text-slate-900">User</span>
                                    <span class="text-xs text-slate-500 mt-1">Người dùng hệ thống bình thường.</span>
                                </div>
                            </label>
                            
                            @foreach($roles as $role)
                            <label class="relative flex items-start p-4 cursor-pointer rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center h-5">
                                    <input name="role" type="radio" value="{{ $role->name }}" class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                                </div>
                                <div class="ml-3 flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 capitalize">{{ $role->name }}</span>
                                    <span class="text-xs text-slate-500 mt-1">
                                        @if($role->name === 'admin')
                                            Có toàn quyền quản trị hệ thống.
                                        @else
                                            Có quyền truy cập khu vực quản trị.
                                        @endif
                                    </span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="reset" class="px-5 py-2.5 text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl font-semibold transition-colors text-sm">
                        Làm mới
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-teal-700 hover:bg-teal-800 text-white rounded-xl font-semibold transition-colors text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tạo Người Dùng
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
