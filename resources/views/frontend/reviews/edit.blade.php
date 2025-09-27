@extends('layouts.frontend')

@section('title', 'Edit Review')

@section('content')
    <div class="container mt-4">
        <h3>Edit Your Review</h3>

        <form action="{{ route('frontend.reviews.update', $review->review_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label class="form-label">Rating (1-5)</label>
                <input type="number" name="rating" class="form-control" value="{{ old('rating', $review->rating) }}"
                    min="1" max="5" required>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">Comment</label>
                <textarea name="comment" class="form-control" rows="4">{{ old('comment', $review->comment) }}</textarea>
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Review</button>
            <a href="{{ route('manga.detail', $review->manga_id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
