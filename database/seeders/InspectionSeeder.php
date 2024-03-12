<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('inspections')->insert([
            [
                'id' => 1,
                'title' => 'Vacuum gauge',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 2,
                'title' => 'Throttle Valve',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                // // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 3,
                'title' => 'Check Valve',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 4,
                'title' => 'Min. press Valve',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 5,
                'title' => 'Moisture trap',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 6,
                'title' => 'Condensate Drain',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 7,
                'title' => 'After Cooler',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'air_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 8,
                'title' => 'Oil Level',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 9,
                'title' => 'Oil Condition',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 10,
                'title' => 'Level Gauge',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 11,
                'title' => 'Oil Filter',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 12,
                'title' => 'Bypass Valve',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 13,
                'title' => 'Oil sep. Element',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 14,
                'title' => 'Oil stop Valve',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 15,
                'title' => 'Oil Cooler',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 16,
                'title' => 'Cooling Fan',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'oil_circuit',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],

            // Mot
            [
                'id' => 17,
                'title' => 'Coupling/Belts',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'mot',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 18,
                'title' => 'Bearing Greased',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'mot',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],

            // Control System
            [
                'id' => 19,
                'title' => 'Regulating unit',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 20,
                'title' => 'Pressure sw.',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 21,
                'title' => 'Gauge',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 22,
                'title' => 'Timer relay',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 23,
                'title' => 'Hour meter',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 24,
                'title' => 'Sensor Transducer',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                //// 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 25,
                'title' => 'Module',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 26,
                'title' => 'Magnetic Contactor',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 27,
                'title' => 'Start Cubicle',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 28,
                'title' => 'Overload',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'control_system',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],

            // General
            [
                'id' => 29,
                'title' => 'Leakage Air/Oil',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'general',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 30,
                'title' => 'Loose Bolts/Nuts',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'general',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 31,
                'title' => 'General Cleanliness',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'general',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
            [
                'id' => 32,
                'title' => 'Site Condition',
                 'limit_value' => $faker->numberBetween(1000,3000),
                'type' => 'general',
                'status' => 'active',
                // 'product_serial_id' => $faker->numberBetween(1,10),
            ],
        ]);
    }
}
