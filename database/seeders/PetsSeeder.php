<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PetsSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = cache()->get('admin_id');

        $pets = [
            // Chó
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-001',
                'Ten'            => 'Bông',
                'Loai'           => 'cho',
                'Giong'          => 'Poodle',
                'Nhom_tuoi'      => 'nho',
                'Can_nang'       => 3.5,
                'Gioi_tinh'      => 'cai',
                'Da_tiem_phong'  => false,
                'Da_triet_san'   => true,
                'Trang_thai'     => 'san_sang',
                'Vi_tri'         => 'noi_tru',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => true,
                'Than_thien_meo'   => false,
                'Che_do_an_dac_biet' => null,
                'Ngay_tiep_nhan' => '2026-04-10',
                'Phi_nhan_nuoi'  => 500000,
                'Noi_bat'        => true,
                'Mo_ta'          => 'Bông là bé Poodle trắng muốt, rất thân thiện và lanh lợi. Bé thích được vuốt ve và chơi đùa.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-002',
                'Ten'            => 'Corgi Cam',
                'Loai'           => 'cho',
                'Giong'          => 'Corgi Pembroke',
                'Nhom_tuoi'      => 'truong_thanh',
                'Can_nang'       => 12.0,
                'Gioi_tinh'      => 'duc',
                'Da_tiem_phong'  => true,
                'Da_triet_san'   => true,
                'Trang_thai'     => 'san_sang',
                'Vi_tri'         => 'noi_tru',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => true,
                'Than_thien_meo'   => true,
                'Che_do_an_dac_biet' => null,
                'Ngay_tiep_nhan' => '2026-03-20',
                'Phi_nhan_nuoi'  => 800000,
                'Noi_bat'        => true,
                'Mo_ta'          => 'Corgi Cam là bé rất năng động, thích chạy nhảy và vui chơi. Bé hợp với gia đình có trẻ em.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-003',
                'Ten'            => 'Phốc Đen',
                'Loai'           => 'cho',
                'Giong'          => 'Phốc sóc',
                'Nhom_tuoi'      => 'nho',
                'Can_nang'       => 2.8,
                'Gioi_tinh'      => 'duc',
                'Da_tiem_phong'  => false,
                'Da_triet_san'   => false,
                'Trang_thai'     => 'chua_san_sang',
                'Vi_tri'         => 'phong_kham',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => null,
                'Than_thien_meo'   => null,
                'Che_do_an_dac_biet' => 'Đang điều trị viêm da, cần thức ăn đặc biệt không có ngũ cốc',
                'Ngay_tiep_nhan' => '2026-05-15',
                'Phi_nhan_nuoi'  => 300000,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Phốc Đen đang được điều trị và sẽ sớm sẵn sàng cho nhận nuôi.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-004',
                'Ten'            => 'Husky Xám',
                'Loai'           => 'cho',
                'Giong'          => 'Siberian Husky',
                'Nhom_tuoi'      => 'truong_thanh',
                'Can_nang'       => 25.0,
                'Gioi_tinh'      => 'cai',
                'Da_tiem_phong'  => false,
                'Da_triet_san'   => false,
                'Trang_thai'     => 'san_sang',
                'Vi_tri'         => 'noi_tru',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => true,
                'Than_thien_meo'   => false,
                'Che_do_an_dac_biet' => 'Cần chế độ ăn cao protein, ít carb',
                'Ngay_tiep_nhan' => '2026-02-28',
                'Phi_nhan_nuoi'  => 1200000,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Husky Xám rất thông minh và năng động. Cần không gian rộng để vận động.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-005',
                'Ten'            => 'Golden Boy',
                'Loai'           => 'cho',
                'Giong'          => 'Golden Retriever',
                'Nhom_tuoi'      => 'truong_thanh',
                'Can_nang'       => 30.0,
                'Gioi_tinh'      => 'duc',
                'Da_tiem_phong'  => true,
                'Da_triet_san'   => true,
                'Trang_thai'     => 'da_nhan_nuoi',
                'Vi_tri'         => 'noi_tru',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => true,
                'Than_thien_meo'   => true,
                'Che_do_an_dac_biet' => null,
                'Ngay_tiep_nhan' => '2026-01-15',
                'Phi_nhan_nuoi'  => 1500000,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Golden Boy đã được nhận nuôi. Bé rất hiền lành và yêu trẻ em.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            // Mèo
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-006',
                'Ten'            => 'Miu',
                'Loai'           => 'meo',
                'Giong'          => 'Mèo Anh lông ngắn',
                'Nhom_tuoi'      => 'truong_thanh',
                'Can_nang'       => 4.5,
                'Gioi_tinh'      => 'cai',
                'Da_tiem_phong'  => true,
                'Da_triet_san'   => false,
                'Trang_thai'     => 'san_sang',
                'Vi_tri'         => 'noi_tru',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => false,
                'Than_thien_meo'   => true,
                'Che_do_an_dac_biet' => null,
                'Ngay_tiep_nhan' => '2026-03-01',
                'Phi_nhan_nuoi'  => 600000,
                'Noi_bat'        => true,
                'Mo_ta'          => 'Miu là cô nàng mèo Anh lông ngắn màu xám xanh, tính cách điềm tĩnh và sang trọng.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-007',
                'Ten'            => 'Chân Ngắn',
                'Loai'           => 'meo',
                'Giong'          => 'Munchkin',
                'Nhom_tuoi'      => 'nho',
                'Can_nang'       => 2.2,
                'Gioi_tinh'      => 'duc',
                'Da_tiem_phong'  => false,
                'Da_triet_san'   => false,
                'Trang_thai'     => 'chua_san_sang',
                'Vi_tri'         => 'phong_kham',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => null,
                'Than_thien_meo'   => true,
                'Che_do_an_dac_biet' => null,
                'Ngay_tiep_nhan' => '2026-05-20',
                'Phi_nhan_nuoi'  => 200000,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Chân Ngắn là bé Munchkin cực kỳ đáng yêu, đang được chăm sóc và tiêm chủng.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-008',
                'Ten'            => 'Maine Khổng Lồ',
                'Loai'           => 'meo',
                'Giong'          => 'Maine Coon',
                'Nhom_tuoi'      => 'gia',
                'Can_nang'       => 7.0,
                'Gioi_tinh'      => 'duc',
                'Da_tiem_phong'  => true,
                'Da_triet_san'   => true,
                'Trang_thai'     => 'san_sang',
                'Vi_tri'         => 'noi_tru',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => true,
                'Than_thien_meo'   => true,
                'Che_do_an_dac_biet' => 'Cần thức ăn dành cho mèo cao tuổi',
                'Ngay_tiep_nhan' => '2026-02-10',
                'Phi_nhan_nuoi'  => 900000,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Maine Khổng Lồ là bé mèo già, hiền hậu và thích cuộn tròn trên lòng người.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            // Khác
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-009',
                'Ten'            => 'Thỏ Trắng',
                'Loai'           => 'khac',
                'Giong'          => 'Thỏ Holland Lop',
                'Nhom_tuoi'      => 'nho',
                'Can_nang'       => 1.8,
                'Gioi_tinh'      => 'cai',
                'Da_tiem_phong'  => false,
                'Da_triet_san'   => false,
                'Trang_thai'     => 'chua_san_sang',
                'Vi_tri'         => 'phong_kham',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => false,
                'Than_thien_meo'   => false,
                'Che_do_an_dac_biet' => 'Ăn cỏ timothy và rau xanh, không ăn ngũ cốc',
                'Ngay_tiep_nhan' => '2026-05-28',
                'Phi_nhan_nuoi'  => 0,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Thỏ Trắng đang được cứu hộ và chăm sóc sức khỏe ban đầu.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
            [
                'Ma_thu_cung'    => Str::uuid()->toString(),
                'Ma_hien_thi'    => 'PET-010',
                'Ten'            => 'Ham Béo',
                'Loai'           => 'khac',
                'Giong'          => 'Hamster Syrian',
                'Nhom_tuoi'      => 'truong_thanh',
                'Can_nang'       => 0.15,
                'Gioi_tinh'      => 'duc',
                'Da_tiem_phong'  => false,
                'Da_triet_san'   => false,
                'Trang_thai'     => 'da_mat',
                'Vi_tri'         => 'phong_kham',
                'Than_thien_nguoi' => true,
                'Than_thien_cho'   => false,
                'Than_thien_meo'   => false,
                'Che_do_an_dac_biet' => null,
                'Ngay_tiep_nhan' => '2026-04-01',
                'Phi_nhan_nuoi'  => 0,
                'Noi_bat'        => false,
                'Mo_ta'          => 'Ham Béo đã không qua khỏi do sức khỏe yếu khi tiếp nhận.',
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
            ],
        ];

        $petIds = [];
        foreach ($pets as $pet) {
            $pet['Ngay_tao']       = now();
            $pet['Ngay_cap_nhat']  = now();
            DB::table('pets')->insert($pet);
            $petIds[$pet['Ma_hien_thi']] = $pet['Ma_thu_cung'];
        }

        cache()->put('pet_ids', $petIds, 600);

        // Generate 150 random pets over the last 6 months
        $faker = \Faker\Factory::create('vi_VN');
        $randomPetIds = [];
        $loaiOptions = ['cho', 'meo', 'khac'];
        $trangThaiOptions = ['chua_san_sang', 'san_sang', 'da_nhan_nuoi', 'da_mat'];
        $viTriOptions = ['noi_tru', 'phong_kham'];

        $totalItems = 150;
        for ($i = 0; $i < $totalItems; $i++) {
            $loai = $faker->randomElement($loaiOptions);
            $p = $i / $totalItems;
            if ($p < 0.05) { $monthsAgo = 5; }
            elseif ($p < 0.12) { $monthsAgo = 4; }
            elseif ($p < 0.22) { $monthsAgo = 3; }
            elseif ($p < 0.37) { $monthsAgo = 2; }
            elseif ($p < 0.62) { $monthsAgo = 1; }
            else { $monthsAgo = 0; }
            
            $start = now()->subMonthsNoOverflow($monthsAgo)->startOfMonth();
            $end = $monthsAgo == 0 ? now() : now()->subMonthsNoOverflow($monthsAgo)->endOfMonth();
            $ngayTiepNhan = \Carbon\Carbon::createFromTimestamp(mt_rand($start->timestamp, $end->timestamp));
            $mucPhi = $faker->boolean(70) ? $faker->numberBetween(10, 50) * 10000 : 0;
            
            $maThuCung = Str::uuid()->toString();
            $maHienThi = 'PET-' . str_pad($i + 11, 3, '0', STR_PAD_LEFT);
            
            $petData = [
                'Ma_thu_cung'    => $maThuCung,
                'Ma_hien_thi'    => $maHienThi,
                'Ten'            => $faker->firstName,
                'Loai'           => $loai,
                'Giong'          => $loai == 'cho' ? $faker->randomElement(['Poodle', 'Corgi', 'Husky', 'Golden', 'Phốc', 'Chó cỏ']) : ($loai == 'meo' ? $faker->randomElement(['Mèo Anh', 'Mèo ta', 'Munchkin', 'Maine Coon', 'Mèo Ba Tư']) : 'Khác'),
                'Nhom_tuoi'      => $faker->randomElement(['so_sinh', 'nho', 'truong_thanh', 'gia']),
                'Can_nang'       => $faker->randomFloat(1, 0.5, 30),
                'Gioi_tinh'      => $faker->randomElement(['duc', 'cai', 'chua_xac_dinh']),
                'Da_tiem_phong'  => $faker->boolean(70),
                'Da_triet_san'   => $faker->boolean(50),
                'Trang_thai'     => $faker->randomElement($trangThaiOptions),
                'Vi_tri'         => $faker->randomElement($viTriOptions),
                'Than_thien_nguoi' => $faker->boolean(80),
                'Than_thien_cho'   => $faker->boolean(60),
                'Than_thien_meo'   => $faker->boolean(50),
                'Che_do_an_dac_biet' => $faker->boolean(20) ? $faker->sentence : null,
                'Ngay_tiep_nhan' => $ngayTiepNhan->format('Y-m-d'),
                'Phi_nhan_nuoi'  => $faker->numberBetween(0, 20) * 100000,
                'Noi_bat'        => $faker->boolean(10),
                'Mo_ta'          => $faker->paragraph,
                'Nguoi_phu_trach' => $adminId,
                'Anh_dai_dien'   => null,
                'Ngay_tao'       => $ngayTiepNhan,
                'Ngay_cap_nhat'  => $ngayTiepNhan,
            ];

            DB::table('pets')->insert($petData);
            $randomPetIds[$maHienThi] = $maThuCung;
        }

        // Cập nhật lại cache pet_ids bao gồm cả pet mới
        $allPetIds = array_merge($petIds, $randomPetIds);
        cache()->put('pet_ids', $allPetIds, 600);
        // Lưu riêng danh sách id pet random để dùng cho các bảng random
        cache()->put('random_pet_ids', array_values($randomPetIds), 600);

        $this->command->info('✅ PetsSeeder hoàn thành: 10 thú cưng cố định + 150 thú cưng ngẫu nhiên.');
    }
}
