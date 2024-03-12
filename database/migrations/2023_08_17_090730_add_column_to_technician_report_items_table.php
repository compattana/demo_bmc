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
        Schema::table('technician_reports', function (Blueprint $table) {
            DB::statement("ALTER TABLE technician_reports MODIFY COLUMN status_report ENUM('in_progress','no_approve','approved','warranty','wait_price'
    , 'rework', 'job_close', 'other') NOT NULL DEFAULT 'in_progress'");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('technician_report_items', function (Blueprint $table) {
            //
        });
    }
};
