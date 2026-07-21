<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Danh sách khách hàng (không có role admin/staff).
     */
    public function index(Request $request)
    {
        $query = User::with('roles')
            ->where('Trang_thai', '!=', 'cho_xac_thuc')
            ->whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']));

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        if ($request->filled('date')) {
            $dates = explode(' to ', $request->date);
            if (count($dates) === 2) {
                $query->whereBetween('Ngay_tao', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
            } else {
                $query->whereDate('Ngay_tao', $request->date);
            }
        }

        $perPage = $request->input('per_page', 10);
        $clients = $query->latest('Ngay_tao')->paginate($perPage)->withQueryString();

        // KPI
        $totalClients  = User::whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))->count();
        $activeClients = User::whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))->where('Trang_thai', 'hoat_dong')->count();
        $lockedClients = User::whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))->where('Trang_thai', 'bi_khoa')->count();

        return view('admin.clients.index', compact('clients', 'totalClients', 'activeClients', 'lockedClients'));
    }

    /**
     * Mở / Khóa tài khoản khách hàng.
     * Tuyệt đối KHÔNG thay đổi role — chỉ thay đổi trạng thái.
     */
    public function toggleStatus(Request $request, User $user)
    {
        // Bảo vệ: không được thao tác trên admin/staff từ endpoint này
        if ($user->hasAnyRole(['admin', 'staff'])) {
            abort(403, 'Không thể thay đổi trạng thái nhân viên từ trang khách hàng.');
        }

        if (Auth::id() === $user->Ma_nguoi_dung) {
            return back()->with('error', 'Không thể tự khóa tài khoản của bản thân.');
        }

        $user->Trang_thai = ($user->Trang_thai === 'hoat_dong') ? 'bi_khoa' : 'hoat_dong';
        $user->save();

        $label = $user->Trang_thai === 'bi_khoa' ? 'khóa' : 'mở khóa';

        // Activity Log
        try {
            DB::table('activity_logs')->insert([
                'Ma_nguoi_dung'  => Auth::id(),
                'Loai_hoat_dong' => $user->Trang_thai === 'bi_khoa' ? 'lock_client' : 'unlock_client',
                'Mo_ta'          => "Đã {$label} tài khoản khách hàng: {$user->Ho_ten} ({$user->Email})",
                'Dia_chi_ip'     => request()->ip(),
                'Thoi_gian'      => now(),
            ]);
        } catch (\Exception $e) {
            \Log::warning('Activity log failed: ' . $e->getMessage());
        }

        return back()->with('success', "Đã {$label} tài khoản khách hàng thành công!");
    }

    /**
     * Xuất danh sách khách hàng ra CSV.
     */
    public function export(Request $request)
    {
        $query = User::with('roles')
            ->where('Trang_thai', '!=', 'cho_xac_thuc')
            ->whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']));

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        $clients  = $query->latest('Ngay_tao')->get();
        $fileName = 'danh_sach_khach_hang_' . date('Y_m_d_His') . '.csv';

        $headers = [
            'Content-type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $columns = ['Họ tên', 'Email', 'Số điện thoại', 'Loại tài khoản', 'Ngày đăng ký', 'Trạng thái'];

        $callback = function () use ($clients, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // BOM for Vietnamese Excel
            fputcsv($file, $columns);

            foreach ($clients as $client) {
                fputcsv($file, [
                    $client->Ho_ten,
                    $client->Email,
                    $client->So_dien_thoai ?? '---',
                    $client->Loai_tai_khoan === 'to_chuc' ? 'Tổ chức' : 'Cá nhân',
                    $client->Ngay_tao ? $client->Ngay_tao->format('d/m/Y H:i') : '---',
                    $client->Trang_thai === 'hoat_dong' ? 'Hoạt động' : 'Bị khóa',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
