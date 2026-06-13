<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('roles')->where('Trang_thai', '!=', 'cho_xac_thuc');

        // Tìm kiếm theo tên, email, sđt
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%");
            });
        }

        // Lọc theo vai trò
        if ($request->filled('role') && $request->role !== 'all') {
            if ($request->role === 'user') {
                $query->whereDoesntHave('roles', function($q) {
                    $q->whereIn('name', ['admin', 'staff']);
                });
            } else {
                $query->whereHas('roles', function($q) use ($request) {
                    $q->where('name', $request->role);
                });
            }
        }

        // Lọc theo trạng thái
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        // Lọc theo ngày đăng ký (có thể là một mốc hoặc khoảng thời gian)
        if ($request->filled('date')) {
            $dates = explode(' to ', $request->date);
            if (count($dates) == 2) {
                $query->whereBetween('Ngay_tao', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
            } else {
                $query->whereDate('Ngay_tao', $request->date);
            }
        }

        $perPage = $request->input('per_page', 5);
        $users = $query->latest('Ngay_tao')->paginate($perPage)->withQueryString();
        $roles = Role::all();
        
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Ho_ten' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:users',
            'Mat_khau_hash' => 'required|string|min:8|confirmed',
            'So_dien_thoai' => 'nullable|string|max:20',
            'role' => 'required|string',
            'Loai_tai_khoan' => 'required|string|in:ca_nhan,to_chuc'
        ]);

        $user = User::create([
            'Ho_ten' => $validated['Ho_ten'],
            'Email' => $validated['Email'],
            'Mat_khau_hash' => Hash::make($validated['Mat_khau_hash']),
            'So_dien_thoai' => $validated['So_dien_thoai'],
            'Loai_tai_khoan' => $validated['Loai_tai_khoan'],
            'Trang_thai' => 'hoat_dong',
            'email_verified_at' => now(), // Đánh dấu đã xác thực luôn cho admin tạo
            'Email_da_xac_thuc' => true,
        ]);

        if ($validated['role'] !== 'user') {
            $user->assignRole($validated['role']);
        }

        return redirect()->route('admin.users.index')->with('success', 'Đã thêm người dùng mới thành công.');
    }

    public function updateRole(Request $request, User $user)
    {
        if (!$request->user()->can('access_users') && !$request->user()->hasRole('admin')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        if ($request->user()->Ma_nguoi_dung === $user->Ma_nguoi_dung) {
            return back()->with('error', 'Không thể tự đổi quyền của bản thân.');
        }

        $validated = $request->validate([
            'role' => 'required|string', 
        ]);

        if ($validated['role'] === 'user') {
            // Remove all roles
            $user->syncRoles([]);
        } else {
            if (Role::where('name', $validated['role'])->exists()) {
                $user->syncRoles([$validated['role']]);
            }
        }

        return back()->with('success', 'Đã cập nhật vai trò người dùng thành công!');
    }

    public function toggleStatus(Request $request, User $user)
    {
        if ($request->user()->Ma_nguoi_dung === $user->Ma_nguoi_dung) {
            return back()->with('error', 'Không thể tự khóa tài khoản của bản thân.');
        }

        $user->Trang_thai = $user->Trang_thai === 'hoat_dong' ? 'bi_khoa' : 'hoat_dong';
        $user->save();

        return back()->with('success', 'Đã cập nhật trạng thái tài khoản!');
    }

    public function destroy(Request $request, User $user)
    {
        return back()->with('error', 'Chức năng xóa người dùng đã bị vô hiệu hóa vì lý do nghiệp vụ.');
    }

    public function export(Request $request)
    {
        $query = User::with('roles')->where('Trang_thai', '!=', 'cho_xac_thuc');

        // Áp dụng lại các bộ lọc y hệt hàm index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            if ($request->role === 'user') {
                $query->whereDoesntHave('roles', function($q) {
                    $q->whereIn('name', ['admin', 'staff']);
                });
            } else {
                $query->whereHas('roles', function($q) use ($request) {
                    $q->where('name', $request->role);
                });
            }
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        if ($request->filled('date')) {
            $dates = explode(' to ', $request->date);
            if (count($dates) == 2) {
                $query->whereBetween('Ngay_tao', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
            } else {
                $query->whereDate('Ngay_tao', $request->date);
            }
        }

        $users = $query->latest('Ngay_tao')->get();

        $fileName = 'danh_sach_nguoi_dung_' . date('Y_m_d_His') . '.csv';
        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Họ tên', 'Email', 'Số điện thoại', 'Loại tài khoản', 'Ngày tạo', 'Trạng thái', 'Vai trò');

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            // Ghi BOM để Excel đọc được tiếng Việt
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $roleName = $user->roles->pluck('name')->join(', ') ?: 'User';
                $row = [
                    $user->Ho_ten,
                    $user->Email,
                    $user->So_dien_thoai ?? '---',
                    $user->Loai_tai_khoan === 'to_chuc' ? 'Tổ chức' : 'Cá nhân',
                    $user->Ngay_tao ? $user->Ngay_tao->format('d/m/Y H:i') : '---',
                    $user->Trang_thai === 'hoat_dong' ? 'Hoạt động' : 'Bị khóa',
                    ucfirst($roleName)
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
