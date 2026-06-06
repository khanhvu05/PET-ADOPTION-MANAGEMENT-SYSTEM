<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        
        // Group permissions logically for the UI based on SRS
        $groupedPermissions = [
            'M1 - Thú cưng & Cứu hộ' => $permissions->filter(fn($p) => in_array($p->name, ['view pets', 'manage pets', 'delete pets', 'manage rescue cases', 'manage vaccination history'])),
            'M2 - Nhận nuôi' => $permissions->filter(fn($p) => in_array($p->name, ['view any adoptions', 'approve adoptions', 'pre-approve adoptions', 'manage interview slots'])),
            'M3 - Ủng hộ' => $permissions->filter(fn($p) => in_array($p->name, ['manage campaigns', 'view any donations'])),
            'M4 - Người dùng & Phân quyền' => $permissions->filter(fn($p) => in_array($p->name, ['manage users', 'manage roles', 'view activity logs'])),
            'M5 - Trợ lý AI' => $permissions->filter(fn($p) => in_array($p->name, ['view tokens', 'manage tokens'])),
            'M6 - Bài viết' => $permissions->filter(fn($p) => in_array($p->name, ['manage posts'])),
            'M7 - Hệ thống' => $permissions->filter(fn($p) => in_array($p->name, ['manage settings'])),
            'M8 - Khác' => $permissions->filter(fn($p) => !in_array($p->name, [
                'view pets', 'manage pets', 'delete pets', 'manage rescue cases', 'manage vaccination history',
                'view any adoptions', 'approve adoptions', 'pre-approve adoptions', 'manage interview slots',
                'manage campaigns', 'view any donations',
                'manage users', 'manage roles', 'view activity logs',
                'view tokens', 'manage tokens',
                'manage posts',
                'manage settings'
            ])),
        ];

        return view('admin.roles.index', compact('roles', 'groupedPermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $permissions = $request->input('permissions', []);
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
