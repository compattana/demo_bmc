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
        Schema::create('compressor_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('compressor_id')->nullable()->unsigned();
            $table->bigInteger('technician_report_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('compressor_id')->references('id')->on('compressors')->cascadeOnDelete();
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
        Schema::dropIfExists('compressor_items');
    }
};
