@extends('layouts.backend')
@section('js_before')
    @include('sweetalert::alert')
    @php
        use Illuminate\Support\Str;
    @endphp
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
    <h3> :: Form Update Manga :: </h3>

    <form action="/admin/manga/{{ $manga->manga_id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Title </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="title" required minlength="3" value="{{ $manga->title }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Author </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="author" required value="{{ $manga->author }}">
                @error('author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Publisher </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="publisher" value="{{ $manga->publisher }}">
                @error('publisher')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Genre </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="genre" required value="{{ $manga->genre }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Status </label>
            <div class="col-sm-6">
                <select class="form-control" name="status" required>
                    <option value="Publishing" {{ $manga->status == 'Publishing' ? 'selected' : '' }}>Publishing</option>
                    <option value="Completed" {{ $manga->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Release Year </label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="release_year" required min="1900"
                    max="{{ date('Y') }}" value="{{ $manga->release_year }}">
                @error('release_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Cover Image </label>
            <div class="col-sm-6">
                <p class="mb-2">Old Image:</p>
                @if ($manga->cover_img)
                    @if (Str::startsWith($manga->cover_img, ['http://', 'https://']))
                        <img src="{{ $manga->cover_img }}" width="200" class="mb-2 border rounded">
                    @else
                        <img src="{{ asset('storage/' . $manga->cover_img) }}" width="200" class="mb-2 border rounded">
                    @endif
                @else
                    <span class="text-muted d-block mb-2">No image</span>
                @endif

                <p class="mb-1">Choose New Image:</p>
                <input type="file" name="cover_img" accept="image/*">
                @error('cover_img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.manga.list') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
@endsection

@section('footer')
@endsection
