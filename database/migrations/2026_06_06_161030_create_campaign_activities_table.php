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
        Schema::create('campaign_activities', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id');
            $table->foreign('campaign_id')->references('Ma_chien_dich')->on('donation_campaigns')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable(); // Admin thực hiện (nếu có user_id)
            $table->string('action'); // Ví dụ: 'Tạo chiến dịch', 'Cập nhật thông tin', 'Đăng chiến dịch'
            $table->string('description')->nullable(); // Ghi chú thêm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_activities');
    }
};
