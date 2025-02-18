<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\File;
class AdminController extends Controller
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
        return view('admins.index', ['cars' => $cars]);
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
        return view('admins.show', [
            'car' => $car,
            'car_images' => $car_images,
            'nextCar' => $nextCar, // Next car
            'prevCar' => $prevCar, // Previous car
        ]);
    }
    public function create()
    {
        return view('admins.create');
    }
    public function store(Request $request)
    {
        
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'horsepower' => 'required|integer',
            'mileage' => 'required|integer',
            'price' => 'required|integer',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        // Create a new car entry
        $car = new Car([
            'name' => $request->name,
            'model' => $request->model,
            'year' => $request->year,
            'horsepower' => $request->horsepower,
            'mileage' => $request->mileage,
            'price' => $request->price,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
    
        $car->save();
    
        // Handle image uploads if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads/car_images'), $imageName);
    
                // Save image information in the database (optional, depending on your structure)
                CarImage::create([
                    'car_id' => $car->id,
                    'image_url' => 'uploads/car_images/'.$imageName,
                ]);
            }
        }
    
        return redirect()->route('admins.index')->with('success', 'Car added successfully!');
    }
    public function edit ($carId)
    {
        {
            // Retrieve the car by its ID
            $car = Car::find($carId);
    
            // Check if the car exists
            if (!$car) {
                return redirect()->route('admins.index')->with('error', 'Car not found');
            }
    
            // Retrieve car images based on the car_id
            $car_images = CarImage::where('car_id', $carId)->get();
    
    
            // Pass the data to the view
            return view('admins.edit', [
                'car' => $car,
                'car_images' => $car_images,
            ]);
        }
    }
    public function update($carId)
    {
        $data = Car::find($carId);

        // dd( $data);
        $data->update([
            'name' => request()->name,
            'model' => request()->model,
            'year' => request()->year,
            'horsepower' => request()->horsepower,
            'mileage' => request()->mileage,
            'price' => request()->price,
            'created_at' => request()->created_at,
            'updated_at' => request()->updated_at,
        ]);
        return to_route('admins.show',$carId);
    }


    public function destroy($carId)
    {
        // Find the car
        $car = Car::find($carId);
    
        if ($car) {
            // Retrieve associated images from the database
            $car_images = CarImage::where('car_id', $carId)->get();
    
            // Loop through each image and delete the file from storage
            foreach ($car_images as $image) {
                $imagePath = public_path($image->image_url);
    
                // Check if file exists before deleting
                if (File::exists($imagePath)) {

                    File::delete($imagePath);
                }
            }
    
            // Delete the associated images from the database
            CarImage::where('car_id', $carId)->delete();
    
            // Delete the car record
            $car->delete();
        }
    
        return to_route('admins.index')->with('success', 'Car and associated images deleted successfully.');
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
    
        return view('admins.index', ['cars' => $cars]);
    }
    

}
