<?php

namespace Database\Seeders;

use App\Models\ProductSerial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSerialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('product_serials')->insert([
            [
                'id' => 1,
                'serial_name' => 'AP1823726',
                'product_id' => '1',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 2,
                'serial_name' => 'AP1325993',
                'product_id' => '2',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 3,
                'serial_name' => 'BC817112',
                'product_id' => '3',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 4,
                'serial_name' => 'BC817113',
                'product_id' => '3',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 5,
                'serial_name' => 'A-2012133',
                'product_id' => '4',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 6,
                'serial_name' => 'A-20130060',
                'product_id' => '4',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 7,
                'serial_name' => 'WUX731317',
                'product_id' => '5',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 8,
                'serial_name' => 'WUX253845',
                'product_id' => '6',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'id' => 9,
                'serial_name' => 'WUX100435',
                'product_id' => '7',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'serial_name' => 'API332711',
                'product_id' => '8',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'serial_name' => 'WUX235853',
                'product_id' => '2',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'serial_name' => 'WUX235540',
                'product_id' => '2',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'serial_name' => 'WUX250148',
                'product_id' => '9',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'serial_name' => 'WUX254559',
                'product_id' => '9',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'serial_name' => 'WXI014364',
                'product_id' => '10',
                'code' => $faker->numerify('pdt-sr-#####'),
                'serial_status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
