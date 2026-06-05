<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Phân Quyền & Vai Trò</h1>
            
            <button onclick="document.getElementById('createRoleModal').classList.remove('hidden')" class="btn-primary flex items-center gap-2 px-4 py-2 bg-orange-brand text-white rounded-lg hover:bg-orange-600 transition">
                <i data-lucide="plus" class="w-4 h-4"></i> Thêm Vai Trò Mới
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-600 p-4 rounded-lg border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="p-4 font-semibold text-slate-700 min-w-[200px]">Nhóm Quyền / Chức Năng</th>
                            @foreach($roles as $role)
                                <th class="p-4 font-semibold text-slate-700 text-center border-l border-slate-200">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="capitalize text-lg">{{ $role->name }}</span>
                                        <form action="{{ route('admin.roles.permissions.update', $role) }}" method="POST" id="form-role-{{ $role->id }}">
                                            @csrf
                                            <button type="submit" class="text-xs bg-slate-900 text-white px-3 py-1.5 rounded-md hover:bg-slate-700 transition">Lưu Quyền</button>
                                        </form>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($groupedPermissions as $groupName => $perms)
                            <tr class="bg-slate-100 border-b border-slate-200">
                                <td colspan="{{ count($roles) + 1 }}" class="p-3 font-bold text-slate-800">{{ $groupName }}</td>
                            </tr>
                            @foreach($perms as $permission)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="p-4 pl-8 text-slate-600 flex flex-col">
                                        <span class="font-medium text-slate-800">{{ $permission->name }}</span>
                                    </td>
                                    
                                    @foreach($roles as $role)
                                        <td class="p-4 text-center border-l border-slate-100">
                                            @if($role->name === 'admin')
                                                <!-- Admin luôn full quyền, hiển thị disabled checked -->
                                                <input type="checkbox" checked disabled class="w-5 h-5 rounded border-slate-300 text-slate-400 cursor-not-allowed">
                                                <input type="hidden" name="permissions[]" value="{{ $permission->name }}" form="form-role-{{ $role->id }}">
                                            @else
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->name }}" 
                                                       form="form-role-{{ $role->id }}"
                                                       {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                       class="w-5 h-5 rounded border-slate-300 text-orange-brand focus:ring-orange-brand cursor-pointer">
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
    <div id="createRoleModal" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold">Thêm Vai Trò Mới</h3>
                <button onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tên Vai Trò (Ký tự tiếng Anh/Số, VD: moderator, editor)</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-brand/20 focus:border-orange-brand outline-none transition-all">
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('createRoleModal').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-orange-brand text-white rounded-lg hover:bg-orange-600 transition">Tạo Vai Trò</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
