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
        Schema::create('schedule_others', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable()->comment('วันที่');
            $table->string('customer_name')->nullable()->comment('ชื่อลูกค้า');
            $table->string('organization_name')->nullable()->comment('ชื่อหน่วยงาน');
            $table->string('product_model')->nullable()->comment('ชื่อรุ่น');
            $table->string('product_number')->nullable()->comment('หมายเลขเครื่อง');
            $table->string('car_no')->nullable()->comment('หมายเลขรถบริการ');
            $table->time('normal_start_time')->nullable()->comment('เวลาเริ่มงานปกติ');
            $table->time('normal_end_time')->nullable()->comment('ทำงานถึงเวลา');
            $table->string('total_normal_work_time')->nullable()->comment('รวมเวลา');
            $table->time('ot_start_time')->nullable()->comment('เวลาล่วงเวลา');
            $table->time('ot_end_time')->nullable()->comment('ทำงานล่วงเวลาถึง');
            $table->string('total_ot_work_time')->nullable()->comment('รวมชั่วโมงทำงานล่วงเวลา');
            $table->string('travel_time')->nullable()->comment('จำนวนชั่วโมงเดินทางไป');
            $table->string('return_time')->nullable()->comment('จำนวนชั่วโมงเดินทางกลับ');
            $table->bigInteger('maintenance_schedule_id')->unsigned();
            $table->timestamps();
            $table->foreign('maintenance_schedule_id')->references('id')->on('maintenance_schedules')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_others');
    }
};
