<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('Ma_ung_ho')->primary();
            $table->uuid('Ma_nguoi_dung')->nullable();
            $table->uuid('Ma_chien_dich')->nullable();
            $table->string('Ten_nguoi_ung_ho', 100);
            $table->boolean('An_danh')->default(false);
            $table->unsignedBigInteger('So_tien');
            $table->string('Loi_nhan', 200)->nullable();
            $table->string('Ma_giao_dich_he_thong', 50)->unique();
            $table->string('Ma_giao_dich_vnpay', 50)->nullable();
            $table->string('Ma_phan_hoi_vnpay', 10)->nullable();
            $table->string('Ma_ngan_hang', 20)->nullable();
            $table->enum('Trang_thai', ['pending', 'success', 'failed', 'expired'])->default('pending');
            $table->timestampTz('Thoi_diem_thanh_toan')->nullable();
            $table->timestampTz('Ngay_tao')->useCurrent();
            $table->timestampTz('Ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('Ma_nguoi_dung')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->nullOnDelete();

            $table->foreign('Ma_chien_dich')
                  ->references('Ma_chien_dich')
                  ->on('donation_campaigns')
                  ->nullOnDelete();

            $table->index('Ma_nguoi_dung', 'idx_donations_ma_nguoi_dung');
            $table->index('Ma_chien_dich', 'idx_donations_ma_chien_dich');
            $table->index('Trang_thai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
