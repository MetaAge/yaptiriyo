<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Store lifecycle reference for store subscriptions:
 *  - Apple: originalTransactionId (stable across renewals)
 *  - Google: purchaseToken
 * Used by the store webhooks (App Store Server Notifications / Google RTDN)
 * to find and extend/expire the matching user subscription on renewal,
 * cancellation and refund events.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('user_subscriptions', 'original_transaction_id')) {
                $table->string('original_transaction_id')->nullable()->index()
                    ->after('transaction_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            if (Schema::hasColumn('user_subscriptions', 'original_transaction_id')) {
                $table->dropColumn('original_transaction_id');
            }
        });
    }
};
