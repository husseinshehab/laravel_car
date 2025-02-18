@extends('layouts.master')

@section('styles')
    <!-- Include the customer_index.css -->
    <link rel="stylesheet" href="{{ asset('customer_index.css') }}">
@endsection

@section('content')

<div class="text-center" style="margin: 15px">
    <a href="{{ route('admins.create') }}"><button type="button" class="btn btn-success">Create Post</button></a>
</div>
<div class="gallery-container">
    <table id="galleryTable">
        @foreach ($cars as $index => $car)
            @if ($index % 3 == 0) <!-- Start a new row every 3 images -->
                <tr>
            @endif

            <td class="gallery-item">
                <a href="{{ route('admins.show', $car->id) }}">
                    <div class="image-container">
                        @if ($car->first_image)
                            <img src="{{ asset($car->first_image->image_url) }}" alt="Car {{ $car->id }}">
                        @else
                            <img src="placeholder.jpg" alt="No image available">
                        @endif
                    </div>
                </a>
                <h4>{{ $car->name }}</h4>
                <p>{{ Str::limit($car->description, 50) }}</p>
            </td>

            @if (($index + 1) % 3 == 0) <!-- Close the row after every 3 images -->
                </tr>
            @endif
        @endforeach
    </table>
</div>
    <!-- Pagination buttons -->
    <div class="pagination">
        <button id="prevButton" onclick="loadPrevPage()">Previous</button>
        <button id="nextButton" onclick="loadNextPage()">Next</button>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('customer_index.js') }}"></script>
@endsection
