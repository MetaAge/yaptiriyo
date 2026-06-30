<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('quantity', 10, 2)->default(1)->after('phone');
            $table->decimal('unit_price', 10, 2)->default(0)->after('quantity');
            $table->string('pricing_type', 20)->default('fixed')->after('unit_price');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unit_price', 'pricing_type']);
        });
    }
};
