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

        $calcMetric = function($query, $isSum = false, $sumCol = '') use ($currentMonth, $currentYear) {
            if ($isSum) {
                $totalCurrent = (clone $query)->sum($sumCol);
                $newThisMonth = (clone $query)->whereYear('Ngay_tao', $currentYear)->whereMonth('Ngay_tao', $currentMonth)->sum($sumCol);
            } else {
                $totalCurrent = (clone $query)->count();
                $newThisMonth = (clone $query)->whereYear('Ngay_tao', $currentYear)->whereMonth('Ngay_tao', $currentMonth)->count();
            }
            
            return [$totalCurrent, $newThisMonth];
        };

        list($petsTotal, $petsNew) = $calcMetric(Pet::query());
        $kpiStats[] = ['label' => 'TỔNG THÚ CƯNG', 'count' => number_format($petsTotal), 'new' => number_format($petsNew), 'is_positive' => true];

        list($adoptionsTotal, $adoptionsNew) = $calcMetric(AdoptionApplication::query());
        $kpiStats[] = ['label' => 'ĐƠN NHẬN NUÔI', 'count' => number_format($adoptionsTotal), 'new' => number_format($adoptionsNew), 'is_positive' => true];

        list($donationsTotal, $donationsNew) = $calcMetric(Donation::where('Trang_thai', 'success'), true, 'So_tien');
        // Format without decimals for VND
        $kpiStats[] = ['label' => 'TỔNG QUYÊN GÓP', 'count' => number_format($donationsTotal, 0, ',', '.') . 'đ', 'new' => number_format($donationsNew, 0, ',', '.') . 'đ', 'is_positive' => true];

        list($campaignsTotal, $campaignsNew) = $calcMetric(DonationCampaign::query());
        $kpiStats[] = ['label' => 'CHIẾN DỊCH', 'count' => number_format($campaignsTotal), 'new' => number_format($campaignsNew), 'is_positive' => true];

        list($usersTotal, $usersNew) = $calcMetric(User::query());
        $kpiStats[] = ['label' => 'NGƯỜI DÙNG', 'count' => number_format($usersTotal), 'new' => number_format($usersNew), 'is_positive' => true];

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
