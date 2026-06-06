<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Tổng Quan
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Phân Quyền</span>
    </x-slot>

    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Phân Quyền & Vai Trò</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Quản lý quyền hạn truy cập của các nhóm người dùng trong hệ thống</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('createRoleModal').classList.remove('hidden')" class="flex items-center justify-center gap-2 h-10 px-5 bg-teal-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-teal-700 transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Thêm Vai Trò Mới
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-100 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden mb-10 w-full">
            <div class="overflow-x-auto custom-scrollbar p-0">
                <table class="w-full text-left border-collapse min-w-[800px] whitespace-nowrap">
                    <thead>
                        <tr class="bg-teal-50">
                            <th class="py-4 px-6 text-[12px] font-bold uppercase tracking-wider text-teal-800 min-w-[250px] border-b border-slate-200">Nhóm Quyền / Chức Năng</th>
                            @foreach($roles as $role)
                                <th class="py-4 px-6 font-bold text-teal-800 text-center border-l border-slate-200 border-b border-slate-200">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="uppercase tracking-wider text-[12px] font-black">{{ $role->name }}</span>
                                        <form action="{{ route('admin.roles.permissions.update', $role) }}" method="POST" id="form-role-{{ $role->id }}">
                                            @csrf
                                            <button type="submit" class="text-[11px] font-bold bg-white text-teal-600 border border-teal-200 px-3 py-1.5 rounded-lg hover:bg-teal-50 hover:text-teal-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1">Lưu Quyền</button>
                                        </form>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($groupedPermissions as $groupName => $perms)
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <td colspan="{{ count($roles) + 1 }}" class="py-3 px-6 text-[13px] font-black uppercase text-slate-700 tracking-wide">{{ $groupName }}</td>
                            </tr>
                            @foreach($perms as $permission)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                    <td class="py-3 px-6 pl-10 text-slate-600 flex items-center h-full">
                                        <span class="font-bold text-slate-800 text-[13px]">{{ $permission->name }}</span>
                                    </td>
                                    
                                    @foreach($roles as $role)
                                        <td class="py-3 px-6 text-center border-l border-slate-100">
                                            @if($role->name === 'admin')
                                                <!-- Admin luôn full quyền, hiển thị disabled checked -->
                                                <input type="checkbox" checked disabled class="w-5 h-5 rounded border-slate-200 text-slate-300 bg-slate-100 cursor-not-allowed shadow-sm">
                                                <input type="hidden" name="permissions[]" value="{{ $permission->name }}" form="form-role-{{ $role->id }}">
                                            @else
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->name }}" 
                                                       form="form-role-{{ $role->id }}"
                                                       {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                       class="w-5 h-5 rounded border-slate-300 text-orange-500 focus:ring-orange-500 cursor-pointer shadow-sm transition-all hover:border-orange-400 bg-white">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tạo Vai Trò -->
    <div id="createRoleModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Thêm Vai Trò Mới</h3>
                <button type="button" onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-1.5 rounded-lg transition-colors outline-none focus:ring-2 focus:ring-slate-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tên Vai Trò</label>
                    <input type="text" name="name" required placeholder="VD: manager, editor..." class="w-full h-11 px-4 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-slate-900 placeholder-slate-400 transition-all shadow-sm">
                    <p class="text-xs text-slate-500 mt-2 font-medium">Chỉ sử dụng ký tự tiếng Anh không dấu, không khoảng trắng.</p>
                </div>
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-all shadow-sm focus:ring-2 focus:ring-slate-200 focus:outline-none">Hủy bỏ</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-xl transition-all shadow-sm focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:outline-none">Tạo Vai Trò</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Ensure escape key closes modal -->
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                document.getElementById('createRoleModal').classList.add('hidden');
            }
        });
    </script>
</x-admin-layout>
