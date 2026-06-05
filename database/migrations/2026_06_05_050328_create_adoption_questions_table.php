<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adoption_questions', function (Blueprint $table) {
            $table->uuid('Ma_cau_hoi')->primary();
            $table->integer('Ma_hien_thi')->unique();
            $table->text('Noi_dung');
            $table->enum('Loai_cau_tra_loi', ['text', 'single_choice', 'multi_choice']);
            $table->json('Cac_lua_chon')->nullable();
            $table->boolean('Bat_buoc')->default(true);
            $table->integer('Thu_tu')->default(0);
            $table->boolean('Hoat_dong')->default(true);
            
            // Customize timestamps
            $table->timestampTz('Ngay_tao')->useCurrent();
            $table->timestampTz('Ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_questions');
    }
};
