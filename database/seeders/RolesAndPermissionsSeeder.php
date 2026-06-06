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
            // M1 - Thú cưng & Cứu hộ
            'view pets',
            'manage pets',
            'delete pets',
            'manage rescue cases',
            'manage vaccination history',

            // M2 - Nhận nuôi
            'view any adoptions',
            'approve adoptions',
            'pre-approve adoptions',
            'manage interview slots',

            // M3 - Ủng hộ
            'manage campaigns',
            'view any donations',

            // M4 - Người dùng & Hệ thống
            'manage users',
            'manage roles',
            'view activity logs',

            // M5 - Chat AI & Tokens
            'view tokens',
            'manage tokens',

            // M6 - Bài viết
            'manage posts',

            // M7 - Cài đặt
            'manage settings',
        ];

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
            'view pets',
            'manage pets',
            'manage rescue cases',
            'manage vaccination history',
            'view any adoptions',
            'approve adoptions',
            'pre-approve adoptions',
            'manage interview slots',
            'manage posts',
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
