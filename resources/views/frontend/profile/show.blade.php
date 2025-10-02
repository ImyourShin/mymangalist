@extends('layouts.frontend')

@section('title', 'My Profile')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<style>
:root{
  --primary-orange:#ff6b47;
  --primary-orange-light:#ff8e53;
  --dark-bg:#0f0f0f;
  --dark-bg-secondary:#1a1a1a;
  --dark-bg-tertiary:#242424;
  --text-primary:#ffffff;
  --text-muted:rgba(255,255,255,.6);
  --border-color:rgba(255,255,255,.1);
  --radius:20px;
  --shadow:0 10px 30px rgba(0,0,0,.4);
}

/* ===== Page ===== */
body{background:radial-gradient(1000px 600px at 50% -200px,#0a0a0a 0%,var(--dark-bg) 70%); font-family:'Poppins','Inter',sans-serif; letter-spacing:.2px; color:var(--text-primary);}
.profile-container{max-width:1200px;margin:auto;padding:32px;}

/* ===== Profile Header ===== */
.profile-header{
  display:flex;flex-wrap:wrap;align-items:center;gap:24px;
  background:var(--dark-bg-secondary);
  border:1px solid var(--border-color);
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  padding:32px;
  margin-bottom:32px;
  position:relative;
}
.profile-header::before{
  content:"";
  position:absolute;left:0;top:0;bottom:0;width:6px;
  background:linear-gradient(180deg,var(--primary-orange),var(--primary-orange-light));
  border-top-left-radius:var(--radius);
  border-bottom-left-radius:var(--radius);
}

/* Avatar */
.profile-avatar{
  position:relative;flex:0 0 auto;
}
.profile-avatar img,.profile-avatar .no-img{
  width:140px;height:140px;border-radius:50%;object-fit:cover;
  box-shadow:0 0 0 4px rgba(255,255,255,.06),0 8px 28px rgba(0,0,0,.45);
}
.profile-avatar .no-img{
  display:flex;align-items:center;justify-content:center;
  background:#2b2b2b;color:var(--text-muted);font-weight:600;
}

/* Info */
.profile-info{flex:1 1 auto;}
.profile-info h2{font-size:1.9rem;font-weight:700;margin:0 0 8px;}
.profile-info .meta{color:var(--text-muted);font-size:.95rem;}

/* Actions */
.profile-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;}
.profile-actions .btn{
  border-radius:999px;
  padding:.55rem 1.2rem;
  font-weight:600;
  display:inline-flex;align-items:center;gap:.5rem;
  transition:all .18s ease;
}
.btn-primary{
  background:linear-gradient(90deg,var(--primary-orange),var(--primary-orange-light));
  border:none;color:#000;
  box-shadow:0 8px 20px rgba(255,107,71,.25);
}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(255,107,71,.35);}
.btn-secondary{
  background:var(--dark-bg-tertiary);border:1px solid var(--border-color);color:var(--text-primary);
}
.btn-secondary:hover{border-color:var(--primary-orange);transform:translateY(-2px);}

/* ===== Stats Cards ===== */
.stats-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:24px;
  margin-bottom:32px;
}
.stat-card{
  background:var(--dark-bg-secondary);
  border:1px solid var(--border-color);
  border-radius:var(--radius);
  padding:20px;
  text-align:center;
  transition:all .2s ease;
}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 0 0 1px rgba(255,107,71,.25),0 12px 30px rgba(0,0,0,.5);}
.stat-icon{
  width:52px;height:52px;
  margin:auto;margin-bottom:12px;
  border-radius:50%;background:rgba(255,107,71,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:1.4rem;color:var(--primary-orange);
}
.stat-value{font-size:1.8rem;font-weight:800;}
.stat-label{text-transform:uppercase;font-size:.8rem;color:var(--text-muted);letter-spacing:.5px;}

/* ===== Section Headers ===== */
.section-header{
  display:flex;align-items:center;gap:10px;margin:28px 0 16px;
  font-weight:700;font-size:1.3rem;color:var(--text-primary);
}
.section-header::before{
  content:"";width:5px;height:20px;border-radius:999px;
  background:linear-gradient(180deg,var(--primary-orange),var(--primary-orange-light));
}

/* Responsive */
@media(max-width:768px){
  .profile-header{flex-direction:column;align-items:center;text-align:center;}
  .profile-actions{justify-content:center;}
}

/* ===== Manga Container ===== */
.manga-container {
    padding: 0 24px;
    max-width: 1400px;
   
}

/* ===== Manga Grid ===== */
.manga-grid {
    display: grid;
    gap: 32px;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
}

/* ===== Manga Cards ===== */
.manga-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border-color);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all 0.4s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
}
.manga-card:hover {
    transform: translateY(-10px);
    border-color: var(--primary-orange);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}
