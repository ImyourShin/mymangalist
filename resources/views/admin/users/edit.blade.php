@extends('layouts.backend')

@section('content')
    <h3> :: Edit User :: </h3>

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
