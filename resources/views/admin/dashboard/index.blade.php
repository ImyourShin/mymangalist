@extends('layouts.backend')

@section('title', 'Dashboard')

@section('css_before')
<style>
:root { 
  --bg-main:  linear-gradient(135deg,#0d0d0d,#1c1c1c);
  --bg-panel: #1d1d1d;
  --bg-elev: #1a1a1a;

  --accent:#ff6b47;
  --accent-grad: linear-gradient(90deg,#e55a2b,#ff8e53);

  --text-100:#f5f5f7;
  --text-70:#b3b3b3;

  --radius:16px;
  --shadow:0 12px 30px rgba(0,0,0,.45);
}

body {
  color:var(--text-100);
  font-family:'Poppins','Inter',sans-serif;
}

/* ===== Page Title Bar ===== */
.page-header {
  background:var(--bg-elev);
  text-transform:uppercase ; 
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  padding:1.2rem 1.6rem;
  margin-bottom:2rem;
  font-weight:700;
  font-size:1.6rem;
  display:flex;
  align-items:center;
  gap:.6rem;
  position:relative;
}
.page-header::before {
  content:"";
  position:absolute;
  left:0; top:0; bottom:0;
  width:6px;
  border-radius:var(--radius) 0 0 var(--radius);
  background:var(--accent-grad);
}

/* ===== Cards ===== */
.stat-card {
  background:var(--bg-panel);
  border-radius:var(--radius);
  padding:1.4rem 1.2rem;
  text-align:center;
  box-shadow:var(--shadow);
  transition:.25s;
}
.stat-card:hover { transform:translateY(-3px); box-shadow:0 0 20px rgba(255,76,0,.4); }
.stat-card .icon {
  width:54px; height:54px;
  display:flex; align-items:center; justify-content:center;
  border-radius:50%;
  margin:0 auto 12px;
  font-size:24px;
  color:#fff;
  background:rgba(255,76,0,.15);
  box-shadow:inset 0 0 14px rgba(255,76,0,.4);
}
.stat-card h5 {
  font-size:.8rem;
  text-transform:uppercase;
  color:var(--text-70);
  margin-bottom:.35rem;
}
.stat-card h2 {
  font-size:32px;
  font-weight:800;
}

/* Unique visitor badge */
.stat-card .badge {
  margin-top:.5rem;
  border-radius:999px;
  border:1px solid var(--accent);
  background:transparent;
  color:#fff;
  font-weight:600;
  padding:.35rem .9rem;
  font-size:.8rem;
}

/* ===== Section Card ===== */
.section-card {
  background:var(--bg-panel);
  border-radius:var(--radius);
  overflow:hidden;
  box-shadow:var(--shadow);
}
.section-card .card-header {
  background:var(--bg-elev);
  padding:.9rem 1.2rem;
  font-weight:600;
  position:relative;
}
.section-card .card-header::before {
  content:"";
  position:absolute;
  left:0; top:0; bottom:0;
  width:6px;
  background:var(--accent-grad);
}
.section-card .card-body { padding:0; }

/* ===== Tables ===== */
.table thead {
  text-transform:uppercase;
  font-size:.8rem;
  color:#fff;
}
.table,
.table tbody,
.table tr,
.table td,
.table th {
  background-color: transparent !important;
  border-color: rgba(255,255,255,.08) !important;
  padding:14px 16px;
  vertical-align:middle;
  color: var(--text-70);
}
.table td:nth-child(2){
  max-width:260px;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}
.table .badge {
  background:var(--accent-grad);
  color:#fff;
  border:none;
  border-radius:999px;
  padding:.3rem .7rem;
}

.icon {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  margin: 0 auto 12px;
  background: rgba(255,76,0,.15);
  box-shadow: inset 0 0 14px rgba(255,76,0,.4);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden; /* กันภาพล้นวงกลม */
}

.icon img {
  width: 60%;   /* ปรับตามต้องการ */
  height: 60%;
  object-fit: contain;
  filter: drop-shadow(0 0 6px rgba(255,76,0,.4)); /* ให้ภาพดู glow ตามวง */
}

.page-header {
  background: var(--bg-elev);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 1.2rem 1.6rem;
  margin-bottom: 2rem;
  font-weight: 700;
  font-size: 1.6rem;
  display: flex;
  align-items: center;
  gap: .8rem;   /* ระยะห่างระหว่างไอคอนกับข้อความ */
  position: relative;
}

.page-header img.header-icon {
  width: 28px;       /* ขนาดไอคอน */
  height: 28px;
  object-fit: contain;
  
}

/* ===== Charts ===== */
#viewsChart,#favoritesChart { min-height:260px; }

/* Responsive */
@media(max-width:768px){
  .stat-card h2{font-size:26px;}
  .table td:nth-child(2){max-width:180px;}
}
</style>
@endsection

@section('content')
<div class="container">

  {{-- Page Header --}}
  <div class="page-header">
    <img src="/images/icons/DashBoard/DashBoard.png" alt="Dashboard" class="header-icon">
    Dashboard
  </div>

  {{-- Summary Cards --}}
  <div class="row g-4">
    <div class="col-md-3 col-6">
      <div class="stat-card">
        <div class="icon">
          <img src="/images\icons\DashBoard\User.png" alt="manga">
        </div>
        <h5>ผู้ใช้งาน</h5>
        <h2>{{ $totalUsers }}</h2>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="stat-card">
        <div class="icon">
          <img src="/images\icons\DashBoard\Book.png" >
        </div>
        <h5>มังงะทั้งหมด</h5>
        <h2>{{ $countManga }}</h2>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="stat-card">
        <div class="icon">
          <img src="/images\icons\DashBoard\Comment.png" >
        </div>
        <h5>รีวิว</h5>
        <h2>{{ $countReviews }}</h2>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="stat-card">
        <div class="icon">
          <img src="/images\icons\DashBoard\Star.png" >
        </div>
        <h5>Favorites</h5>
        <h2>{{ $countFavorites }}</h2>
      </div>
    </div>
  </div>

  {{-- Views & Site --}}
  <div class="row g-4 mt-1">
    <div class="col-md-6">
      <div class="stat-card">
        <div class="icon">
          <img src="/images\icons\DashBoard\Group.png" >
        </div>
        <h5>เข้าชมมังงะ</h5>
        <h2>{{ $countMangaViews }}</h2>
        <span class="badge">Unique: {{ $uniqueMangaVisitors }}</span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="stat-card">
        <div class="icon">
          <img src="/images\icons\DashBoard\Door.png" >
        </div>
        <h5>เข้าชมเว็บไซต์</h5>
        <h2>{{ $countSiteViews }}</h2>
        <span class="badge">Unique: {{ $uniqueSiteVisitors }}</span>
      </div>
    </div>
  </div>

  {{-- Top Tables --}}
  <div class="row mt-1 g-4">
    <div class="col-md-6">
      <div class="section-card">
        <div class="card-header"><i class="bi bi-trophy-fill"></i> Top 5 Manga by Views</div>
        <div class="card-body">
          <table class="table mb-0">
            <thead>
              <tr><th>#</th><th>ชื่อเรื่อง</th><th class="text-center">Views</th></tr>
            </thead>
            <tbody>
              @forelse($topManga as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->manga->title ?? 'Unknown' }}</td>
                <td class="text-center"><span class="badge">{{ $item->total }}</span></td>
              </tr>
              @empty
              <tr><td colspan="3" class="text-center text-muted">ไม่มีข้อมูล</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="section-card">
        <div class="card-header"><i class="bi bi-star-fill"></i> Top 5 Manga by Favorites</div>
        <div class="card-body">
          <table class="table mb-0">
            <thead>
              <tr><th>#</th><th>ชื่อเรื่อง</th><th class="text-center">Favorites</th></tr>
            </thead>
            <tbody>
              @forelse($topFavoriteManga as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->manga->title ?? 'Unknown' }}</td>
                <td class="text-center"><span class="badge">{{ $item->total }}</span></td>
              </tr>
              @empty
              <tr><td colspan="3" class="text-center text-muted">ไม่มีข้อมูล</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Charts --}}
  <div class="row mt-1 g-4">
    <div class="col-md-6">
      <div class="section-card">
        <div class="card-header"><i class="bi bi-graph-up"></i> Views (7 วันล่าสุด)</div>
        <div class="card-body"><canvas id="viewsChart"></canvas></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="section-card">
        <div class="card-header"><i class="bi bi-bar-chart"></i> Favorites (7 วันล่าสุด)</div>
        <div class="card-body"><canvas id="favoritesChart"></canvas></div>
      </div>
    </div>
  </div>

</div>
@endsection
