<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('manga', function (Blueprint $table) {
            // เพิ่ม created_at, updated_at (NULL ได้)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('manga', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};