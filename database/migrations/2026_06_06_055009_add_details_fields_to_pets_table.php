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
        Schema::table('pets', function (Blueprint $table) {
            $table->string('Mau_long')->nullable()->after('Gioi_tinh');
            $table->string('Tinh_cach')->nullable()->after('Mo_ta');
            $table->text('Thoi_quen')->nullable()->after('Tinh_cach');
            $table->text('Yeu_thich')->nullable()->after('Thoi_quen');
            $table->json('Thu_vien_anh')->nullable()->after('Anh_dai_dien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn(['Mau_long', 'Tinh_cach', 'Thoi_quen', 'Yeu_thich', 'Thu_vien_anh']);
        });
    }
};
