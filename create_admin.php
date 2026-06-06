<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Check if admin already exists
    $existingAdmin = User::where('Email', 'admin@petjam.vn')->first();
    if ($existingAdmin) {
        echo "Admin user already exists!\n";
        exit(0);
    }

    $admin = User::create([
        'Ma_nguoi_dung'    => Str::uuid()->toString(),
        'Ho_ten'           => 'Quản Trị Viên',
        'Email'            => 'admin@petjam.vn',
        'So_dien_thoai'    => '0901234567',
        'Mat_khau_hash'    => Hash::make('Admin@123456'),
        'Loai_tai_khoan'   => 'ca_nhan',
        'Trang_thai'       => 'hoat_dong',
        'Nguon_dang_ky'    => 'nhan_vien_tao',
        'Email_da_xac_thuc' => 1,
    ]);

    // Assign admin role
    $admin->assignRole('admin');
    
    echo "✓ Admin user created successfully!\n";
    echo "Email: admin@petjam.vn\n";
    echo "Password: Admin@123456\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
