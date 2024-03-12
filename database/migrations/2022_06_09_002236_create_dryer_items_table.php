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
        Schema::create('dryer_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dryer_id')->unsigned();
            $table->bigInteger('technician_report_id')->unsigned();
            $table->timestamps();
            $table->foreign('dryer_id')->references('id')->on('dryers')->cascadeOnDelete();
            $table->foreign('technician_report_id')->references('id')->on('technician_reports')->cascadeOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dryer_items');
    }
};
