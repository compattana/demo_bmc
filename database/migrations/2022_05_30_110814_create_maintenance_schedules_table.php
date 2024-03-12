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
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('round_pm')->comment('ครั้งที่')->nullable();
            $table->date('month_pm')->comment('เดือนที่ต้องเข้า maintenance_pm')->nullable();
            $table->enum('status',['pending','in_progress','no_approve','approved'])->default('pending')->comment('สถานะการดำเนินการ');
            $table->dateTime('appointment_date')->nullable()->comment('วันเวลาที่ต้องการลงเวลา');
            $table->string('note')->nullable()->comment('โน๊ต');
            $table->enum('type', ['maintenance_pm', 'no_contract', 'emergency', 'install', 'rework'])->default('maintenance_pm')->comment('ประเภทการนัดลงเวลา');
            $table->bigInteger('agreement_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('approve_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('agreement_id')->references('id')->on('agreements')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('approve_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('maintenance_schedules');
    }
};
