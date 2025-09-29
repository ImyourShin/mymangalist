@extends('layouts.frontend')

@section('title', isset($keyword) ? 'Search Results' : 'My Manga List')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
<style>
:root {
  --bg-0: #121212;
  --bg-1: #161616;
  --bg-2: #1a1a1a;
  --glass: rgba(255,255,255,.04);
  --white: #ffffff;
  --muted: #a6a6a6;
  --accent: #FF4C00;
  --shadow: 0 10px 30px rgba(0,0,0,.45);
  --radius: 16px;
}

/* ===== Global ===== */
html, body {
  background: radial-gradient(1200px 1200px at 10% -10%, #1c1c1c 0%, var(--bg-0) 40%), var(--bg-0);
  color: var(--white);
  font-family: Inter, Poppins, sans-serif;
}

/* ===== Panels ===== */
.glass-panel {
  background: var(--glass);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
}
.card-body > .border-bottom {
  border-bottom: none !important;
}

/* ===== Section Titles ===== */
.section-title {
  font-weight: 800;
  background: var(--accent);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
.sidebar-section {
  color: white;          /* ข้อความเป็นสีขาว */
  font-weight: 700;
  position: relative;
  padding-bottom: 4px;
}
.sidebar-section::after {
  content: "";
  display: block;
  width: 28px;
  height: 2px;
  background: rgba(255,255,255,0.25); /* เส้นเทาอ่อน */
  margin-top: 4px;
  border-radius: 1px;
}

.filter-divider {
  border-top: 1px solid rgba(255,255,255,0.12); /* เส้นเทาโปร่ง */
  margin: 16px 0;
}

/* ===== Inputs ===== */
.form-control {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.12);
  
  color: var(--white) !important;
  border-radius: 12px;
}
.form-control::placeholder { color: #9a9a9a; }
.form-control:focus {
  background: rgba(255,255,255,.08);
  border-color: var(--accent);
  box-shadow: 0 0 0 .2rem rgba(255,76,0,.25);
}

/* Checkboxes & Radios */
.form-check-input {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.2);
  cursor: pointer;
  accent-color: var(--accent);
}
.form-check-label { color: var(--white); }

/* ===== Buttons ===== */
.btn-gradient {
  background: var(--accent);
  color: #fff;
  font-weight: 600;
  border: none;
  border-radius: 12px;
  transition: all .2s ease;
}
.btn-gradient:hover {
  background: #ff6622;
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(255,76,0,.4);
}
.btn-outline-light {
  background: transparent;
  border: 1px solid rgba(255,255,255,.25);
  color: #fff;
  border-radius: 12px;
  transition: all .2s ease;
}
.btn-outline-light:hover {
  background: rgba(255,255,255,.08);
  border-color: rgba(255,255,255,.4);
}

.text-author {
  color: var(--muted) !important;
}

/* Sidebar sticky footer */
.filter-actions {
  position: sticky;
  bottom: 0;
  background: var(--bg-2);
  backdrop-filter: blur(6px);
  padding: 12px;
  /* border-top: 1px solid rgba(255,255,255,.12); */
  z-index: 10;
  border-radius: 0 0 var(--radius-16) var(--radius-16); /* มนตาม card */
}
.filter-actions .btn-gradient,
.filter-actions .btn-outline-light {
  flex: 1;
}

.sidebar-card {
  padding-bottom: 10px; /* กันปุ่มไปทับ content */
}

@media (max-width: 991px){
  .filter-actions {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 0;
    margin: 0;
    z-index: 999;
  }
}

.manga-grid {
  display: grid;
  gap: 1rem;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
}

/* force iPad (768px – 1024px) = 3 columns */
@media (min-width: 768px) and (max-width: 1024px) {
  .manga-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}



/* Toggle button (mobile) */
.btn[data-bs-toggle="collapse"] {
  background: rgba(255,255,255,.08);
  border-radius: 8px;
  padding: 4px 8px;
}
.btn[data-bs-toggle="collapse"]:hover {
  background: rgba(255,255,255,.15);
}

/* ===== Responsive Sidebar ===== */
.sidebar-card { height: auto !important; max-height: none !important; }
@media (min-width: 992px) {
  .sidebar-card { height: 100% !important; }
  .sidebar-scroll {
    max-height: calc(100vh - 120px);
    overflow: auto;
  }
}

/* ===== Manga Cards ===== */
.manga-card {
  background: #000;
  border-radius: var(--radius);
  box-shadow: 0 8px 20px rgba(0,0,0,.4);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  transition: all .25s ease;
}
.manga-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(0,0,0,.65);
}

