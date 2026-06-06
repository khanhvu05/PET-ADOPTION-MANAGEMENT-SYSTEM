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
        // 1. Thống Kê Tổng Quan (KPIs)
        $totalPets = Pet::count();
        $availablePets = Pet::where('Trang_thai', 'san_sang')->count();
        $petsPercent = $totalPets > 0 ? round(($availablePets / $totalPets) * 100, 1) : 0;

        $totalAdoptions = AdoptionApplication::count();
        $pendingAdoptions = AdoptionApplication::where('Trang_thai', 'pending')->count();
        // Assuming percent can be pending/total just for display
        $adoptionsPercent = $totalAdoptions > 0 ? round(($pendingAdoptions / $totalAdoptions) * 100, 1) : 0;

        $totalDonations = Donation::where('Trang_thai', 'success')->sum('So_tien');
        // Calculate recent donations (e.g. this month vs last month for trend)
        $thisMonthDonations = Donation::where('Trang_thai', 'success')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('So_tien');
        $donationsPercent = $totalDonations > 0 ? round(($thisMonthDonations / $totalDonations) * 100, 1) : 0;

        $totalUsers = User::count();
        $recentUsers = User::whereMonth('created_at', Carbon::now()->month)->count();
        $usersPercent = $totalUsers > 0 ? round(($recentUsers / $totalUsers) * 100, 1) : 0;

        // 2. Dữ liệu Biểu đồ (Charts)
        // Main Chart: Adoption Trends (Last 6 Months)
        $chartLabels = [];
        $adoptionsTrendData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartLabels[] = $month->format('M Y');
            
            $adoptionsTrendData[] = AdoptionApplication::whereYear('created_at', $month->year)
                                        ->whereMonth('created_at', $month->month)
                                        ->count();
        }

        // Doughnut Chart: Pet Breakdown
        $dogsCount = Pet::where('Loai', 'cho')->count();
        $catsCount = Pet::where('Loai', 'meo')->count();
        $othersCount = Pet::whereNotIn('Loai', ['cho', 'meo'])->count();
        $petBreakdownData = [$dogsCount, $catsCount, $othersCount];

        // 3. Dữ liệu Danh sách (Recent Applications)
        $recentApplications = AdoptionApplication::with(['thuCung', 'nguoiDung'])
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('dashboard', compact(
            'totalPets', 'availablePets', 'petsPercent',
            'totalAdoptions', 'pendingAdoptions', 'adoptionsPercent',
            'totalDonations', 'thisMonthDonations', 'donationsPercent',
            'totalUsers', 'recentUsers', 'usersPercent',
            'chartLabels', 'adoptionsTrendData', 'petBreakdownData',
            'recentApplications'
        ));
    }
}
