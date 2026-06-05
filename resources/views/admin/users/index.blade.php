<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Người Dùng</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Quản Lý Người Dùng</h2>
                <p class="text-sm text-slate-500">Quản lý tài khoản và phân quyền người dùng trong hệ thống.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </button>
                <button class="bg-teal-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-800 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Người Dùng
                </button>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            
            <!-- Card 1: Tổng Người Dùng -->
            <x-admin.kpi-card 
                title="Tổng Người Dùng" 
                value="{{ \App\Models\User::count() }}" 
                percent="12.5" 
            />

            <!-- Card 2: Admin -->
            <x-admin.kpi-card 
                title="Admin" 
                value="{{ \App\Models\User::role('admin')->count() }}" 
                percent="0" 
            />

            <!-- Card 3: Staff -->
            <x-admin.kpi-card 
                title="Staff" 
                value="{{ \App\Models\User::role('staff')->count() }}" 
                percent="5.2" 
            />

            <!-- Card 4: Người dùng thường -->
            <x-admin.kpi-card 
                title="Người dùng thường" 
                value="{{ \App\Models\User::whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))->count() }}" 
                percent="15.1" 
            />

        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            
            <!-- Filters Section -->
            <div class="p-6 pb-4 border-b border-slate-100 overflow-x-auto custom-scrollbar">
                <div class="flex gap-4 min-w-max items-end">
                    <!-- Search -->
                    <div class="w-72">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" placeholder="Tìm kiếm tên, email, SĐT..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm">
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="w-40">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Vai trò</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Admin</option>
                            <option>Nhân viên</option>
                            <option>Người dùng</option>
                        </select>
                    </div>

                    <div class="w-40">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Trạng thái</label>
                        <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 appearance-none shadow-sm text-slate-700">
                            <option>Tất cả</option>
                            <option>Hoạt động</option>
                            <option>Bị khóa</option>
                        </select>
                    </div>

                    <div class="w-44">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Ngày đăng ký</label>
                        <div class="relative">
                            <input type="text" placeholder="Chọn thời gian" class="w-full pl-3 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm text-slate-700">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 ml-auto">

                        <button class="px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 hover:shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Làm mới
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-[#f8fafc]">
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Người Dùng</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Vai Trò</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Liên Hệ</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Ngày Đăng Ký</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Trạng Thái</th>
                            <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100 text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        @foreach($users as $user)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-200 shrink-0 overflow-hidden">
                                        <img src="{{ $user->Anh_dai_dien ?? 'https://ui-avatars.com/api/?name='.urlencode($user->Ho_ten) }}" alt="Avatar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-900">{{ $user->Ho_ten }}</span>
                                        <span class="text-xs text-slate-500 mt-0.5">{{ $user->Email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-600 capitalize">
                                    {{ $user->roles->pluck('name')->join(', ') ?: 'User' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-600">{{ $user->So_dien_thoai ?? '---' }}</td>
                            <td class="py-4 px-6 text-slate-600">{{ $user->Ngay_tao->format('d/m/Y H:i') }}</td>
                            <td class="py-4 px-6">
                                @if($user->Trang_thai === 'hoat_dong')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Hoạt động
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                    Bị khóa
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Role button -->
                                    <button onclick="openRoleModal('{{ $user->Ma_nguoi_dung }}', '{{ $user->roles->first()->name ?? 'user' }}')" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center hover:bg-orange-100 transition-colors tooltip-trigger" title="Phân quyền">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-5 border-t border-slate-100">
                {{ $users->links() }}
            </div>

        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="roleModal" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold">Cập nhật Vai Trò</h3>
                <button onclick="closeRoleModal()" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="roleForm" method="POST" action="" class="p-6">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Chọn vai trò mới</label>
                    <select name="role" id="roleSelect" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-brand/20 focus:border-orange-brand outline-none transition-all">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                        <option value="user">User (Thường)</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeRoleModal()" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-orange-brand text-white rounded-lg hover:bg-orange-600 transition">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function openRoleModal(userId, currentRole) {
            document.getElementById('roleModal').classList.remove('hidden');
            document.getElementById('roleForm').action = `/admin/users/${userId}/role`;
            
            let select = document.getElementById('roleSelect');
            for(let i=0; i<select.options.length; i++) {
                if(select.options[i].value === currentRole) {
                    select.selectedIndex = i;
                    break;
                }
            }
        }
        function closeRoleModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }
    </script>
    @endpush


        </div>
    </div>
</x-admin-layout>
