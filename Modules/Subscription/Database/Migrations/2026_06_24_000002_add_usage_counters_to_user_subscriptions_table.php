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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            // Monthly usage counters consumed by PlanGate. Reset every period
            // (anchored on usage_period_start) so limits are per-month, not lifetime.
            $table->unsignedInteger('offers_used')->default(0)->after('limit');
            $table->unsignedInteger('reels_used')->default(0)->after('offers_used');
            $table->unsignedInteger('stories_used')->default(0)->after('reels_used');
            $table->timestamp('usage_period_start')->nullable()->after('stories_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn(['offers_used', 'reels_used', 'stories_used', 'usage_period_start']);
        });
    }
};
