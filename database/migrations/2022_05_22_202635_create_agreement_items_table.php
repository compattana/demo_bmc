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
        Schema::create('agreement_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agreement_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('product_serial_id')->unsigned();
            $table->timestamps();
            $table->foreign('agreement_id')->references('id')->on('agreements')->cascadeOnDelete();
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

    }
};
