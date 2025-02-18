@extends('layouts.master')


@section('styles')
    <style>
.gallery-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #f8f9fa;
    border-radius: 8px;
}

#galleryTable {
    width: 100%;
    border-collapse: separate; /* Use 'separate' instead of 'collapse' */
    border-spacing: 45px; /* Adds space between table cells (images) */
    table-layout: fixed;
}

#galleryTable td {
    width: 33.33%;
    padding: 0;
    text-align: center;
    vertical-align: top;
}

.gallery-item {
    background-color: #fff;
    padding: 30px;
    margin: 300em
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
}

.gallery-item:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.image-container img {
    width: 90%; /* Make the image slightly smaller */
    max-height: 250px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
    margin: 0 auto; /* Center the image */
}

.image-container img:hover {
    transform: scale(1.05);
}

h4 {
    font-size: 1.5rem;
    margin-top: 10px;
    color: #333;
    font-weight: bold;
}

p {
    font-size: 1rem;
    color: #666;
    margin: 5px 0;
}

.pagination {
    text-align: center;
    margin-top: 30px;
}

.pagination button {
    padding: 10px 20px;
    margin: 0 10px;
    border: none;
    background-color: #007bff;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.pagination button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 700px) {
    #galleryTable td {
        width: 50%; /* Show 2 items per row */
    }
}

@media (max-width: 576px) {
    #galleryTable td {
        width: 100%; /* Show 1 item per row */
    }

    .pagination button {
        width: 100%;
        margin-bottom: 10px;
    }
}

    </style>
@endsection

@section('content')
<div class="gallery-container">
    <table id="galleryTable">
        <tr> <!-- Always start with a new row -->
        <td class="gallery-item">
            <div class="image-container">
            </br>
                @foreach($car_images as $image)
                <img src="{{ asset($image->image_url) }}" alt="Car {{ $car->id }}" onclick="showCarDetails({{ $car->id }})" style="margin: 15px">
                 @endforeach
            </div>
        </td>
        </tr>
    </table>
</div>
<div class="container mt-5">
    <h2>Add Car Details</h2>
    <form method="POST" action="{{ route('admins.update', $car->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Car Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $car->name }}">
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" required value="{{ $car->model }}">
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control" id="year" name="year" required value="{{ $car->year }}">
        </div>

        <div class="form-group">
            <label for="horsepower">Horsepower</label>
            <input type="number" class="form-control" id="horsepower" name="horsepower" required value="{{ $car->horsepower }}">
        </div>

        <div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" class="form-control" id="mileage" name="mileage" required value="{{ $car->mileage }}">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" required value="{{ $car->price }}">
        </div>

        <div class="form-group">
            <label for="created_at">Created At</label>
            <input type="date" class="form-control" id="created_at" name="created_at" required value="{{ $car->created_at }}">
        </div>

        <div class="form-group">
            <label for="updated_at">Updated At</label>
            <input type="date" class="form-control" id="updated_at" name="updated_at" required value="{{ $car->updated_at }}">
        </div>

        <div class="form-group">
            <label for="images">Car Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        </div>

        <button type="submit" class="btn btn-success">Edit</button>
    </form>
</div>
@endsection
