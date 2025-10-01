@extends('layouts.backend')

@section('css_before')

<style>
:root {
  --bg-900:#0d0d0d;
  /* --bg-800:#1a1a1a; */
  --bg-800:#1c1c1c;;
  --text-100:#f5f5f7;
  --text-70:#b3b3b3     ;
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
  background: var(--bg-800);
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
  text-transform:uppercase;
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

.form-control::placeholder {
  color: var(--text-70); /* เทาอ่อน */
  opacity: 1;            /* ให้ชัดเต็ม */
  font-style: italic;    /* เอียงนิดหน่อยให้ต่างจาก value */
}

input[type="file"] {
  color: var(--text-70);
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

@section('content')
    <h3> Add Favorite </h3>

    <form action="{{ route('admin.favorites.create') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label>User ID</label>
            <input type="number" name="user_id" class="form-control" required>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label>Manga ID</label>
            <input type="number" name="manga_id" class="form-control" required>
            @error('manga_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.favorites.list') }}" class="btn btn-danger">Cancel</a>
    </form>
@endsection
