<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DonationsSeeder extends Seeder
{
    public function run(): void
    {
        $userIds     = cache()->get('user_ids');
        $campaignIds = cache()->get('campaign_ids');

        $donations = [
            // Chiến dịch 1: Cứu hộ mùa mưa
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[0],
                'Ma_chien_dich'            => $campaignIds[0],
                'Ten_nguoi_ung_ho'         => 'Nguyễn Thị Lan',
                'An_danh'                  => false,
                'So_tien'                  => 500000,
                'Loi_nhan'                 => 'Chúc các bé mau khỏe mạnh!',
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '001',
                'Ma_giao_dich_vnpay'       => 'VNP20260510001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'VCB',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-05-10 09:30:00',
            ],
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[1],
                'Ma_chien_dich'            => $campaignIds[0],
                'Ten_nguoi_ung_ho'         => 'Ẩn danh',
                'An_danh'                  => true,
                'So_tien'                  => 1000000,
                'Loi_nhan'                 => 'Mong trung tâm luôn phát triển',
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '002',
                'Ma_giao_dich_vnpay'       => 'VNP20260511001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'TCB',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-05-11 14:20:00',
            ],
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[2],
                'Ma_chien_dich'            => $campaignIds[0],
                'Ten_nguoi_ung_ho'         => 'Lê Phương Anh',
                'An_danh'                  => false,
                'So_tien'                  => 200000,
                'Loi_nhan'                 => null,
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '003',
                'Ma_giao_dich_vnpay'       => 'VNP20260515001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'MB',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-05-15 10:00:00',
            ],
            // Giao dịch thất bại
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[3],
                'Ma_chien_dich'            => $campaignIds[0],
                'Ten_nguoi_ung_ho'         => 'Phạm Đức Long',
                'An_danh'                  => false,
                'So_tien'                  => 300000,
                'Loi_nhan'                 => null,
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '004',
                'Ma_giao_dich_vnpay'       => null,
                'Ma_phan_hoi_vnpay'        => '24',
                'Ma_ngan_hang'             => null,
                'Trang_thai'               => 'failed',
                'Thoi_diem_thanh_toan'     => null,
            ],
            // Chiến dịch 2: Tiêm chủng
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[0],
                'Ma_chien_dich'            => $campaignIds[1],
                'Ten_nguoi_ung_ho'         => 'Nguyễn Thị Lan',
                'An_danh'                  => false,
                'So_tien'                  => 350000,
                'Loi_nhan'                 => 'Tiêm đủ vắc-xin cho các bé nhé!',
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '005',
                'Ma_giao_dich_vnpay'       => 'VNP20260602001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'VCB',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-06-02 11:15:00',
            ],
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[4],
                'Ma_chien_dich'            => $campaignIds[1],
                'Ten_nguoi_ung_ho'         => 'Hoàng Thị Mai',
                'An_danh'                  => false,
                'So_tien'                  => 500000,
                'Loi_nhan'                 => 'Tôi yêu thú cưng!',
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '006',
                'Ma_giao_dich_vnpay'       => 'VNP20260603001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'ACB',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-06-03 16:45:00',
            ],
            // Chiến dịch 3: Khu vui chơi
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[1],
                'Ma_chien_dich'            => $campaignIds[2],
                'Ten_nguoi_ung_ho'         => 'Trần Văn Minh',
                'An_danh'                  => false,
                'So_tien'                  => 2000000,
                'Loi_nhan'                 => 'Xây dựng khu vui chơi thật đẹp cho các bé!',
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '007',
                'Ma_giao_dich_vnpay'       => 'VNP20260410001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'BIDV',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-04-10 08:00:00',
            ],
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => null,  // Khách vãng lai
                'Ma_chien_dich'            => $campaignIds[2],
                'Ten_nguoi_ung_ho'         => 'Ẩn danh',
                'An_danh'                  => true,
                'So_tien'                  => 3000000,
                'Loi_nhan'                 => 'Cố lên trung tâm!',
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '008',
                'Ma_giao_dich_vnpay'       => 'VNP20260420001',
                'Ma_phan_hoi_vnpay'        => '00',
                'Ma_ngan_hang'             => 'VCB',
                'Trang_thai'               => 'success',
                'Thoi_diem_thanh_toan'     => '2026-04-20 12:30:00',
            ],
            // Đơn đang xử lý (pending)
            [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userIds[2],
                'Ma_chien_dich'            => $campaignIds[0],
                'Ten_nguoi_ung_ho'         => 'Lê Phương Anh',
                'An_danh'                  => false,
                'So_tien'                  => 100000,
                'Loi_nhan'                 => null,
                'Ma_giao_dich_he_thong'    => 'PETJAM' . date('YmdHis') . '009',
                'Ma_giao_dich_vnpay'       => null,
                'Ma_phan_hoi_vnpay'        => null,
                'Ma_ngan_hang'             => null,
                'Trang_thai'               => 'pending',
                'Thoi_diem_thanh_toan'     => null,
            ],
        ];

        foreach ($donations as $donation) {
            $donation['Ngay_tao']      = now();
            $donation['Ngay_cap_nhat'] = now();
            DB::table('donations')->insert($donation);
        }

        // Generate 200 random donations over the last 6 months
        $faker = \Faker\Factory::create('vi_VN');
        $randomUserIds = cache()->get('user_ids');
        $allCampaignIds = cache()->get('campaign_ids');
        $bankOptions = ['VCB', 'TCB', 'MB', 'ACB', 'BIDV', 'VPB', 'VIB'];

        $totalItems = 200;
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
            
            $campaignId = $faker->randomElement($allCampaignIds);

            $isAnonymous = $faker->boolean(30);
            $userId = $faker->boolean(80) ? $faker->randomElement($randomUserIds) : null;
            
            $trangThaiOptions = ['success', 'success', 'success', 'failed', 'pending'];
            $trangThai = $faker->randomElement($trangThaiOptions);

            // Scale amounts significantly up over time to guarantee positive revenue KPI
            $minMultiplier = 1 + floor($p * 15); // ranges from 1 to 16
            $maxMultiplier = 5 + floor($p * 45); // ranges from 5 to 50
            $soTien = mt_rand($minMultiplier, $maxMultiplier) * 100000;

            $donation = [
                'Ma_ung_ho'                => Str::uuid()->toString(),
                'Ma_nguoi_dung'            => $userId,
                'Ma_chien_dich'            => $campaignId,
                'Ten_nguoi_ung_ho'         => $isAnonymous ? 'Ẩn danh' : $faker->name,
                'An_danh'                  => $isAnonymous,
                'So_tien'                  => $soTien,
                'Loi_nhan'                 => $faker->boolean(40) ? $faker->sentence : null,
                'Ma_giao_dich_he_thong'    => 'PETJAM' . $ngayTao->format('YmdHis') . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Ma_giao_dich_vnpay'       => $trangThai === 'success' ? 'VNP' . $ngayTao->format('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT) : null,
                'Ma_phan_hoi_vnpay'        => $trangThai === 'success' ? '00' : ($trangThai === 'failed' ? '24' : null),
                'Ma_ngan_hang'             => $trangThai === 'success' ? $faker->randomElement($bankOptions) : null,
                'Trang_thai'               => $trangThai,
                'Thoi_diem_thanh_toan'     => $trangThai === 'success' ? $ngayTao->format('Y-m-d H:i:s') : null,
                'Ngay_tao'                 => $ngayTao,
                'Ngay_cap_nhat'            => $ngayTao,
            ];

            DB::table('donations')->insert($donation);

            if ($trangThai === 'success') {
                DB::table('donation_campaigns')
                    ->where('Ma_chien_dich', $campaignId)
                    ->increment('So_tien_hien_tai', $soTien);
            }
        }

        $this->command->info('✅ DonationsSeeder hoàn thành: Giao dịch cố định + 200 giao dịch ngẫu nhiên.');
    }
}
