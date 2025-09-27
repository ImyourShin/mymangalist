@extends('layouts.backend')

@section('content')
    <h3> :: Reviews Management ::
        <a href="{{ route('admin.reviews.adding') }}" class="btn btn-primary btn-sm"> Add Review </a>
    </h3>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info text-center">
                <th width="5%">ID</th>
                <th width="10%">User</th>
                <th width="10%">Manga</th>
                <th width="10%">Rating</th>
                <th width="40%">Comment</th>
                <th width="10%">Created</th>
                <th width="5%">Edit</th>
                <th width="5%">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviewList as $row)
                <tr>
                    <td class="text-center">{{ $row->review_id }}</td>
                    <td class="text-center">{{ $row->user_id }}</td>
                    <td class="text-center">{{ $row->manga_id }}</td>
                    <td class="text-center">{{ $row->rating }}</td>
                    <td>{{ $row->comment }}</td>
                    <td class="text-center">{{ $row->created_at->format('Y-m-d') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.reviews.edit', $row->review_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="deleteConfirm({{ $row->review_id }})">Delete</button>
                        <form id="delete-form-{{ $row->review_id }}"
                            action="{{ route('admin.reviews.remove', $row->review_id) }}" method="POST"
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
        {{ $reviewList->links() }}
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirm(id) {
        Swal.fire({
            title: 'แน่ใจหรือไม่?',
            text: "คุณต้องการลบ Review นี้จริง ๆ หรือไม่",
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
