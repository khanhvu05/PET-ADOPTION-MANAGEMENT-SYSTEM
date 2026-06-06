<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->uuid('Ma_thu_cung')->primary();
            $table->string('Ma_hien_thi', 20)->unique();
            $table->string('Ten', 100);
            $table->enum('Loai', ['cho', 'meo', 'khac'])->nullable();
            $table->string('Giong', 100)->nullable();
            $table->enum('Nhom_tuoi', ['so_sinh', 'nho', 'truong_thanh', 'gia'])->nullable();
            $table->decimal('Can_nang', 5, 2)->nullable();
            $table->enum('Gioi_tinh', ['duc', 'cai', 'chua_xac_dinh'])->nullable();
            $table->boolean('Da_tiem_phong')->default(false);
            $table->boolean('Da_triet_san')->default(false);
            $table->enum('Trang_thai', ['dang_cuu_ho', 'chua_san_sang', 'san_sang', 'da_nhan_nuoi', 'da_mat'])
                  ->default('chua_san_sang');
            $table->enum('Vi_tri', ['noi_tru', 'phong_kham'])->nullable();
            $table->boolean('Than_thien_nguoi')->nullable();
            $table->boolean('Than_thien_cho')->nullable();
            $table->boolean('Than_thien_meo')->nullable();
            $table->text('Che_do_an_dac_biet')->nullable();
            $table->date('Ngay_tiep_nhan');
            $table->decimal('Phi_nhan_nuoi', 12, 2)->default(0);
            $table->boolean('Noi_bat')->default(false);
            $table->text('Mo_ta')->nullable();
            $table->uuid('Nguoi_phu_trach')->nullable();
            $table->timestampTz('Ngay_tao')->useCurrent();
            $table->timestampTz('Ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();
            $table->string('Anh_dai_dien', 255)->nullable();

            $table->foreign('Nguoi_phu_trach')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->nullOnDelete();

            $table->index('Trang_thai', 'idx_pets_trang_thai');
            $table->index('Loai');
            $table->index('Ngay_tiep_nhan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
