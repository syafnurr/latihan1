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
        Schema::create('analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('member_id')->nullable()->index();
            $table->unsignedBigInteger('staff_id')->nullable()->index();
            $table->unsignedBigInteger('card_id')->nullable()->index();
            $table->unsignedBigInteger('reward_id')->nullable()->index();
            $table->string('event', 250)->nullable();
            $table->string('locale', 12)->nullable();
            $table->char('currency', 3)->nullable();
            $table->unsignedBigInteger('purchase_amount')->nullable();
            $table->integer('points')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::table('analytics', function (Blueprint $table) {
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('SET NULL');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('SET NULL');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('CASCADE');
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
