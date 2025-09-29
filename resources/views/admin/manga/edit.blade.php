@extends('layouts.backend')
@section('js_before')
    @include('sweetalert::alert')
    @php
        use Illuminate\Support\Str;
    @endphp
@endsection

@section('css_before')
<style>
:root {
  --bg-900:#0d0d0d;
  --bg-800:#1a1a1a;
  --text-100:#f5f5f7;
  --text-70:#b3b3b3;
  --accent:#FF4C00;
  --danger:#d33;
  --radius:14px;
  --shadow-soft:0 6px 20px rgba(0,0,0,.45);
  --font:'Poppins','Inter',sans-serif;
}

body {
  font-family: var(--font);
  font-size: 15px;
  line-height: 1.6;
  background: var(--bg-900);
  color: var(--text-100);
}

/* ===== Title Bar ===== */
h3 {
  color: var(--text-100);
  font-weight: 700;
  font-size: 1.4rem;
  padding: 1rem 1.25rem;
  margin-bottom: 1.5rem;
  background: var(--bg-800);
  border-left: 6px solid var(--accent);
  border-radius: var(--radius);
  box-shadow: var(--shadow-soft);
}

/* ===== Form Panel ===== */
form {
  background: var(--bg-800);
  padding: 2rem 1.5rem;
  border-radius: var(--radius);
  box-shadow: var(--shadow-soft);
}

.form-group label {
  color: var(--text-100);
  font-weight: 600;
}

/* Input & Select */
.form-control {
  background: #1a1a1a;
  border: 1px solid rgba(255,255,255,.1);
  color: var(--text-100);
  border-radius: 10px;
  padding: .6rem .75rem;
  transition: 0.25s ease;
}
.form-control:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 2px rgba(255,76,0,.3);
  background: #1c1c1c;
  color: #fff;
}

/* Placeholder */
.form-control::placeholder {
  color: var(--text-70);
  opacity: 1;
  font-style: italic;
}

/* File input */
input[type="file"] {
  color: var(--text-70);
}

/* Preview Image */
form img {
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,.4);
}

/* Error text */
.text-danger {
  font-size: 0.875rem;
  margin-top: .25rem;
}

/* ===== Buttons ===== */
.btn {
  border-radius: 999px;
  font-weight: 600;
  padding: .5rem 1.25rem;
  transition: 0.25s ease;
}

.btn-primary {
  background: var(--accent);
  border: none;
}
.btn-primary:hover {
  background: #ff6320;
  box-shadow: 0 0 10px rgba(255,76,0,.6);
}

.btn-danger {
  background: var(--danger);
  border: none;
}
.btn-danger:hover {
  background: #ff4444;
  box-shadow: 0 0 10px rgba(211,51,51,.6);
}
</style>
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
                <a href="/manga" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
@endsection

@section('footer')
@endsection
