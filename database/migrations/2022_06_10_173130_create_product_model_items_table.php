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
        Schema::create('product_model_items', function (Blueprint $table) {
            $table->id();
            $table->string('last_record')->nullable()->comment('ค่าที่บันทึกครั้งล่าสุด');
            $table->string('present_record')->nullable()->comment('ค่าปัจจุบัน');
            $table->string('result')->nullable()->comment('ผลลัพธ์');
            $table->bigInteger('pm_id')->unsigned();
            $table->bigInteger('product_model_id')->unsigned();
            $table->timestamps();
            $table->foreign('pm_id')->references('id')->on('preventive_maintenances')->cascadeOnDelete();
            $table->foreign('product_model_id')->references('id')->on('product_models')->cascadeOnDelete();
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
        Schema::dropIfExists('product_model_items');
    }
};
