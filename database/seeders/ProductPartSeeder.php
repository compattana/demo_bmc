<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('product_parts')->insert([
                [
                    'id' => 1,
                    'title' => 'Filter Kit (air/oil filter)',
                    'limit_value' => '4000',
                    // // 'type' => 'air_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 2,
                    'title' => 'Oil Separator',
                    'limit_value' => '4000',
                    // 'type' => 'air_circuit',
                    'status' => 'active',
                  // // 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 3,
                    'title' => 'Oil Lubricant (20 l.)',
                    'limit_value' => '4000',
                    // 'type' => 'air_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 4,
                    'title' => 'Filter Kit ( air/oil filter)',
                    'limit_value' => '8000',
                    // 'type' => 'air_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 5,
                    'title' => 'Oil Separator ',
                    'limit_value' => '8000',
                    // 'type' => 'air_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 6,
                    'title' => 'Oil Lubricant (20 l.)',
                    'limit_value' => '8000',
                    // 'type' => 'air_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 7,
                    'title' => 'Oil Lubricant (5 l. (G,GA55-90 kw.))',
                    'limit_value' => '8000',
                    // 'type' => 'air_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 8,
                    'title' => 'Unloaded Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 9,
                    'title' => 'Minimum Pressure Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 10,
                    'title' => 'Thermostatic Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 11,
                    'title' => 'Oil stop/check Valve Kit ',
                    'limit_value' => '8000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 12,
                    'title' => 'Scavenge Line ',
                    'limit_value' => '8000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 13,
                    'title' => 'Drain Kit ( WSD25-80;EWD330M;LD200-202;ED12)',
                    'limit_value' => '8000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 14,
                    'title' => 'Air/oil Filter',
                    'limit_value' => '4000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 15,
                    'title' => 'Oil Separator',
                    'limit_value' => '4000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 16,
                    'title' => 'Oil Lubricant',
                    'limit_value' => '4000',
                    // 'type' => 'oil_circuit',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 17,
                    'title' => 'Air/Oil Filter ',
                    'limit_value' => '8000',
                    // 'type' => 'mot',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 18,
                    'title' => 'Oil Separator',
                    'limit_value' => '8000',
                    // 'type' => 'mot',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],

                // Control System
                [
                    'id' => 19,
                    'title' => 'Oil Lubricant',
                    'limit_value' => '8000',
                    // 'type' => 'control_system',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 20,
                    'title' => 'Unloaded Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'control_system',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 21,
                    'title' => 'Minimum Pressure Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'control_system',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 22,
                    'title' => 'Thermostatic Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'control_system',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 23,
                    'title' => 'Non Return Valve Kit',
                    'limit_value' => '8000',
                    // 'type' => 'control_system',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 24,
                    'title' => 'V-belt (belt driver) ',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    // 'type' => 'control_system',
                    'status' => 'active',
                   //// 'product_serial_id' => $faker->numberBetween(1,10),
                ],
//
            ]
        );
    }
}
