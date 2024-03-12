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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('ชื่ออาการ parts');
            $table->enum('type',['air_circuit', 'oil_circuit', 'mot', 'control_system', 'general'])->default('general')->comment('ประเภท');
            $table->string('limit_value')->nullable()->comment('ค่าจำกัด');
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
        Schema::dropIfExists('inspections');
    }
};
