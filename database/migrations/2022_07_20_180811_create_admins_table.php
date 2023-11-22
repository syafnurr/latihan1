<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'admins' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Account information
            $table->tinyInteger('role')->default(2)->index(); // 1 = Admin, 2 = Manager
            $table->string('display_name', 64)->nullable();
            $table->string('name', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            // Two-Factor Authentication
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->string('two_factor_recovery_codes')->nullable();

            // Account expiration
            $table->timestamp('account_expires_at')->nullable();
            $table->timestamp('premium_expires_at')->nullable();

            // Localization settings
            $table->string('locale', 12)->nullable();
            $table->char('country_code', 2)->nullable();
            $table->char('currency', 3)->nullable();
            $table->string('time_zone', 48)->nullable();

            // Phone information
            $table->string('phone_prefix', 4)->nullable();
            $table->string('phone_country', 2)->nullable();
            $table->string('phone', 24)->nullable();
            $table->string('phone_e164', 24)->nullable();

            // Account settings
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_undeletable')->default(false);
            $table->boolean('is_uneditable')->default(false);

            // Login statistics
            $table->integer('number_of_times_logged_in')->unsigned()->default(0);
            $table->timestamp('last_login_at')->nullable();

            // Meta information
            $table->text('meta')->nullable();

            // Ownership and timestamps
            $table->bigInteger('created_by')->unsigned()->nullable()->index();
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index();
            $table->bigInteger('updated_by')->unsigned()->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations to drop the 'admins' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
