@extends('layouts.frontend')

@section('title', $manga->title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @if ($manga->cover_img)
                <img src="{{ asset('storage/' . $manga->cover_img) }}" class="img-fluid rounded shadow">
            @else
                <div class="bg-secondary text-center p-5">No Image</div>
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{ $manga->title }}</h2>
            <p><strong>Author:</strong> {{ $manga->author ?? '-' }}</p>
            <p><strong>Publisher:</strong> {{ $manga->publisher ?? '-' }}</p>
            <p><strong>Genre:</strong> {{ $manga->genre ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $manga->status }}</p>
            <p><strong>Release Year:</strong> {{ $manga->release_year }}</p>
        </div>
    </div>

    {{-- Favorite Button --}}
    @auth
        <button id="favorite-btn" data-manga="{{ $manga->manga_id }}" class="btn {{ $isFavorite ? 'btn-danger' : 'btn-warning' }}">
            {{ $isFavorite ? '❌ Remove from Favorite' : '⭐ Add to Favorite' }}
        </button>
    @else
        <a href="{{ route('login') }}" onclick="alert('Please login before adding to favorites.')" class="btn btn-secondary">
            ⭐ Add to Favorite
        </a>
    @endauth




    <hr>


    <h4>Write a Review</h4>
    <form action="{{ route('frontend.reviews.store', $manga->manga_id) }}" method="POST">
        @csrf
        <div class="mb-2">
            <label class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Comment</label>
            <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-orange">Submit Review</button>
    </form>


    <!-- Show Reviews -->
    <h4>Reviews</h4>
    @forelse ($manga->reviews as $review)
        <div class="card mb-2" style="background-color:#4e4f50; color:#f1f1f1;">
            <div class="card-body">
                <strong>{{ $review->user->username ?? 'Anonymous' }}</strong>
                <span class="text-warning">({{ $review->rating }}/5)</span>
                <p class="mb-0">{{ $review->comment }}</p>

                {{-- ปุ่มแก้ไข / ลบ --}}
                @auth
                    <div class="d-flex gap-2 mt-2">
                        @can('update', $review)
                            <a href="{{ route('frontend.reviews.edit', $review->review_id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                        @endcan

                        @can('delete', $review)
                            <form action="{{ route('frontend.reviews.remove', $review->review_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this review?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endcan
                    </div>
                @endauth

            </div>
        </div>
    @empty
        <p class="text-muted">No reviews yet.</p>
    @endforelse




    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btn = document.getElementById("favorite-btn");

            if (btn) {
                btn.addEventListener("click", () => {
                    let mangaId = btn.dataset.manga;

                    fetch(`/favorites/toggle/${mangaId}`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json",
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "added") {
                                btn.innerText = "❌ Remove from Favorite";
                                btn.classList.remove("btn-warning");
                                btn.classList.add("btn-danger");
                            } else if (data.status === "removed") {
                                btn.innerText = "⭐ Add to Favorite";
                                btn.classList.remove("btn-danger");
                                btn.classList.add("btn-warning");
                            } else if (data.status === "guest") {
                                alert("Please login before adding to favorites.");
                                window.location.href = "{{ route('login') }}";
                            }
                        });
                });
            }
        });
    </script>


@endsection
