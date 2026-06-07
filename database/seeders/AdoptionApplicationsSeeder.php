<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdoptionApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = cache()->get('admin_id');
        $userIds = cache()->get('user_ids');
        $petIds  = cache()->get('pet_ids');
        $slotIds = cache()->get('slot_ids');

        // Đơn 1: pending – User 1 muốn nhận Miu (mèo Anh lông ngắn, san_sang)
        $don1Id = Str::uuid()->toString();
        DB::table('adoption_applications')->insert([
            'Ma_don'          => $don1Id,
            'Ma_nguoi_dung'   => $userIds[0],
            'Ma_thu_cung'     => $petIds['PET-006'],
            'Ho_ten'          => 'Nguyễn Thị Lan',
            'So_dien_thoai'   => '0912345678',
            'Dia_chi'         => '12 Nguyễn Trãi, Thanh Xuân, Hà Nội',
            'Nghe_nghiep'     => 'Nhân viên văn phòng',
            'Loai_nha_o'      => 'Chung cư (có ban công)',
            'Kinh_nghiem'     => 'Đã từng nuôi mèo 3 năm trước khi bé qua đời vì tuổi già',
            'Ly_do_nhan_nuoi' => 'Tôi yêu thú cưng và muốn mang lại ngôi nhà ấm áp cho Miu. Tôi hiểu rõ cách chăm sóc mèo và sẵn sàng dành thời gian cho bé.',
            'Cam_ket'         => true,
            'Trang_thai'      => 'pending',
            'Ghi_chu_admin'   => null,
            'Ngay_tao'        => now(),
            'Ngay_cap_nhat'   => now(),
        ]);

        // Đơn 2: pending – User 2 muốn nhận Bông (Poodle, san_sang)
        $don2Id = Str::uuid()->toString();
        DB::table('adoption_applications')->insert([
            'Ma_don'          => $don2Id,
            'Ma_nguoi_dung'   => $userIds[1],
            'Ma_thu_cung'     => $petIds['PET-001'],
            'Ho_ten'          => 'Trần Văn Minh',
            'So_dien_thoai'   => '0923456789',
            'Dia_chi'         => '56 Đội Cấn, Ba Đình, Hà Nội',
            'Nghe_nghiep'     => 'Kỹ sư phần mềm',
            'Loai_nha_o'      => 'Nhà riêng (có sân)',
            'Kinh_nghiem'     => 'Chưa từng nuôi thú cưng nhưng đã nghiên cứu kỹ về Poodle',
            'Ly_do_nhan_nuoi' => 'Gia đình tôi muốn có một người bạn đồng hành. Chúng tôi có sân rộng và nhiều thời gian cho bé vui chơi.',
            'Cam_ket'         => true,
            'Trang_thai'      => 'pending',
            'Ghi_chu_admin'   => null,
            'Ngay_tao'        => now()->subDays(2),
            'Ngay_cap_nhat'   => now()->subDays(2),
        ]);

        // Đơn 3: pre_approved – User 3 muốn nhận Corgi Cam, đã duyệt sơ bộ, có lịch phỏng vấn
        $don3Id = Str::uuid()->toString();
        DB::table('adoption_applications')->insert([
            'Ma_don'          => $don3Id,
            'Ma_nguoi_dung'   => $userIds[2],
            'Ma_thu_cung'     => $petIds['PET-002'],
            'Ho_ten'          => 'Lê Phương Anh',
            'So_dien_thoai'   => '0934567890',
            'Dia_chi'         => '89 Lê Văn Lương, Thanh Xuân, Hà Nội',
            'Nghe_nghiep'     => 'Giáo viên',
            'Loai_nha_o'      => 'Nhà riêng (2 tầng)',
            'Kinh_nghiem'     => 'Đã nuôi chó Golden 5 năm, có kinh nghiệm chăm sóc chó cỡ vừa và lớn',
            'Ly_do_nhan_nuoi' => 'Tôi sống một mình và muốn có người bạn đồng hành. Corgi rất phù hợp với lối sống năng động của tôi.',
            'Cam_ket'         => true,
            'Trang_thai'      => 'approved',
            'Ghi_chu_admin'   => 'Hồ sơ tốt, đủ điều kiện phỏng vấn. Người đăng ký có kinh nghiệm nuôi chó.',
            'Ngay_tao'        => now()->subDays(5),
            'Ngay_cap_nhat'   => now()->subDays(1),
        ]);

        // Tạo lịch phỏng vấn cho Đơn 3 (trạng thái cho_xac_nhan_don – chờ User chọn slot)
        DB::table('interview_schedules')->insert([
            'Ma_lich'              => Str::uuid()->toString(),
            'Ma_don'               => $don3Id,
            'Ma_slot'              => null, // Chưa chọn slot
            'Loai_lich'            => null,
            'Thoi_gian_du_kien'    => null,
            'Thoi_gian_xac_nhan'   => null,
            'Nhan_vien_xu_ly'      => $adminId,
            'Trang_thai'           => 'cho_xac_nhan_don',
            'Email_da_gui'         => true, // Đã gửi email kèm link chọn slot
            'Ghi_chu'              => 'Đã gửi email chọn slot ngày ' . now()->subDays(1)->format('d/m/Y'),
            'Ngay_tao'             => now()->subDays(1),
            'Ngay_cap_nhat'        => now()->subDays(1),
        ]);

        // Generate 150 random adoption applications over the last 6 months
        $faker = \Faker\Factory::create('vi_VN');
        $randomUserIds = cache()->get('user_ids');
        $randomPetIds = cache()->get('random_pet_ids', []);
        $trangThaiOptions = ['pending', 'approved', 'cho_phong_van', 'completed', 'rejected'];
        
        $totalItems = 150;
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
            $ngayTao = \Carbon\Carbon::createFromTimestamp(mt_rand($start->timestamp, $end->timestamp));
            
            $petId = $faker->randomElement($randomPetIds);
            $userId = $faker->randomElement($randomUserIds);
            $trangThai = $faker->randomElement($trangThaiOptions);

            $maDon = Str::uuid()->toString();
            $application = [
                'Ma_don'          => $maDon,
                'Ma_nguoi_dung'   => $userId,
                'Ma_thu_cung'     => $petId,
                'Ho_ten'          => $faker->name,
                'So_dien_thoai'   => $faker->numerify('09########'),
                'Dia_chi'         => $faker->address,
                'Nghe_nghiep'     => $faker->jobTitle,
                'Loai_nha_o'      => $faker->randomElement(['Chung cư', 'Nhà riêng', 'Nhà thuê']),
                'Kinh_nghiem'     => $faker->boolean(70) ? 'Đã từng nuôi thú cưng' : 'Chưa có kinh nghiệm',
                'Ly_do_nhan_nuoi' => $faker->sentence,
                'Cam_ket'         => true,
                'Trang_thai'      => $trangThai,
                'Ghi_chu_admin'   => $faker->boolean(30) ? $faker->sentence : null,
                'Ngay_tao'        => $ngayTao->format('Y-m-d H:i:s'),
                'Ngay_cap_nhat'   => $ngayTao->format('Y-m-d H:i:s'),
            ];

            DB::table('adoption_applications')->insert($application);
            
            // Randomly generate an interview schedule
            if (in_array($trangThai, ['approved', 'cho_phong_van', 'completed', 'rejected'])) {
                // If rejected, 50% chance it was rejected after an interview
                if ($trangThai === 'rejected' && !$faker->boolean(50)) {
                    continue; 
                }

                $thoiGianDuKien = (clone $ngayTao)->modify('+' . $faker->numberBetween(1, 5) . ' days');
                
                $ketQuaPhongVan = null;
                $trangThaiLich = 'cho_xac_nhan_don';
                
                if (in_array($trangThai, ['completed', 'approved'])) {
                    $ketQuaPhongVan = 'dat';
                    $trangThaiLich = 'da_xac_nhan';
                } elseif ($trangThai === 'rejected') {
                    $ketQuaPhongVan = $faker->randomElement(['tu_choi', 'vang_mat']);
                    $trangThaiLich = 'da_xac_nhan'; // Finished interview with failed result
                }

                DB::table('interview_schedules')->insert([
                    'Ma_lich'              => Str::uuid()->toString(),
                    'Ma_don'               => $maDon,
                    'Ma_slot'              => null,
                    'Loai_lich'            => $faker->randomElement(['slot_co_dinh', 'lich_khac']),
                    'Thoi_gian_du_kien'    => $thoiGianDuKien->format('Y-m-d H:i:s'),
                    'Thoi_gian_xac_nhan'   => $thoiGianDuKien->format('Y-m-d H:i:s'),
                    'Nhan_vien_xu_ly'      => $adminId,
                    'Trang_thai'           => $trangThaiLich,
                    'Ket_qua_phong_van'    => $ketQuaPhongVan,
                    'Email_da_gui'         => true,
                    'Ghi_chu'              => $faker->sentence,
                    'Ngay_tao'             => $ngayTao->format('Y-m-d H:i:s'),
                    'Ngay_cap_nhat'        => $ngayTao->format('Y-m-d H:i:s'),
                ]);
            }
        }

        $this->command->info('✅ AdoptionApplicationsSeeder hoàn thành: Đơn cố định + 150 đơn ngẫu nhiên.');
    }
}
