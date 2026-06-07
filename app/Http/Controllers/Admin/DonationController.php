<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Donation::query()->with(['nguoiDung', 'chienDich']);

        // Mặc định chỉ hiển thị giao dịch Thành Công
        $query->where('Trang_thai', 'success');

        // Lọc theo Method (VNPay)
        if ($request->filled('method') && $request->input('method') !== 'all') {
            $query->where('Ma_ngan_hang', $request->input('method'));
        }

        // Lọc theo khoảng thời gian (Date Range)
        if ($request->filled('date_range')) {
            $dates = explode(' to ', $request->date_range);
            if (count($dates) === 2) {
                try {
                    $fromDate = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
                    $toDate = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();
                    $query->whereBetween('Ngay_tao', [$fromDate, $toDate]);
                } catch (\Exception $e) {
                    // Bỏ qua nếu lỗi format
                }
            }
        }

        // Search: Xử lý tìm kiếm tiếng Việt không dấu bằng COLLATE utf8mb4_unicode_ci (MySQL)
        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = ltrim($search, '#');
            $query->where(function($q) use ($search, $cleanSearch) {
                $q->where('Ma_ung_ho', 'like', "%{$cleanSearch}%")
                  ->orWhereRaw('Ten_nguoi_ung_ho COLLATE utf8mb4_unicode_ci LIKE ?', ["%{$search}%"])
                  ->orWhere('Ma_giao_dich_he_thong', 'like', "%{$cleanSearch}%")
                  ->orWhereHas('nguoiDung', function($q) use ($search) {
                      $q->whereRaw('Email COLLATE utf8mb4_unicode_ci LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('Ho_ten COLLATE utf8mb4_unicode_ci LIKE ?', ["%{$search}%"]);
                  });
            });
        }

        // Sorting
        $query->orderBy('Ngay_tao', 'desc');

        // Xử lý Xuất Excel (CSV thuần)
        if ($request->has('export') && $request->export === 'excel') {
            return $this->exportExcel($query);
        }

        // Sorting
        $query->orderBy('Ngay_tao', 'desc');

        // Pagination
        $perPage = $request->get('per_page', 5);
        $donations = $query->paginate($perPage)->withQueryString();

        // Calculate KPIs
        $currentMonth = now()->month;
        $currentYear  = now()->year;
        $lastMonth     = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;

        $stats = $this->getKpiStats($currentMonth, $currentYear, $lastMonth, $lastMonthYear);

        if ($request->ajax()) {
            return view('admin.donations.index', compact('donations', 'stats'))->render();
        }

        return view('admin.donations.index', compact('donations', 'stats'));
    }

    /**
     * Show detailed view of a donation.
     */
    public function show($id)
    {
        $donation = Donation::with(['nguoiDung', 'chienDich'])->findOrFail($id);
        return view('admin.donations.show', compact('donation'));
    }
    /**
     * Xuất dữ liệu ra file CSV
     */
    private function exportExcel($query)
    {
        $donations = $query->get();
        $filename = "DS_QuyenGop_" . now()->format('Ymd_His') . ".xlsx";

        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::streamDownload($filename);

        foreach ($donations as $donation) {
            $name = $donation->An_danh ? 'Ẩn danh' : ($donation->Ten_nguoi_ung_ho ?? ($donation->nguoiDung->Ho_ten ?? ''));
            $email = !$donation->An_danh ? ($donation->nguoiDung->Email ?? '') : '';
            
            $writer->addRow([
                'Mã GD' => $donation->Ma_ung_ho,
                'Mã Hệ Thống' => $donation->Ma_giao_dich_he_thong ?? '',
                'Người Ủng Hộ' => $name,
                'Email' => $email,
                'Số Tiền' => $donation->So_tien,
                'Phương Thức' => $donation->Ma_ngan_hang ?? 'VNPay',
                'Mục Đích' => $donation->Loi_nhan ?? 'Không',
                'Thời Gian' => $donation->Ngay_tao->format('d/m/Y H:i:s'),
                'Trạng Thái' => $donation->Trang_thai
            ]);
        }

        return $writer->toBrowser();
    }
    /**
     * Trang thống kê quyên góp (UC06)
     */
    public function statistics(Request $request)
    {
        $year = $request->get('year', now()->year);

        // --- KPI tổng hợp ---
        $totalAmount  = Donation::where('Trang_thai', 'success')->sum('So_tien');
        $totalTx      = Donation::where('Trang_thai', 'success')->count();
        $uniqueDonors = Donation::where('Trang_thai', 'success')
                            ->whereNotNull('Ma_nguoi_dung')
                            ->distinct('Ma_nguoi_dung')
                            ->count('Ma_nguoi_dung');
        $avgAmount    = $totalTx > 0 ? round($totalAmount / $totalTx) : 0;

        // --- Biểu đồ xu hướng theo tháng (Line chart) ---
        $monthlyRaw = Donation::where('Trang_thai', 'success')
            ->whereYear('Ngay_tao', $year)
            ->select(
                DB::raw('MONTH(Ngay_tao) as month'),
                DB::raw('SUM(So_tien) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('MONTH(Ngay_tao)'))
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $monthlyLabels = [];
        $monthlyTotals = [];
        $monthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyLabels[] = 'Tháng ' . $m;
            $monthlyTotals[] = $monthlyRaw->has($m) ? (int) $monthlyRaw[$m]->total : 0;
            $monthlyCounts[] = $monthlyRaw->has($m) ? (int) $monthlyRaw[$m]->count : 0;
        }

        // --- Biểu đồ phân bổ theo chiến dịch (Doughnut chart) ---
        $campaignStats = Donation::where('Trang_thai', 'success')
            ->join('donation_campaigns', 'donations.Ma_chien_dich', '=', 'donation_campaigns.Ma_chien_dich')
            ->select(
                'donation_campaigns.Tieu_de',
                DB::raw('SUM(donations.So_tien) as total')
            )
            ->groupBy('donation_campaigns.Ma_chien_dich', 'donation_campaigns.Tieu_de')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        // Số tiền cho "Quỹ chung" (không gắn chiến dịch)
        $generalFundTotal = Donation::where('Trang_thai', 'success')
            ->whereNull('Ma_chien_dich')
            ->sum('So_tien');

        $campaignLabels = $campaignStats->pluck('Tieu_de')->toArray();
        $campaignTotals = $campaignStats->pluck('total')->map(fn($v) => (int) $v)->toArray();

        if ($generalFundTotal > 0) {
            $campaignLabels[] = 'Quỹ chung';
            $campaignTotals[] = (int) $generalFundTotal;
        }

        // --- Danh sách năm có dữ liệu để chọn ---
        $availableYears = Donation::where('Trang_thai', 'success')
            ->selectRaw('YEAR(Ngay_tao) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();
        if (!in_array(now()->year, $availableYears)) {
            array_unshift($availableYears, now()->year);
        }

        // --- Top 5 nhà hảo tâm ---
        $topDonors = Donation::where('Trang_thai', 'success')
            ->select('Ten_nguoi_ung_ho', 'An_danh', DB::raw('SUM(So_tien) as total'), DB::raw('COUNT(*) as count'))
            ->groupBy('Ten_nguoi_ung_ho', 'An_danh')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.donations.statistics', compact(
            'totalAmount', 'totalTx', 'uniqueDonors', 'avgAmount',
            'monthlyLabels', 'monthlyTotals', 'monthlyCounts',
            'campaignLabels', 'campaignTotals',
            'availableYears', 'year', 'topDonors'
        ));
    }

    // ──────────────────────────────────────────
    //  Private Helpers
    // ──────────────────────────────────────────

    private function getKpiStats($cm, $cy, $lm, $ly)
    {
        $baseQuery = Donation::query();

        // Current Month
        $cmQuery = clone $baseQuery;
        $cmQuery->whereMonth('Ngay_tao', $cm)->whereYear('Ngay_tao', $cy);

        $cmTotalAmount = (clone $cmQuery)->where('Trang_thai', 'success')->sum('So_tien');
        $cmTotalTx     = (clone $cmQuery)->count();
        $cmSuccess     = (clone $cmQuery)->where('Trang_thai', 'success')->count();
        $cmPending     = (clone $cmQuery)->where('Trang_thai', 'pending')->count();
        $cmFailed      = (clone $cmQuery)->whereIn('Trang_thai', ['failed', 'expired'])->count();

        // Last Month
        $lmQuery = clone $baseQuery;
        $lmQuery->whereMonth('Ngay_tao', $lm)->whereYear('Ngay_tao', $ly);

        $lmTotalAmount = (clone $lmQuery)->where('Trang_thai', 'success')->sum('So_tien');
        $lmTotalTx     = (clone $lmQuery)->count();
        $lmSuccess     = (clone $lmQuery)->where('Trang_thai', 'success')->count();
        $lmPending     = (clone $lmQuery)->where('Trang_thai', 'pending')->count();
        $lmFailed      = (clone $lmQuery)->whereIn('Trang_thai', ['failed', 'expired'])->count();

        return [
            'total_amount' => [
                'value'   => number_format($cmTotalAmount, 0, ',', '.'),
                'percent' => $this->calculateGrowth($cmTotalAmount, $lmTotalAmount),
            ],
            'total_tx' => [
                'value'   => $cmTotalTx,
                'percent' => $this->calculateGrowth($cmTotalTx, $lmTotalTx),
            ],
            'success' => [
                'value'   => $cmSuccess,
                'percent' => $this->calculateGrowth($cmSuccess, $lmSuccess),
            ],
            'pending' => [
                'value'   => $cmPending,
                'percent' => $this->calculateGrowth($cmPending, $lmPending),
            ],
            'failed' => [
                'value'   => $cmFailed,
                'percent' => $this->calculateGrowth($cmFailed, $lmFailed),
            ],
        ];
    }

    private function calculateGrowth($current, $last)
    {
        if ($last == 0) return $current > 0 ? 100 : 0;
        return round((($current - $last) / $last) * 100, 1);
    }
}
