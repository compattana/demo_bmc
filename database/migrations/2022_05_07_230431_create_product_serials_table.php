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
        Schema::create('product_serials', function (Blueprint $table) {
            $table->id();
            $table->string('serial_name')->comment('ชื่อ product serial number');
            $table->string('code')->nullable()->comment('รหัส serial number');
            $table->enum('serial_status',['active','inactive'])->nullable()->comment('สถานะ');
            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
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
        Schema::dropIfExists('product_serials');
    }
};
