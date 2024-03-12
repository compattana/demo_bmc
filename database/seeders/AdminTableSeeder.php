<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                [
                    'id' => 1,
                    'username' => 'weeradach',
                    'name' => 'weeradach compat',
                    'email' => 'weeradach.ch@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 2,
                    'username' => 'y.pornwisa',
                    'name' => 'Admin Compat2',
                    'email' => 'y.pornwisa@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 3,
                    'username' => 'g.porawet',
                    'name' => 'Admin Compat2',
                    'email' => 'porawet.kunlaphruetmetha@compattana.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                   'id' => 4,
                    'username' => 'nutdanai.c',
                    'name' => 'Admin Compat3',
                    'email' => 'nuttdanai.chaleekrua@compattana.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 5,
                    'username' => 'adminBMC01',
                    'name' => 'AdminBMC01',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 6,
                    'username' => 'adminBMC02',
                    'name' => 'AdminBMC02',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 7,
                    'username' => 'technician01',
                    'name' => 'technician01',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 8,
                    'username' => 'technician02',
                    'name' => 'technician02',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],

                // new
                [
                    'id' => 9,
                    'username' => 'tanapol',
                    'name' => 'tanapol compat',
                    'email' => 'tanapol@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 10,
                    'username' => 'ekkaluk',
                    'name' => 'ekkaluk compat',
                    'email' => 'ekkaluk@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 11,
                    'username' => 'technician03',
                    'name' => 'technician03',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 12,
                    'username' => 'technician04',
                    'name' => 'technician04',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 13,
                    'username' => 'technician05',
                    'name' => 'technician05',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],
                [
                    'id' => 14,
                    'username' => 'technician06',
                    'name' => 'technician06',
                    'email' => '',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ],

            ]
        );
    }
}
