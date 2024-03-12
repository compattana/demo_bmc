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
        Schema::create('product_parts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('ชื่อ');
            $table->string('part_no')->nullable()->comment('เลขที่อะไหล่');
            $table->string('limit_value')->comment('ค่าจำกัด');
            $table->string('note')->nullable()->comment('รายละเอียดเพิ่มเติม');
            $table->enum('status',['active','inactive'])->default('active')->comment('สถานะ');
            $table->timestamps();
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
        Schema::dropIfExists('product_parts');
    }
};
