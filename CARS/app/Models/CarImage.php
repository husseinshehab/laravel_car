<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;

    // Table name if different from model plural
    protected $table = 'car_images';

    // Allow mass assignment
    protected $fillable = [
        'car_id', 'image_url'
    ];

    // Define relationship: An image belongs to a car
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
