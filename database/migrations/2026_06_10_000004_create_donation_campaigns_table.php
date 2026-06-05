<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_campaigns', function (Blueprint $table) {
            $table->uuid('Ma_chien_dich')->primary();
            $table->string('Tieu_de', 200);
            $table->text('Mo_ta')->nullable();
            $table->string('Anh_dai_dien', 255)->nullable();
            $table->unsignedBigInteger('So_tien_muc_tieu')->nullable()->comment('NULL = khong gioi han');
            $table->unsignedBigInteger('So_tien_hien_tai')->default(0);
            $table->date('Ngay_bat_dau');
            $table->date('Ngay_ket_thuc')->nullable()->comment('NULL = khong gioi han thoi gian');
            $table->enum('Trang_thai', ['active', 'closed'])->default('active');
            $table->timestampTz('Ngay_tao')->useCurrent();
            $table->timestampTz('Ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_campaigns');
    }
};
