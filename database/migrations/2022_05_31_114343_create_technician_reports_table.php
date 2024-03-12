<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_reports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['general', 'maintenance_pm', 'no_contract', 'emergency', 'install', 'rework'])->default('maintenance_pm')->comment('ประเภทใบรายงานช่าง');
            $table->enum('status', ['finished', 'unfinished'])->default('finished')->comment('สถานะใบรายงานช่าง');
            $table->enum('status_report',['in_progress','no_approve','approved'])->default('in_progress')->comment('สถานะการดำเนินการ');
            $table->date('date')->comment('วันที่เข้าPM')->nullable();
            $table->string('pm_no')->nullable()->comment('เลขที่ pm');
            $table->string('maintenance_no')->nullable()->comment('เลขที่ข้อตกลงบำรุงรักษา');
            $table->string('contract')->nullable()->comment('จำนวนครั้งต่อปี');
            $table->date('end_contract')->nullable()->comment('วันที่หมดสัญญา');
            $table->string('service_round')->nullable()->comment('เข้ารับบริการรอบที่');
            $table->string('car_no')->nullable()->comment('หมายเลขรถบริการ');
            $table->string('pressure_load')->nullable()->comment('ความดัน Load/Unload');
            $table->string('hour_used')->nullable()->comment('ชั่วโมงใช้งาน');
            $table->string('hour_load')->nullable()->comment('ชั่วโมง Load');
            $table->string('prefilter')->nullable()->comment('รุ่นของ prefilter');
            $table->date('last_change_prefilter_date')->nullable()->comment('วันที่เปลี่ยนครั้งล่าสุด');
            $table->string('after_filter')->nullable()->comment('รุ่นของ after filter');
            $table->date('last_change_after_filter_date')->nullable()->comment('วันที่เปลี่ยนครั้งล่าสุด');
            $table->boolean('compressor_check')->nullable()->comment('compressor ตรวจเช็คเครื่องตามวาระ');
            $table->string('compressor_check_detail')->nullable()->comment('compressor ตรวจเช็คเครื่องตามวาระ');
            $table->string('max_pressure')->nullable()->comment('max_pressure');
            $table->boolean('compressor_other_check')->nullable()->comment('รายละเอียด compressor อื่นๆ');
            $table->string('compressor_other')->nullable()->comment('รายละเอียดอื่นๆ');
            $table->string('dryer_serial_no')->nullable()->comment('serial no ของ dryer');
            $table->boolean('dryer_other_check')->nullable()->comment('รายละเอียด dryer อื่นๆ');
            $table->string('dryer_other')->nullable()->comment('รายละเอียดอื่นๆ dryer');
            $table->text('detail')->nullable()->comment('รายละเอียดเพิ่มเติมและการแก้ไข');
            $table->time('normal_start_time')->nullable()->comment('เวลาเริ่มงานปกติ');
            $table->time('normal_end_time')->nullable()->comment('ทำงานถึงเวลา');
            $table->string('total_normal_work_time')->nullable()->comment('รวมเวลา');
            $table->time('ot_start_time')->nullable()->comment('เวลาล่วงเวลา');
            $table->time('ot_end_time')->nullable()->comment('ทำงานล่วงเวลาถึง');
            $table->string('total_ot_work_time')->nullable()->comment('รวมชั่วโมงทำงานล่วงเวลา');
            $table->string('travel_time')->nullable()->comment('จำนวนชั่วโมงเดินทางไป');
            $table->string('return_time')->nullable()->comment('จำนวนชั่วโมงเดินทางกลับ');
            $table->bigInteger('maintenance_schedule_id')->unsigned()->nullable();
            $table->bigInteger('agreement_item_id')->unsigned()->nullable();
            $table->bigInteger('technician_id')->unsigned()->nullable()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('product_serial_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('maintenance_schedule_id')->references('id')->on('maintenance_schedules')->cascadeOnDelete();
            $table->foreign('agreement_item_id')->references('id')->on('agreement_items')->cascadeOnDelete();
            $table->foreign('technician_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('product_serial_id')->references('id')->on('product_serials');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('technician_reports');
    }
};
