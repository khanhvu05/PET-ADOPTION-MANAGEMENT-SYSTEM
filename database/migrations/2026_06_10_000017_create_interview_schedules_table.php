<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->uuid('Ma_lich')->primary();
            $table->uuid('Ma_don')->unique();
            $table->uuid('Ma_slot')->nullable();
            $table->enum('Loai_lich', ['slot_co_dinh', 'lich_khac'])->nullable();
            $table->timestampTz('Thoi_gian_du_kien')->nullable();
            $table->timestampTz('Thoi_gian_xac_nhan')->nullable();
            $table->uuid('Nhan_vien_xu_ly')->nullable();
            $table->enum('Trang_thai', ['cho_xac_nhan_don', 'cho_duyet', 'da_xac_nhan', 'da_doi_lich', 'da_huy'])
                  ->default('cho_xac_nhan_don');
            $table->boolean('Email_da_gui')->default(false);
            $table->text('Ghi_chu')->nullable();
            $table->timestampTz('Ngay_tao')->useCurrent();
            $table->timestampTz('Ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('Ma_don')
                  ->references('Ma_don')
                  ->on('adoption_applications')
                  ->cascadeOnDelete();

            $table->foreign('Ma_slot')
                  ->references('Ma_slot')
                  ->on('interview_slots')
                  ->nullOnDelete();

            $table->foreign('Nhan_vien_xu_ly')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->nullOnDelete();

            $table->index('Ma_don', 'idx_interview_ma_don');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};