.manga-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 107, 71, 0.05), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.manga-card:hover::before {
    opacity: 1;
}

/* ===== Cover Image ===== */
.manga-cover-wrap {
    position: relative;
    overflow: hidden;
    height: 340px;
    background: var(--dark-bg-tertiary);
}
.manga-cover {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.manga-card:hover .manga-cover {
    transform: scale(1.1);
}
.manga-cover-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15, 15, 15, 0.9) 0%, transparent 50%);
    z-index: 2;
}
.manga-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
    box-shadow: 0 4px 12px rgba(255,107,71,0.4);
    z-index: 3;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ===== No Image ===== */
.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 12px;
    background: linear-gradient(135deg, var(--dark-bg-secondary), var(--dark-bg-tertiary));
    color: var(--text-muted);
}
.no-image i {
    font-size: 3rem;
    opacity: 0.5;
}
.no-image span {
    font-weight: 600;
    font-size: 0.9rem;
}

/* ===== Card Body ===== */
.manga-card .card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    background: rgba(15,15,15,0.6);
    backdrop-filter: blur(10px);
    position: relative;
    z-index: 2;
}
.manga-title {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.6em;
}
.text-author {
    color: var(--text-muted) !important;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 16px !important;
    display: flex;
    align-items: center;
    gap: 6px;
}
.text-author i {
    font-size: 0.75rem;
}
.manga-card .btn-gradient {
    margin-top: auto;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px;
    font-size: 0.9rem;
}

/* ===== Page Header ===== */
.page-header {
    max-width: 1400px;
    margin: 0 0 40px 0;   /* <<< ตัด auto ทิ้ง จะไม่บังคับให้อยู่กลาง */
    padding: 32px 24px 24px;
    text-align: left;     /* ให้ข้อความชิดซ้าย */
}

.page-header h1 {
    font-size: clamp(2rem, 4vw, 2.5rem);   /* ขนาด dynamic ตามจอ */
    font-weight: 900;                      /* หนาแน่น */
    color: var(--text-primary);            /* สีขาวหลัก */
    margin: 0 0 8px 0;
    letter-spacing: -0.02em;               /* ขยับ spacing ตัวอักษร */
}

.page-header p {
    color: var(--text-muted);              /* ข้อความคำอธิบายสีเทา */
    font-size: 1.1rem;
    margin: 0;
}

/* Animation */
.page-header.fade-in {
    opacity: 0;
    transform: translateX(-30px);  /* เริ่มจากซ้าย */
    transition: all 0.6s ease;
}
.page-header.fade-in.active {
    opacity: 1;
    transform: translateX(0);      /* เลื่อนเข้าที่ */
}

/* Badge นับจำนวนผลลัพธ์ */
.results-count {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(255, 107, 71, 0.1);   /* พื้นหลังส้มใส */
    border: 1px solid rgba(255, 107, 71, 0.3);
    border-radius: 12px;
    color: var(--primary-orange-light);    /* สีตัวอักษรส้มอ่อน */
    font-weight: 600;
    font-size: 0.9rem;
    margin-top: 12px;
}

.icon img {
  width: 60%;   /* ปรับตามต้องการ */
  height: 60%;
  object-fit: contain;
  filter: drop-shadow(0 0 6px rgba(255,76,0,.4)); /* ให้ภาพดู glow ตามวง */
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




/* ===== Animation ===== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.manga-card { opacity: 0; animation: fadeInUp 0.6s ease forwards; }
.manga-card:nth-child(1){ animation-delay:.05s; }
.manga-card:nth-child(2){ animation-delay:.1s; }
.manga-card:nth-child(3){ animation-delay:.15s; }
.manga-card:nth-child(4){ animation-delay:.2s; }

/* ===== Buttons ===== */
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.25);
            position: relative;
            overflow: hidden;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-orange-light), var(--primary-orange));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 71, 0.35);
            color: #fff;
        }

        .btn-gradient:hover::before {
            opacity: 1;
        }

        .btn-gradient span,
        .btn-gradient i {
            position: relative;
            z-index: 1;
        }

        /* ===== Buttons ===== */
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.25);
            position: relative;
            overflow: hidden;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-orange-light), var(--primary-orange));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 71, 0.35);
            color: #fff;
        }

        .btn-gradient:hover::before {
            opacity: 1;
        }

        .btn-gradient span,
        .btn-gradient i {
            position: relative;
            z-index: 1;
        }

        .manga-card .btn-gradient {
                    margin-top: auto;
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    padding: 12px;
                    font-size: 0.9rem;
                }
        
        .btn-outline-danger {
            border-radius: 50%;
            width: 45px;
            height: 45px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            
        }

        /* ===== Swiper Container ===== */
.favorites-swiper {
    position: relative;
    padding: 0 60px 40px; /* เผื่อพื้นที่ซ้ายขวา + ล่างให้หายใจ */
}

