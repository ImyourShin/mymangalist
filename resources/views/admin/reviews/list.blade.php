@extends('layouts.backend')

@section('css_before')
<style>
:root {
  --bg-900:#0d0d0d;
  --bg-800:#1c1c1c;
  --bg-700:#1a1a1a;
  --text-100:#f5f5f7;
  --text-70:#b3b3b3;
  --accent:#FF4C00;
  --danger:#d33;
  --radius:14px;
  --shadow-soft:0 6px 20px rgba(0,0,0,.45);
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

/* ===== Page Title ===== */
h3 {
  color: var(--text-100);
  text-transform:uppercase; 
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
  background: #ff6320;
  box-shadow: 0 0 10px rgba(255,76,0,.6);
}

/* ===== Table ===== */
.table {
  width: 100%;
  table-layout: auto;   /* ปล่อยให้ auto จัด column */
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
.table tbody tr:nth-child(odd) { background: var(--bg-700) !important; }
.table tbody tr:nth-child(even){ background: var(--bg-800) !important; }
.table tbody tr:hover { background: rgba(255,76,0,.08) !important; }
.table td {
  padding: 0.9rem;
  font-size: 14px;
  vertical-align: middle;
  border: none !important;
  color: var(--text-100);
}

/* ===== Column Adjustments for Reviews ===== */

/* Comment column (ยาวสุด → truncate) */
.table td:nth-child(5) {
  max-width: 350px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Created column (วันที่ → nowrap + font เล็กลง) */
.table td:nth-child(6) {
  font-size: 13px;
  white-space: nowrap;
  text-align: center;
}

/* Action column (ปุ่ม → fix width, center) */
.table td:nth-child(7),
.table th:nth-child(7) {
  width: 140px;
  text-align: center;
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
  background:rgba(255,76,0,.15) !important;
  color:var(--accent) !important;
  border:1px solid var(--accent);
}
.badge.bg-success {
  background:rgba(40,167,69,.15) !important;
  color:#4caf50 !important;
  border:1px solid #4caf50;
}
.badge.bg-secondary {
  background:rgba(255,255,255,.08) !important;
  color:var(--text-70) !important;
  border:1px solid rgba(255,255,255,.15);
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
  box-shadow: 0 0 8px rgba(255,76,0,.6);
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
  box-shadow: 0 0 8px rgba(211,51,51,.6);
}

.table td:last-child {
  text-align: center;
}
.table td:last-child {ุ
  display: flex;
  justify-content: center;
  gap: 8px;       /* ระยะห่าง */
}
.table td:last-child form {
  margin: 0;      /* ตัด margin เดิมออก */
}

.table td:last-child .btn-warning,
.table td:last-child .btn-danger {
  width: 90px;       /* fix ความกว้าง */
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

.comment-cell {
  max-width: 350px;
  vertical-align: top;
  position: relative;
}

.comment-box {
  display: flex;
  justify-content: space-between; /* ดันข้อความซ้าย ปุ่มไปขวา */
  align-items: flex-start;
  gap: 10px;
}

/* ข้อความ */
.comment-text {
  flex: 1; /* กินพื้นที่ซ้ายเต็ม */
  max-height: 60px;
  overflow: hidden;
  transition: max-height 0.3s ease;
  white-space: pre-wrap;
  font-size: 14px;
  line-height: 1.5;
  text-align: left;
}

/* เมื่อขยาย */
.comment-text.expanded {
  max-height: 1000px;
}

/* ปุ่ม toggle */
.toggle-btn {
  flex-shrink: 0; /* ไม่ให้ปุ่มหด */
  padding: 2px 8px;
  border-radius: 50%;
  font-size: 14px;
  background: var(--bg-700);
  color: var(--text-100);
  border: 1px solid rgba(255,255,255,.15);
  transition: .2s;
  height: 28px;
  width: 28px;
  text-align: center;
  line-height: 1;
  text-align: center;
}
.toggle-btn:hover {
  background: var(--accent);
  color: #fff;
  border-color: var(--accent);
}

</style>
@endsection

@section('content')
    <h3> Reviews Management 
        <a href="{{ route('admin.reviews.adding') }}" class="btn btn-primary btn-sm"> + Review </a>
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
                <th width="10%">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reviewList as $row)
                <tr>
                    <td class="text-center">{{ $row->review_id }}</td>
                    <td class="text-center">{{ $row->user_id }}</td>
                    <td class="text-center">{{ $row->manga_id }}</td>
                    <td class="text-center">{{ $row->rating }}</td>
                    <td class="comment-cell">
                    <div class="comment-box">
                        <div class="comment-text" id="comment-{{ $row->review_id }}">
                            {{ $row->comment }}
                        </div>
                        <button type="button" 
                            class="btn btn-sm toggle-btn d-none" 
                            onclick="toggleComment({{ $row->review_id }})"
                            id="toggle-btn-{{ $row->review_id }}">
                            ▼
                        </button>
                    </div>
                </td>
                    <td class="text-center">{{ $row->created_at->format('Y-m-d') }}</td>

                    <td class="text-center">
                        <a href="{{ route('admin.reviews.edit', $row->review_id) }}" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <form id="delete-form-{{ $row->review_id }}"
                              action="{{ route('admin.reviews.remove', $row->review_id) }}" 
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this Review?');">
                            @csrf
                            @method('DELETE')
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
        {{ $reviewList->links() }}
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // ตรวจสอบแต่ละ comment
    document.querySelectorAll(".comment-text").forEach(text => {
        const id = text.id.replace("comment-", "");
        const btn = document.getElementById("toggle-btn-" + id);

        if (text.scrollHeight > 60) { 
            // ถ้ายาวเกิน limit → แสดงปุ่ม
            btn.classList.remove("d-none");
        }
    });
});

function toggleComment(id) {
    const text = document.getElementById("comment-" + id);
    const btn = document.getElementById("toggle-btn-" + id);

    text.classList.toggle("expanded");
    btn.textContent = text.classList.contains("expanded") ? "▲" : "▼";
}
</script>
