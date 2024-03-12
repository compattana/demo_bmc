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
        Schema::create('part_change_items', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['present','future'])->nullable()->comment('ประเภทรายการอะไหล่ที่เปลี่ยน');
            $table->string('product_part_no')->nullable()->comment('เลขที่อะไหล่');
            $table->string('quantity')->nullable()->comment('จำนวน');
            $table->bigInteger('technician_report_id')->unsigned()->nullable()->comment('อ้างอิงใบรายงานช่าง');
            $table->bigInteger('product_part_id')->unsigned()->nullable()->comment('อ้างอิงใบรายงานช่าง');
            $table->timestamps();
            $table->foreign('technician_report_id')->references('id')->on('technician_reports')->cascadeOnDelete();
            $table->foreign('product_part_id')->references('id')->on('product_parts')->cascadeOnDelete();
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
        Schema::dropIfExists('part_change_items');
    }
};
