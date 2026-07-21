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

        // ─── 3. Tạo/Cập nhật Vai trò tùy chỉnh (Custom Preset Roles) ─────────────

        // Xóa toàn bộ vai trò tùy chỉnh cũ (la_vai_tro_he_thong = false)
        Role::where('la_vai_tro_he_thong', false)->each(function ($role) {
            $role->syncPermissions([]);
            $role->delete();
        });

        // Preset 1: Quản trị viên (IT Admin)
        // Chỉ có quyền nhân sự + cài đặt hệ thống. KHÔNG có dashboard, KHÔNG có posts.
        $roleQTV = Role::create([
            'name'               => 'Quản trị viên',
            'mo_ta'              => 'Quản lý tài khoản nhân viên và cài đặt hệ thống.',
            'la_vai_tro_he_thong' => false,
        ]);
        $roleQTV->syncPermissions([
            'staff.view', 'staff.create', 'staff.edit', 'staff.toggle_status', 'staff.assign_permissions',
            'settings.view', 'settings.edit',
        ]);

        // Preset 2: Nhân viên Cứu hộ & Y tế
        // Toàn quyền về hồ sơ thú cưng, bệnh án, cứu hộ.
        $roleYTe = Role::create([
            'name'               => 'Nhân viên Cứu hộ & Y tế',
            'mo_ta'              => 'Tiếp nhận thú cưng, ghi chép hồ sơ sức khỏe và thông tin cứu hộ.',
            'la_vai_tro_he_thong' => false,
        ]);
        $roleYTe->syncPermissions([
            'dashboard.view',
            'pets.view', 'pets.create', 'pets.edit', 'pets.notes', 'pets.health', 'pets.rescue',
        ]);

        // Preset 3: Nhân viên Xử lý Đơn
        // Toàn quyền xử lý đơn nhận nuôi (duyệt, từ chối, đóng đơn...).
        $roleDon = Role::create([
            'name'               => 'Nhân viên Xử lý Đơn',
            'mo_ta'              => 'Tiếp nhận, thẩm định và ra quyết định với các đơn đăng ký nhận nuôi.',
            'la_vai_tro_he_thong' => false,
        ]);
        $roleDon->syncPermissions([
            'dashboard.view',
            'adoptions.view', 'adoptions.create', 'adoptions.review',
            'adoptions.complete', 'adoptions.edit_info', 'adoptions.add_note', 'adoptions.delete',
        ]);

        // Preset 4: Nhân viên Phỏng vấn
        // Quản lý lịch phỏng vấn + xem đơn (chỉ đọc để nắm context).
        $rolePV = Role::create([
            'name'               => 'Nhân viên Phỏng vấn',
            'mo_ta'              => 'Sắp xếp lịch phỏng vấn, phân công và cập nhật kết quả buổi phỏng vấn.',
            'la_vai_tro_he_thong' => false,
        ]);
        $rolePV->syncPermissions([
            'dashboard.view',
            'adoptions.view',
            'interviews.view', 'interviews.create', 'interviews.delete',
            'interviews.update_result', 'interviews.assign',
        ]);

        // ─── 4. Gán role admin cho tài khoản mặc định ────────────────────────────
        $adminUser = \App\Models\User::where('Email', 'admin@petjam.vn')->first();
        if ($adminUser) {
            $adminUser->syncRoles(['admin']);
        }

        $this->command->info('✅ Đã seed ' . count($permissions) . ' permissions, 3 roles hệ thống và 4 vai trò tùy chỉnh.');
    }
}
