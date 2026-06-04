<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        return view('admin.pets.index');
    }

    public function create()
    {
        return view('admin.pets.create');
    }

    public function show($id)
    {
        // For UI purposes, we're returning the show view for any ID
        return view('admin.pets.show', compact('id'));
    }
}
