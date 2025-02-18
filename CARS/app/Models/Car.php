<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'cars';

    // Allow mass assignment for these fields
    protected $fillable = [
        'id','name', 'model', 'year', 'horsepower', 'mileage', 'price'
    ];

    // Define relationship: A car has many images
    public function images()
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }
}
