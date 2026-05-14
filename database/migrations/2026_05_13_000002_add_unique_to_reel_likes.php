<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reel_likes', function (Blueprint $table) {
            // İndeks zaten var mı kontrol edelim
            $conn = Schema::getConnection();
            $dbName = $conn->getDatabaseName();
            $indexExists = DB::select("
                SELECT INDEX_NAME 
                FROM INFORMATION_SCHEMA.STATISTICS 
                WHERE TABLE_SCHEMA = ? 
                AND TABLE_NAME = 'reel_likes' 
                AND INDEX_NAME = 'reel_likes_reel_id_user_id_unique'
            ", [$dbName]);

            if (empty($indexExists)) {
                $table->unique(['reel_id', 'user_id']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('reel_likes', function (Blueprint $table) {
            $table->dropUnique(['reel_id', 'user_id']);
        });
    }
};
