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
        Schema::create('inspection_items', function (Blueprint $table) {
            $table->id();
            $table->string('last_record_inspection')->nullable()->comment('ค่าที่บันทึกครั้งล่าสุด');
            $table->boolean('checked')->nullable()->comment('checked');
            $table->boolean('cleaned')->nullable()->comment('cleaned');
            $table->boolean('adjust')->nullable()->comment('adjust');
            $table->boolean('repair')->nullable()->comment('repair');
            $table->boolean('replace')->nullable()->comment('replace');
            $table->boolean('remarks')->nullable()->comment('remarks');
            $table->bigInteger('pm_id')->unsigned();
            $table->bigInteger('inspection_id')->unsigned();
            $table->timestamps();
            $table->foreign('pm_id')->references('id')->on('preventive_maintenances')->cascadeOnDelete();
            $table->foreign('inspection_id')->references('id')->on('inspections')->cascadeOnDelete();
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
        Schema::dropIfExists('inspection_items');
    }
};
