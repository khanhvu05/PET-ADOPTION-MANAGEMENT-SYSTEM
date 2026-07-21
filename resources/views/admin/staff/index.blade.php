<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-sidebar-blue transition-colors flex items-center gap-1.5 text-slate-500">
            <i data-lucide="home" class="w-4 h-4"></i>
            Quản Lý
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Nhân Viên</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Quản Lý Nhân Viên</h2>
                <p class="text-sm text-slate-500">Quản lý tài khoản và phân quyền cho ban quản trị và nhân viên.</p>
            </div>
            <div class="flex items-center gap-3">
                @can('staff.create')
                <a href="{{ route('admin.staff.create') }}" class="bg-teal-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-teal-700 hover:shadow-md transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Nhân Viên
                </a>
                @endcan
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-admin.kpi-card title="Admin" value="{{ $totalAdmin }}" percent="0" />
            <x-admin.kpi-card title="Nhân viên" value="{{ $totalStaff }}" percent="0" />
            <x-admin.kpi-card title="Đang hoạt động" value="{{ $activeCount }}" percent="0" />
            <x-admin.kpi-card title="Bị khóa" value="{{ $lockedCount }}" percent="0" />
        </div>

        <!-- Custom Roles Management Card -->
        @if(auth()->user()->hasRole('admin'))
        <div class="bg-white border border-slate-200 rounded-xl shadow p-6 mb-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Vai trò tùy chỉnh (Preset)</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Nhấn vào một vai trò để xem và chỉnh sửa quyền</p>
                </div>
                <button onclick="document.getElementById('createRoleModal').classList.remove('hidden')" class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tạo vai trò mới
                </button>
            </div>
            
            @if($customRoles->isEmpty())
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <p class="text-sm text-slate-500">Chưa có vai trò tùy chỉnh nào. Nhấp vào nút <strong>"Tạo vai trò mới"</strong> để tạo.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($customRoles as $role)
                    @php
                        $rolePerms = $role->permissions->pluck('name');
                        $usersCount = $role->users()->count();
                    @endphp
                    <div class="group relative bg-gradient-to-br from-slate-50 to-white border border-slate-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-md transition-all cursor-pointer"
                         onclick="openEditRoleModal({{ $role->id }}, '{{ addslashes($role->name) }}', '{{ addslashes($role->mo_ta ?? '') }}', {{ $rolePerms->toJson() }})">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center shrink-0">
                                <svg class="w-4.5 h-4.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <!-- Delete button (stop event propagation) -->
                            <form method="POST" action="{{ route('admin.staff.custom_role.destroy', $role->id) }}"
                                  id="delete-role-form-{{ $role->id }}"
                                  onclick="event.stopPropagation()"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="event.stopPropagation(); confirmDeleteRole({{ $role->id }}, '{{ addslashes($role->name) }}');"
                                        class="opacity-0 group-hover:opacity-100 w-6 h-6 rounded-md flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                        
                        <!-- Role name & desc -->
                        <h4 class="font-bold text-slate-800 text-sm leading-snug mb-1 group-hover:text-indigo-700 transition-colors">{{ $role->name }}</h4>
                        @if($role->mo_ta)
                            <p class="text-xs text-slate-500 mb-3 leading-relaxed line-clamp-2">{{ $role->mo_ta }}</p>
                        @else
                            <p class="text-xs text-slate-400 italic mb-3">Chưa có mô tả</p>
                        @endif
                        
                        <!-- Stats -->
                        <div class="flex items-center justify-between text-xs">
                            <span class="flex items-center gap-1 text-slate-500">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $rolePerms->count() }} quyền
                            </span>
                            <span class="flex items-center gap-1 text-slate-500">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $usersCount }} người dùng
                            </span>
                        </div>

                        <!-- Edit hint -->
                        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-xs text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Nhấn để xem và chỉnh sửa quyền
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
        @endif

        <!-- Edit Role Modal -->
        <div id="editRoleModal" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl mx-4 max-h-[90vh] flex flex-col">
                <div class="p-6 border-b border-slate-100 flex justify-between items-start shrink-0">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900" id="editRoleModalTitle">Chỉnh sửa vai trò</h3>
                        <p class="text-sm text-slate-500 mt-0.5" id="editRoleModalDesc"></p>
                    </div>
                    <button onclick="document.getElementById('editRoleModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form id="editRoleForm" method="POST" action="" class="flex flex-col overflow-hidden">
                    @csrf
                    @method('PUT')
                    <div class="p-6 overflow-y-auto flex-1">
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Mô tả vai trò</label>
                            <input type="text" name="mo_ta" id="editRoleMoTa" placeholder="Mô tả ngắn gọn về vai trò này..." class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                        </div>

                        <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                            Danh sách quyền hạn
                            <span id="editRolePermCount" class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-bold bg-teal-100 text-teal-700">0</span>
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($allPermissions as $module => $modulePermissions)
                            @if(in_array($module, ['donations', 'campaigns'])) @continue @endif
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <h5 class="font-semibold text-slate-700 mb-3 text-sm border-b border-slate-200 pb-2 flex items-center justify-between">
                                    {{ config("permissions.modules.$module", ucfirst($module)) }}
                                    <label class="flex items-center gap-1 cursor-pointer text-xs font-normal text-indigo-600 hover:text-indigo-700 select-none">
                                        <input type="checkbox" class="w-3.5 h-3.5 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500 edit-select-all-module" data-module="{{ $module }}">
                                        Tất cả
                                    </label>
                                </h5>
                                <div class="space-y-2">
                                    @foreach($modulePermissions as $permission)
                                    @php $action = str_replace($module.'.', '', $permission->name); @endphp
                                    <label class="flex items-start gap-2.5 cursor-pointer group">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="mt-0.5 w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500 edit-module-checkbox-{{ $module }} edit-perm-checkbox"
                                            data-module="{{ $module }}">
                                        <span class="text-xs text-slate-600 group-hover:text-slate-900 leading-snug">
                                            {{ config("permissions.actions.$action", ucfirst(str_replace('_', ' ', $action))) }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-6 border-t border-slate-100 flex justify-between items-center gap-3 shrink-0 bg-slate-50/50 rounded-b-2xl">
                        <p class="text-xs text-slate-500">Thay đổi sẽ áp dụng ngay cho tất cả nhân viên đang dùng vai trò này.</p>
                        <div class="flex gap-3">
                            <button type="button" onclick="document.getElementById('editRoleModal').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-xl transition font-medium text-sm">Hủy</button>
                            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-semibold shadow-sm text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Filter & Table Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow flex flex-col mb-10 w-full overflow-hidden">
            <form id="filter-form" method="GET" action="{{ route('admin.staff.index') }}" class="p-6 pb-4 border-b border-slate-100">
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="w-72">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tên, email, SĐT..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-500 transition-colors shadow-sm">
                        </div>
                    </div>

                    <div class="w-40 relative" x-data="{ open: false, value: '{{ request('role', 'all') }}', options: {'all': 'Tất cả', 'admin': 'Admin', 'staff': 'Staff'} }">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Vai trò</label>
                        <input type="hidden" name="role" x-model="value" id="role-filter-input">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm shadow-sm text-slate-700 flex items-center justify-between">
                            <span x-text="options[value]"></span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" class="absolute left-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50 overflow-hidden">
                            <template x-for="(text, val) in options" :key="val">
                                <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('role-filter-input').dispatchEvent(new Event('change', { bubbles: true })); }, 50);" class="w-full text-left px-4 py-2.5 text-sm" :class="{'bg-teal-50/50 text-teal-700 font-semibold': value === val, 'text-slate-600': value !== val}">
                                    <span x-text="text"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="w-40 relative" x-data="{ open: false, value: '{{ request('status', 'all') }}', options: {'all': 'Tất cả', 'hoat_dong': 'Hoạt động', 'bi_khoa': 'Bị khóa'} }">
                        <label class="block text-[11px] font-bold text-slate-500 mb-1.5 ml-1">Trạng thái</label>
                        <input type="hidden" name="status" x-model="value" id="status-filter-input">
                        <button type="button" @click="open = !open" @click.away="open = false" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm shadow-sm text-slate-700 flex items-center justify-between">
                            <span x-text="options[value]"></span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" class="absolute left-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50 overflow-hidden">
                            <template x-for="(text, val) in options" :key="val">
                                <button type="button" @click="value = val; open = false; setTimeout(() => { document.getElementById('status-filter-input').dispatchEvent(new Event('change', { bubbles: true })); }, 50);" class="w-full text-left px-4 py-2.5 text-sm" :class="{'bg-teal-50/50 text-teal-700 font-semibold': value === val, 'text-slate-600': value !== val}">
                                    <span x-text="text"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 ml-auto">
                        <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-semibold hover:bg-teal-700 transition-all shadow-sm">Lọc</button>
                        <a href="{{ route('admin.staff.index') }}" class="px-5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-all flex items-center gap-2">Làm mới</a>
                    </div>
                </div>
            </form>

            <div id="staff-table-container" class="relative">
                <div class="overflow-x-auto min-h-[280px] pb-4">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#f8fafc]">
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Nhân Viên</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Vai Trò</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Liên Hệ</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">Trạng Thái</th>
                                <th class="py-4 px-6 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100 text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($staffList as $staff)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 shrink-0 overflow-hidden">
                                            <img src="{{ $staff->Anh_dai_dien ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->Ho_ten) }}" alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-slate-900">{{ $staff->Ho_ten }}</span>
                                            <span class="text-xs text-slate-500 mt-0.5">{{ $staff->Email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex flex-col gap-1">
                                        @if($staff->Chuc_danh)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold
                                                {{ $staff->hasRole('admin') ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-teal-50 text-teal-700 border border-teal-200' }}">
                                                {{ $staff->Chuc_danh }}
                                            </span>
                                        @else
                                            @foreach($staff->roles as $role)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium 
                                                    {{ $role->name === 'admin' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                                    {{ ucfirst($role->name) }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-600">{{ $staff->So_dien_thoai ?? '---' }}</td>
                                <td class="py-4 px-6">
                                    @if($staff->Trang_thai === 'hoat_dong')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">Hoạt động</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">Bị khóa</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 relative" x-data="{ open: false, dropUp: false }">
                                    <div class="flex items-center justify-center">
                                        <button @click="open = !open; dropUp = ($event.clientY > window.innerHeight - 200)" @click.away="open = false" class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-500 flex items-center justify-center transition-colors focus:outline-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>

                                        <div x-show="open" 
                                             :class="dropUp ? 'bottom-[50%] mb-2' : 'top-[50%] mt-2'"
                                             class="absolute right-[50px] w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1 z-50">
                                            
                                            <a href="{{ route('admin.staff.show', $staff->Ma_nguoi_dung) }}" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Xem chi tiết
                                            </a>
                                            
                                            @can('staff.edit')
                                            <a href="{{ route('admin.staff.edit', $staff->Ma_nguoi_dung) }}" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Phân quyền
                                            </a>
                                            @endcan

                                            @can('staff.toggle_status')
                                            @if(auth()->id() !== $staff->Ma_nguoi_dung)
                                            <form method="POST" action="{{ route('admin.staff.toggle_status', $staff->Ma_nguoi_dung) }}" onsubmit="confirmToggleStatus(event, this, '{{ $staff->Trang_thai === 'hoat_dong' ? 'khóa' : 'mở khóa' }}')" class="block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                                                    @if($staff->Trang_thai === 'hoat_dong')
                                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                        Khóa tài khoản
                                                    @else
                                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                                        Mở khóa
                                                    @endif
                                                </button>
                                            </form>
                                            @endif
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-slate-500">
                        Hiển thị {{ $staffList->firstItem() ?? 0 }} đến {{ $staffList->lastItem() ?? 0 }} của {{ $staffList->total() }} kết quả
                    </div>
                    <div>
                        {{ $staffList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Custom Role Modal -->
    <div id="createRoleModal" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] flex flex-col">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center shrink-0">
                <h3 class="text-lg font-bold">Tạo Vai Trò Tùy Chỉnh Mới</h3>
                <button onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form method="POST" action="{{ route('admin.staff.custom_role.store') }}" class="flex flex-col overflow-hidden">
                @csrf
                <div class="p-6 overflow-y-auto">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Tên vai trò *</label>
                            <input type="text" name="name" required placeholder="Ví dụ: QuanLyDon" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Mô tả</label>
                            <input type="text" name="mo_ta" placeholder="Mô tả ngắn gọn" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-800 mb-4">Chọn quyền (Permissions)</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($allPermissions as $module => $modulePermissions)
                        @if(in_array($module, ['donations', 'campaigns'])) @continue @endif
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <h5 class="font-semibold text-slate-800 mb-3 capitalize border-b border-slate-200 pb-2 flex items-center justify-between">
                                {{ config("permissions.modules.$module", ucfirst($module)) }}
                                <label class="flex items-center gap-1 cursor-pointer text-xs font-normal text-teal-600 hover:text-teal-700 select-none">
                                    <input type="checkbox" class="w-3.5 h-3.5 text-teal-600 rounded border-slate-300 focus:ring-teal-500 select-all-module" data-module="{{ $module }}">
                                    Chọn tất cả
                                </label>
                            </h5>
                            <div class="space-y-2">
                                @foreach($modulePermissions as $permission)
                                <label class="flex items-start gap-2.5 cursor-pointer group">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                        class="mt-1 w-4 h-4 text-teal-600 rounded border-slate-300 focus:ring-teal-500 module-checkbox-{{ $module }}">
                                    <span class="text-sm text-slate-700 group-hover:text-slate-900 leading-snug">
                                        @php $action = str_replace($module.'.', '', $permission->name); @endphp
                                        {{ config("permissions.actions.$action", ucfirst(str_replace('_', ' ', $action))) }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="p-6 border-t border-slate-100 flex justify-end gap-3 shrink-0 bg-slate-50 rounded-b-xl">
                    <button type="button" onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition font-medium">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium shadow-sm">Tạo vai trò</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logic for "Select All" in create role modal
            document.querySelectorAll('.select-all-module').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let module = this.getAttribute('data-module');
                    let checkboxes = document.querySelectorAll('.module-checkbox-' + module);
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            });

            // Logic for "Select All" in EDIT role modal
            document.querySelectorAll('.edit-select-all-module').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let module = this.getAttribute('data-module');
                    let checkboxes = document.querySelectorAll('.edit-module-checkbox-' + module);
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    updateEditPermCount();
                });
            });

            // Update count on every checkbox change
            document.querySelectorAll('.edit-perm-checkbox').forEach(function(cb) {
                cb.addEventListener('change', updateEditPermCount);
            });
        });

        function updateEditPermCount() {
            const count = document.querySelectorAll('.edit-perm-checkbox:checked').length;
            document.getElementById('editRolePermCount').textContent = count;
        }

        function openEditRoleModal(roleId, roleName, roleDesc, currentPerms) {
            // Set form action URL
            document.getElementById('editRoleForm').action = '/quan-tri/nhan-vien/vai-tro-tuy-chinh/' + roleId;

            // Set title and description
            document.getElementById('editRoleModalTitle').textContent = 'Chỉnh sửa: ' + roleName;
            document.getElementById('editRoleModalDesc').textContent = roleDesc || 'Chưa có mô tả';
            document.getElementById('editRoleMoTa').value = roleDesc;

            // Uncheck all permission checkboxes first
            document.querySelectorAll('.edit-perm-checkbox').forEach(cb => cb.checked = false);

            // Check the permissions this role has
            currentPerms.forEach(function(permName) {
                const cb = document.querySelector('.edit-perm-checkbox[value="' + permName + '"]');
                if (cb) cb.checked = true;
            });

            // Update "Select All" states per module
            document.querySelectorAll('.edit-select-all-module').forEach(function(selectAll) {
                let module = selectAll.getAttribute('data-module');
                let all = document.querySelectorAll('.edit-module-checkbox-' + module);
                let checked = document.querySelectorAll('.edit-module-checkbox-' + module + ':checked');
                selectAll.checked = all.length > 0 && all.length === checked.length;
                selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
            });

            // Update count badge
            updateEditPermCount();

            // Show modal
            document.getElementById('editRoleModal').classList.remove('hidden');
        }

        function confirmDeleteRole(roleId, roleName) {
            let customConfig = {...window.swalConfig};
            customConfig.customClass = { ...window.swalConfig.customClass, confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold rounded-[10px] px-6 py-2.5 transition-colors shadow-sm' };

            Swal.fire({
                ...customConfig,
                title: 'Xóa vai trò?',
                html: `Bạn có chắc chắn muốn xóa vai trò <strong>"${roleName}"</strong>?<br><span class="text-sm text-slate-500">Hành động này không thể hoàn tác.</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa vai trò',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-role-form-' + roleId).submit();
                }
            });
        }

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
                text: `Bạn có chắc chắn muốn ${actionName} tài khoản nhân viên này?`,
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
    @endpush
</x-admin-layout>
