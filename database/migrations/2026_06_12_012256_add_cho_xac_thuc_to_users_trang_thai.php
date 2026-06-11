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
        DB::statement("ALTER TABLE users MODIFY COLUMN Trang_thai ENUM('hoat_dong', 'khong_hoat_dong', 'bi_khoa', 'cho_xac_thuc') DEFAULT 'hoat_dong'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN Trang_thai ENUM('hoat_dong', 'khong_hoat_dong', 'bi_khoa') DEFAULT 'hoat_dong'");
    }
};
