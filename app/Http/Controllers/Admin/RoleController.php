<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Update the user's role (Admin only).
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Authorize that the acting user is an Admin
        if (!$request->user() || !$request->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        // Prevent admin from changing their own role (avoid lockout)
        if ($request->user()->id === $user->id) {
            return back()->with('error', 'Bạn không thể tự thay đổi vai trò của chính mình.');
        }

        // Validate the role parameter
        $validated = $request->validate([
            'role' => ['required', 'string', Rule::in(['admin', 'staff', 'user'])],
        ]);

        // Perform the role update
        $user->role = $validated['role'];
        $user->save();

        return back()->with('status', 'role-updated');
    }
}
