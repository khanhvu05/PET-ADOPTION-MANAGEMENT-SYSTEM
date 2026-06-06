<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Thêm FK cho interview_slots -> users (Nhan_vien_xu_ly)
        Schema::table('interview_slots', function (Blueprint $table) {
            $table->foreign('Nhan_vien_xu_ly')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->nullOnDelete();
        });

        Schema::create('adopter_profiles', function (Blueprint $table) {
            $table->uuid('Ma_nguoi_dung')->primary();
            $table->string('Loai_nha_o', 100)->nullable();
            $table->boolean('Co_kinh_nghiem')->default(false);
            $table->text('Dia_chi')->nullable();
            $table->string('Thanh_pho', 100)->nullable();

            $table->foreign('Ma_nguoi_dung')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adopter_profiles');

        Schema::table('interview_slots', function (Blueprint $table) {
            $table->dropForeign(['Nhan_vien_xu_ly']);
        });
    }
};
