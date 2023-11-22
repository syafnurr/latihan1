<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'clubs' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Club details
            $table->string('name', 96)->nullable();
            $table->text('description')->nullable();
            $table->string('host', 250)->nullable();
            $table->string('slug', 250)->nullable()->unique();

            // Address and location
            $table->string('location', 128)->nullable();
            $table->string('street1', 250)->nullable();
            $table->string('street2', 250)->nullable();
            $table->string('box_number', 32)->nullable();
            $table->string('postal_code', 32)->nullable();
            $table->string('city', 128)->nullable();
            $table->string('admin1', 164)->nullable();
            $table->string('admin2', 164)->nullable();
            $table->integer('geoname_id')->unsigned()->nullable();
            $table->string('region', 64)->nullable();
            $table->integer('region_geoname_id')->unsigned()->nullable();
            $table->char('country_code', 2)->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();

            // Localization settings
            $table->string('locale', 12)->nullable();
            $table->char('currency', 3)->nullable();
            $table->string('time_zone', 48)->nullable();

            // Club settings
            $table->boolean('is_active')->default(true);
            $table->boolean('is_primary')->default(false);
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

        Schema::table('clubs', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('deleted_by')->references('id')->on('partners')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('partners')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations to drop the 'clubs' table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
};
