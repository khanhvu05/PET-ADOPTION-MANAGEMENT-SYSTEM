<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('Ma_nguoi_dung')->primary();
            $table->string('Ho_ten', 200);
            $table->string('Email', 255)->unique();
            $table->string('So_dien_thoai', 20)->nullable();
            $table->string('Mat_khau_hash', 255)->nullable();
            $table->date('Ngay_sinh')->nullable();
            $table->enum('Loai_tai_khoan', ['ca_nhan', 'to_chuc'])->nullable();
            $table->enum('Trang_thai', ['hoat_dong', 'khong_hoat_dong', 'bi_khoa'])->default('hoat_dong');
            $table->enum('Nguon_dang_ky', ['web', 'ung_dung', 'nhan_vien_tao'])->default('web');
            $table->boolean('Email_da_xac_thuc')->default(false);
            $table->string('Anh_dai_dien', 255)->nullable();
            $table->timestampsTz();
        });

        // Đổi tên cột timestamps cho khớp CSDL.md
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('created_at', 'Ngay_tao');
            $table->renameColumn('updated_at', 'Ngay_cap_nhat');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->uuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
