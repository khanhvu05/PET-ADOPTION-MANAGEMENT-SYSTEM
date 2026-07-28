<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Admin hoặc Staff → redirect vào trang admin phù hợp với quyền
        if ($user->isStaff()) {
            return redirect($this->getAdminRedirectUrl($user));
        }

        // Client bình thường → vào trang frontend
        return redirect()->intended(route('frontend.adoptions.index', absolute: false));
    }

    /**
     * Tìm trang admin đầu tiên mà user có quyền truy cập.
     * Chỉ bao gồm các trang đang active trong sidebar.
     */
    private function getAdminRedirectUrl($user): string
    {
        $checks = [
            'dashboard.view'  => route('dashboard'),
            'pets.view'       => route('admin.pets.index'),
            'adoptions.view'  => route('admin.adoptions.index'),
            'interviews.view' => route('admin.interview_schedules.index'),
            'staff.view'      => route('admin.staff.index'),
            'clients.view'    => route('admin.clients.index'),
        ];

        foreach ($checks as $permission => $url) {
            if ($user->can($permission)) {
                return $url;
            }
        }

        // Fallback: trang Tài Khoản admin (luôn accessible với staff)
        return route('admin.profile.edit');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
