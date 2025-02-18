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
            <h4>{{ $car->name }}</h4>
            <p>Price : {{$car->price}}</p> <!-- Show short description -->
            <p>Model : {{$car->model}}</p>
            <p>Mileage : {{$car->mileage}}</p>
        </td>
        </tr>
    </table>

    <!-- Pagination buttons -->
    <div class="pagination">
        <!-- Previous Button -->
        @if ($prevCar)
            <a href="{{ route('customers.show', $prevCar->id) }}" class="btn btn-primary" style="margin: 10px">Previous</a>
        @else
            <button class="btn btn-secondary" disabled style="margin: 10px">Previous</button>
        @endif
        
        <!-- Next Button -->
        @if ($nextCar)
            <a href="{{ route('customers.show', $nextCar->id) }}" class="btn btn-primary" style="margin: 10px">Next</a>
        @else
            <button class="btn btn-secondary" disabled style="margin: 10px">Next</button>
        @endif
    </div>
</div>
@endsection

@section('scripts')

@endsection
