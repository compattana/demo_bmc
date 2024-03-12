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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('ชื่อสัญญา');
            $table->string('code')->comment('เลขที่สัญญา');
            $table->string('tax_invoice')->nullable()->comment('ใบกำกับภาษี');
            $table->string('contract')->comment('จำนวนครั้งการเข้าซ่อม');
            $table->string('price')->comment('ราคา');
            $table->date('start_contract')->comment('วันที่เริ่มสัญญา');
            $table->date('end_contract')->comment('วันที่หมดสัญญา');
            $table->string('note')->nullable()->comment('หมายเหตุ');
            $table->enum('contract_type',['month','year'])->comment('ประเภทสัญญา');
            $table->enum('status',['active','inactive'])->default('active')->comment('สถานะ');
            $table->bigInteger('customer_id')->unsigned();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
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
        Schema::dropIfExists('agreements');
    }
};
