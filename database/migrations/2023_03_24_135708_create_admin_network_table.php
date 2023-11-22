<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the 'admin_network' table.
     */
    public function up(): void
    {
        Schema::create('admin_network', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->index();
            $table->unsignedBigInteger('network_id')->index();
            $table->timestamps();
        });

        Schema::table('admin_network', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('CASCADE');
            $table->foreign('network_id')->references('id')->on('networks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_network');
    }
};
