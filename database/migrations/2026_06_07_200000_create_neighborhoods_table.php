<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->id();
            $table->string('neighborhood');
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('state_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('neighborhoods');
    }
};
