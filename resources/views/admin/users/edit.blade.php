@extends('layouts.backend')

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
  
  color: var(--text-100);
}

/* ===== Title Bar ===== */
h3 {
  color: var(--text-100);
  text-transform:uppercase; 
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

@section('content')
    <h3> Edit User </h3>

    <form action="{{ route('admin.users.update', $user->user_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Username --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Username</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="username" required minlength="3"
                    value="{{ old('username', $user->username) }}">
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Name --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Email</label>
            <div class="col-sm-7">
                <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Password (optional) --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" name="password" minlength="6"
                    placeholder="Leave blank if not changing">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Role --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Role</label>
            <div class="col-sm-6">
                <select class="form-control" name="role" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Status --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Status</label>
            <div class="col-sm-6">
                <select class="form-control" name="status" required>
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Profile Image --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Profile Image</label>
            <div class="col-sm-6">
                @if ($user->profile_img)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Profile" class="img-thumbnail"
                            width="120">
                    </div>
                @endif
                <input type="file" name="profile_img" accept="image/*">
                @error('profile_img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Buttons --}}
        <div class="form-group row mb-2">
            <div class="col-sm-5 offset-sm-2">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('admin.users.list') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
@endsection
