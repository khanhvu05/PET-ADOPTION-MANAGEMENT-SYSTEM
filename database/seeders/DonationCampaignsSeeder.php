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

        $this->command->info('✅ DonationCampaignsSeeder hoàn thành: 3 chiến dịch.');
    }
}
