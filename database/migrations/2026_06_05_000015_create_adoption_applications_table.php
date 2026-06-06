<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoption_applications', function (Blueprint $table) {
            $table->uuid('Ma_don')->primary();
            $table->uuid('Ma_nguoi_dung');
            $table->uuid('Ma_thu_cung');
            $table->string('Ho_ten', 100);
            $table->string('So_dien_thoai', 20);
            $table->text('Dia_chi');
            $table->string('Nghe_nghiep', 100)->nullable();
            $table->string('Loai_nha_o', 100)->nullable();
            $table->text('Kinh_nghiem')->nullable();
            $table->text('Ly_do_nhan_nuoi');
            $table->boolean('Cam_ket')->default(false);
            $table->enum('Trang_thai', ['pending', 'pre_approved', 'approved', 'rejected', 'cancelled'])
                  ->default('pending');
            $table->text('Ghi_chu_admin')->nullable();
            $table->timestampTz('Ngay_tao')->useCurrent();
            $table->timestampTz('Ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('Ma_nguoi_dung')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->foreign('Ma_thu_cung')
                  ->references('Ma_thu_cung')
                  ->on('pets')
                  ->restrictOnDelete();

            $table->index('Ma_nguoi_dung', 'idx_adoption_ma_nguoi_dung');
            $table->index('Trang_thai', 'idx_adoption_trang_thai');
            $table->index('Ma_thu_cung');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoption_applications');
    }
};
