<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = cache()->get('role_admin_id');
        $userRoleId  = cache()->get('role_user_id');

        $users = [
            [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => 'Quản Trị Viên',
                'Email'            => 'admin@petjam.vn',
                'So_dien_thoai'    => '0901234567',
                'Mat_khau_hash'    => Hash::make('Admin@123456'),
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => 'nhan_vien_tao',
                'Email_da_xac_thuc' => true,
                'email_verified_at' => now(),
                'role'             => 'admin',
            ],
            [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => 'Nguyễn Thị Lan',
                'Email'            => 'nguyen.thi.lan@gmail.com',
                'So_dien_thoai'    => '0912345678',
                'Mat_khau_hash'    => Hash::make('User@123456'),
                'Ngay_sinh'        => '1995-03-15',
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => 'web',
                'Email_da_xac_thuc' => true,
                'email_verified_at' => now(),
                'role'             => 'user',
            ],
            [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => 'Trần Văn Minh',
                'Email'            => 'tran.van.minh@gmail.com',
                'So_dien_thoai'    => '0923456789',
                'Mat_khau_hash'    => Hash::make('User@123456'),
                'Ngay_sinh'        => '1990-07-22',
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => 'web',
                'Email_da_xac_thuc' => true,
                'email_verified_at' => now(),
                'role'             => 'user',
            ],
            [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => 'Lê Phương Anh',
                'Email'            => 'le.phuong.anh@gmail.com',
                'So_dien_thoai'    => '0934567890',
                'Mat_khau_hash'    => Hash::make('User@123456'),
                'Ngay_sinh'        => '1998-11-05',
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => 'web',
                'Email_da_xac_thuc' => true,
                'email_verified_at' => now(),
                'role'             => 'user',
            ],
            [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => 'Phạm Đức Long',
                'Email'            => 'pham.duc.long@gmail.com',
                'So_dien_thoai'    => '0945678901',
                'Mat_khau_hash'    => Hash::make('User@123456'),
                'Ngay_sinh'        => '1993-01-30',
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => 'web',
                'Email_da_xac_thuc' => true,
                'email_verified_at' => now(),
                'role'             => 'user',
            ],
            [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => 'Hoàng Thị Mai',
                'Email'            => 'hoang.thi.mai@gmail.com',
                'So_dien_thoai'    => '0956789012',
                'Mat_khau_hash'    => Hash::make('User@123456'),
                'Ngay_sinh'        => '2000-06-18',
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => 'web',
                'Email_da_xac_thuc' => true,
                'email_verified_at' => now(),
                'role'             => 'user',
            ],
        ];

        $userRoleMap = [];

        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']);

            DB::table('users')->insert($userData);

            // Gán vai trò qua Spatie
            $userModel = \App\Models\User::find($userData['Ma_nguoi_dung']);
            if ($role === 'admin') {
                $userModel->assignRole('admin');
            } else {
                $userModel->assignRole('customer');
            }

            $userRoleMap[$role][] = $userData['Ma_nguoi_dung'];
        }

        // Generate 50 random users over the last 6 months
        $faker = \Faker\Factory::create('vi_VN');
        $randomUsers = [];
        
        $totalItems = 50;
        for ($i = 0; $i < $totalItems; $i++) {
            $p = $i / $totalItems;
            if ($p < 0.05) { $monthsAgo = 5; }
            elseif ($p < 0.12) { $monthsAgo = 4; }
            elseif ($p < 0.22) { $monthsAgo = 3; }
            elseif ($p < 0.37) { $monthsAgo = 2; }
            elseif ($p < 0.62) { $monthsAgo = 1; }
            else { $monthsAgo = 0; }
            
            $start = now()->subMonthsNoOverflow($monthsAgo)->startOfMonth();
            $end = $monthsAgo == 0 ? now() : now()->subMonthsNoOverflow($monthsAgo)->endOfMonth();
            $createdAt = \Carbon\Carbon::createFromTimestamp(mt_rand($start->timestamp, $end->timestamp));
            
            $userData = [
                'Ma_nguoi_dung'    => Str::uuid()->toString(),
                'Ho_ten'           => $faker->name,
                'Email'            => $faker->unique()->safeEmail,
                'So_dien_thoai'    => $faker->numerify('09########'),
                'Mat_khau_hash'    => Hash::make('User@123456'),
                'Ngay_sinh'        => $faker->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
                'Loai_tai_khoan'   => 'ca_nhan',
                'Trang_thai'       => 'hoat_dong',
                'Nguon_dang_ky'    => $faker->randomElement(['web', 'ung_dung', 'nhan_vien_tao']),
                'Email_da_xac_thuc' => $faker->boolean(80),
                'email_verified_at' => $createdAt,
                'Ngay_tao'       => $createdAt,
                'Ngay_cap_nhat'       => $createdAt,
            ];

            DB::table('users')->insert($userData);
            
            $userModel = \App\Models\User::find($userData['Ma_nguoi_dung']);
            $userModel->assignRole('customer');
            
            $userRoleMap['user'][] = $userData['Ma_nguoi_dung'];
        }

        // Cache admin ID và user IDs để seeders khác dùng
        cache()->put('admin_id', $userRoleMap['admin'][0], 600);
        cache()->put('user_ids', $userRoleMap['user'], 600);

        $this->command->info('✅ UsersSeeder hoàn thành: 1 admin + 5 users cố định + 50 users ngẫu nhiên.');
    }
}
