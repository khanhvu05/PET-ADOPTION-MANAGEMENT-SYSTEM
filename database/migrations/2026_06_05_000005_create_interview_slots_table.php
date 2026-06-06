<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_slots', function (Blueprint $table) {
            $table->uuid('Ma_slot')->primary();
            $table->date('Ngay');
            $table->time('Gio_bat_dau');
            $table->time('Gio_ket_thuc');
            $table->integer('So_luong_toi_da')->default(1);
            $table->integer('So_luong_hien_tai')->default(0);
            $table->uuid('Nhan_vien_xu_ly')->nullable();
            $table->enum('Trang_thai', ['mo', 'day', 'huy'])->default('mo');
            $table->timestampTz('Ngay_tao')->useCurrent();

            // FK được thêm sau khi users tạo xong (tầng 1 sẽ add constraint)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_slots');
    }
};
