<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống Kê Tổng Quan (KPIs) - Trọng tâm vào Đơn Nhận Nuôi
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $kpiStats = [];
        $statuses = [
            'total' => ['label' => 'TỔNG ĐƠN', 'status' => null],
            'pending' => ['label' => 'ĐANG XỬ LÝ', 'status' => 'pending'],
            'approved' => ['label' => 'ĐÃ PHÊ DUYỆT', 'status' => 'approved'],
            'rejected' => ['label' => 'ĐÃ TỪ CHỐI', 'status' => 'rejected'],
            'completed' => ['label' => 'ĐÃ NHẬN NUÔI', 'status' => 'completed']
        ];

        foreach ($statuses as $key => $data) {
            $query = AdoptionApplication::query();
            if ($data['status']) {
                $query->where('Trang_thai', $data['status']);
            }
            
            $totalCount = (clone $query)->count();
            $currentCount = (clone $query)->whereYear('Ngay_tao', $currentYear)->whereMonth('Ngay_tao', $currentMonth)->count();
            $lastCount = (clone $query)->whereYear('Ngay_tao', $lastMonthYear)->whereMonth('Ngay_tao', $lastMonth)->count();

            $percentChange = $lastCount > 0 ? round((($currentCount - $lastCount) / $lastCount) * 100, 1) : ($currentCount > 0 ? 100 : 0);
            
            $kpiStats[$key] = [
                'label' => $data['label'],
                'count' => $totalCount,
                'percent' => $percentChange,
                'is_positive' => $percentChange >= 0
            ];
        }

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

        // 3. Dữ liệu Danh sách (Recent Applications)
        $recentApplications = AdoptionApplication::with(['thuCung', 'nguoiDung'])
                                ->orderBy('Ngay_tao', 'desc')
                                ->take(5)
                                ->get();

        return view('dashboard', compact(
            'kpiStats',
            'chartLabels', 'adoptionsTrendData', 'petBreakdownData',
            'recentApplications'
        ));
    }
}
