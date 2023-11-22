<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'rewards' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Reward details
            $table->string('name', 250);
            $table->json('title');
            $table->json('description')->nullable();
            $table->integer('max_number_to_redeem')->default(0);
            $table->integer('points')->unsigned();
            $table->timestamp('active_from')->nullable();
            $table->timestamp('expiration_date')->nullable();

            // Reward activation
            $table->boolean('is_active')->default(true);

            // Reward statistics
            $table->integer('number_of_times_redeemed')->unsigned()->default(0);
            $table->integer('views')->unsigned()->default(0);
            $table->timestamp('last_view')->nullable();
            $table->boolean('is_undeletable')->default(false);
            $table->boolean('is_uneditable')->default(false);

            // Meta information
            $table->json('meta')->nullable();

            // Ownership and timestamps
            $table->bigInteger('created_by')->unsigned()->nullable()->index();
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index();
            $table->bigInteger('updated_by')->unsigned()->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('rewards', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('partners')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations to drop the 'rewards' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
};
