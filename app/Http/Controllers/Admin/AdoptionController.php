<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.adoptions.index');
    }

    public function create()
    {
        return view('admin.adoptions.create');
    }

    public function show($id)
    {
        return view('admin.adoptions.show');
    }
}
