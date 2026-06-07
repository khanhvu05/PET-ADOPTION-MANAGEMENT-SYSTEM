<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RescueCasesSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = cache()->get('admin_id');
        $petIds  = cache()->get('pet_ids');

        $cases = [
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-001'],
                'Ngay_cuu_ho'     => '2026-04-09',
                'Dia_diem_cuu_ho' => 'Công viên Thống Nhất, Hà Nội',
                'Loai_cuu_ho'     => 'lang_thang',
                'Nguoi_bao_cao'   => 'Nguyễn Văn A (0901111222)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 200000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Bé ở tình trạng tốt, không bị thương.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-002'],
                'Ngay_cuu_ho'     => '2026-03-19',
                'Dia_diem_cuu_ho' => 'Quận Hoàn Kiếm, Hà Nội',
                'Loai_cuu_ho'     => 'bi_bo_roi',
                'Nguoi_bao_cao'   => 'Trần Thị B (0912333444)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 300000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Chủ cũ bỏ rơi khi chuyển nhà.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-003'],
                'Ngay_cuu_ho'     => '2026-05-14',
                'Dia_diem_cuu_ho' => 'Khu dân cư Mỹ Đình, Hà Nội',
                'Loai_cuu_ho'     => 'bi_nguoc_dai',
                'Nguoi_bao_cao'   => 'Lê Văn C (0923555666)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 150000,
                'Trang_thai_ca'   => 'dang_dieu_tri',
                'Ghi_chu'         => 'Bé bị viêm da do bị ngược đãi, đang điều trị.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-004'],
                'Ngay_cuu_ho'     => '2026-02-27',
                'Dia_diem_cuu_ho' => 'Đường Láng, Hà Nội',
                'Loai_cuu_ho'     => 'lac_duong',
                'Nguoi_bao_cao'   => 'Phạm Văn D (0934777888)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 500000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Husky bị lạc, đã kiểm tra chip nhưng không có thông tin chủ.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-005'],
                'Ngay_cuu_ho'     => '2026-01-14',
                'Dia_diem_cuu_ho' => 'Cầu Giấy, Hà Nội',
                'Loai_cuu_ho'     => 'bi_bo_roi',
                'Nguoi_bao_cao'   => 'Hoàng Thị E (0945999000)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 400000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Golden bị bỏ rơi trước cổng trung tâm.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-006'],
                'Ngay_cuu_ho'     => '2026-02-28',
                'Dia_diem_cuu_ho' => 'Chung cư Times City, Hà Nội',
                'Loai_cuu_ho'     => 'lang_thang',
                'Nguoi_bao_cao'   => 'Vũ Văn F (0956111222)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 250000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Mèo Anh lông ngắn đang đi lang thang trong khu chung cư.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-007'],
                'Ngay_cuu_ho'     => '2026-05-19',
                'Dia_diem_cuu_ho' => 'Chợ Hôm, Hà Nội',
                'Loai_cuu_ho'     => 'bi_bo_roi',
                'Nguoi_bao_cao'   => 'Đặng Thị G (0901222333)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 100000,
                'Trang_thai_ca'   => 'dang_dieu_tri',
                'Ghi_chu'         => 'Munchkin bị bỏ trong hộp trước cổng chợ.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-008'],
                'Ngay_cuu_ho'     => '2026-02-09',
                'Dia_diem_cuu_ho' => 'Ba Đình, Hà Nội',
                'Loai_cuu_ho'     => 'bi_bo_roi',
                'Nguoi_bao_cao'   => 'Nguyễn Thị H (0912333444)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 350000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Chủ cũ không nuôi được do dị ứng lông mèo.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-009'],
                'Ngay_cuu_ho'     => '2026-05-27',
                'Dia_diem_cuu_ho' => 'Đống Đa, Hà Nội',
                'Loai_cuu_ho'     => 'lang_thang',
                'Nguoi_bao_cao'   => 'Trần Văn I (0923444555)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 80000,
                'Trang_thai_ca'   => 'dang_xu_ly',
                'Ghi_chu'         => 'Thỏ đang được kiểm tra sức khỏe ban đầu.',
            ],
            [
                'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                'Ma_thu_cung'     => $petIds['PET-010'],
                'Ngay_cuu_ho'     => '2026-03-31',
                'Dia_diem_cuu_ho' => 'Hai Bà Trưng, Hà Nội',
                'Loai_cuu_ho'     => 'bi_bo_roi',
                'Nguoi_bao_cao'   => 'Lê Thị J (0934555666)',
                'Nguoi_thuc_hien' => $adminId,
                'Chi_phi_cuu_ho'  => 50000,
                'Trang_thai_ca'   => 'da_dong',
                'Ghi_chu'         => 'Hamster bị bỏ rơi trong tình trạng sức khỏe yếu.',
            ],
        ];

        foreach ($cases as $case) {
            $case['Ngay_tao'] = now();
            DB::table('rescue_cases')->insert($case);

            // Cộng chi phí cứu hộ vào Phi_nhan_nuoi của thú cưng
            DB::table('pets')
                ->where('Ma_thu_cung', $case['Ma_thu_cung'])
                ->increment('Phi_nhan_nuoi', $case['Chi_phi_cuu_ho']);
        }

        // Generate random rescue cases for 80% of the random pets
        $randomPetIds = cache()->get('random_pet_ids', []);
        $faker = \Faker\Factory::create('vi_VN');
        $loaiCuuHoOptions = ['lang_thang', 'bi_bo_roi', 'bi_nguoc_dai', 'lac_duong'];
        $trangThaiCaOptions = ['dang_xu_ly', 'dang_dieu_tri', 'da_dong'];

        foreach ($randomPetIds as $petId) {
            if ($faker->boolean(80)) {
                $chiPhi = $faker->numberBetween(1, 10) * 50000;
                $ngayCuuHo = $faker->dateTimeBetween('-6 months', 'now');
                
                $case = [
                    'Ma_ca_cuu_ho'    => Str::uuid()->toString(),
                    'Ma_thu_cung'     => $petId,
                    'Ngay_cuu_ho'     => $ngayCuuHo->format('Y-m-d'),
                    'Dia_diem_cuu_ho' => $faker->address,
                    'Loai_cuu_ho'     => $faker->randomElement($loaiCuuHoOptions),
                    'Nguoi_bao_cao'   => $faker->name . ' (' . $faker->numerify('09########') . ')',
                    'Nguoi_thuc_hien' => $adminId,
                    'Chi_phi_cuu_ho'  => $chiPhi,
                    'Trang_thai_ca'   => $faker->randomElement($trangThaiCaOptions),
                    'Ghi_chu'         => $faker->sentence,
                    'Ngay_tao'        => $ngayCuuHo,
                ];

                DB::table('rescue_cases')->insert($case);

                DB::table('pets')
                    ->where('Ma_thu_cung', $petId)
                    ->increment('Phi_nhan_nuoi', $chiPhi);
            }
        }

        $this->command->info('✅ RescueCasesSeeder hoàn thành: 10 ca cứu hộ cố định + ca cứu hộ ngẫu nhiên.');
    }
}
