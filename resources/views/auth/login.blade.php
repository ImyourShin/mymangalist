@extends('layouts.frontend')

@section('content')
    <div class="col-md-6 offset-md-3">
        <h3 class="mb-3">Login</h3>

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-success">Login</button>
        </form>
    </div>
@endsection