/* ===== Swiper Navigation Arrows ===== */
.favorites-swiper .swiper-button-next,
.favorites-swiper .swiper-button-prev {
    color: var(--primary-orange);
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 18px rgba(0,0,0,0.4);
    transition: all 0.3s ease;
    backdrop-filter: blur(6px);
    z-index: 11;
}



/* Hover */
.favorites-swiper .swiper-button-next:hover,
.favorites-swiper .swiper-button-prev:hover {
    background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
    color: #000;
    transform: translateY(-50%) scale(1.08); /* <<< fix ไม่ให้หล่น */
    box-shadow: 0 8px 24px rgba(255,107,71,0.5);
}

/* ให้อยู่กลางแนวตั้ง */
.favorites-swiper .swiper-button-next,
.favorites-swiper .swiper-button-prev {
    top: 50%;
    transform: translateY(-50%);
}

/* <<< ดันเข้ามาใน container ไม่ให้หายไป */
.favorites-swiper .swiper-button-prev {
    left: 10px;
}
.favorites-swiper .swiper-button-next {
    right: 10px;
}

/* ขยาย icon ข้างใน */
.favorites-swiper .swiper-button-next::after,
.favorites-swiper .swiper-button-prev::after {
    font-size: 20px;
    font-weight: bold;
}

.btn-danger-gradient {
    background: linear-gradient(135deg, #ff4c4c, #ff1a1a);
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 999px;
    padding: .55rem 1.2rem;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    box-shadow: 0 6px 18px rgba(255,0,0,.35);
    transition: all .2s ease;
}
.btn-danger-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(255,0,0,.5);
}


</style>
@endpush

@section('content')
<div class="profile-container">
    
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            @if ($user->profile_img)
                <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Profile">
            @else
                <div class="no-img">No Image</div>
            @endif
        </div>
        <div class="profile-info">
            <h2>{{ $user->username }}</h2>
            <div class="meta">Joined: {{ $user->created_at->format('M Y') }}</div>
            <div class="meta">Email: {{ $user->email }}</div>
            <div class="meta">Name: {{ $user->name ?? '-' }}</div>

            <div class="profile-actions">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Edit Profile
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="bi bi-gear"></i> Settings
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon">
               <img src="/images\icons\DashBoard\Star.png" >
            </div>
            <div class="stat-value">{{ $user->favorites_count }}</div>
            <div class="stat-label">Favorites</div>
        </div>
        <div class="stat-card">
            <div class="icon">
               <img src="/images\icons\DashBoard\Comment.png" >
            </div>
            <div class="stat-value">{{ $user->reviews_count}}</div>
            <div class="stat-label">Reviews</div>
        </div>
    </div>

    <!-- Sections -->
    <div class="section-header">Favorites</div>
<div class="manga-container">
  @if ($favorites->count() > 0)
    <div class="swiper favorites-swiper">
        <div class="swiper-wrapper">
            @foreach ($favorites as $fav)
                @if ($fav->manga)
                <div class="swiper-slide">
                    <div class="manga-card">
                        <!-- Cover -->
                        <div class="manga-cover-wrap">
                            @if ($fav->manga->cover_img)
                                <img src="{{ asset('storage/' . $fav->manga->cover_img) }}" alt="{{ $fav->manga->title }}" class="manga-cover">
                            @else
                                <div class="no-image">
                                    <i class="bi bi-image"></i>
                                    <span>No Image</span>
                                </div>
                            @endif
                            <div class="manga-cover-overlay"></div>
                            <span class="manga-badge">{{ $fav->manga->type ?? 'Manga' }}</span>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <h6 class="manga-title">{{ $fav->manga->title ?? 'Unknown' }}</h6>
                            <p class="text-author"><i class="bi bi-pencil"></i> {{ $fav->manga->author ?? 'Unknown Author' }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manga.detail', $fav->manga_id) }}" class="btn btn-gradient">
                                    <i class="bi bi-eye-fill"></i><span>View Details</span>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <!-- Arrows -->
        @if ($favorites->count() > 3)
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        @endif
    </div>
  @else
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h3>No Favorites Yet</h3>
        <p>Start adding some manga to your favorites list!</p>
        <a href="{{ route('frontend.mangalist') }}" class="btn btn-gradient mt-3">
            <i class="bi bi-search"></i><span>Browse Manga</span>
        </a>
    </div>
  @endif
</div>

    

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".favorites-swiper", {
    slidesPerView: 1,
    spaceBetween: 24,
    centeredSlides: false,
    slidesOffsetBefore: 0,
    slidesOffsetAfter: 0,
    breakpoints: {
        768: { slidesPerView: 2 },
        992: { slidesPerView: 3 }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
});
</script>
@endpush