/* Cover */
.manga-cover-wrap { position: relative; overflow: hidden; }
.manga-cover-wrap img { transition: transform .3s ease; }
.manga-card:hover .manga-cover-wrap img { transform: scale(1.05); }
.manga-cover {
  height: 300px;
  object-fit: cover;
  width: 100%;
  border-top-left-radius: var(--radius);
  border-top-right-radius: var(--radius);
}
.manga-cover-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,.75) 20%, rgba(0,0,0,0) 60%);
}

/* Badge */
.manga-badge {
  position: absolute;
  top: 10px; left: 10px;
  background: var(--accent);
  color: #fff;
  font-size: .75rem;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 999px;
  box-shadow: 0 3px 8px rgba(0,0,0,.4);
}

/* Title clamp */
.manga-title {
  font-weight: 700;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-height: 1.3;
}

/* ===== Pagination ===== */
.pagination { gap: .35rem; }
.page-link {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.12);
  color: var(--white);
  border-radius: 999px !important;
  padding: .45rem .85rem;
  transition: all .15s ease;
}
.page-link:hover { background: rgba(255,255,255,.1); }
.page-item.active .page-link {
  background: var(--accent);
  border-color: transparent;
  color: #111;
  box-shadow: 0 6px 16px rgba(255,76,0,.28);
}

/* ===== Scrollbar ===== */
.overflow-auto::-webkit-scrollbar { width: 6px; }
.overflow-auto::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,.15);
  border-radius: 3px;
}
.overflow-auto::-webkit-scrollbar-thumb:hover {
  background: rgba(255,255,255,.3);
}

/* ============ Pagination ============ */
.pagination-wrapper {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: .5rem;
  width: 100%;
  margin-top: 1.5rem;
}

.pagination {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: .5rem;
  padding-left: 0;
  margin: 0;
}

.page-item {
  list-style: none;
}

/* ปุ่มเลข + ลูกศร */
.page-link {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.12);
  color: var(--white);
  border-radius: 50% !important;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  transition: all .2s ease;
}

/* Hover */
.page-link:hover {
  background: rgba(255,255,255,.15);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(0,0,0,.35);
}

/* Active */
.page-item.active .page-link {
  background: var(--accent);
  border-color: transparent;
  color: #fff;
  box-shadow: 0 6px 16px rgba(255,76,0,.4);
}

/* Disabled */
.page-item.disabled .page-link {
  background: rgba(255,255,255,.03);
  color: rgba(255,255,255,.25);
  border: 1px solid rgba(255,255,255,.08);
  pointer-events: none;
  box-shadow: none;
}

.title-bar {
    background: rgba(255,255,255,.25);
    padding: 10px 16px;
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 6px 18px rgba(0,0,0,.45);
    backdrop-filter: blur(6px);
}

</style>

@endpush

@section('content')
<div class="row mt-4" style="min-height:100vh;">

  {{-- ===== ถ้ามี keyword = หน้า Search Results ===== --}}
  <div class="col-12">
    <h3 class="search-header title-bar">🔎 Search Results for: <span>{{ $keyword }}</span></h3>
    <div class="row g-3 mt-3">
      @forelse($mangaList as $manga)
      <div class="col-12 col-sm-6 col-md-3">
        <div class="manga-card h-100">
          {{-- Cover --}}
          <div class="manga-cover-wrap">
            @if ($manga->cover_img)
            <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}" class="manga-cover" style="height:300px;">
            @else
            <div class="bg-secondary d-flex align-items-center justify-content-center text-white"
                 style="height:300px;width: 100%;font-weight:700;">No Image</div>
            @endif
            <div class="manga-cover-overlay"></div>
            <span class="manga-badge">{{ $manga->type ?? 'Manga' }}</span>
          </div>
          {{-- Body --}}
          <div class="p-3 mt-auto">
            <h6 class="manga-title mb-2">{{ $manga->title }}</h6>
            <p class="text-author small mb-3">{{ $manga->author ?? '-' }}</p>
            <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn btn-gradient btn-sm d-flex align-items-center justify-content-center" style="border-radius:8px; width: 120px;">
              <i class="bi bi-eye-fill"></i> Detail
            </a>
          </div>
        </div>
      </div>
      @empty
        <p class="text-center text-muted">No results found.</p>
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
      {{ $mangaList->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  </div>
 

</div>
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
