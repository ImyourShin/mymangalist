@extends('layouts.backend')

@section('content')
    <h3> :: Edit Favorite :: </h3>

    <form action="{{ route('favorites.update', $favorite->favorite_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label>User ID</label>
            <input type="number" name="user_id" value="{{ $favorite->user_id }}" class="form-control" required>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label>Manga ID</label>
            <input type="number" name="manga_id" value="{{ $favorite->manga_id }}" class="form-control" required>
            @error('manga_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.favorites.list') }}" class="btn btn-danger">Cancel</a>
    </form>
@endsection
