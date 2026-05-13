<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emergency_request_id');
            $table->unsignedBigInteger('freelancer_id');
            $table->decimal('offered_price', 10, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('emergency_request_id')->references('id')->on('emergency_requests')->onDelete('cascade');
            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_offers');
    }
};
