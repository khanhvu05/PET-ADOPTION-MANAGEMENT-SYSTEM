<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class StaffController extends Controller
{
    /**
     * Danh sách nhân viên (role = staff hoặc admin, không phải customer).
     */
    public function index(Request $request)
    {
        $query = User::with('roles', 'permissions')
            ->whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']));

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('roles', fn($q) => $q->where('name', $request->role));
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        $perPage  = $request->input('per_page', 10);
        $staffList = $query->latest('Ngay_tao')->paginate($perPage)->withQueryString();

        // Tất cả permissions phân theo module để hiển thị trong bảng
        $allPermissions = Permission::all()->filter(fn($p) => !str_starts_with($p->name, 'access_') && !str_starts_with($p->name, 'posts.'))->groupBy(fn($p) => explode('.', $p->name)[0]);

        // Custom roles (không phải system roles, không phải admin/staff/customer)
        $customRoles = Role::where('la_vai_tro_he_thong', false)->get();

        // Tổng số nhân viên
        $totalStaff  = User::whereHas('roles', fn($q) => $q->where('name', 'staff'))->count();
        $totalAdmin  = User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->count();
        $activeCount = User::whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))
            ->where('Trang_thai', 'hoat_dong')->count();
        $lockedCount = User::whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'staff']))
            ->where('Trang_thai', 'bi_khoa')->count();

        return view('admin.staff.index', compact(
            'staffList', 'allPermissions', 'customRoles',
            'totalStaff', 'totalAdmin', 'activeCount', 'lockedCount'
        ));
    }

    /**
     * Form tạo nhân viên mới.
     */
    public function create()
    {
        $allPermissions = Permission::all()->filter(fn($p) => !str_starts_with($p->name, 'access_') && !str_starts_with($p->name, 'posts.'))->groupBy(fn($p) => explode('.', $p->name)[0]);
        $customRoles    = Role::with('permissions')->where('la_vai_tro_he_thong', false)->get();
        return view('admin.staff.create', compact('allPermissions', 'customRoles'));
    }

    /**
     * Lưu nhân viên mới.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Ho_ten'           => 'required|string|max:255',
            'Email'            => 'required|email|max:255|unique:users,Email',
            'Mat_khau_hash'    => 'required|string|min:8|confirmed',
            'So_dien_thoai'    => 'nullable|string|max:20',
            'Chuc_danh'        => 'nullable|string|max:255',
            'permissions'      => 'nullable|array',
            'permissions.*'    => 'string|exists:permissions,name',
            'custom_role_id'   => 'nullable|integer|exists:roles,id',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $staff = User::create([
                'Ho_ten'             => $validated['Ho_ten'],
                'Chuc_danh'          => $validated['Chuc_danh'] ?? null,
                'Email'              => $validated['Email'],
                'Mat_khau_hash'      => Hash::make($validated['Mat_khau_hash']),
                'So_dien_thoai'      => $validated['So_dien_thoai'] ?? null,
                'Loai_tai_khoan'     => 'ca_nhan',
                'Trang_thai'         => 'hoat_dong',
                'co_quyen_tuy_chinh' => false,
                'email_verified_at'  => now(),
            ]);

            // Gán role staff (role hệ thống)
            $staff->assignRole('staff');

            $directPermissions = $validated['permissions'] ?? [];
            $customRoleId      = $validated['custom_role_id'] ?? null;

            if ($customRoleId) {
                $customRole = Role::find($customRoleId);
                if ($customRole && !$customRole->la_vai_tro_he_thong) {
                    if (empty($directPermissions)) {
                        // Chỉ chọn role, không tick thêm → gắn role, chưa snapshot
                        $staff->assignRole($customRole);
                        $staff->syncPermissions([]);
                        $staff->update(['co_quyen_tuy_chinh' => false]);
                    } else {
                        // Chọn role VÀ tick thêm quyền → Snapshot ngay:
                        // Gộp quyền của role + quyền thêm, lưu thành direct permissions
                        $rolePerms    = $customRole->permissions->pluck('name')->toArray();
                        $allPerms     = array_unique(array_merge($rolePerms, $directPermissions));
                        app()[PermissionRegistrar::class]->forgetCachedPermissions();
                        $staff->syncPermissions($allPerms);
                        $staff->update(['co_quyen_tuy_chinh' => true]);
                        // Không gán custom role vì đã snapshot
                    }
                }
            } else {
                // Không chọn role, chỉ tick quyền thủ công → Snapshot
                if (!empty($directPermissions)) {
                    app()[PermissionRegistrar::class]->forgetCachedPermissions();
                    $staff->syncPermissions($directPermissions);
                    $staff->update(['co_quyen_tuy_chinh' => true]);
                }
            }

            // Activity Log
            $this->logActivity('create_staff', "Tạo tài khoản nhân viên mới: {$staff->Ho_ten} ({$staff->Email})");
        });

        return redirect()->route('admin.staff.index')
            ->with('success', 'Đã tạo tài khoản nhân viên thành công!');
    }

    /**
     * Xem chi tiết nhân viên và quyền của họ.
     */
    public function show(User $staff)
    {
        $this->authorizeStaff($staff);
        $staff->load('roles', 'permissions');
        $allPermissions = Permission::all()
            ->filter(fn($p) => !str_starts_with($p->name, 'access_') && !str_starts_with($p->name, 'posts.'))
            ->groupBy(fn($p) => explode('.', $p->name)[0]);

        // Tính toán permissions thực tế (từ roles + direct permissions)
        $effectivePermissions = $staff->getAllPermissions()->pluck('name')->toArray();

        return view('admin.staff.show', compact('staff', 'allPermissions', 'effectivePermissions'));
    }

    /**
     * Form chỉnh sửa nhân viên.
     */
    public function edit(User $staff)
    {
        $this->authorizeStaff($staff);
        $staff->load('roles', 'permissions');
        $allPermissions  = Permission::all()->filter(fn($p) => !str_starts_with($p->name, 'access_') && !str_starts_with($p->name, 'posts.'))->groupBy(fn($p) => explode('.', $p->name)[0]);
        $customRoles     = Role::with('permissions')->where('la_vai_tro_he_thong', false)->get();
        $directPermissions = $staff->permissions->pluck('name')->toArray();

        return view('admin.staff.edit', compact('staff', 'allPermissions', 'customRoles', 'directPermissions'));
    }

    /**
     * Cập nhật thông tin và permissions nhân viên.
     */
    public function update(Request $request, User $staff)
    {
        $this->authorizeStaff($staff);

        $validated = $request->validate([
            'Ho_ten'        => 'required|string|max:255',
            'Chuc_danh'     => 'nullable|string|max:255',
            'So_dien_thoai' => 'nullable|string|max:20',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
            'custom_role_id' => 'nullable|integer|exists:roles,id',
            'Mat_khau_hash'  => 'nullable|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($validated, $request, $staff) {
            $staff->update([
                'Ho_ten'        => $validated['Ho_ten'],
                'Chuc_danh'     => $validated['Chuc_danh'] ?? null,
                'So_dien_thoai' => $validated['So_dien_thoai'] ?? $staff->So_dien_thoai,
            ]);

            // Đổi mật khẩu nếu có
            if (!empty($validated['Mat_khau_hash'])) {
                $staff->update(['Mat_khau_hash' => Hash::make($validated['Mat_khau_hash'])]);
            }

            // ── SNAPSHOT: Khi admin nhấn Lưu thì luôn snapshot ──────────────────
            // 1. Lấy danh sách quyền được chọn trong form
            $chosenPermissions = $validated['permissions'] ?? [];

            // 2. Xóa hết custom role (giữ lại role hệ thống: admin, staff, customer)
            $systemRoles  = ['admin', 'staff', 'customer'];
            $currentRoles = $staff->roles->pluck('name')->toArray();
            $rolesToKeep  = array_intersect($currentRoles, $systemRoles);
            $staff->syncRoles($rolesToKeep);

            // 3. Lưu toàn bộ quyền chọn làm direct permissions
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            $staff->syncPermissions($chosenPermissions);

            // 4. Đánh dấu đã snapshot (nếu có quyền được chọn)
            $staff->update(['co_quyen_tuy_chinh' => !empty($chosenPermissions)]);

            $this->logActivity('update_staff', "Cập nhật quyền (snapshot) cho nhân viên: {$staff->Ho_ten}");
        });

        return redirect()->route('admin.staff.index')
            ->with('success', 'Đã cập nhật nhân viên thành công!');
    }

    /**
     * Khóa / Mở khóa tài khoản nhân viên (tức thì — session bị vô hiệu ở middleware).
     */
    public function toggleStatus(Request $request, User $staff)
    {
        $this->authorizeStaff($staff);

        if (Auth::id() === $staff->Ma_nguoi_dung) {
            return back()->with('error', 'Không thể tự khóa tài khoản của bản thân.');
        }

        $oldStatus = $staff->Trang_thai;
        $staff->Trang_thai = ($oldStatus === 'hoat_dong') ? 'bi_khoa' : 'hoat_dong';
        $staff->save();

        $action = $staff->Trang_thai === 'bi_khoa' ? 'lock_staff' : 'unlock_staff';
        $label  = $staff->Trang_thai === 'bi_khoa' ? 'khóa' : 'mở khóa';
        $this->logActivity($action, "Đã {$label} tài khoản nhân viên: {$staff->Ho_ten}");

        return back()->with('success', "Đã {$label} tài khoản nhân viên thành công!");
    }

    /**
     * Tạo custom role (không phải system role).
     */
    public function storeCustomRole(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:50|unique:roles,name',
            'mo_ta'       => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $role = Role::create([
            'name'               => $validated['name'],
            'mo_ta'              => $validated['mo_ta'] ?? null,
            'la_vai_tro_he_thong' => false,
        ]);

        if (!empty($validated['permissions'])) {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            $role->syncPermissions($validated['permissions']);
        }

        $this->logActivity('create_custom_role', "Tạo vai trò tùy chỉnh: {$role->name}");

        return back()->with('success', "Đã tạo vai trò \"{$role->name}\" thành công!");
    }

    /**
     * Xóa custom role (chỉ được xóa role không phải hệ thống).
     */
    public function destroyCustomRole(Role $role)
    {
        if ($role->la_vai_tro_he_thong) {
            return back()->with('error', 'Không thể xóa vai trò hệ thống.');
        }

        $usersCount = $role->users()->count();
        if ($usersCount > 0) {
            return back()->with('error', "Không thể xóa vai trò đang được gán cho {$usersCount} người dùng.");
        }

        $this->logActivity('delete_custom_role', "Xóa vai trò tùy chỉnh: {$role->name}");
        $role->delete();

        return back()->with('success', 'Đã xóa vai trò thành công!');
    }

    /**
     * Cập nhật quyền của custom role.
     */
    public function updateCustomRole(Request $request, Role $role)
    {
        if ($role->la_vai_tro_he_thong) {
            return back()->with('error', 'Không thể chỉnh sửa vai trò hệ thống.');
        }

        $validated = $request->validate([
            'mo_ta'           => 'nullable|string|max:255',
            'permissions'     => 'nullable|array',
            'permissions.*'   => 'string|exists:permissions,name',
        ]);

        $role->update(['mo_ta' => $validated['mo_ta'] ?? $role->mo_ta]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $role->syncPermissions($validated['permissions'] ?? []);

        $this->logActivity('update_custom_role', "Cập nhật quyền vai trò tùy chỉnh: {$role->name}");

        return back()->with('success', "Đã cập nhật quyền cho vai trò \"{$role->name}\" thành công!");
    }

    /**
     * Đảm bảo user được thao tác là admin/staff (không phải customer).
     */
    private function authorizeStaff(User $user): void
    {
        if (!$user->hasAnyRole(['admin', 'staff'])) {
            abort(403, 'Người dùng này không phải nhân viên.');
        }
    }

    /**
     * Ghi activity log.
     */
    private function logActivity(string $type, string $description): void
    {
        try {
            DB::table('activity_logs')->insert([
                'Ma_nguoi_dung'   => Auth::id(),
                'Loai_hoat_dong'  => $type,
                'Mo_ta'           => $description,
                'Dia_chi_ip'      => request()->ip(),
                'Thoi_gian'       => now(),
            ]);
        } catch (\Exception $e) {
            // Không để lỗi log làm hỏng flow chính
            \Log::warning('Activity log failed: ' . $e->getMessage());
        }
    }
}
