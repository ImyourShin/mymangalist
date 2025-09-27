@extends('layouts.frontend')

@section('title', 'My Favorites')

@section('content')
    <h3 class="mb-4">⭐ My Favorite Manga</h3>

    @forelse ($favorites as $fav)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-2">
                    @if ($fav->manga && $fav->manga->cover_img)
                        <img src="{{ asset('storage/' . $fav->manga->cover_img) }}" class="img-fluid rounded-start"
                            style="height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-center text-white p-4">No Image</div>
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">{{ $fav->manga->title ?? 'Unknown' }}</h5>
                        <p class="card-text">
                            <small class="text-muted">
                                {{ $fav->manga->author ?? '-' }} |
                                {{ $fav->manga->genre ?? '-' }}
                            </small>
                        </p>
                        <a href="{{ route('manga.detail', $fav->manga->manga_id) }}" class="btn btn-primary btn-sm">
                            View Detail
                        </a>
                        <form action="{{ route('admin.favorites.remove', $fav->favorite_id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Remove this manga from favorites?')">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">You have no favorite manga yet.</p>
    @endforelse

    <div>
        {{ $favorites->links() }}
    </div>
@endsection
