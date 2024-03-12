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
        Schema::create('preventive_maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('compressor_type')->nullable()->comment('ประเภท compressor');
            $table->string('contract_person')->nullable()->comment('ผู้ติดต่อ');
            $table->string('report_no')->nullable()->comment('เลขที่รายงาน');
            $table->string('running')->nullable();
            $table->string('loading')->nullable();
            $table->string('load1')->nullable();
            $table->string('load2')->nullable();
            $table->string('load3')->nullable();
            $table->string('unload1')->nullable();
            $table->string('unload2')->nullable();
            $table->string('unload3')->nullable();
            $table->text('result_pm')->nullable()->comment('ผลลัพธ์');
            $table->bigInteger('maintenance_schedule_id')->unsigned();
            $table->bigInteger('technician_report_id')->unsigned();
            $table->bigInteger('agreement_item_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('maintenance_schedule_id')->references('id')->on('maintenance_schedules')->cascadeOnDelete();
            $table->foreign('technician_report_id')->references('id')->on('technician_reports')->cascadeOnDelete();
            $table->foreign('agreement_item_id')->references('id')->on('agreement_items')->cascadeOnDelete();
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
        Schema::dropIfExists('preventive_maintenances');
    }
};
