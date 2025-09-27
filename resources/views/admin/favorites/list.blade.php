@extends('layouts.backend')

@section('content')
    <h3> :: Favorites Management ::
        <a href="{{ route('admin.favorites.adding') }}" class="btn btn-primary btn-sm"> Add Favorite </a>
    </h3>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info text-center">
                <th width="5%">ID</th>
                <th width="15%">User</th>
                <th width="15%">Manga</th>
                <th width="15%">Created</th>
                <th width="5%">Edit</th>
                <th width="5%">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favoriteList as $row)
                <tr>
                    <td class="text-center">{{ $row->favorite_id }}</td>
                    <td class="text-center">{{ $row->user_id }}</td>
                    <td class="text-center">{{ $row->manga_id }}</td>
                    <td class="text-center">{{ $row->created_at->format('Y-m-d') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.favorites.edit', $row->favorite_id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="deleteConfirm({{ $row->favorite_id }})">Delete</button>
                        <form id="delete-form-{{ $row->favorite_id }}"
                            action="{{ route('admin.favorites.remove', $row->favorite_id) }}" method="POST"
                            style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $favoriteList->links() }}
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirm(id) {
        Swal.fire({
            title: 'แน่ใจหรือไม่?',
            text: "คุณต้องการลบ Favorite นี้จริง ๆ หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
