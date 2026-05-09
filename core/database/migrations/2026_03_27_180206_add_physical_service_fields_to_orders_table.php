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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'appointment_date')) {
                $table->date('appointment_date')->nullable();
            }
            if (!Schema::hasColumn('orders', 'appointment_time')) {
                $table->string('appointment_time')->nullable();
            }
            if (!Schema::hasColumn('orders', 'service_address')) {
                $table->text('service_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable();
            }
            if (!Schema::hasColumn('orders', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable(); // Used as District
            }
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['appointment_date', 'appointment_time', 'service_address', 'city_id', 'state_id', 'phone']);
        });
    }
};
