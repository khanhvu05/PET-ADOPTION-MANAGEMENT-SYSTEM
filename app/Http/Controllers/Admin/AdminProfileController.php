<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    /**
     * Display the admin's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the admin's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('Anh_dai_dien')) {
            if ($user->Anh_dai_dien) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->Anh_dai_dien);
            }
            $path = $request->file('Anh_dai_dien')->store('avatars', 'public');
            $user->Anh_dai_dien = $path;
        }

        if ($user->isDirty('Email')) {
            $user->Email_da_xac_thuc = false;
        }

        $user->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }
}
