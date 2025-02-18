<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarImageSeeder extends Seeder
{
    public function run()
    {
        // Fetch all the cars
        $cars = DB::table('cars')->get();

        // Define the correct image path relative to the public directory
        $imagePath = 'CARS/public/image.jpg'; 

        // Loop through each car and insert a random number of images (1, 3, or 4)
        foreach ($cars as $car) {
            // Generate a random number of images (1, 3, or 4)
            $numImages = [1, 3, 4][rand(0, 2)]; // Randomly select 1, 3, or 4

            // Insert the specified number of images
            for ($i = 1; $i <= $numImages; $i++) {
                DB::table('car_images')->insert([
                    'car_id' => $car->id,
                    'image_url' => 'image.jpg',  // Store only the filename
                ]);               
            }
        }
    }
}
