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
        Schema::table('subscription_features', function (Blueprint $table) {
            // Structured key/value enforcement schema. The legacy `feature`/`status`
            // free-text columns are kept for UI labels / backward compatibility,
            // but all gating is read from `feature_key` / `feature_value`.
            $table->string('feature_key')->nullable()->after('feature');
            $table->string('feature_value')->nullable()->after('feature_key');
            $table->index(['subscription_id', 'feature_key'], 'sub_feature_key_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_features', function (Blueprint $table) {
            $table->dropIndex('sub_feature_key_idx');
            $table->dropColumn(['feature_key', 'feature_value']);
        });
    }
};
