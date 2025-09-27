@extends('layouts.frontend')

@section('title', 'My Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4 class="mb-3">My Profile</h4>
                    @if ($user->profile_img)
                        <img src="{{ asset('storage/' . $user->profile_img) }}" class="rounded-circle mb-3" width="120">
                    @else
                        <div class="bg-secondary rounded-circle mb-3 d-flex align-items-center justify-content-center"
                            style="width:120px; height:120px;">No Image</div>
                    @endif
                    <p><strong>Username:</strong> {{ $user->username }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Name:</strong> {{ $user->name ?? '-' }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
