@extends('layouts.frontend')

@section('title', 'My Manga List')

@section('content')
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            {{-- Search --}}
            <div class="card bg-dark text-white shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="text-orange fw-bold">🔎 Search Manga</h5>
                    <form action="{{ route('frontend.mangalist') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2"
                            placeholder="Search by Title, Author, Genre..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-sm btn-primary">Go</button>
                    </form>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card bg-dark text-white shadow-sm">
                <div class="card-body">
                    <h5 class="text-orange fw-bold">🎯 Refine Search</h5>
                    <hr class="border-secondary">

                    <form action="{{ route('frontend.mangalist') }}" method="GET">
                        {{-- Genres --}}
                        <div class="mb-3">
                            <h6 class="fw-bold">Genres</h6>
                            @foreach ($genres as $g)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="genres[]"
                                        value="{{ $g }}" id="genre-{{ $loop->index }}"
                                        {{ in_array($g, request()->get('genres', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genre-{{ $loop->index }}">
                                        {{ $g }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Authors --}}
                        <div class="mb-3">
                            <h6 class="fw-bold">Authors</h6>
                            <input type="text" name="author" class="form-control form-control-sm mb-2"
                                placeholder="Search Author..." value="{{ request('author') }}">
                            <div class="small text-muted">🔎 พิมพ์ชื่อบางส่วนได้</div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <h6 class="fw-bold">Status</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Publishing"
                                    id="status-publishing" {{ request('status') == 'Publishing' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-publishing">Publishing</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Completed"
                                    id="status-completed" {{ request('status') == 'Completed' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-completed">Completed</label>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-primary w-50">Apply</button>
                            <a href="{{ route('frontend.mangalist') }}" class="btn btn-sm btn-secondary w-50">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Manga Grid -->
        <div class="col-md-9">
            <div class="row">
                @forelse ($mangaList as $manga)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            @if ($manga->cover_img)
                                <img src="{{ asset('storage/' . $manga->cover_img) }}" class="card-img-top"
                                    style="height:220px;object-fit:cover;">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center"
                                    style="height:220px;">No Image</div>
                            @endif
                            <div class="card-body">
                                <h6 class="fw-bold text-truncate">{{ $manga->title }}</h6>
                                <p class="text-muted small mb-2">{{ $manga->author ?? '-' }}</p>
                                <a href="{{ route('manga.detail', $manga->manga_id) }}"
                                    class="btn btn-orange btn-sm w-100">More Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No Manga Found</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $mangaList->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
