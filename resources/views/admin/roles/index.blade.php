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
            
            <!-- User profile header right mock -->
            <div class="flex items-center gap-4">
                <div class="relative">
                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-orange-500 rounded-full"></span>
                </div>
            </div>
        </div>
    </x-slot>

    @php
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
        ];
    @endphp

    <div class="space-y-6 max-w-[1400px] mx-auto pb-10">
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

        <!-- Tabs & Add Button -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-0">
            <div class="flex space-x-8">
                <a href="#" class="pb-3 border-b-2 border-orange-500 text-[15px] font-bold text-orange-600">Vai trò</a>
                <a href="#" class="pb-3 text-[15px] font-medium text-slate-500 hover:text-slate-800 transition-colors">Nhóm quyền</a>
            </div>
            
            <div class="pb-3">
                <button onclick="document.getElementById('createRoleModal').classList.remove('hidden')" class="flex items-center justify-center gap-2 px-5 py-2.5 bg-teal-600 text-white rounded-lg font-bold text-[14px] shadow-sm hover:bg-teal-700 transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Thêm vai trò mới
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden w-full">
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
                                                <!-- Custom user icon per role (simplified to one dynamic colored icon) -->
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            <div class="text-left">
                                                <div class="uppercase tracking-wide text-[13px] font-black text-slate-800">{{ $role->name }}</div>
                                                <div class="text-[12px] font-normal text-slate-500 mt-0.5">{{ $subtitle }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3 dots menu -->
                                    <div class="absolute top-4 right-4" x-data="{ open: false }" @click.away="open = false">
                                        <button @click="open = !open" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full p-1 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                                        </button>
                                        <div x-show="open" style="display: none;" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-slate-100 z-10 text-left py-1">
                                            <button type="submit" form="form-role-{{ $role->id }}" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-teal-600 font-medium">Lưu quyền</button>
                                            @if($role->name !== 'admin')
                                                <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium">Xóa vai trò</button>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('admin.roles.permissions.update', $role) }}" method="POST" id="form-role-{{ $role->id }}">
                                        @csrf
                                    </form>
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
                                        <div class="font-bold text-slate-800 text-[14px]">{{ trans('permissions.' . $permission->name) ?? ucfirst($permission->name) }}</div>
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
    </div>

    <!-- Modal Tạo Vai Trò -->
    <div id="createRoleModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Thêm Vai Trò Mới</h3>
                <button type="button" onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 hover:bg-slate-200 p-1.5 rounded-lg transition-colors outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Tên Vai Trò (Tiếng Anh, không dấu)</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border-slate-200 rounded-xl shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm px-4 py-3 bg-slate-50 focus:bg-white transition-colors"
                        placeholder="Ví dụ: manager, editor, support...">
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('createRoleModal').classList.add('hidden')"
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
</x-admin-layout>
