<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$customRoles = [
    [
        'name' => 'Quản lý Đơn nhận nuôi',
        'mo_ta' => 'Chuyên xử lý, duyệt đơn nhận nuôi và sắp xếp lịch phỏng vấn.',
        'permissions' => [
            'dashboard.view',
            'adoptions.view', 'adoptions.create', 'adoptions.review', 'adoptions.complete', 'adoptions.edit_info', 'adoptions.add_note', 'adoptions.export',
            'interviews.view', 'interviews.create', 'interviews.update_result', 'interviews.assign',
            'pets.view', 'clients.view'
        ]
    ],
    [
        'name' => 'Quản lý Gây quỹ',
        'mo_ta' => 'Quản lý các chiến dịch quyên góp và theo dõi lịch sử ủng hộ.',
        'permissions' => [
            'dashboard.view',
            'donations.view', 'donations.statistics', 'donations.export',
            'campaigns.view', 'campaigns.create', 'campaigns.edit', 'campaigns.close', 'campaigns.export',
            'clients.view'
        ]
    ],
    [
        'name' => 'Biên tập viên',
        'mo_ta' => 'Quản lý và viết bài đăng tin tức trên website.',
        'permissions' => [
            'dashboard.view',
            'posts.view', 'posts.create', 'posts.edit', 'posts.delete', 'posts.export'
        ]
    ],
    [
        'name' => 'Chăm sóc Thú cưng',
        'mo_ta' => 'Quản lý thông tin, tình trạng sức khỏe và ghi chú cứu hộ của thú cưng.',
        'permissions' => [
            'dashboard.view',
            'pets.view', 'pets.create', 'pets.edit', 'pets.export', 'pets.notes', 'pets.health', 'pets.rescue'
        ]
    ]
];

foreach ($customRoles as $data) {
    // Check if role exists
    $role = Role::firstOrCreate(
        ['name' => $data['name']],
        [
            'mo_ta' => $data['mo_ta'],
            'la_vai_tro_he_thong' => false,
        ]
    );

    // Get permission models
    $perms = Permission::whereIn('name', $data['permissions'])->get();
    
    // Sync
    $role->syncPermissions($perms);
    echo "Created/Updated role: " . $data['name'] . " with " . $perms->count() . " permissions.\n";
}

// Reset cache
app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
echo "Done.";
