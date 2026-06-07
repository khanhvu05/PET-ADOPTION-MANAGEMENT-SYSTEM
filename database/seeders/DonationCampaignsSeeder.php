<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DonationCampaignsSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = [
            [
                'Ma_chien_dich'    => Str::uuid()->toString(),
                'Tieu_de'          => 'Cứu hộ mùa mưa 2026',
                'Mo_ta'            => 'Mùa mưa đến, hàng trăm thú cưng bị lạc hoặc bỏ rơi cần được cứu hộ và chăm sóc. Hãy cùng chúng tôi giúp đỡ các bé vượt qua mùa mưa này!',
                'Anh_dai_dien'     => null,
                'So_tien_muc_tieu' => 50000000,
                'So_tien_hien_tai' => 12500000,
                'Ngay_bat_dau'     => '2026-05-01',
                'Ngay_ket_thuc'    => '2026-08-31',
                'Trang_thai'       => 'active',
            ],
            [
                'Ma_chien_dich'    => Str::uuid()->toString(),
                'Tieu_de'          => 'Tiêm chủng cho các bé tháng 6',
                'Mo_ta'            => 'Giúp chúng tôi tiêm phòng đầy đủ cho các bé thú cưng đang được chăm sóc tại trung tâm. Mỗi đóng góp của bạn bảo vệ sức khỏe cho một sinh linh nhỏ bé.',
                'Anh_dai_dien'     => null,
                'So_tien_muc_tieu' => 20000000,
                'So_tien_hien_tai' => 8750000,
                'Ngay_bat_dau'     => '2026-06-01',
                'Ngay_ket_thuc'    => '2026-06-30',
                'Trang_thai'       => 'active',
            ],
            [
                'Ma_chien_dich'    => Str::uuid()->toString(),
                'Tieu_de'          => 'Xây dựng khu vui chơi cho thú cưng',
                'Mo_ta'            => 'Chúng tôi muốn xây dựng một khu vui chơi rộng rãi, an toàn và vui vẻ cho các bé tại trung tâm. Không có giới hạn thời gian – mỗi đóng góp đều có ý nghĩa!',
                'Anh_dai_dien'     => null,
                'So_tien_muc_tieu' => null, // Không giới hạn
                'So_tien_hien_tai' => 5000000,
                'Ngay_bat_dau'     => '2026-04-01',
                'Ngay_ket_thuc'    => null, // Không giới hạn thời gian
                'Trang_thai'       => 'active',
            ],
        ];

        $campaignIds = [];
        foreach ($campaigns as $campaign) {
            $campaign['Ngay_tao']      = now();
            $campaign['Ngay_cap_nhat'] = now();
            DB::table('donation_campaigns')->insert($campaign);
            $campaignIds[] = $campaign['Ma_chien_dich'];
        }

        cache()->put('campaign_ids', $campaignIds, 600);

        // Generate 10 random campaigns over the last 6 months
        $faker = \Faker\Factory::create('vi_VN');
        $randomCampaignIds = [];
        $campaignTitles = [
            'Cứu trợ mùa đông cho mèo hoang',
            'Chung tay xây nhà mới cho chó bị bỏ rơi',
            'Gây quỹ phẫu thuật cho thú cưng',
            'Hỗ trợ thức ăn cho trạm cứu hộ',
            'Chiến dịch triệt sản miễn phí',
            'Ủng hộ y tế cho các bé sơ sinh',
            'Mang mùa xuân đến cho thú cưng',
            'Sưởi ấm những đôi chân nhỏ',
            'Quỹ vắc-xin phòng bệnh dại',
            'Tiếp sức cho các tình nguyện viên',
            'Gây quỹ mái che mùa mưa',
            'Hỗ trợ chi phí đi lại cứu hộ'
        ];

        $totalItems = 10;
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
            $ngayBatDau = \Carbon\Carbon::createFromTimestamp(mt_rand($start->timestamp, $end->timestamp));
            
            $isCompleted = $faker->boolean(40);
            
            if ($isCompleted) {
                $ngayKetThuc = $faker->dateTimeBetween($ngayBatDau, 'now');
                $trangThai = 'closed';
            } else {
                $ngayKetThuc = $faker->boolean(70) ? $faker->dateTimeBetween('now', '+3 months') : null;
                $trangThai = 'active';
            }

            $maChienDich = Str::uuid()->toString();
            $campaign = [
                'Ma_chien_dich'    => $maChienDich,
                'Tieu_de'          => $faker->randomElement($campaignTitles) . ' ' . $faker->year(),
                'Mo_ta'            => $faker->realText(200),
                'Anh_dai_dien'     => null,
                'So_tien_muc_tieu' => $faker->randomElement([5000000, 10000000, 20000000, 50000000, 100000000]),
                'So_tien_hien_tai' => $faker->numberBetween(0, 50000000),
                'Ngay_bat_dau'     => $ngayBatDau->format('Y-m-d'),
                'Ngay_ket_thuc'    => $ngayKetThuc ? $ngayKetThuc->format('Y-m-d') : null,
                'Trang_thai'       => $trangThai,
                'Ngay_tao'         => $ngayBatDau->format('Y-m-d H:i:s'),
                'Ngay_cap_nhat'    => $ngayBatDau->format('Y-m-d H:i:s'),
            ];

            DB::table('donation_campaigns')->insert($campaign);
            $randomCampaignIds[] = $maChienDich;
        }

        $allCampaignIds = array_merge($campaignIds, $randomCampaignIds);
        cache()->put('campaign_ids', $allCampaignIds, 600);
        cache()->put('random_campaign_ids', $randomCampaignIds, 600);

        $this->command->info('✅ DonationCampaignsSeeder hoàn thành: 3 chiến dịch cố định + 10 chiến dịch ngẫu nhiên.');
    }
}
