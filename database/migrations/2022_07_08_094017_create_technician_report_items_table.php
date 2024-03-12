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
        Schema::create('technician_report_items', function (Blueprint $table) {
            $table->id();
            $table->boolean('ms')->nullable()->comment('หัวหน้าตรวจสอบ M/S');
            $table->boolean('wty')->nullable()->comment('หัวหน้าตรวจสอบ WTY');
            $table->boolean('job_close')->nullable()->comment('หัวหน้าตรวจสอบ job close');
            $table->boolean('file')->nullable()->comment('หัวหน้าตรวจสอบ file');
            $table->boolean('ass')->nullable()->comment('หัวหน้าตรวจสอบ ass');
            $table->boolean('cust')->nullable()->comment('หัวหน้าตรวจสอบ cust');
            $table->text('other_check')->nullable()->comment('อื่นๆเพิ่มเติม');
            $table->text('other_detail')->nullable()->comment('อื่นๆเพิ่มเติม');
            $table->text('note')->nullable()->comment('noteของใบรายงานช่าง');
            $table->bigInteger('technician_report_id')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('technician_report_items');
    }
};
