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
        $users = request()->user()->isAdmin() ? \App\Models\User::all() : collect();
        return view('admin.settings.index', compact('users'));
    }
}
