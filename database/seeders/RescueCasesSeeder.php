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

        $this->command->info('✅ RescueCasesSeeder hoàn thành: 10 ca cứu hộ + cập nhật Phi_nhan_nuoi.');
    }
}
