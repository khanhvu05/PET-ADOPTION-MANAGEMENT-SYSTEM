<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Donation::query()->with(['nguoiDung', 'chienDich']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = ltrim($search, '#');
            $query->where(function($q) use ($search, $cleanSearch) {
                $q->where('Ma_ung_ho', 'like', "%{$cleanSearch}%")
                  ->orWhere('Ten_nguoi_ung_ho', 'like', "%{$search}%")
                  ->orWhere('Ma_giao_dich_he_thong', 'like', "%{$cleanSearch}%")
                  ->orWhereHas('nguoiDung', function($q) use ($search) {
                      $q->where('Email', 'like', "%{$search}%")
                        ->orWhere('Ho_ten', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        if ($request->filled('method') && $request->input('method') !== 'all') {
            // Assuming Ma_ngan_hang stores the method like VNPAY, MOMO
            $query->where('Ma_ngan_hang', $request->input('method'));
        }

        // Sorting
        $query->orderBy('Ngay_tao', 'desc');

        // Pagination
        $perPage = $request->get('per_page', 5);
        $donations = $query->paginate($perPage)->withQueryString();

        // Calculate KPIs
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $lastMonth = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;

        $stats = $this->getKpiStats($currentMonth, $currentYear, $lastMonth, $lastMonthYear);

        if ($request->ajax()) {
            return view('admin.donations.index', compact('donations', 'stats'))->render();
        }

        return view('admin.donations.index', compact('donations', 'stats'));
    }

    private function getKpiStats($cm, $cy, $lm, $ly)
    {
        $baseQuery = \App\Models\Donation::query();

        // Current Month
        $cmQuery = clone $baseQuery;
        $cmQuery->whereMonth('Ngay_tao', $cm)->whereYear('Ngay_tao', $cy);
        
        $cmTotalAmount = (clone $cmQuery)->where('Trang_thai', 'success')->sum('So_tien');
        $cmTotalTx = (clone $cmQuery)->count();
        $cmSuccess = (clone $cmQuery)->where('Trang_thai', 'success')->count();
        $cmPending = (clone $cmQuery)->where('Trang_thai', 'pending')->count();
        $cmFailed = (clone $cmQuery)->whereIn('Trang_thai', ['failed', 'expired'])->count();

        // Last Month
        $lmQuery = clone $baseQuery;
        $lmQuery->whereMonth('Ngay_tao', $lm)->whereYear('Ngay_tao', $ly);
        
        $lmTotalAmount = (clone $lmQuery)->where('Trang_thai', 'success')->sum('So_tien');
        $lmTotalTx = (clone $lmQuery)->count();
        $lmSuccess = (clone $lmQuery)->where('Trang_thai', 'success')->count();
        $lmPending = (clone $lmQuery)->where('Trang_thai', 'pending')->count();
        $lmFailed = (clone $lmQuery)->whereIn('Trang_thai', ['failed', 'expired'])->count();

        return [
            'total_amount' => [
                'value' => number_format($cmTotalAmount, 0, ',', '.'),
                'percent' => $this->calculateGrowth($cmTotalAmount, $lmTotalAmount)
            ],
            'total_tx' => [
                'value' => $cmTotalTx,
                'percent' => $this->calculateGrowth($cmTotalTx, $lmTotalTx)
            ],
            'success' => [
                'value' => $cmSuccess,
                'percent' => $this->calculateGrowth($cmSuccess, $lmSuccess)
            ],
            'pending' => [
                'value' => $cmPending,
                'percent' => $this->calculateGrowth($cmPending, $lmPending)
            ],
            'failed' => [
                'value' => $cmFailed,
                'percent' => $this->calculateGrowth($cmFailed, $lmFailed)
            ]
        ];
    }

    private function calculateGrowth($current, $last)
    {
        if ($last == 0) return $current > 0 ? 100 : 0;
        return round((($current - $last) / $last) * 100, 1);
    }

    public function show($id)
    {
        return view('admin.donations.show');
    }
}
