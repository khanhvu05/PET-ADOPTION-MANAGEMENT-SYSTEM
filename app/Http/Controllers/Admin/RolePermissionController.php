<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{

    public function updatePermissions(Request $request, Role $role)
    {
        $permissions = $request->input('permissions', []);
        
        // Đảm bảo các permission này tồn tại trong DB với guard 'web' để tránh lỗi Spatie cache hoặc thiếu DB
        foreach ($permissions as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        }

        // Xóa cache của Spatie để tránh lỗi PermissionDoesNotExist do cache cũ
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $role->syncPermissions($permissions);

        return back()->with('success', 'Đã cập nhật quyền thành công!');
    }

    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create(['name' => $validated['name']]);

        return back()->with('success', 'Đã tạo vai trò mới!');
    }

    public function destroyRole(Role $role)
    {
        if ($role->name === 'admin' || $role->name === 'staff') {
            return back()->with('error', 'Không thể xóa vai trò hệ thống (admin/staff).');
        }

        // Kiểm tra xem có user nào đang giữ role này không, nếu có thì không cho xoá (tuỳ logic)
        $usersCount = User::role($role->name)->count();
        if ($usersCount > 0) {
            return back()->with('error', "Không thể xóa vai trò đang được gán cho $usersCount người dùng. Vui lòng chuyển vai trò của họ trước.");
        }

        $role->delete();

        return back()->with('success', 'Đã xóa vai trò thành công!');
    }

    public function storePermission(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $validated['name']]);

        return back()->with('success', 'Đã thêm quyền mới!');
    }

    public function destroyPermission(Permission $permission)
    {
        $permission->delete();
        return back()->with('success', 'Đã xóa quyền thành công!');
    }
}
