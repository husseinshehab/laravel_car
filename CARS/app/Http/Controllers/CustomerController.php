<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all cars and their first image
        $cars = Car::with('images') // Assuming 'images' is the relationship method on the Car model
                    ->get()
                    ->map(function ($car) {
                        $car->first_image = $car->images->first(); // Get the first image of each car
                        return $car;
                    });

        // Return the view with the cars and their first image
        return view('customers.index', ['cars' => $cars]);
    }

 
    public function show($carId)
    {
        // Retrieve the car by its ID
        $car = Car::find($carId);

        // Check if the car exists
        if (!$car) {
            return redirect()->route('customers.index')->with('error', 'Car not found');
        }

        // Retrieve car images based on the car_id
        $car_images = CarImage::where('car_id', $carId)->get();

        // Get the next car
        $nextCar = Car::where('id', '>', $carId)->orderBy('id', 'asc')->first();
        
        // Get the previous car
        $prevCar = Car::where('id', '<', $carId)->orderBy('id', 'desc')->first();

        // Pass the data to the view
        return view('customers.show', [
            'car' => $car,
            'car_images' => $car_images,
            'nextCar' => $nextCar, // Next car
            'prevCar' => $prevCar, // Previous car
        ]);
    }

    public function search(Request $request)
    {

        $string = $request->query('query'); // Get search query from URL
        
        // Fetch cars that match the search criteria in any column
        $cars = Car::with('images')
                    ->where(function ($query) use ($string) {
                        $query->where('id', 'LIKE', "%{$string}%")
                            ->orWhere('name', 'LIKE', "%{$string}%")
                            ->orWhere('model', 'LIKE', "%{$string}%")
                            ->orWhere('year', 'LIKE', "%{$string}%")
                            ->orWhere('horsepower', 'LIKE', "%{$string}%")
                            ->orWhere('mileage', 'LIKE', "%{$string}%")
                            ->orWhere('price', 'LIKE', "%{$string}%")
                            ->orWhere('created_at', 'LIKE', "%{$string}%")
                            ->orWhere('updated_at', 'LIKE', "%{$string}%");
                    })
                    ->get()
                    ->map(function ($car) {
                        $car->first_image = $car->images->first(); // Get the first image of each car
                        return $car;
                    });

        return view('customers.index', ['cars' => $cars]);
    }

}
