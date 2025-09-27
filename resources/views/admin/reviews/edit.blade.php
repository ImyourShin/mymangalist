@extends('layouts.backend')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')
@endsection
@section('content')
    <h3> :: Form Edit Review :: </h3>

    <form action="{{ route('admin.reviews.update', $review->review_id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> User ID </label>
            <div class="col-sm-7">
                <input type="number" class="form-control" name="user_id" required
                    value="{{ old('user_id', $review->user_id) }}">
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Manga ID </label>
            <div class="col-sm-7">
                <input type="number" class="form-control" name="manga_id" required
                    value="{{ old('manga_id', $review->manga_id) }}">
                @error('manga_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Rating </label>
            <div class="col-sm-6">
                <select class="form-control" name="rating" required>
                    <option value="">-- Select Rating --</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>
                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                        </option>
                    @endfor
                </select>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Comment </label>
            <div class="col-sm-7">
                <textarea class="form-control" name="comment" rows="4" required>{{ old('comment', $review->comment) }}</textarea>
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-success"> Update Review </button>
                <a href="{{ route('admin.reviews.list') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </form>
@endsection

@section('footer')
@endsection
@section('js_before')
@endsection
