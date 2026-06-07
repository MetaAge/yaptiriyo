<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'users' => 'city_id',
            'projects' => 'city_id',
            'orders' => 'city_id',
            'user_service_areas' => 'city_id',
            'project_service_areas' => 'city_id',
            'user_addresses' => 'city_id',
            'identity_verifications' => 'city_id',
            'emergency_requests' => 'city_id',
        ];

        foreach ($tables as $table => $afterColumn) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'neighborhood_id')) {
                Schema::table($table, function (Blueprint $t) use ($afterColumn) {
                    $t->unsignedBigInteger('neighborhood_id')->nullable()->after($afterColumn)->index();
                });
            }
        }
    }

    public function down(): void
    {
        $tables = ['users', 'projects', 'orders', 'user_service_areas', 'project_service_areas', 'user_addresses', 'identity_verifications', 'emergency_requests'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'neighborhood_id')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropColumn('neighborhood_id');
                });
            }
        }
    }
};
