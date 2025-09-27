@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
    <!-- Banner Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="banner">Main Banner</div>
        </div>
        <div class="col-md-4">
            <div class="banner">Banner</div>
        </div>
        <div class="col-md-4">
            <div class="banner">Banner</div>
        </div>
    </div>

    <!-- What's Popular -->
    <h4>What's Popular</h4>
    <div class="row">
        @foreach ($popularManga as $manga)
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    @if ($manga->cover_img)
                        <img src="{{ asset('storage/' . $manga->cover_img) }}" class="card-img-top"
                            style="height:180px;object-fit:cover;">
                    @else
                        <div class="banner">No Image</div>
                    @endif
                    <div class="card-body">
                        <h6>{{ $manga->title }}</h6>
                        <p class="text-muted small">{{ $manga->genre ?? 'Unknown Genre' }}</p>
                        <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn btn-orange btn-sm">More
                            Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
