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
            // Önce varsa mükerrer kayıtları temizleyelim (güvenlik için)
            $duplicates = DB::table('reel_likes')
                ->select('reel_id', 'user_id')
                ->groupBy('reel_id', 'user_id')
                ->havingRaw('COUNT(*) > 1')
                ->get();

            foreach ($duplicates as $duplicate) {
                $ids = DB::table('reel_likes')
                    ->where('reel_id', $duplicate->reel_id)
                    ->where('user_id', $duplicate->user_id)
                    ->pluck('id');
                
                // İlkini tutup geri kalanını silelim
                DB::table('reel_likes')->whereIn('id', $ids->slice(1))->delete();
            }

            $table->unique(['reel_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::table('reel_likes', function (Blueprint $table) {
            $table->dropUnique(['reel_id', 'user_id']);
        });
    }
};
