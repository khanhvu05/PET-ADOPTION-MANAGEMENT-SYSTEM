<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use App\Models\Donation;
use App\Models\DonationCampaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống Kê Tổng Quan (KPIs) - Dữ liệu chung
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $kpiStats = [];

        $calcMetric = function($query, $isSum = false, $sumCol = '') use ($currentMonth, $currentYear, $lastMonth, $lastMonthYear) {
            if ($isSum) {
                $totalCurrent = (clone $query)->sum($sumCol);
                $newThisMonth = (clone $query)->whereYear('Ngay_tao', $currentYear)->whereMonth('Ngay_tao', $currentMonth)->sum($sumCol);
                $newLastMonth = (clone $query)->whereYear('Ngay_tao', $lastMonthYear)->whereMonth('Ngay_tao', $lastMonth)->sum($sumCol);
            } else {
                $totalCurrent = (clone $query)->count();
                $newThisMonth = (clone $query)->whereYear('Ngay_tao', $currentYear)->whereMonth('Ngay_tao', $currentMonth)->count();
                $newLastMonth = (clone $query)->whereYear('Ngay_tao', $lastMonthYear)->whereMonth('Ngay_tao', $lastMonth)->count();
            }
            
            if ($newLastMonth > 0) {
                $pct = round((($newThisMonth - $newLastMonth) / $newLastMonth) * 100, 1);
            } else {
                $pct = $newThisMonth > 0 ? 100 : 0;
            }
            return [$totalCurrent, $pct];
        };

        list($petsTotal, $petsPct) = $calcMetric(Pet::query());
        $kpiStats[] = ['label' => 'TỔNG THÚ CƯNG', 'count' => number_format($petsTotal), 'percent' => $petsPct, 'is_positive' => $petsPct >= 0];

        list($adoptionsTotal, $adoptionsPct) = $calcMetric(AdoptionApplication::query());
        $kpiStats[] = ['label' => 'ĐƠN NHẬN NUÔI', 'count' => number_format($adoptionsTotal), 'percent' => $adoptionsPct, 'is_positive' => $adoptionsPct >= 0];

        /* 
        list($donationsTotal, $donationsPct) = $calcMetric(Donation::where('Trang_thai', 'success'), true, 'So_tien');
        // Format without decimals for VND
        $kpiStats[] = ['label' => 'TỔNG QUYÊN GÓP', 'count' => number_format($donationsTotal, 0, ',', '.') . 'đ', 'percent' => $donationsPct, 'is_positive' => $donationsPct >= 0];

        list($campaignsTotal, $campaignsPct) = $calcMetric(DonationCampaign::query());
        $kpiStats[] = ['label' => 'CHIẾN DỊCH', 'count' => number_format($campaignsTotal), 'percent' => $campaignsPct, 'is_positive' => $campaignsPct >= 0];
        */

        list($usersTotal, $usersPct) = $calcMetric(User::query());
        $kpiStats[] = ['label' => 'NGƯỜI DÙNG', 'count' => number_format($usersTotal), 'percent' => $usersPct, 'is_positive' => $usersPct >= 0];

        // 2. Dữ liệu Biểu đồ (Charts)
        // Main Chart: Adoption Trends (Last 6 Months)
        $chartLabels = [];
        $adoptionsTrendData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartLabels[] = $month->format('M Y');
            
            $adoptionsTrendData[] = AdoptionApplication::whereYear('Ngay_tao', $month->year)
                                        ->whereMonth('Ngay_tao', $month->month)
                                        ->count();
        }

        // Doughnut Chart: Pet Breakdown
        $dogsCount = Pet::where('Loai', 'cho')->count();
        $catsCount = Pet::where('Loai', 'meo')->count();
        $othersCount = Pet::whereNotIn('Loai', ['cho', 'meo'])->count();
        $petBreakdownData = [$dogsCount, $catsCount, $othersCount];

        // Bar Chart: Top 5 Campaigns by Donation Amount
        $topCampaigns = DonationCampaign::orderBy('So_tien_hien_tai', 'desc')->take(5)->get();
        $campaignLabels = $topCampaigns->pluck('Tieu_de')->toArray();
        $campaignData = $topCampaigns->pluck('So_tien_hien_tai')->toArray();

        // 3. Dữ liệu Danh sách (Recent Applications)
        $recentApplications = AdoptionApplication::with(['thuCung', 'nguoiDung'])
                                ->orderBy('Ngay_tao', 'desc')
                                ->take(5)
                                ->get();

        return view('dashboard', compact(
            'kpiStats',
            'chartLabels', 'adoptionsTrendData', 'petBreakdownData',
            'campaignLabels', 'campaignData',
            'recentApplications'
        ));
    }
}
