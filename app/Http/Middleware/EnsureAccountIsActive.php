<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Kiểm tra tài khoản còn hoạt động sau mỗi request.
 * Nếu admin khóa tài khoản nhân viên, nhân viên bị đăng xuất ngay lập tức.
 */
class EnsureAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->Trang_thai === 'bi_khoa') {
                // Đăng xuất ngay lập tức, vô hiệu hóa session hiện tại
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
            }
        }

        return $next($request);
    }
}
