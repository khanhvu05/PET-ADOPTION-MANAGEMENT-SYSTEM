<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Alter enum to string for flexibility
        DB::statement("ALTER TABLE adoption_applications MODIFY COLUMN Trang_thai VARCHAR(50) DEFAULT 'cho_duyet'");
        // Replace old values
        DB::statement("UPDATE adoption_applications SET Trang_thai = 'cho_duyet' WHERE Trang_thai = 'pending'");
        DB::statement("UPDATE adoption_applications SET Trang_thai = 'cho_xac_nhan_don' WHERE Trang_thai = 'approved'");
        DB::statement("UPDATE adoption_applications SET Trang_thai = 'hoan_thanh' WHERE Trang_thai = 'completed'");
        DB::statement("UPDATE adoption_applications SET Trang_thai = 'tu_choi' WHERE Trang_thai = 'rejected'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
