<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Giao diện người dùng
Route::view('/nhan-nuoi', 'frontend.adoptions.index')->name('frontend.adoptions.index');
Route::view('/ung-ho', 'frontend.donations.index')->name('frontend.donations.index');
Route::view('/ung-ho/thuc-hien', 'frontend.donations.process')->name('frontend.donations.process');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/admin/users/{user}/role', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.users.role.update');
    Route::resource('admin/pets', \App\Http\Controllers\Admin\PetController::class, ['as' => 'admin']);
    Route::resource('admin/adoptions', \App\Http\Controllers\Admin\AdoptionController::class, ['as' => 'admin']);
    Route::resource('admin/donations', \App\Http\Controllers\Admin\DonationController::class, ['as' => 'admin']);
    Route::resource('admin/posts', \App\Http\Controllers\Admin\PostController::class, ['as' => 'admin']);
    Route::resource('admin/users', \App\Http\Controllers\Admin\UserController::class, ['as' => 'admin']);
    Route::resource('admin/settings', \App\Http\Controllers\Admin\SettingController::class, ['as' => 'admin']);
});

require __DIR__.'/auth.php';


