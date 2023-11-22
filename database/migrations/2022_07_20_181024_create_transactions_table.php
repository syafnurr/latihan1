<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'transactions' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Foreign keys and indexes for participants and relations
            $table->bigInteger('staff_id')->unsigned()->nullable()->index();
            $table->bigInteger('member_id')->unsigned()->index();
            $table->bigInteger('card_id')->unsigned()->nullable()->index();
            $table->bigInteger('reward_id')->unsigned()->nullable()->index();

            // Participants' information
            // Save this information in case a staff member, card or reward is deleted
            $table->string('partner_name', 128)->nullable();
            $table->string('partner_email', 128);
            $table->string('staff_name', 128)->nullable();
            $table->string('staff_email', 128);
            $table->json('card_title')->nullable();
            $table->json('reward_title')->nullable();
            $table->integer('reward_points')->unsigned()->nullable();

            // Transaction details
            $table->char('currency', 3)->nullable();
            $table->bigInteger('purchase_amount')->unsigned()->nullable();
            $table->integer('points');
            $table->integer('points_used')->unsigned()->default(0);
            $table->integer('currency_unit_amount')->unsigned()->nullable();
            $table->integer('points_per_currency')->unsigned()->nullable();
            $table->decimal('point_value', 8, 4)->unsigned()->nullable();
            $table->integer('min_points_per_purchase')->unsigned()->nullable();
            $table->integer('max_points_per_purchase')->unsigned()->nullable();
            $table->integer('min_points_per_redemption')->unsigned()->nullable();
            $table->integer('max_points_per_redemption')->unsigned()->nullable();
            $table->string('event', 250)->nullable();
            $table->text('note')->nullable();
            $table->timestamp('expires_at')->nullable();

            // Meta information
            $table->json('meta')->nullable();

            // Ownership and timestamps
            $table->bigInteger('created_by')->unsigned()->nullable()->index();
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index();
            $table->bigInteger('updated_by')->unsigned()->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('SET NULL');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('CASCADE');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('CASCADE');
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('SET NULL');
            $table->foreign('created_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('partners')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations to drop the 'transactions' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
