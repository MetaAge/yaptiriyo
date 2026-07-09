<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Content / user reports (App Store Guideline 1.2 — apps with UGC must provide
 * a mechanism to report offensive content and abusive users).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('reported_user_id')->nullable();
            // Reported content: e.g. 'project', 'reel', 'message', 'review', 'user'
            $table->string('reportable_type')->nullable();
            $table->unsignedBigInteger('reportable_id')->nullable();
            $table->string('reason');                 // short reason code/label
            $table->text('note')->nullable();         // optional free text
            $table->string('status')->default('pending'); // pending|reviewed|actioned|dismissed
            $table->timestamps();

            $table->index('reporter_id');
            $table->index('reported_user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_reports');
    }
};
