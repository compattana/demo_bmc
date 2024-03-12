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
        Schema::create('part_has_inspections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_part_id')->unsigned();
            $table->bigInteger('inspection_id')->unsigned();
            $table->timestamps();
            $table->foreign('product_part_id')->references('id')->on('product_parts')->cascadeOnDelete();
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
        Schema::dropIfExists('part_has_inspections');
    }
};
