<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rescue_cases', function (Blueprint $table) {
            $table->uuid('Ma_ca_cuu_ho')->primary();
            $table->uuid('Ma_thu_cung');
            $table->date('Ngay_cuu_ho');
            $table->text('Dia_diem_cuu_ho')->nullable();
            $table->enum('Loai_cuu_ho', ['lang_thang', 'lac_duong', 'bi_bo_roi', 'bi_nguoc_dai'])->nullable();
            $table->string('Nguoi_bao_cao', 200)->nullable();
            $table->uuid('Nguoi_thuc_hien')->nullable();
            $table->decimal('Chi_phi_cuu_ho', 12, 2)->default(0);
            $table->enum('Trang_thai_ca', ['dang_xu_ly', 'dang_dieu_tri', 'on_dinh', 'da_dong'])
                  ->default('dang_xu_ly');
            $table->text('Ghi_chu')->nullable();
            $table->timestampTz('Ngay_tao')->useCurrent();

            $table->foreign('Ma_thu_cung')
                  ->references('Ma_thu_cung')
                  ->on('pets')
                  ->cascadeOnDelete();

            $table->foreign('Nguoi_thuc_hien')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->nullOnDelete();

            $table->index('Ma_thu_cung', 'idx_rescue_ma_thu_cung');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rescue_cases');
    }
};
