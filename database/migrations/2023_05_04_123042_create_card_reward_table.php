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
        Schema::create('card_reward', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id')->index();
            $table->unsignedBigInteger('reward_id')->index();
            $table->timestamps();
        });

        Schema::table('card_reward', function (Blueprint $table) {
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('CASCADE');
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_reward');
    }
};
