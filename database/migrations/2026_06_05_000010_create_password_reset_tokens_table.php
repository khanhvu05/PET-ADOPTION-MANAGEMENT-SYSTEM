<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->uuid('Ma_token')->primary();
            $table->uuid('Ma_nguoi_dung');
            $table->string('Token', 255)->unique();
            $table->timestampTz('Ngay_het_han');
            $table->boolean('Da_su_dung')->default(false);
            $table->timestampTz('Ngay_tao')->useCurrent();

            $table->foreign('Ma_nguoi_dung')
                  ->references('Ma_nguoi_dung')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->index('Token', 'idx_reset_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
