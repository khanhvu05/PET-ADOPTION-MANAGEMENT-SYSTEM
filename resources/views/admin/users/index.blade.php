<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-sidebar-blue transition-colors flex items-center gap-1.5 text-slate-500">
            <i data-lucide="home" class="w-4 h-4"></i>
            Quản Lý
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
                <a href="{{ route('admin.users.export', request()->all()) }}" class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Xuất Excel
                </a>
                <a href="{{ route('admin.users.create') }}" class="bg-[#3f899a] text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#3f899a]/80 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Người Dùng
                </a>
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
            <form id="filter-form" method="GET" action="{{ route('admin.users.index') }}" class="p-6 pb-4 border-b border-slate-100">
                <div class="flex flex-wrap gap-4 items-end">
                    <!-- Search -->
                    <div class="w-72">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tên, email, SĐT..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors shadow-sm">
                        </div>
                    </div>

                    <!-- Dropdowns -->
                    <div class="w-40 relative" x-data="{ 
                        open: false, 
                        value: '{{ request('role', 'all') }}', 
                        options: {'all': 'Tất cả', 'admin': 'Admin', 'staff': 'Nhân viên', 'customer': 'Người dùng'} 
                    }">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Vai trò</label>
                        <input type="hidden" name="role" x-model="value" id="role-filter-input">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 shadow-sm text-slate-700 flex items-center justify-between transition-colors hover:bg-white">
                            <span x-text="options[value]"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50 overflow-hidden">
                            <template x-for="(text, val) in options" :key="val">
                                <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('role-filter-input').dispatchEvent(new Event('change', { bubbles: true })); }, 50);" class="w-full text-left px-4 py-2.5 text-sm transition-colors flex items-center justify-between" :class="{'bg-teal-50/50 text-teal-700 font-semibold': value === val, 'text-slate-600 hover:bg-slate-50 hover:text-slate-900': value !== val}">
                                    <span x-text="text"></span>
                                    <svg x-show="value === val" class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="w-40 relative" x-data="{ 
                        open: false, 
                        value: '{{ request('status', 'all') }}', 
                        options: {'all': 'Tất cả', 'hoat_dong': 'Hoạt động', 'bi_khoa': 'Bị khóa'} 
                    }">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Trạng thái</label>
                        <input type="hidden" name="status" x-model="value" id="status-filter-input">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 shadow-sm text-slate-700 flex items-center justify-between transition-colors hover:bg-white">
                            <span x-text="options[value]"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50 overflow-hidden">
                            <template x-for="(text, val) in options" :key="val">
                                <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('status-filter-input').dispatchEvent(new Event('change', { bubbles: true })); }, 50);" class="w-full text-left px-4 py-2.5 text-sm transition-colors flex items-center justify-between" :class="{'bg-teal-50/50 text-teal-700 font-semibold': value === val, 'text-slate-600 hover:bg-slate-50 hover:text-slate-900': value !== val}">
                                    <span x-text="text"></span>
                                    <svg x-show="value === val" class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 ml-auto">
                        <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 hover:shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Làm mới
                        </a>
                    </div>
                </div>
            </form>

            <!-- Table Container -->
            <div id="users-table-container" class="relative">
                <!-- Loading Overlay -->
                <div id="table-loading-overlay" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 hidden flex items-center justify-center">
                    <div class="w-8 h-8 border-4 border-teal-500 border-t-transparent rounded-full animate-spin"></div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto min-h-[280px] pb-4">
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
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-900">{{ $user->Ho_ten }}</span>
                                            @if($user->Loai_tai_khoan === 'to_chuc')
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                                    Tổ chức
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                                    Cá nhân
                                                </span>
                                            @endif
                                        </div>
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
                            <td class="py-4 px-6 text-slate-600">{{ $user->Ngay_tao ? $user->Ngay_tao->format('d/m/Y H:i') : '---' }}</td>
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
                            <td class="py-4 px-6 relative" x-data="{ open: false, dropUp: false }">
                                <div class="flex items-center justify-center">
                                    <button @click="open = !open; dropUp = ($event.clientY > window.innerHeight - 250)" @click.away="open = false" class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-500 flex items-center justify-center transition-colors focus:outline-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         :class="dropUp ? 'bottom-[50%] mb-2' : 'top-[50%] mt-2'"
                                         class="absolute right-[50px] w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1 z-50">
                                        
                                        <button onclick="openRoleModal('{{ $user->Ma_nguoi_dung }}', '{{ $user->roles->first()->name ?? 'user' }}')" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Phân quyền
                                        </button>

                                        <form method="POST" action="{{ route('admin.users.toggle_status', $user->Ma_nguoi_dung) }}" onsubmit="confirmToggleStatus(event, this, '{{ $user->Trang_thai === 'hoat_dong' ? 'khóa' : 'mở khóa' }}')" class="block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                                @if($user->Trang_thai === 'hoat_dong')
                                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                    Khóa tài khoản
                                                @else
                                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                                    Mở khóa
                                                @endif
                                            </button>
                                        </form>

                                        {{-- 
                                        <div class="border-t border-slate-100 my-1"></div>

                                        <form method="POST" action="{{ route('admin.users.destroy', $user->Ma_nguoi_dung) }}" class="block confirm-delete" data-title="Xóa người dùng?" data-text="Bạn có chắc chắn muốn xóa người dùng này vĩnh viễn? Hành động này không thể hoàn tác!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Xóa tài khoản
                                            </button>
                                        </form>
                                        --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

                <!-- Pagination -->
                <div class="p-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-slate-500">
                        Hiển thị {{ $users->firstItem() ?? 0 }} đến {{ $users->lastItem() ?? 0 }} của {{ $users->total() }} kết quả
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-slate-500">Hiển thị</span>
                            <select name="per_page" form="filter-form" class="bg-white border border-slate-200 rounded-lg text-sm text-slate-700 focus:ring-teal-500 focus:border-teal-500 px-2 py-1 outline-none">
                                <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div> <!-- End Table Container -->

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
            document.getElementById('roleForm').action = `/quan-tri/nguoi-dung/${userId}/vai-tro`;
            
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

        // Sử dụng window.swalConfig từ admin layout

        // Hàm confirmToggleStatus vẫn giữ nguyên vì logic riêng biệt
        function confirmToggleStatus(event, form, actionName) {
            event.preventDefault();
            let isLock = actionName === 'khóa';
            
            let customConfig = {...window.swalConfig};
            if(isLock) {
                customConfig.customClass = { ...window.swalConfig.customClass, confirmButton: 'bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm' };
            } else {
                customConfig.customClass = { ...window.swalConfig.customClass, confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm' };
            }

            Swal.fire({
                ...customConfig,
                title: (isLock ? 'Khóa' : 'Mở khóa') + ' tài khoản?',
                text: `Bạn có chắc chắn muốn ${actionName} tài khoản này?`,
                icon: isLock ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonText: 'Có, ' + actionName,
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(typeof window.initAjaxTable === 'function') {
                window.initAjaxTable('users-table-container', 'filter-form');
            }
        });
    </script>
    @endpush


        </div>
    </div>
</x-admin-layout>
