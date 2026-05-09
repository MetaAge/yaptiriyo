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
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'country_id')) {
                $table->unsignedBigInteger('country_id')->nullable()->after('category_id')->index();
            }
            if (!Schema::hasColumn('projects', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable()->after('country_id')->index();
            }
            if (!Schema::hasColumn('projects', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable()->after('state_id')->index();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['country_id', 'state_id', 'city_id']);
        });
    }
};
