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
        Schema::table('maintenance_schedules', function (Blueprint $table) {
            DB::statement("ALTER TABLE maintenance_schedules MODIFY COLUMN type ENUM('maintenance_pm', 'no_contract', 'emergency', 'install', 'rework', 'other') NOT NULL DEFAULT 'maintenance_pm'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
        });
    }
};
