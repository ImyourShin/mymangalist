@extends('layouts.backend')
@php
    use Illuminate\Support\Str;
@endphp




@section('css_before')
    <style>
        :root {
            --bg-900: #0d0d0d;
            --bg-800: #1c1c1c;
            --bg-700: #1a1a1a;
            --text-100: #f5f5f7;
            --text-70: #b3b3b3;
            --accent: #ff6b47;
            --danger: #d33;
            --radius: 14px;
            --shadow-soft: 0 6px 20px rgba(0, 0, 0, .45);
        }

        /* Force Dark Theme for Table */
        .table,
        .table tbody,
        .table tr,
        .table td,
        .table th {
            background-color: transparent !important;
            border-color: rgba(255, 255, 255, .08) !important;
        }

        /* ===== Page Title ===== */
        h3 {
            color: var(--text-100);
            text-transform: uppercase;
            font-weight: 700;
            font-size: 1.5rem;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1rem;
            background: var(--bg-800);
            border-left: 6px solid var(--accent);
            border-radius: var(--radius);
            box-shadow: var(--shadow-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        h3 a.btn {
            background: var(--accent);
            border: none;
            border-radius: 999px;
            padding: 6px 18px;
            font-weight: 600;
            transition: 0.25s ease;
        }

        h3 a.btn:hover {
            background: #ff6b47;
            box-shadow: 0 0 10px #ff8e53;
        }

        h3 a.btn {
            background: var(--accent);
            border: none;
            border-radius: 999px;
            padding: 6px 18px;
            font-weight: 600;
            transition: 0.25s ease;
        }

        h3 a.btn:hover {
            background: #ff6320;
            box-shadow: 0 0 10px rgba(255, 76, 0, .6);
        }

        /* ===== Table ===== */
        .table {
            width: 100%;
            table-layout: auto;
            /* ปล่อยให้ auto จัด column */
            border-collapse: separate !important;
            border-spacing: 0;
            background: var(--bg-800);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            color: var(--text-100);
        }

        .table thead tr {
            background: var(--bg-900);
            border-bottom: 3px solid var(--accent);
        }

        .table thead th {
            color: var(--text-100);
            font-weight: 600;
            text-align: center;
            padding: 0.9rem;
            font-size: 14px;
            white-space: nowrap;
        }

        .table tbody tr:nth-child(odd) {
            background: var(--bg-700) !important;
        }

        .table tbody tr:nth-child(even) {
            background: var(--bg-800) !important;
        }

        .table tbody tr:hover {
            background: rgba(255, 76, 0, .08) !important;
        }

        .table td {
            padding: 0.9rem;
            font-size: 14px;
            vertical-align: middle;
            border: none !important;
            color: var(--text-100);
        }

        /* ===== Column Adjustments ===== */
        .table td:nth-child(4) {
            /* Email */
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table td:nth-child(7) {
            /* Join Date */
            font-size: 13px;
            white-space: nowrap;
        }

        .table td:nth-child(8),
        .table th:nth-child(8) {
            /* Profile */
            width: 70px;
            text-align: center;
        }

        .table td:last-child,
        .table th:last-child {
            /* Action */
            width: 130px;
            text-align: center;
        }

        /* ===== Profile Image ===== */
        td img.rounded {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .1);
            box-shadow: 0 0 6px rgba(0, 0, 0, .35);
        }

        /* ===== Badges ===== */
        .badge {
            padding: .25rem .6rem;
            font-size: 12px;
            min-width: 60px;
            text-align: center;
            border-radius: 999px;
        }

        .badge.bg-primary {
            background: rgba(255, 76, 0, .15) !important;
            color: var(--accent) !important;
            border: 1px solid var(--accent);
        }

        .badge.bg-success {
            background: rgba(40, 167, 69, .15) !important;
            color: #4caf50 !important;
            border: 1px solid #4caf50;
        }

        .badge.bg-secondary {
            background: rgba(255, 255, 255, .08) !important;
            color: var(--text-70) !important;
            border: 1px solid rgba(255, 255, 255, .15);
        }

        /* ===== Action Buttons ===== */
        .btn-warning {
            background: var(--accent) !important;
            border: none !important;
            color: #fff !important;
            border-radius: 999px;
            padding: .35rem .9rem;
            font-weight: 500;
            transition: .2s;
        }

        .btn-warning:hover {
            background: #ff6b47 !important;
            box-shadow: 0 0 8px rgba(255, 76, 0, .6);
        }

        .btn-danger {
            background: var(--danger) !important;
            border: none !important;
            color: #fff !important;
            border-radius: 999px;
            padding: .35rem .9rem;
            font-weight: 500;
            transition: .2s;
        }

        .btn-danger:hover {
            background: #e74c3c !important;
            box-shadow: 0 0 8px rgba(211, 51, 51, .6);
        }

        .table td:last-child {
            text-align: center;
        }

        .table td:last-child {
            ุ display: flex;
            justify-content: center;
            gap: 8px;
            /* ระยะห่าง */
        }

        .table td:last-child form {
            margin: 0;
            /* ตัด margin เดิมออก */
        }

        .table td:last-child .btn-warning,
        .table td:last-child .btn-danger {
            width: 90px;
            /* fix ความกว้าง */
            text-align: center;
        }

        /* ===== Pagination ===== */
        .pagination {
            justify-content: center;
            margin-top: 1.5rem;
            gap: .4rem;
        }

        .pagination .page-item .page-link {
            background: var(--bg-800);
            border: none;
            color: var(--text-70);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.25s ease;
        }

        .pagination .page-item .page-link:hover {
            color: var(--accent);
            background: var(--bg-700);
        }

        .pagination .page-item.active .page-link {
            background: var(--accent);
            color: #fff;
            font-weight: 600;
        }
    </style>
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
    <h3> Manga Management
        <a href="/admin/manga/adding" class="btn btn-primary btn-sm"> + Manga </a>
    </h3>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info text-center">
                <th width="5%">ID</th>
                <th width="10%">Cover</th>
                <th width="15%">Title</th>
                <th width="15%">Author</th>
                <th width="10%">Type</th> {{-- ✅ เพิ่ม --}}
                <th width="15%">Publisher</th>
                <th width="10%">Genre</th>
                <th width="10%">Status</th>
                <th width="5%">Year</th>
                <th width="15%">Synopsis</th> {{-- ✅ เพิ่ม --}}
                <th width="10%">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mangaList as $row)
                <tr>
                    <td class="text-center">{{ $row->manga_id }}</td>

                    <td class="text-center">
                        @if ($row->cover_img)
                            @if (Str::startsWith($row->cover_img, 'http'))
                                <img src="{{ $row->cover_img }}" width="80" class="rounded shadow-sm">
                            @else
                                <img src="{{ asset('storage/' . $row->cover_img) }}" width="80"
                                    class="rounded shadow-sm">
                            @endif
                        @else
                            <span class="text-muted">No Cover</span>
                        @endif
                    </td>

                    <td>{{ $row->title }}</td>
                    <td>{{ $row->author }}</td>
                    <td class="text-center">{{ $row->type ?? '-' }}</td> {{-- ✅ แสดง type --}}
                    <td>{{ $row->publisher }}</td>

                    <td class="text-center">
                        @forelse($row->genres as $g)
                            <span class="badge bg-primary">{{ $g->name }}</span>
                        @empty
                            <span class="badge bg-secondary">No Genre</span>
                        @endforelse
                    </td>

                    <td class="text-center">{{ $row->status }}</td>
                    <td class="text-center">{{ $row->release_year }}</td>
                    <td style="max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        {{ $row->synopsis ?? '-' }}
                    </td> {{-- ✅ แสดง synopsis --}}

                    <td>
                        <a href="{{ route('admin.manga.edit', $row->manga_id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <form id='delete-form-{{ $row->manga_id }}'
                            action="{{ route('admin.manga.remove', $row->manga_id) }}" method="post"
                            style="display:inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this Manga?');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger mt-2">
                                Delete
                            </button>
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
