<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Tạo Permissions
        $permissions = [
            'access_pets',      // Quản lý Thú cưng & Cứu hộ
            'access_adoptions', // Quản lý Đơn nhận nuôi
            'access_donations', // Quản lý Chiến dịch ủng hộ
            'access_posts',     // Quản lý Bài viết
            'access_users',     // Quản lý Người dùng
            'access_settings',  // Cài đặt hệ thống (Quyền & Vai trò, Cài đặt chung)
            'access_tokens',    // Quản lý AI Tokens
        ];

        // Xóa các permission cũ không còn dùng nữa
        Permission::whereNotIn('name', $permissions)->delete();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Tạo Roles và Gán Permissions
        // Admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // Staff (Nhân viên / Tình nguyện viên)
        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $staffRole->syncPermissions([
            'access_pets',
            'access_adoptions',
            'access_donations',
            'access_posts',
        ]);

        // Customer (Người dùng phổ thông - không cần quyền đặc biệt để thao tác basic)
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        
        // 3. Gán Role cho một số tài khoản mặc định (nếu có)
        // Lấy admin user hiện tại để gán quyền
        $adminUser = \App\Models\User::where('Loai_tai_khoan', 'admin')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}
