<?php

namespace Database\Seeders;

use App\Models\ProductPart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductSerialSeeder::class);
        $this->call(ProductModelSeeder::class);
        $this->call(ProductPartSeeder::class);
        $this->call(CompressorSeeder::class);
        $this->call(DryerSeeder::class);
        $this->call(InspectionSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
