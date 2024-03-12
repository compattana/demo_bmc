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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('ชื่อลูกค้า');
            $table->string('organization_name')->comment('ชื่อหน่วยงาน');
            $table->string('code')->nullable()->nullable()->comment('รหัสลูกค้า');
            $table->string('tel')->nullable()->comment('เบอร์โทร');
            $table->string('email')->comment('email');
            $table->text('address')->nullable()->comment('ที่อยู่');
            $table->string('tax_number')->nullable()->comment('เลขที่ภาษี');
            $table->string('contact_name')->nullable()->comment('ชื่อผู้ติดต่อ');
            $table->string('contact_tel')->nullable()->comment('เบอร์โทรผู้ติดต่อ');
            $table->string('token')->comment('token');
            $table->enum('status',['inactive','active'])->default('active')->comment('สถานะ');
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
        Schema::dropIfExists('customers');
    }
};
