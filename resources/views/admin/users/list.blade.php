@extends('layouts.backend')

@section('content')
    <h3> :: Users Management :: </h3>

    {{-- ปุ่มเพิ่ม User --}}
    <div class="mb-3">
        <a href="{{ route('admin.users.adding') }}" class="btn btn-success">
            + Add User
        </a>
    </div>

    {{-- ตาราง Users --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Join Date</th>
                <th>Profile</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userList as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name ?? '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td>
                        @if ($user->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $user->join_date }}</td>
                    <td>
                        @if ($user->profile_img)
                            <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Profile" width="50"
                                height="50" class="rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('admin.users.remove', $user->user_id) }}" method="post"
                            style="display:inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $userList->links() }}
    </div>
@endsection
