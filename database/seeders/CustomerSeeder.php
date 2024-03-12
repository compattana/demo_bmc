<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('customers')->insert([
            [
                'id' => 1,
                'name' => '',
                'organization_name' => 'บจก.นครราชสีมา ฮอนด้าออโตโมบิล',
                'code' => $faker->numerify('cus-#####'),
                'token' => bcrypt(Str::random(50)),
                'email' => 'y.pornwisa@gmail.com',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => '',
                'organization_name' => 'บจก.โรงสีทรัพย์อนันต์',
                'code' => $faker->numerify('cus-#####'),
                'status' => 'active',
                'token' => bcrypt(Str::random(50)),
                'email' => 'y.pornwisa@gmail.com',
            ],
            [
                'id' => 3,
                'name' => '',
                'organization_name' => 'บจก.สมบูรณ์การพิมพ์',
                'code' => $faker->numerify('cus-#####'),
                'status' => 'active',
                'token' => bcrypt(Str::random(50)),
                'email' => 'y.pornwisa@gmail.com',
            ],
            [
                'id' => 4,
                'name' => '',
                'organization_name' => 'บจก.ตังปักโคราช',
                'code' => $faker->numerify('cus-#####'),
                'status' => 'active',
                'token' => bcrypt(Str::random(50)),
                'email' => 'y.pornwisa@gmail.com',
            ],
            [
                'id' => 5,
                'name' => '',
                'organization_name' => 'บจก.กฤติมาก่อสร้าง(ATLAS)',
                'code' => $faker->numerify('cus-#####'),
                'status' => 'active',
                'token' => bcrypt(Str::random(50)),
                'email' => 'y.pornwisa@gmail.com',
            ],
            [
                'id' => 6,
                'name' => '',
                'organization_name' => 'บจก.เบทาโกร(ปักธงชัย)',
                'code' => $faker->numerify('cus-#####'),
                'status' => 'active',
                'token' => bcrypt(Str::random(50)),
                'email' => 'y.pornwisa@gmail.com',
            ],
        ]);
    }
}
