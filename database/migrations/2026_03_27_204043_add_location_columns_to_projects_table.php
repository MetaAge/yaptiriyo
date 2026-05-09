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
                $table->integer('country_id')->nullable()->after('meta_tags');
            }
            if (!Schema::hasColumn('projects', 'state_id')) {
                $table->integer('state_id')->nullable()->after('country_id');
            }
            if (!Schema::hasColumn('projects', 'city_id')) {
                $table->integer('city_id')->nullable()->after('state_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'country_id')) {
                $table->dropColumn('country_id');
            }
            if (Schema::hasColumn('projects', 'state_id')) {
                $table->dropColumn('state_id');
            }
            if (Schema::hasColumn('projects', 'city_id')) {
                $table->dropColumn('city_id');
            }
        });
    }
};
