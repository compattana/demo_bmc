<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('products')->insert([
            [
                'id' => 1,
                'title' => 'GA18VSD+',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 2,
                'title' => 'GA18+',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 3,
                'title' => 'TKID 15/500',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 4,
                'title' => 'TA-120',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 5,
                'title' => 'G45+',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 6,
                'title' => 'GAe22FF',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 7,
                'title' => 'GA22',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 8,
                'title' => 'GA22+',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 9,
                'title' => 'GAE18',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
            [
                'id' => 10,
                'title' => 'G11FFTM',
                'code' => $faker->numerify('pdt-#####'),
                'status' => 'active',

            ],
        ]);
    }
}
