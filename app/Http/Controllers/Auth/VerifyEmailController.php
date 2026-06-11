<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->with('error', 'Đường dẫn xác thực không hợp lệ.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Tài khoản đã được xác thực trước đó. Vui lòng đăng nhập.');
        }

        if ($user->markEmailAsVerified()) {
            $user->update(['Trang_thai' => 'hoat_dong']);
            event(new Verified($user));
        }

        Auth::login($user);

        return redirect()->intended(route('frontend.adoptions.index', absolute: false))->with('success', 'Chào mừng ' . $user->Ho_ten . ' đã xác nhận tài khoản thành công!');
    }
}
