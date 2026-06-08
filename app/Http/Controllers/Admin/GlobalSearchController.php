<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use App\Models\AdoptionApplication;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');
        
        if (!$q || strlen($q) < 2) {
            return response()->json([]);
        }

        $results = [];

        // 1. Search Pets
        $pets = Pet::where('Ten', 'like', "%{$q}%")
            ->orWhere('Giong', 'like', "%{$q}%")
            ->orWhere('Mau_long', 'like', "%{$q}%")
            ->limit(5)->get();
            
        foreach($pets as $pet) {
            $results[] = [
                'type' => 'Thú cưng',
                'title' => $pet->Ten . ' (' . $pet->Giong . ')',
                'url' => route('admin.pets.show', $pet->Ma_thu_cung),
                'icon' => '<svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514"></path></svg>'
            ];
        }

        // 2. Search Users
        $users = User::where('Ho_ten', 'like', "%{$q}%")
            ->orWhere('Email', 'like', "%{$q}%")
            ->orWhere('So_dien_thoai', 'like', "%{$q}%")
            ->limit(5)->get();

        foreach($users as $user) {
            $results[] = [
                'type' => 'Người dùng',
                'title' => $user->Ho_ten . ' - ' . $user->Email,
                'url' => route('admin.users.show', $user->Ma_nguoi_dung),
                'icon' => '<svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>'
            ];
        }

        // 3. Search Adoptions
        $adoptions = AdoptionApplication::where('Ma_don', 'like', "%{$q}%")
            ->orWhere('Ly_do_nhan_nuoi', 'like', "%{$q}%")
            ->limit(5)->get();

        foreach($adoptions as $adoption) {
            $results[] = [
                'type' => 'Đơn nhận nuôi',
                'title' => 'Đơn #' . $adoption->Ma_don . ' - ' . $adoption->Trang_thai,
                'url' => route('admin.adoptions.show', $adoption->Ma_don),
                'icon' => '<svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'
            ];
        }

        return response()->json($results);
    }
}
