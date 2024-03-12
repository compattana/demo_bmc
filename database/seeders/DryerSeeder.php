<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DryerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dryers')->insert([
            [
                'id' => 1,
                'title' => 'Com. dryer ไม่ทำงาน',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'title' => 'Dewpoint สูง',
                'status' => 'active',
            ],
            [
                'id' => 3,
                'title' => 'มีน้ำไปกับลม',
                'status' => 'active',
            ],
            [
                'id' => 4,
                'title' => 'ระบบลมหรือน้ำยารั่ว',
                'status' => 'active',
            ],
        ]);
    }
}
