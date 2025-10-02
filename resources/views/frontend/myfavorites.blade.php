@extends('layouts.frontend')

@section('title', 'My Favorites')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
:root {
    --primary-orange: #ff6b47;
    --primary-orange-light: #ff8e53;
    --dark-bg: #0f0f0f;
    --dark-bg-secondary: #1a1a1a;
    --dark-bg-tertiary: #242424;
    --text-primary: #ffffff;
    --text-muted: rgba(255, 255, 255, 0.6);
    --border-color: rgba(255, 255, 255, 0.1);
    --radius: 20px;
    --shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* ===== Fix Empty Right Space ===== */
.col-lg-9 {
  flex: 0 0 100% !important;
  max-width: 100% !important;
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

        


</style>
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header fade-in">
            <h1>My Favorite Manga</h1>
            <p>Your personal collection of saved manga – quick access to what you love.</p>
            @if (isset($mangaList) && $mangaList->total() > 0)
                <span class="results-count">
                    <i class="bi bi-collection"></i>
                    {{ $mangaList->total() }} {{ Str::plural('manga', $mangaList->total()) }} found
                </span>
            @endif
        </div>
    </div>

    <div class="col-12 col-lg-9">
        <div class="manga-container">
            @if ($favorites->count() > 0)
                <div class="manga-grid">
                    @foreach ($favorites as $fav)
                        @if ($fav->manga)
                            <div class="manga-card">
                                <!-- Cover -->
                                <div class="manga-cover-wrap">
                                    @if ($fav->manga->cover_img)
                                        <img src="{{ asset('storage/' . $fav->manga->cover_img) }}"
                                            alt="{{ $fav->manga->title }}" class="manga-cover">
                                    @else
                                        <div class="no-image">
                                            <i class="bi bi-image"></i>
                                            <span>No Image</span>
                                        </div>
                                    @endif
                                    <div class="manga-cover-overlay"></div>
                                    <span class="manga-badge">{{ $fav->manga->type ?? 'Manga' }}</span>
                                </div>
                                <div class="manga-slider-wrapper">
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <h6 class="manga-title">{{ $fav->manga->title ?? 'Unknown' }}</h6>
                                        <p class="text-author">
                                            <i class="bi bi-pencil"></i>
                                            {{ $fav->manga->author ?? 'Unknown Author' }}
                                        </p>
                                        <div class="d-flex gap-2 ">
                                            <a href="{{ route('manga.detail', $fav->manga_id) }}" class="btn btn-gradient">
                                                <i class="bi bi-eye-fill"></i>
                                                <span>View Details</span>
                                            </a>

                                            <!-- Remove from Favorites -->
                                            <form action="{{ route('admin.favorites.remove', $fav->favorite_id) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Remove this manga from favorites?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger mt-1" title="Remove from Favorites">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $favorites->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>No Favorites Yet</h3>
                    <p>Start adding some manga to your favorites list!</p>
                    <a href="{{ route('frontend.mangalist') }}" class="btn btn-gradient mt-3">
                        <i class="bi bi-search"></i>
                        <span>Browse Manga</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    

            
    </div>



<script>
    const pageHeader = document.querySelector('.page-header');
if (pageHeader) {
    setTimeout(() => {
        pageHeader.classList.add('active');
    }, 100);
}
</script>

@endsection
