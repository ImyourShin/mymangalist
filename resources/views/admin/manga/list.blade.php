@extends('layouts.backend')
@php
    use Illuminate\Support\Str;
@endphp


@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
    <h3> :: Manga Management ::
        <a href="/admin/manga/adding" class="btn btn-primary btn-sm"> Add Manga </a>
    </h3>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info text-center">
                <th width="5%">ID</th>
                <th width="10%">Cover</th>
                <th width="15%">Title</th>
                <th width="15%">Author</th>
                <th width="15%">Publisher</th>
                <th width="10%">Genre</th>
                <th width="10%">Status</th>
                <th width="5%">Year</th>
                <th width="5%">Edit</th>
                <th width="5%">Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mangaList as $row)
                <tr>
                    <td class="text-center">{{ $row->manga_id }}</td>

                    <td class="text-center">
                        @if ($row->cover_img)
                            @if (Str::startsWith($row->cover_img, 'http'))
                                {{-- ถ้าเป็น URL เต็ม --}}
                                <img src="{{ $row->cover_img }}" width="80" class="rounded shadow-sm">
                            @else
                                {{-- ถ้าเป็นไฟล์ที่อัปโหลดเก็บใน storage --}}
                                <img src="{{ asset('storage/' . $row->cover_img) }}" width="80"
                                    class="rounded shadow-sm">
                            @endif
                        @else
                            <span class="text-muted">No Cover</span>
                        @endif
                    </td>


                    <td>{{ $row->title }}</td>
                    <td>{{ $row->author }}</td>
                    <td>{{ $row->publisher }}</td>
                    <td class="text-center">{{ $row->genre }}</td>
                    <td class="text-center">{{ $row->status }}</td>
                    <td class="text-center">{{ $row->release_year }}</td>

                    <td class="text-center">
                        <a href="{{ route('admin.manga.edit', $row->manga_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->manga_id }})">
                            Delete
                        </button>

                        <form id="delete-form-{{ $row->manga_id }}"
                            action="{{ route('admin.manga.remove', $row->manga_id) }}" method="POST"
                            style="display:none;">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $mangaList->links() }}
    </div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteConfirm(id) {
        Swal.fire({
            title: 'แน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูลนี้จริง ๆ หรือไม่",
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
