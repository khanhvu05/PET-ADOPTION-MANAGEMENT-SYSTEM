<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vaccination_history', function (Blueprint $table) {
            $table->uuid('Ma_lan_tiem')->primary();
            $table->uuid('Ma_thu_cung');
            $table->string('Ten_vac_xin', 200);
            $table->date('Ngay_tiem');
            $table->date('Ngay_tiem_nhac_tiep')->nullable();
            $table->uuid('Nguoi_thuc_hien')->nullable();
            $table->string('Ten_noi_tiem', 200)->nullable();
            $table->decimal('Chi_phi', 12, 2)->default(0);

            $table->foreign('Ma_thu_cung')
                  ->references('Ma_thu_cung')
                  ->on('pets')
                  ->cascadeOnDelete();

            $table->foreign('Nguoi_thuc_hien')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->nullOnDelete();

            $table->index('Ma_thu_cung', 'idx_vaccine_ma_thu_cung');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccination_history');
    }
};
