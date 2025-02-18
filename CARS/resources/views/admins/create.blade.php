@extends('layouts.master')


@section('content')
<div class="container mt-5">
    <h2>Add Car Details</h2>
    <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Car Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>

        <div class="form-group">
            <label for="horsepower">Horsepower</label>
            <input type="number" class="form-control" id="horsepower" name="horsepower" required>
        </div>

        <div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" class="form-control" id="mileage" name="mileage" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="created_at">Created At</label>
            <input type="date" class="form-control" id="created_at" name="created_at" required>
        </div>

        <div class="form-group">
            <label for="updated_at">Updated At</label>
            <input type="date" class="form-control" id="updated_at" name="updated_at" required>
        </div>

        <div class="form-group">
            <label for="images">Car Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
