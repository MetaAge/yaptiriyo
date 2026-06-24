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
            // Free trial granted at signup (1-month default, or founding-member 3-month).
            $table->boolean('is_trial')->default(false)->after('status');
            $table->timestamp('trial_ends_at')->nullable()->after('is_trial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn(['is_trial', 'trial_ends_at']);
        });
    }
};
