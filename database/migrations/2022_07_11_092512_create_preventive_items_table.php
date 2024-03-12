<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventive_items', function (Blueprint $table) {
            $table->id();
            $table->string('point')->nullable();
            $table->string('dbi')->nullable();
            $table->string('dbm1')->nullable();
            $table->string('dbc1')->nullable();
            $table->string('dbm2')->nullable();
            $table->string('dbc2')->nullable();
            $table->string('other')->nullable();
            $table->bigInteger('preventive_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('preventive_id')->references('id')->on('preventive_maintenances')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preventive_items');
    }
};
