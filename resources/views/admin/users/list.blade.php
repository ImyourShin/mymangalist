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

/* ===== Column Adjustments ===== */
.table td:nth-child(4) { /* Email */
  max-width: 220px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.table td:nth-child(7) { /* Join Date */
  font-size: 13px;
  white-space: nowrap;
}
.table td:nth-child(8),
.table th:nth-child(8) { /* Profile */
  width: 70px;
  text-align: center;
}
.table td:last-child,
.table th:last-child { /* Action */
  width: 130px;
  text-align: center;
}

/* ===== Profile Image ===== */
td img.rounded {
  width: 45px;
  height: 45px;
  object-fit: cover;
  border-radius: 50%;
  border:1px solid rgba(255,255,255,.1);
  box-shadow:0 0 6px rgba(0,0,0,.35);
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
</style>
@endsection



@section('content')
    <h3> Users Management  
        <div>
        <a href="{{ route('admin.users.adding') }}" class="btn btn-success">
            + User
        </a>
    </div>
    </h3>

    
    {{-- ตาราง Users --}}
    

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info text-center">
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

        <tbody >
            @foreach ($userList as $user)
                <tr class="">



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
                            <button type="submit" class="btn btn-sm btn-danger mt-2">
                                Delete
                            </button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>

        
    </table>

    {{-- Pagination --}}
    <div>
        {{ $userList->links() }}
    </div>

@endsection






