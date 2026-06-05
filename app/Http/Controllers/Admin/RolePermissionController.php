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
}
