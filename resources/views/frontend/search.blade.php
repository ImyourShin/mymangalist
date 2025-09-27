@extends('layouts.frontend')

@section('title', 'Search Results')

@section('content')
    <h3 class="mb-3">Search Results for: <span class="text-primary">{{ $keyword }}</span></h3>

    <div class="row">
        @forelse($mangaList as $manga)
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    @if ($manga->cover_img)
                        <img src="{{ asset('storage/' . $manga->cover_img) }}" class="card-img-top"
                            style="height:180px;object-fit:cover;">
                    @else
                        <div class="bg-secondary text-center p-5">No Image</div>
                    @endif
                    <div class="card-body">
                        <h6>{{ $manga->title }}</h6>
                        <p class="text-muted small">{{ $manga->author }}</p>
                        <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No results found.</p>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $mangaList->withQueryString()->links() }}
    </div>
@endsection
