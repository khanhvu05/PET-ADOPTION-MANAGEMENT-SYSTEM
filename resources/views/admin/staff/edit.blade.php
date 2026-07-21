<x-admin-layout>
    <x-slot name="header">
        <a href="{{ route('admin.staff.index') }}" class="hover:text-sidebar-blue transition-colors flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Quay lại
        </a>
        <svg class="w-4 h-4 mx-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-700 font-bold">Sửa Nhân Viên</span>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-1">Cập nhật Nhân Viên: {{ $staff->Ho_ten }}</h2>
            <p class="text-sm text-slate-500">Thay đổi thông tin và cập nhật quyền cho nhân viên.</p>
        </div>

        <form method="POST" action="{{ route('admin.staff.update', $staff->Ma_nguoi_dung) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Thông tin cơ bản -->
            <div class="bg-white border border-slate-200 rounded-xl shadow p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Thông tin tài khoản</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Họ tên <span class="text-red-500">*</span></label>
                        <input type="text" name="Ho_ten" value="{{ old('Ho_ten', $staff->Ho_ten) }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none @error('Ho_ten') border-red-500 @enderror">
                        @error('Ho_ten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email (Không thể thay đổi)</label>
                        <input type="email" value="{{ $staff->Email }}" disabled class="w-full px-4 py-2 border border-slate-200 bg-slate-50 text-slate-500 rounded-lg outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Mật khẩu mới (Để trống nếu không đổi)</label>
                        <input type="password" name="Mat_khau_hash" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none @error('Mat_khau_hash') border-red-500 @enderror">
                        @error('Mat_khau_hash') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Xác nhận mật khẩu mới</label>
                        <input type="password" name="Mat_khau_hash_confirmation" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Số điện thoại</label>
                        <input type="text" name="So_dien_thoai" value="{{ old('So_dien_thoai', $staff->So_dien_thoai) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Chức danh / Vai trò hiển thị</label>
                        <input type="text" name="Chuc_danh" value="{{ old('Chuc_danh', $staff->Chuc_danh) }}" placeholder="VD: Nhân viên quản lý đơn, Nhân viên chăm sóc thú cưng..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                        <p class="text-xs text-slate-400 mt-1">Tên vai trò cụ thể hiển thị trong danh sách nhân viên.</p>
                    </div>
                </div>
            </div>

            <!-- Phân quyền -->
            <div class="bg-white border border-slate-200 rounded-xl shadow p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Cấp quyền (Phân quyền RBAC)</h3>
                
                @if($staff->hasRole('admin'))
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mb-4 flex gap-3">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm">Người dùng này đang có vai trò <strong>Admin</strong>. Admin có toàn quyền truy cập hệ thống và bỏ qua mọi kiểm tra permission (thông qua Gate). Các thay đổi bên dưới sẽ được lưu nhưng không giới hạn được quyền lực thực sự của Admin.</p>
                    </div>
                @endif

                <div class="mb-6">
                    @php
                        // Determine if they currently have a custom role
                        $currentCustomRoleId = null;
                        foreach($staff->roles as $role) {
                            if(!$role->la_vai_tro_he_thong) {
                                $currentCustomRoleId = $role->id;
                                break;
                            }
                        }
                    @endphp
                    <label class="block text-sm font-medium text-slate-700 mb-2">Áp dụng mẫu vai trò (Preset Custom Role)</label>
                    <select name="custom_role_id" class="w-full md:w-1/2 px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                        <option value="">-- Không sử dụng mẫu (Chỉ định quyền thủ công bên dưới) --</option>
                        @foreach($customRoles as $role)
                            <option value="{{ $role->id }}" {{ (old('custom_role_id') ?? $currentCustomRoleId) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <h4 class="font-bold text-slate-800 mb-4 mt-6">Cấp quyền tùy chỉnh chi tiết</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($allPermissions as $module => $modulePermissions)
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
                                    class="mt-1 w-4 h-4 text-teal-600 rounded border-slate-300 focus:ring-teal-500 module-checkbox-{{ $module }}"
                                    {{ in_array($permission->name, old('permissions', $directPermissions)) ? 'checked' : '' }}>
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

            <!-- Submit -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.staff.index') }}" class="px-5 py-2.5 text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-xl transition font-medium">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition font-medium shadow-sm">Lưu Thay Đổi</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Map custom role IDs to their permissions
            const rolePermissionsMap = {
                @foreach($customRoles as $role)
                    "{{ $role->id }}": {!! json_encode($role->permissions->pluck('name')) !!},
                @endforeach
            };

            const roleSelect = document.querySelector('select[name="custom_role_id"]');
            const allPermissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
            const selectAllCheckboxes = document.querySelectorAll('.select-all-module');

            // Handle preset role selection
            roleSelect.addEventListener('change', function() {
                const selectedRoleId = this.value;
                
                // Uncheck all permissions first
                allPermissionCheckboxes.forEach(cb => cb.checked = false);

                if (selectedRoleId && rolePermissionsMap[selectedRoleId]) {
                    const permissionsToSelect = rolePermissionsMap[selectedRoleId];
                    
                    // Check the corresponding permissions
                    allPermissionCheckboxes.forEach(cb => {
                        if (permissionsToSelect.includes(cb.value)) {
                            cb.checked = true;
                        }
                    });
                }

                // Update "Select all" module checkboxes states
                updateSelectAllStates();
            });

            // Logic for "Select All" in create role modal
            selectAllCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let module = this.getAttribute('data-module');
                    let checkboxes = document.querySelectorAll('.module-checkbox-' + module);
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            });

            // Update individual module checkboxes change event to update "Select All" status
            allPermissionCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateSelectAllStates();
                });
            });

            function updateSelectAllStates() {
                selectAllCheckboxes.forEach(function(selectAll) {
                    let module = selectAll.getAttribute('data-module');
                    let all = document.querySelectorAll('.module-checkbox-' + module);
                    let checked = document.querySelectorAll('.module-checkbox-' + module + ':checked');
                    selectAll.checked = all.length > 0 && all.length === checked.length;
                    selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
                });
            }

            // Initialize select all states on load
            updateSelectAllStates();
        });
    </script>
    @endpush
</x-admin-layout>
