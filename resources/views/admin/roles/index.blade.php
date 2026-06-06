<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-1.5">
                <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Tổng Quan
                </a>
                <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-700 font-bold">Phân Quyền</span>
            </div>
        </div>
    </x-slot>

    @php
        $permissionNames = [
            'view pets' => 'Xem thú cưng',
            'manage pets' => 'Quản lý thú cưng',
            'delete pets' => 'Xóa thú cưng',
            'manage rescue cases' => 'Quản lý cứu hộ',
            'manage vaccination history' => 'Quản lý tiêm phòng',
            'view any adoptions' => 'Xem đơn nhận nuôi',
            'approve adoptions' => 'Duyệt đơn nhận nuôi',
            'pre-approve adoptions' => 'Duyệt sơ bộ',
            'manage interview slots' => 'Quản lý lịch phỏng vấn',
            'manage campaigns' => 'Quản lý chiến dịch',
            'view any donations' => 'Xem lịch sử ủng hộ',
            'manage users' => 'Quản lý người dùng',
            'manage roles' => 'Quản lý phân quyền',
            'view activity logs' => 'Xem nhật ký hoạt động',
            'view tokens' => 'Xem token AI',
            'manage tokens' => 'Quản lý token AI',
            'manage posts' => 'Quản lý bài viết',
            'manage settings' => 'Cài đặt hệ thống',
        ];

        $permissionDescriptions = [
            'view pets' => 'Xem thông tin và danh sách thú cưng',
            'manage pets' => 'Thêm, sửa, cập nhật thông tin thú cưng',
            'delete pets' => 'Xóa thú cưng khỏi hệ thống',
            'manage rescue cases' => 'Thêm, sửa, theo dõi trường hợp cứu hộ',
            'manage vaccination history' => 'Xem và cập nhật lịch sử tiêm phòng',
            'view any adoptions' => 'Xem danh sách đơn nhận nuôi',
            'approve adoptions' => 'Duyệt hoặc từ chối đơn nhận nuôi',
            'pre-approve adoptions' => 'Duyệt sơ bộ đơn nhận nuôi',
            'manage interview slots' => 'Quản lý lịch phỏng vấn',
            'manage campaigns' => 'Thêm, sửa, cập nhật chiến dịch ủng hộ',
            'view any donations' => 'Xem danh sách ủng hộ',
            'manage users' => 'Thêm, sửa, khóa tài khoản người dùng',
            'manage roles' => 'Quản lý vai trò và phân quyền',
            'view activity logs' => 'Xem nhật ký hoạt động hệ thống',
            'view tokens' => 'Xem thống kê token AI',
            'manage tokens' => 'Quản lý cấu hình token AI',
            'manage posts' => 'Quản lý bài viết blog',
            'manage settings' => 'Cài đặt hệ thống chung',
        ];

        $roleColors = [
            0 => ['icon_color' => 'text-orange-500', 'icon_bg' => 'bg-orange-100', 'checkbox' => 'text-orange-500 focus:ring-orange-500'],
            1 => ['icon_color' => 'text-teal-500', 'icon_bg' => 'bg-teal-100', 'checkbox' => 'text-teal-500 focus:ring-teal-500'],
            2 => ['icon_color' => 'text-indigo-500', 'icon_bg' => 'bg-indigo-100', 'checkbox' => 'text-indigo-500 focus:ring-indigo-500'],
            3 => ['icon_color' => 'text-emerald-500', 'icon_bg' => 'bg-emerald-100', 'checkbox' => 'text-emerald-500 focus:ring-emerald-500'],
            4 => ['icon_color' => 'text-amber-500', 'icon_bg' => 'bg-amber-100', 'checkbox' => 'text-amber-500 focus:ring-amber-500'],
            5 => ['icon_color' => 'text-blue-500', 'icon_bg' => 'bg-blue-100', 'checkbox' => 'text-blue-500 focus:ring-blue-500'],
        ];

        $roleSubtitles = [
            'admin' => 'Toàn quyền',
            'staff' => 'Quyền quản lý',
            'user' => 'Người dùng',
            'customer' => 'Khách hàng',
            'customers' => 'Khách hàng',
        ];
    @endphp

    <div x-data="{ activeTab: 'roles', showRoleModal: false, showPermissionModal: false }" class="space-y-6 max-w-[1400px] mx-auto pb-10">
        <!-- Header Section -->
        <div class="flex flex-col">
            <h2 class="text-[28px] font-black text-slate-900 tracking-tight">Phân quyền & Vai trò</h2>
            <p class="text-[15px] text-slate-500 mt-1">Quản lý quyền hạn truy cập của các nhóm người dùng trong hệ thống.</p>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-100 flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-emerald-600 hover:text-emerald-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" class="bg-red-50 text-red-700 px-4 py-3 rounded-xl border border-red-100 flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <p class="text-sm font-bold">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-600 hover:text-red-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        <!-- Tabs & Add Button -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-0">
            <div class="flex space-x-8">
                <button @click="activeTab = 'roles'" :class="{'border-orange-500 text-orange-600 font-bold': activeTab === 'roles', 'border-transparent text-slate-500 hover:text-slate-800 font-medium': activeTab !== 'roles'}" class="pb-3 border-b-2 text-[15px] transition-colors">
                    Vai trò
                </button>
                <button @click="activeTab = 'permissions'" :class="{'border-orange-500 text-orange-600 font-bold': activeTab === 'permissions', 'border-transparent text-slate-500 hover:text-slate-800 font-medium': activeTab !== 'permissions'}" class="pb-3 border-b-2 text-[15px] transition-colors">
                    Nhóm quyền
                </button>
            </div>
            
            <div class="pb-3 flex gap-3">
                <button x-show="activeTab === 'permissions'" style="display: none;" @click="showPermissionModal = true" class="flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-bold text-[14px] shadow-sm hover:bg-indigo-700 transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Thêm quyền mới
                </button>
                <button x-show="activeTab === 'roles'" @click="showRoleModal = true" class="flex items-center justify-center gap-2 px-5 py-2.5 bg-teal-600 text-white rounded-lg font-bold text-[14px] shadow-sm hover:bg-teal-700 transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Thêm vai trò mới
                </button>
            </div>
        </div>

        <!-- ROLES TAB CONTENT -->
        <div x-show="activeTab === 'roles'" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden w-full">
            <div class="overflow-x-auto custom-scrollbar p-0">
                <table class="w-full text-left border-collapse min-w-[1000px] whitespace-nowrap">
                    <thead>
                        <tr>
                            <th class="py-5 px-6 text-[13px] font-bold uppercase tracking-wider text-slate-700 min-w-[300px] border-b border-slate-200 bg-white align-middle">
                                NHÓM QUYỀN / CHỨC NĂNG
                            </th>
                            @foreach($roles as $index => $role)
                                @php
                                    $color = $roleColors[$index % count($roleColors)];
                                    $subtitle = $roleSubtitles[$role->name] ?? 'Khác';
                                @endphp
                                <th class="py-4 px-4 font-bold text-center border-l border-b border-slate-200 bg-white min-w-[160px] align-middle relative group">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full {{ $color['icon_bg'] }} {{ $color['icon_color'] }} flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            <div class="text-left">
                                                <div class="uppercase tracking-wide text-[13px] font-black text-slate-800">{{ $role->name }}</div>
                                                <div class="text-[12px] font-normal text-slate-500 mt-0.5">{{ $subtitle }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action buttons instead of dropdown to prevent overflow -->
                                    <div class="mt-4 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button type="submit" form="form-role-{{ $role->id }}" class="text-[11px] font-bold bg-white text-teal-600 border border-teal-200 hover:bg-teal-50 px-3 py-1.5 rounded-lg shadow-sm transition-colors">
                                            Lưu quyền
                                        </button>
                                        @if(!in_array($role->name, ['admin', 'staff']))
                                            <button type="submit" form="form-delete-role-{{ $role->id }}" class="text-[11px] font-bold bg-white text-red-600 border border-red-200 hover:bg-red-50 px-3 py-1.5 rounded-lg shadow-sm transition-colors">
                                                Xóa
                                            </button>
                                        @endif
                                    </div>
                                    
                                    <form action="{{ route('admin.roles.permissions.update', $role) }}" method="POST" id="form-role-{{ $role->id }}">
                                        @csrf
                                    </form>

                                    @if(!in_array($role->name, ['admin', 'staff']))
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" id="form-delete-role-{{ $role->id }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vai trò này không? Hành động này không thể hoàn tác.');">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($groupedPermissions as $groupName => $perms)
                            <tr class="bg-slate-50/70 border-b border-slate-200">
                                <td colspan="{{ count($roles) + 1 }}" class="py-3 px-6 text-[13px] font-bold text-slate-800 tracking-wide flex items-center gap-2">
                                    {{ $groupName }}
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </td>
                            </tr>
                            @foreach($perms as $permission)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6 text-slate-600 h-full">
                                        <div class="font-bold text-slate-800 text-[14px]">{{ $permissionNames[$permission->name] ?? ucfirst($permission->name) }}</div>
                                        <div class="text-[13px] text-slate-500 mt-1 whitespace-normal max-w-sm leading-relaxed">
                                            {{ $permissionDescriptions[$permission->name] ?? 'Mô tả quyền hạn truy cập' }}
                                        </div>
                                    </td>
                                    
                                    @foreach($roles as $index => $role)
                                        @php
                                            $color = $roleColors[$index % count($roleColors)];
                                        @endphp
                                        <td class="py-4 px-6 text-center border-l border-slate-100">
                                            @if($role->name === 'admin')
                                                <!-- Admin luôn full quyền -->
                                                <div class="flex justify-center items-center h-full">
                                                    <input type="checkbox" checked disabled class="w-5 h-5 rounded border-orange-500 text-orange-500 bg-orange-500 focus:ring-0 shadow-sm opacity-100" style="background-image: url(&quot;data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e&quot;);">
                                                </div>
                                                <input type="hidden" name="permissions[]" value="{{ $permission->name }}" form="form-role-{{ $role->id }}">
                                            @else
                                                <div class="flex justify-center items-center h-full">
                                                    <input type="checkbox" 
                                                           name="permissions[]" 
                                                           value="{{ $permission->name }}" 
                                                           form="form-role-{{ $role->id }}"
                                                           {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                           class="w-5 h-5 rounded border-slate-300 {{ $color['checkbox'] }} cursor-pointer shadow-sm transition-all hover:border-slate-400 bg-white">
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Legend -->
            <div class="bg-white border-t border-slate-200 py-4 px-6 flex items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-orange-500 border border-orange-500 flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-sm text-slate-600 font-medium">Có quyền</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-white border border-slate-300"></div>
                    <span class="text-sm text-slate-600 font-medium">Không có quyền</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 font-bold text-lg leading-none">-</span>
                    <span class="text-sm text-slate-600 font-medium">Không áp dụng</span>
                </div>
            </div>
        </div>

        <!-- PERMISSIONS TAB CONTENT -->
        <div x-show="activeTab === 'permissions'" style="display: none;" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden w-full p-6">
            <h3 class="text-lg font-black text-slate-800 mb-6">Quản lý danh sách quyền hạn (Permissions)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($groupedPermissions as $groupName => $perms)
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5">
                        <h4 class="font-bold text-slate-800 text-[14px] uppercase border-b border-slate-200 pb-2 mb-4">{{ $groupName }}</h4>
                        <ul class="space-y-3">
                            @forelse($perms as $permission)
                                <li class="flex items-start justify-between group">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-700 text-sm">{{ $permissionNames[$permission->name] ?? ucfirst($permission->name) }}</span>
                                        <span class="text-xs text-slate-500">{{ $permissionDescriptions[$permission->name] ?? 'Mô tả quyền hạn truy cập' }}</span>
                                    </div>
                                    <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" onsubmit="return confirm('Xóa quyền này có thể ảnh hưởng đến hệ thống. Bạn có chắc chắn?');" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1" title="Xóa quyền">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </li>
                            @empty
                                <li class="text-sm text-slate-500 italic">Không có quyền nào trong nhóm này.</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Modal Tạo Vai Trò -->
    <div x-show="showRoleModal" style="display: none;" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
        <div @click.away="showRoleModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Thêm Vai Trò Mới</h3>
                <button type="button" @click="showRoleModal = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-200 p-1.5 rounded-lg transition-colors outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Tên Vai Trò</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border-slate-200 rounded-xl shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm px-4 py-3 bg-slate-50 focus:bg-white transition-colors"
                        placeholder="Ví dụ: Kế toán, Quản lý kho, Hỗ trợ...">
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showRoleModal = false"
                        class="px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 hover:text-slate-900 transition-colors">
                        Hủy
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-teal-600 text-white rounded-xl font-bold shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all">
                        Lưu Vai Trò
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tạo Quyền -->
    <div x-show="showPermissionModal" style="display: none;" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
        <div @click.away="showPermissionModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Thêm Quyền Mới</h3>
                <button type="button" @click="showPermissionModal = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-200 p-1.5 rounded-lg transition-colors outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.permissions.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <label for="permission_name" class="block text-sm font-bold text-slate-700 mb-2">Tên Quyền</label>
                    <input type="text" name="name" id="permission_name" required
                        class="w-full border-slate-200 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-slate-50 focus:bg-white transition-colors"
                        placeholder="Ví dụ: Xem báo cáo, Quản lý nhân sự...">
                    <p class="mt-2 text-xs text-slate-500">Quyền mới sẽ tự động được thêm vào nhóm "Khác". Bạn có thể gán quyền này cho các vai trò ở tab Vai trò.</p>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showPermissionModal = false"
                        class="px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 hover:text-slate-900 transition-colors">
                        Hủy
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                        Lưu Quyền
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
