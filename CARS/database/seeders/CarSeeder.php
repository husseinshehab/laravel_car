<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert 30 cars
        for ($i = 1; $i <= 30; $i++) {
            DB::table('cars')->insert([
                'name' => 'Car ' . $i,
                'model' => 'Model ' . $i,
                'year' => rand(2010, 2023), // Random year between 2010 and 2023
                'horsepower' => rand(100, 500), // Random horsepower between 100 and 500
                'mileage' => rand(0, 100000), // Random mileage between 0 and 100000
                'price' => rand(5000, 50000), // Random price between 5000 and 50000
            ]);
        }
    }

}
