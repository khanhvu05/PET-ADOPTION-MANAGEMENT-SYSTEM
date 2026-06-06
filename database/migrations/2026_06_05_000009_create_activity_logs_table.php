<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->uuid('Ma_nhat_ky')->primary();
            $table->uuid('Ma_nguoi_dung');
            $table->string('Tai_nguyen', 50);
            $table->string('Hanh_dong', 30);
            $table->json('Chi_tiet')->nullable();
            $table->string('Dia_chi_ip', 45)->nullable();
            $table->timestampTz('Thoi_diem')->useCurrent();

            $table->foreign('Ma_nguoi_dung')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->restrictOnDelete();

            $table->index('Ma_nguoi_dung', 'idx_logs_ma_nguoi_dung');
            $table->index('Thoi_diem');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
