<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'members' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Foreign key
            $table->bigInteger('affiliate_id')->unsigned()->nullable()->index();
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('SET NULL');

            // Member account details
            $table->tinyInteger('role')->default(1); // 1 = regular member
            $table->string('member_number', 32)->nullable()->unique(); // Unique number in format of: xxx-xxx-xxx-xxx
            $table->string('unique_identifier', 32)->nullable()->unique(); // Unique identifier
            $table->string('display_name', 64)->nullable(); // Visible to other users
            $table->string('name', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->default(0); // 0 = unknown, 1 = male, 2 = female

            // Two-Factor Authentication
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->string('two_factor_recovery_codes')->nullable();

            // Account expiration and premium status
            $table->timestamp('account_expires_at')->nullable();
            $table->timestamp('premium_expires_at')->nullable();

            // Localization settings
            $table->string('locale', 12)->nullable();
            $table->char('country_code', 2)->nullable();
            $table->char('currency', 3)->nullable();
            $table->string('time_zone', 48)->nullable();

            // Phone details
            $table->string('phone_prefix', 4)->nullable();
            $table->string('phone_country', 2)->nullable();
            $table->string('phone', 24)->nullable();
            $table->string('phone_e164', 24)->nullable();

            // Member account settings
            $table->boolean('is_active')->default(true);
            $table->boolean('is_vip')->default(false);
            $table->boolean('accepts_emails')->default(false);
            $table->boolean('accepts_text_messages')->default(false);
            $table->boolean('is_undeletable')->default(false);
            $table->boolean('is_uneditable')->default(false);

            // Interaction stats
            $table->integer('number_of_times_logged_in')->unsigned()->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->integer('number_of_emails_received')->unsigned()->default(0);
            $table->integer('number_of_text_messages_received')->unsigned()->default(0);
            $table->integer('number_of_reviews_written')->unsigned()->default(0);
            $table->integer('number_of_ratings_given')->unsigned()->default(0);

            // Meta information
            $table->json('meta')->nullable();

            // Ownership and timestamps
            $table->bigInteger('created_by')->unsigned()->nullable()->index();
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index();
            $table->bigInteger('updated_by')->unsigned()->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('members', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('SET NULL');
            $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations to drop the 'members' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
