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
        Schema::create('preventive_replacement_items', function (Blueprint $table) {
            $table->id();
            $table->text('filter_type')->nullable();
            $table->text('last_replacement')->nullable();
            $table->text('next_replacement')->nullable();
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
        Schema::dropIfExists('preventive_replacement_items');
    }
};
