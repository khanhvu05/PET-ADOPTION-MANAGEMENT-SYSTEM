<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::with('roles')->paginate(10);
        $roles = \Spatie\Permission\Models\Role::all();
        
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, \App\Models\User $user)
    {
        // Require permission to manage roles
        if (!$request->user()->can('manage roles') && !$request->user()->hasRole('admin')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        // Prevent modifying own role
        if ($request->user()->Ma_nguoi_dung === $user->Ma_nguoi_dung) {
            return back()->with('error', 'Không thể tự đổi quyền của bản thân.');
        }

        $validated = $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$validated['role']]);

        return back()->with('success', 'Đã cập nhật vai trò người dùng thành công!');
    }
}
