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

        // ─── 1. Định nghĩa 40 permissions mới theo chuẩn module.action ────────────
        $permissions = [
            // Dashboard
            'dashboard.view',

            // Thú cưng
            'pets.view',
            'pets.create',
            'pets.edit',
            'pets.delete',
            'pets.export',
            'pets.notes',
            'pets.health',
            'pets.rescue',

            // Đơn nhận nuôi
            'adoptions.view',
            'adoptions.create',
            'adoptions.review',
            'adoptions.complete',
            'adoptions.edit_info',
            'adoptions.add_note',
            'adoptions.delete',
            'adoptions.export',

            // Lịch phỏng vấn
            'interviews.view',
            'interviews.create',
            'interviews.delete',
            'interviews.update_result',
            'interviews.assign',

            // Ủng hộ
            'donations.view',
            'donations.statistics',
            'donations.export',

            // Chiến dịch gây quỹ
            'campaigns.view',
            'campaigns.create',
            'campaigns.edit',
            'campaigns.close',
            'campaigns.export',

            // Bài viết
            'posts.view',
            'posts.create',
            'posts.edit',
            'posts.delete',
            'posts.export',

            // Khách hàng (client)
            'clients.view',
            'clients.toggle_status',
            'clients.export',

            // Nhân viên (staff management) - chỉ admin
            'staff.view',
            'staff.create',
            'staff.edit',
            'staff.toggle_status',
            'staff.assign_permissions',

            // Cài đặt hệ thống
            'settings.view',
            'settings.edit',
        ];

        // Xóa permissions cũ không còn dùng (bao gồm 7 permissions thô cũ)
        Permission::whereNotIn('name', $permissions)->delete();

        // Tạo permissions mới nếu chưa tồn tại
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Reset cache sau khi tạo permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ─── 2. Tạo/Cập nhật Roles hệ thống ─────────────────────────────────────

        // Admin: toàn quyền
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'mo_ta' => 'Quản trị viên hệ thống, có toàn quyền cấu hình và quản lý dữ liệu.',
                'la_vai_tro_he_thong' => true,
            ]
        );
        $adminRole->update([
            'mo_ta' => 'Quản trị viên hệ thống, có toàn quyền cấu hình và quản lý dữ liệu.',
            'la_vai_tro_he_thong' => true,
        ]);
        // Admin luôn có tất cả permissions
        $adminRole->syncPermissions(Permission::all());

        // Staff: bắt đầu không có permissions - admin sẽ cấp thủ công
        $staffRole = Role::firstOrCreate(
            ['name' => 'staff'],
            [
                'mo_ta' => 'Nhân viên — chỉ có quyền được admin cấp cho từng cá nhân.',
                'la_vai_tro_he_thong' => true,
            ]
        );
        $staffRole->update([
            'mo_ta' => 'Nhân viên — chỉ có quyền được admin cấp cho từng cá nhân.',
            'la_vai_tro_he_thong' => true,
        ]);
        // Staff role không có permissions mặc định — phân quyền trực tiếp cho từng user
        $staffRole->syncPermissions([]);

        // Customer: khách hàng frontend, không có quyền admin
        $customerRole = Role::firstOrCreate(
            ['name' => 'customer'],
            [
                'mo_ta' => 'Khách hàng — có thể đăng ký nhận nuôi và quyên góp trên website.',
                'la_vai_tro_he_thong' => true,
            ]
        );
        $customerRole->update([
            'mo_ta' => 'Khách hàng — có thể đăng ký nhận nuôi và quyên góp trên website.',
            'la_vai_tro_he_thong' => true,
        ]);
        $customerRole->syncPermissions([]);

        // ─── 3. Gán role admin cho tài khoản mặc định ────────────────────────────
        $adminUser = \App\Models\User::where('Email', 'admin@petjam.vn')->first();
        if ($adminUser) {
            $adminUser->syncRoles(['admin']);
        }

        $this->command->info('✅ Đã seed ' . count($permissions) . ' permissions và 3 roles hệ thống.');
    }
}
