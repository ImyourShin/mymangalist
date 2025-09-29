@extends('layouts.backend')
@php
    use Illuminate\Support\Str;
@endphp




@section('css_before')
<style>
:root {
  --bg-900:#0d0d0d;
  --bg-800:#1c1c1c; /*page*/
  --bg-700:#1a1a1a;
  --text-100:#f5f5f7;
  --text-70:#b3b3b3;
  --accent:#FF4C00;
  --danger:#d33;
  --radius:14px;
  --shadow-soft:0 6px 20px rgba(0,0,0,.45);
}

/* ====== Page Title ====== */
h3 {
  color: var(--text-100);
  font-weight: 700;
  font-size: 1.4rem;
  padding: 1rem 1.25rem;
  margin-bottom: 1rem;
  background: var(--bg-800);
  border-left: 6px solid var(--accent);
  border-radius: var(--radius);
  box-shadow: var(--shadow-soft);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Add Manga button */
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
  box-shadow: 0 0 10px rgba(255,76,0,.6);
}

/* ====== Table Wrapper ====== */
table {
  width: 100%;
  border-collapse: separate !important;
  border-spacing: 0;
  background: var(--bg-800);
  border-radius: var(--radius);
  overflow: hidden;
  box-shadow: var(--shadow-soft);
}

/* Table Header */
.table thead tr {
  background: var(--bg-900);
  border-bottom: 3px solid var(--accent);
}
.table thead th {
  color: var(--text-100);
  font-weight: 600;
  text-align: center;
  padding: .75rem;
}

/* Table Body */
.table tbody tr {
  background: var(--bg-700);
  color: var(--text-70);
  transition: 0.25s ease;
}
.table tbody tr:nth-child(even) {
  background: var(--bg-800);
}
.table tbody tr:hover {
  background: rgba(255,76,0,.08);
}

/* Table Cells */
.table td {
  padding: .75rem;
  vertical-align: middle;
  color: var(--text-70);
}
.table td.text-center {
  text-align: center;
}

/* Cover images */
.table td img {
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,.4);
}
.table td .text-muted {
  color: var(--text-70) !important;
  font-style: italic;
}

/* ====== Action Buttons ====== */
.btn-warning {
  background: var(--accent);
  border: none;
  border-radius: 999px;
  font-weight: 600;
  padding: 4px 12px;
  transition: .25s ease;
}
.btn-warning:hover {
  background: #ff6320;
  box-shadow: 0 0 8px rgba(255,76,0,.6);
}

.btn-danger {
  background: var(--danger);
  border: none;
  border-radius: 999px;
  font-weight: 600;
  padding: 4px 12px;
  transition: .25s ease;
}
.btn-danger:hover {
  background: #ff4444;
  box-shadow: 0 0 8px rgba(211,51,51,.6);
}

/* ====== Pagination ====== */
.pagination {
  justify-content: center;
  margin-top: 1.5rem;
  gap: .4rem;
}
.pagination .page-item .page-link {
  background: var(--bg-800);
  border: 1px solid transparent;
  color: var(--text-70);
  border-radius: var(--radius);
  padding: .4rem .8rem;
  transition: .25s ease;
}
.pagination .page-item .page-link:hover {
  border-color: var(--accent);
  color: var(--accent);
}
.pagination .page-item.active .page-link {
  background: var(--accent);
  border-color: var(--accent);
  color: #fff;
  font-weight: 600;
}


/* Force Dark Theme for Table */
.table,
.table tbody,
.table tr,
.table td,
.table th {
  background-color: transparent !important;
  border-color: rgba(255,255,255,.08) !important;
}

/* Table Wrapper */
table {
  background: var(--bg-800) !important; /* dark panel */
  color: var(--text-70) !important;
}

/* Fix striped row color */
.table-striped tbody tr:nth-of-type(odd) {
  background-color: var(--bg-700) !important;
}
.table-striped tbody tr:nth-of-type(even) {
  background-color: var(--bg-800) !important;
}

/* Hover effect */
.table-hover tbody tr:hover {
  background-color: rgba(255,76,0,.08) !important;
}

/* Table header override */
.table thead th {
  background-color: var(--bg-900) !important;
  color: var(--text-100) !important;
  border-bottom: 3px solid var(--accent) !important;
}

/* Force Row Divider */
.table tbody tr {
  border-bottom: 1px solid rgba(255,255,255,0.08) !important;
}
.table tbody td {
  border-top: none !important;   /* ตัดเส้นบนของ cell */
  border-bottom: none !important; /* ไม่เอาเส้น cell default */
}
.table-bordered {
  border: none !important; /* ตัดกรอบรวมของ bootstrap */
}

/* ===== Improve Font Readability ===== */
body {
  font-family: 'Poppins','Inter',sans-serif;
  font-size: 15px;
  line-height: 1.6;
  color: var(--text-100);
}

.table thead th {
  font-size: 15px;
  letter-spacing: 0.5px;
}

.table td {
  font-size: 14px;
  line-height: 1.5;
}

h3 {
  font-size: 1.5rem; /* ใหญ่ขึ้นเล็กน้อย */
  letter-spacing: 0.5px;
}

/* ===== Make Table Bigger & Easier to Read ===== */
.table thead th {
  font-size: 15px;
  padding: 1rem; /* เพิ่ม padding */
}

.table td {
  font-size: 14.5px;
  padding: 1rem; /* เพิ่ม padding */
}

.table tbody tr {
  min-height: 56px; /* ความสูงขั้นต่ำของแต่ละ row */
}

</style>

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

        <tbody >
            @foreach ($mangaList as $row)
                <tr class="">
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
