<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // === BẢNG PETS ===
        // 1. Map dữ liệu cũ sang trạng thái mới trước khi sửa ENUM
        DB::table('pets')->where('Trang_thai', 'dang_cuu_ho')->update(['Trang_thai' => 'chua_san_sang']);
        DB::table('pets')->where('Trang_thai', 'cho_phong_van')->update(['Trang_thai' => 'san_sang']);

        // 2. Sửa ENUM (chỉ còn 3 trạng thái chính + da_mat)
        DB::statement("ALTER TABLE pets MODIFY COLUMN Trang_thai ENUM('chua_san_sang', 'san_sang', 'da_nhan_nuoi', 'da_mat') DEFAULT 'chua_san_sang'");

        // === BẢNG ADOPTION_APPLICATIONS ===
        // 1. Map dữ liệu cũ
        DB::table('adoption_applications')->where('Trang_thai', 'pre_approved')->update(['Trang_thai' => 'approved']);
        DB::table('adoption_applications')->where('Trang_thai', 'cancelled')->update(['Trang_thai' => 'rejected']);

        // 2. Sửa ENUM (5 trạng thái mới)
        DB::statement("ALTER TABLE adoption_applications MODIFY COLUMN Trang_thai ENUM('pending', 'approved', 'cho_phong_van', 'completed', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE adoption_applications MODIFY COLUMN Trang_thai ENUM('pending', 'pre_approved', 'approved', 'cho_phong_van', 'rejected', 'cancelled') DEFAULT 'pending'");
        DB::statement("ALTER TABLE pets MODIFY COLUMN Trang_thai ENUM('dang_cuu_ho', 'chua_san_sang', 'san_sang', 'cho_phong_van', 'da_nhan_nuoi', 'da_mat') DEFAULT 'chua_san_sang'");
    }
};
