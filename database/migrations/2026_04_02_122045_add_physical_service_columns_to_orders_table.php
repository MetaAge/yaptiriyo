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
                $table->string('appointment_time')->nullable();
                $table->text('service_address')->nullable();
                $table->unsignedBigInteger('city_id')->nullable();
                $table->unsignedBigInteger('state_id')->nullable();
                $table->string('phone')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'appointment_date',
                'appointment_time',
                'service_address',
                'city_id',
                'state_id',
                'phone'
            ]);
        });
    }
};
