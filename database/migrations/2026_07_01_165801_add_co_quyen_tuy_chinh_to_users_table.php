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
        Schema::table('users', function (Blueprint $table) {
            // Đánh dấu nhân viên đã được tùy chỉnh quyền riêng (snapshot)
            // false = đang thừa hưởng quyền từ role
            // true  = đã snapshot, không còn gắn với role preset nữa
            $table->boolean('co_quyen_tuy_chinh')->default(false)->after('Loai_tai_khoan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('co_quyen_tuy_chinh');
        });
    }
};
