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
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('ชื่อ product model');
            $table->string('limit_value')->comment('คำสูงสุด');
            $table->enum('type',['temperature', 'pressure', 'voltage', 'current_load', 'current_unload'])->default('temperature')->comment('ประเภท');
            $table->enum('status',['active','inactive'])->default('active')->comment('สถานะการใช้งาน');
//            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();
//            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
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
        Schema::dropIfExists('product_models');
    }
};
