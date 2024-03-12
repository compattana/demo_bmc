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
        Schema::create('technician_pms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('technician_id')->unsigned()->nullable();
            $table->bigInteger('maintenance_schedule_id')->unsigned()->nullable();
            $table->bigInteger('report_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('technician_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('maintenance_schedule_id')->references('id')->on('maintenance_schedules')->cascadeOnDelete();
            $table->foreign('report_id')->references('id')->on('technician_reports')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technician_pms');
    }
};
