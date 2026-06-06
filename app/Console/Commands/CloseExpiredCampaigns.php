<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DonationCampaign;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CloseExpiredCampaigns extends Command
{
    protected $signature = 'campaigns:close-expired';
    protected $description = 'Tự động đóng các chiến dịch quyên góp đã quá hạn ngày kết thúc';

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $expiredCampaigns = DonationCampaign::where('Trang_thai', 'active')
            ->whereNotNull('Ngay_ket_thuc')
            ->where('Ngay_ket_thuc', '<', $today)
            ->get();

        $count = 0;
        foreach ($expiredCampaigns as $campaign) {
            $campaign->update(['Trang_thai' => 'closed']);
            $count++;
        }

        $this->info("Đã đóng thành công {$count} chiến dịch quyên góp hết hạn.");
        Log::info("Cronjob campaigns:close-expired ran. Closed {$count} campaigns.");
    }
}
