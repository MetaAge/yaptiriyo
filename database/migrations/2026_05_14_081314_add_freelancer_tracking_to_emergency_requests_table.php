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
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->string('freelancer_status')->nullable()->after('status'); // accepted, on_the_way, arrived, working
            $table->decimal('freelancer_lat', 10, 8)->nullable()->after('freelancer_status');
            $table->decimal('freelancer_long', 11, 8)->nullable()->after('freelancer_lat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn(['freelancer_status', 'freelancer_lat', 'freelancer_long']);
        });
    }
};
