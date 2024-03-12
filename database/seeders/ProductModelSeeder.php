<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('product_models')->insert([
                [
                    'id' => 1,
                    'title' => 'Ambient',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
//                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 2,
                    'title' => 'Air Outlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
//                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 3,
                    'title' => 'E1 Outlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
//                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 4,
                    'title' => 'E2 Outlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
//                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 5,
                    'title' => 'Oil in cooler',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 6,
                    'title' => 'Oil out cooler',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 7,
                    'title' => 'A/W inlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 8,
                    'title' => 'A/W outlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 9,
                    'title' => 'Motor housing',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 10,
                    'title' => 'Cooling',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'temperature',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],

                // Pressure
                [
                    'id' => 11,
                    'title' => 'Delivery',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'pressure',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 12,
                    'title' => 'DP AF.',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'pressure',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 13,
                    'title' => 'DP Oilsep.',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'pressure',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 14,
                    'title' => 'Oil injection',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'pressure',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 15,
                    'title' => 'W inlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'pressure',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 16,
                    'title' => 'W outlet',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'pressure',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],

                // Voltage
                [
                    'id' => 17,
                    'title' => 'Phase L1, L2',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'voltage',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 18,
                    'title' => 'Phase L2, L3',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'voltage',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 19,
                    'title' => 'Phase L3, L1',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'voltage',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],

                // Current Load
                [
                    'id' => 20,
                    'title' => 'Drive mot.L1',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'current_load',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 21,
                    'title' => 'Drive mot.L2',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'current_load',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 22,
                    'title' => 'Drive mot.L3',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'current_load',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],

                // Current Unload
                [
                    'id' => 23,
                    'title' => 'Drive mot.L1',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'current_unload',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 24,
                    'title' => 'Drive mot.L2',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'current_unload',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
                [
                    'id' => 25,
                    'title' => 'Drive mot.L3',
                    'limit_value' => $faker->numberBetween(1000,3000),
                    'type' => 'current_unload',
                    'status' => 'active',
                    // 'product_id' => $faker->numberBetween(1,10),
                ],
            ]
        );
    }
}
