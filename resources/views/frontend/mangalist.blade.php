@extends('layouts.frontend')

@section('title', 'My Manga List')

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

/* 🔥 ซ่อนข้อความ Previous/Next เหลือแค่ลูกศร */
.pagination .page-link span:not([aria-hidden="true"]) {
  display: none !important;
}

/* ===== Responsive (มือถือ) ===== */
@media (max-width: 576px) {
  .pagination-wrapper {
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .pagination {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    flex: 1;
  }

  .page-link {
    width: 48px;
    height: 48px;
    font-size: 1.4rem;
    border-radius: 50% !important;
  }
}

  

</style>

@endpush

@section('content')
<div class="row mt-4" style="min-height:100vh;">
  <!-- Sidebar -->
<div class="col-12 col-lg-3 mb-4">
  <div class="card glass-panel h-100 sidebar-card d-flex flex-column">
    <div class="card-body p-0 d-flex flex-column">
      
      <!-- Header + Toggle -->
      <div class="p-3 pb-2  d-flex justify-content-between align-items-center">
        <h5 class="section-title mb-0">🎯 Refine Search</h5>
        <!-- ปุ่ม toggle (มือถือเท่านั้น) -->
        <button class="btn btn-sm text-white d-lg-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#refineCollapse"
                aria-expanded="false" aria-controls="refineCollapse"
                style="background:rgba(255,255,255,.1); border-radius:8px;">
          <i class="bi bi-funnel"></i>
        </button>
      </div>

      

      <!-- Content (Collapse) -->
      <div class="collapse d-lg-block" id="refineCollapse">
        <div class="flex-grow-1 p-3 sidebar-scroll" style="max-height:calc(100vh - 120px);">
          <form action="{{ route('frontend.mangalist') }}" method="GET" class="d-flex flex-column h-100">
            
            {{-- Genres --}}
            <div class="mb-4">
              <h6 class="fw-bold mb-2 sidebar-section">Genres</h6>
              @foreach ($genres as $g)
              <div class="form-check mb-1">
                <input class="form-check-input" type="checkbox" name="genres[]"
                  value="{{ $g }}" id="genre-{{ $loop->index }}"
                  {{ in_array($g, request()->get('genres', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="genre-{{ $loop->index }}">{{ $g }}</label>
              </div>
              @endforeach
            </div>

            <div class="filter-divider"></div>

            {{-- Authors --}}
            <div class="mb-2">
              <h6 class="fw-bold mb-2 sidebar-section">Authors</h6>
              <input type="text" name="author" class="form-control form-control-sm mb-2"
                placeholder="Search Author..." value="{{ request('author') }}">
              
            </div>

            <div class="filter-divider"></div>

            {{-- Status --}}
            <div class="mb-4">
              <h6 class="fw-bold mb-2 sidebar-section">Status</h6>
              <div class="form-check mb-1">
                <input class="form-check-input" type="radio" name="status" value="Publishing"
                  id="status-publishing" {{ request('status') == 'Publishing' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-publishing">Publishing</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="Completed"
                  id="status-completed" {{ request('status') == 'Completed' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-completed">Completed</label>
              </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Sticky footer buttons -->
            <div class="filter-actions d-flex gap-2">
              <button type="submit" class="btn btn-sm btn-gradient w-50">Apply</button>
              <a href="{{ route('frontend.mangalist') }}" class="btn btn-sm btn-outline-light w-50">Reset</a>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

  <!-- Manga Grid -->
  <div class="col-md-9">
    <div class="row g-3">
      @forelse ($mangaList as $manga)
      <div class="col-12 col-sm-6 col-md-4 ">
        <div class="manga-card h-100">
        {{-- Cover --}}
            <div class="manga-cover-wrap">
                @if ($manga->cover_img)
                <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}" class="manga-cover">
                @else
                <div class="bg-secondary d-flex align-items-center justify-content-center text-white"
                    style="height:220px;font-weight:700;">No Image</div>
                @endif
                <div class="manga-cover-overlay"></div>
                <span class="manga-badge">{{ $manga->type ?? 'Manga' }}</span>
            </div>

            {{-- Body --}}
            <div class="p-3 mt-auto">
                <h6 class="manga-title mb-2">{{ $manga->title }}</h6>
                <p class="text-author small mb-3">{{ $manga->author ?? '-' }}</p>
                <a href="{{ route('manga.detail', $manga->manga_id) }}"
                class="btn btn-gradient btn-sm d-flex align-items-center justify-content-center "
                style="border-radius:8px; width: 120px; ">
                <i class="bi bi-eye-fill"></i> More Detail
                </a>
            </div>
        </div>
      </div>
      @empty
      <p class="text-center text-muted">No Manga Found</p>
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
