<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompressorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compressors')->insert([
            [
                'id' => 1,
                'title' => 'Start เครื่องไม่ได้',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'title' => 'ชุดควบคุมไม่ทำงาน',
                'status' => 'active',
            ],
            [
                'id' => 3,
                'title' => 'เครื่องไม่ทำลม',
                'status' => 'active',
            ],
            [
                'id' => 4,
                'title' => 'น้ำมันไปกับลม',
                'status' => 'active',
            ],
            [
                'id' => 5,
                'title' => 'ตัดดับอุณหภูมิสูง',
                'status' => 'active',
            ],
            [
                'id' => 6,
                'title' => 'เครื่อง Load ตลอด',
                'status' => 'active',
            ],
            [
                'id' => 7,
                'title' => 'น้ำมันรั่ว',
                'status' => 'active',
            ],
            [
                'id' => 8,
                'title' => 'ความดันน้ำมันต่ำ',
                'status' => 'active',
            ],
            [
                'id' => 9,
                'title' => 'ทำลมต่ำกว่าปกติ',
                'status' => 'active',
            ],
            [
                'id' => 10,
                'title' => 'เครื่องมีเสียงดัง',
                'status' => 'active',
            ],
            [
                'id' => 11,
                'title' => 'Motor Overload',
                'status' => 'active',
            ],
            [
                'id' => 12,
                'title' => 'Coupling แตก',
                'status' => 'active',
            ],
            [
                'id' => 13,
                'title' => 'Safety Valve ทำงาน',
                'status' => 'active',
            ],
            [
                'id' => 14,
                'title' => 'ลมออกอุณหภูมิสูง',
                'status' => 'active',
            ],
            [
                'id' => 15,
                'title' => 'Auto Drain ไม่ทำงาน',
                'status' => 'active',
            ],
        ]);
    }
}
