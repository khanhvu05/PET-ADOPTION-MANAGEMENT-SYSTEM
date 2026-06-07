<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Chỉ lấy các user là admin và staff cho bảng quản lý vai trò
        $users = request()->user()->isAdmin() ? \App\Models\User::role(['admin', 'staff'])->get() : collect();
        
        $chatboxService = app(\App\Services\ChatboxService::class);
        $chatboxSettings = $chatboxService->getSettings();
        
        // Tính lượng token đã sử dụng của mỗi user trong 7 ngày gần đây
        $sevenDaysAgo = time() - (7 * 24 * 60 * 60);
        $userUsageMap = [];
        foreach ($chatboxSettings['userTokenUsage'] ?? [] as $usage) {
            if (($usage['timestamp'] ?? 0) >= $sevenDaysAgo) {
                $uid = $usage['userId'];
                $userUsageMap[$uid] = ($userUsageMap[$uid] ?? 0) + ($usage['tokens'] ?? 0);
            }
        }

        $roleLimits = $chatboxSettings['weeklyRoleLimits'] ?? [
            'admin' => 200000,
            'staff' => 100000,
            'user' => 50000
        ];
        foreach ($users as $user) {
            $used = $userUsageMap[$user->Ma_nguoi_dung] ?? 0;
            $user->chatbox_used_tokens = $used;
            
            $role = 'user';
            if ($user->hasRole('admin')) {
                $role = 'admin';
            } elseif ($user->hasRole('staff')) {
                $role = 'staff';
            }
            
            $limit = $roleLimits[$role] ?? ($chatboxSettings['weeklyTokenLimit'] ?? 50000);
            $user->chatbox_remaining_tokens = max(0, $limit - $used);
        }

        // Xóa cache của Spatie trước khi load view để tránh lỗi PermissionDoesNotExist do cache cũ trên môi trường deploy
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // Lấy dữ liệu phân quyền (tương tự như RolePermissionController cũ)
        $roles = \Spatie\Permission\Models\Role::whereIn('name', ['admin', 'staff'])->with('permissions')->get();
        
        // Đảm bảo các quyền cần thiết luôn tồn tại trong DB trước khi load view
        $requiredPermissions = [
            'access_pets', 'access_adoptions', 'access_donations', 'access_posts',
            'access_users', 'access_settings', 'access_tokens'
        ];
        foreach ($requiredPermissions as $perm) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }
        
        $permissions = \Spatie\Permission\Models\Permission::all();
        
        $groupedPermissions = [
            'Cấu Hình Phân Quyền Theo Module' => $permissions->filter(fn($p) => in_array($p->name, [
                'access_pets', 'access_adoptions', 'access_donations',
                'access_users', 'access_settings', 'access_tokens'
            ])),
            'Khác' => $permissions->filter(fn($p) => !in_array($p->name, [
                'access_pets', 'access_adoptions', 'access_donations', 'access_posts',
                'access_users', 'access_settings', 'access_tokens'
            ])),
        ];

        // Lấy tất cả cài đặt chung
        $settings = \App\Models\Setting::pluck('value', 'key')->all();

        return view('admin.settings.index', compact('users', 'chatboxSettings', 'roles', 'groupedPermissions', 'settings'));
    }

    public function storeGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_slogan' => 'nullable|string|max:255',
            'site_email' => 'nullable|email|max:255',
            'site_hotline' => 'nullable|string|max:50',
            'site_address' => 'nullable|string',
            'default_language' => 'nullable|string',
            'timezone' => 'nullable|string',
            'date_format' => 'nullable|string',
            'time_format' => 'nullable|string',
            'allow_registration' => 'nullable|boolean',
            'maintenance_mode' => 'nullable|boolean',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            \App\Models\Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $logoPath]);
            unset($validated['site_logo']); // Đừng lưu đường dẫn file thô vào vòng lặp phía dưới
        }

        // Đảm bảo checkbox boolean có giá trị mặc định là 0 nếu không được gửi lên
        $booleanKeys = ['allow_registration', 'maintenance_mode'];
        foreach ($booleanKeys as $key) {
            $validated[$key] = $request->has($key) ? '1' : '0';
        }

        foreach ($validated as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Đã lưu Cài đặt Thông tin chung thành công.');
    }
}
