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
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'mo_ta' => 'Quản trị viên hệ thống, có toàn quyền cấu hình và quản lý dữ liệu.',
                'la_vai_tro_he_thong' => true
            ]
        );
        $adminRole->update([
            'mo_ta' => 'Quản trị viên hệ thống, có toàn quyền cấu hình và quản lý dữ liệu.',
            'la_vai_tro_he_thong' => true
        ]);
        $adminRole->syncPermissions(Permission::all());

        // Staff (Nhân viên / Tình nguyện viên)
        $staffRole = Role::firstOrCreate(
            ['name' => 'staff'],
            [
                'mo_ta' => 'Nhân viên/Tình nguyện viên, thực hiện cứu hộ, chăm sóc và quản lý hồ sơ thú cưng, duyệt đơn.',
                'la_vai_tro_he_thong' => true
            ]
        );
        $staffRole->update([
            'mo_ta' => 'Nhân viên/Tình nguyện viên, thực hiện cứu hộ, chăm sóc và quản lý hồ sơ thú cưng, duyệt đơn.',
            'la_vai_tro_he_thong' => true
        ]);
        $staffRole->syncPermissions([
            'access_pets',
            'access_adoptions',
            'access_donations',
            'access_posts',
        ]);

        // Customer (Người dùng phổ thông - không cần quyền đặc biệt để thao tác basic)
        $customerRole = Role::firstOrCreate(
            ['name' => 'customer'],
            [
                'mo_ta' => 'Người dùng phổ thông, có thể đăng ký tài khoản, gửi đơn nhận nuôi và thực hiện quyên góp.',
                'la_vai_tro_he_thong' => true
            ]
        );
        $customerRole->update([
            'mo_ta' => 'Người dùng phổ thông, có thể đăng ký tài khoản, gửi đơn nhận nuôi và thực hiện quyên góp.',
            'la_vai_tro_he_thong' => true
        ]);
        
        // 3. Gán Role cho một số tài khoản mặc định (nếu có)
        // Lấy admin user hiện tại để gán quyền
        $adminUser = \App\Models\User::where('Email', 'admin@petjam.vn')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}
