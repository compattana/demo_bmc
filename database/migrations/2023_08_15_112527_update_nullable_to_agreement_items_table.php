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
        Schema::table('agreement_items', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned()->nullable(true)->change();
            $table->bigInteger('product_serial_id')->unsigned()->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agreement_items', function (Blueprint $table) {
            //
        });
    }
};
