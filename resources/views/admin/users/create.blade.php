@extends('layouts.backend')

@section('content')
    <h3> :: Form Add User :: </h3>

    <form action="{{ route('admin.users.create') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Username --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Username</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="username" required minlength="3" value="{{ old('username') }}"
                    placeholder="Username">
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Name --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                    placeholder="Full Name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Email</label>
            <div class="col-sm-7">
                <input type="email" class="form-control" name="email" required value="{{ old('email') }}"
                    placeholder="Email Address">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Password --}}
        <div class="form-group row mb-2">
            <label class="col-sm-2">Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" name="password" required minlength="6" placeholder="Password">
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
                    <option value="">-- Select Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
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
                    <option value="">-- Select Status --</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                <input type="file" name="profile_img" accept="image/*">
                @error('profile_img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Buttons --}}
        <div class="form-group row mb-2">
            <div class="col-sm-5 offset-sm-2">
                <button type="submit" class="btn btn-primary">Insert User</button>
                <a href="{{ route('admin.users.list') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
@endsection
