<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'cards' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Foreign key
            $table->bigInteger('club_id')->unsigned()->nullable()->index();
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('CASCADE');

            // Card content and details
            $table->string('name', 250);
            $table->string('type', 32)->default('loyalty');
            $table->string('icon', 32)->nullable();
            $table->json('head')->nullable();
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->string('unique_identifier', 32)->nullable()->unique(); // Unique number in format of: xxx-xxx-xxx-xxx
            $table->timestamp('issue_date')->useCurrent();
            $table->timestamp('expiration_date')->nullable();

            // Card design
            $table->string('bg_color', 25)->nullable();
            $table->tinyInteger('bg_color_opacity')->nullable();
            $table->string('text_color', 32)->nullable();
            $table->string('text_label_color', 32)->nullable();
            $table->string('qr_color_light', 32)->nullable();
            $table->string('qr_color_dark', 32)->nullable();

            // Card features and settings
            $table->char('currency', 3)->nullable();
            $table->integer('initial_bonus_points')->unsigned()->nullable();
            $table->integer('points_expiration_months')->unsigned()->nullable();
            $table->integer('currency_unit_amount')->unsigned()->nullable();
            $table->integer('points_per_currency')->unsigned()->nullable();
            $table->decimal('point_value', 8, 4)->unsigned()->nullable();
            $table->bigInteger('min_points_per_purchase')->unsigned()->nullable();
            $table->bigInteger('max_points_per_purchase')->unsigned()->nullable();
            $table->bigInteger('min_points_per_redemption')->unsigned()->nullable();
            $table->bigInteger('max_points_per_redemption')->unsigned()->nullable();
            $table->json('custom_rule1')->nullable();
            $table->json('custom_rule2')->nullable();
            $table->json('custom_rule3')->nullable();

            // Card activation and visibility
            $table->boolean('is_active')->default(true);
            $table->boolean('is_visible_by_default')->default(false);
            $table->boolean('is_visible_when_logged_in')->default(false);
            $table->boolean('is_undeletable')->default(false);
            $table->boolean('is_uneditable')->default(false);

            // Card statistics
            $table->integer('total_amount_purchased')->unsigned()->default(0);
            $table->integer('number_of_points_issued')->unsigned()->default(0);
            $table->timestamp('last_points_issued_at')->nullable();
            $table->integer('number_of_points_redeemed')->unsigned()->default(0);
            $table->integer('number_of_rewards_redeemed')->unsigned()->default(0);
            $table->timestamp('last_reward_redeemed_at')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->timestamp('last_view')->nullable();

            // Meta information
            $table->json('meta')->nullable();

            // Ownership and timestamps
            $table->bigInteger('created_by')->unsigned()->nullable()->index();
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index();
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('partners')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations to drop the 'cards' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
};