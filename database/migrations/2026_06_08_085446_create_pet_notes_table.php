<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_notes', function (Blueprint $table) {
            $table->uuid('Ma_ghi_chu')->primary();
            $table->uuid('Ma_thu_cung');
            $table->uuid('Ma_nguoi_dung'); // người tạo ghi chú
            $table->text('Noi_dung');
            $table->timestampTz('Ngay_tao')->useCurrent();

            $table->foreign('Ma_thu_cung')
                  ->references('Ma_thu_cung')
                  ->on('pets')
                  ->cascadeOnDelete();

            $table->foreign('Ma_nguoi_dung')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->index('Ma_thu_cung', 'idx_pet_notes_ma_thu_cung');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_notes');
    }
};
