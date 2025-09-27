@extends('layouts.backend')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')
@endsection
@section('content')
    <h3> :: Form Add Manga :: </h3>

    <form action="/manga/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Title </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="title" required placeholder="Manga Title" minlength="3"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Author </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="author" required placeholder="Author"
                    value="{{ old('author') }}">
                @error('author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Publisher </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="publisher" placeholder="Publisher"
                    value="{{ old('publisher') }}">
                @error('publisher')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Genre </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="genre" required placeholder="e.g. Action, Romance"
                    value="{{ old('genre') }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Status </label>
            <div class="col-sm-6">
                <select class="form-control" name="status" required>
                    <option value="">-- Select Status --</option>
                    <option value="Publishing" {{ old('status') == 'Publishing' ? 'selected' : '' }}>Publishing</option>
                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
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
                    max="{{ date('Y') }}" placeholder="e.g. 2020" value="{{ old('release_year') }}">
                @error('release_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Cover Image </label>
            <div class="col-sm-6">
                <input type="file" name="cover_img" placeholder="cover_img" accept="image/*">
                @error('cover_img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary"> Insert Manga </button>
                <a href="{{ route('admin.manga.list') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </form>

    </div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
