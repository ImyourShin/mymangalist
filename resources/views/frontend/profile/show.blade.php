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
body{background:radial-gradient(1000px 600px at 50% -200px,#0a0a0a 0%,var(--dark-bg) 70%); font-family:'Poppins','Inter',sans-serif; color:var(--text-primary);}
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
.profile-avatar img,.profile-avatar .no-img{
  width:140px;height:140px;border-radius:50%;object-fit:cover;
  box-shadow:0 0 0 4px rgba(255,255,255,.06),0 8px 28px rgba(0,0,0,.45);
}
.profile-avatar .no-img{
  display:flex;align-items:center;justify-content:center;
  background:#2b2b2b;color:var(--text-muted);font-weight:600;
}

/* Info */
.profile-info{flex:1;}
.profile-info h2{font-size:1.9rem;font-weight:700;margin:0 0 8px;}
.profile-info .meta{color:var(--text-muted);font-size:.95rem;}
.profile-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;}
.profile-actions .btn{border-radius:999px;padding:.55rem 1.2rem;font-weight:600;display:flex;align-items:center;gap:.5rem;}

/* Buttons */
.btn-primary{
  background:linear-gradient(90deg,var(--primary-orange),var(--primary-orange-light));
  border:none;color:#000;
  box-shadow:0 8px 20px rgba(255,107,71,.25);
}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(255,107,71,.35);}
.btn-secondary{background:var(--dark-bg-tertiary);border:1px solid var(--border-color);color:var(--text-primary);}
.btn-secondary:hover{border-color:var(--primary-orange);transform:translateY(-2px);}

/* ===== Stats Cards ===== */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:24px;margin-bottom:32px;}
.stat-card{background:var(--dark-bg-secondary);border:1px solid var(--border-color);border-radius:var(--radius);padding:20px;text-align:center;}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 0 0 1px rgba(255,107,71,.25),0 12px 30px rgba(0,0,0,.5);}
.icon{width:54px;height:54px;border-radius:50%;margin:0 auto 12px;background:rgba(255,76,0,.15);box-shadow:inset 0 0 14px rgba(255,76,0,.4);display:flex;align-items:center;justify-content:center;}
.icon img{width:60%;height:60%;object-fit:contain;filter:drop-shadow(0 0 6px rgba(255,76,0,.4));}
.stat-value{font-size:1.8rem;font-weight:800;}
.stat-label{text-transform:uppercase;font-size:.8rem;color:var(--text-muted);letter-spacing:.5px;}

/* ===== Section Header ===== */
.section-header{display:flex;align-items:center;gap:10px;margin:28px 0 16px;font-weight:700;font-size:1.3rem;}
.section-header::before{content:"";width:5px;height:20px;border-radius:999px;background:linear-gradient(180deg,var(--primary-orange),var(--primary-orange-light));}

/* ===== Manga Card (used inside Swiper) ===== */
.manga-card{background:rgba(255,255,255,.03);backdrop-filter:blur(10px);border:1px solid var(--border-color);border-radius:var(--radius);overflow:hidden;display:flex;flex-direction:column;height:100%;}
.manga-card:hover{ transform:none;border-color:var(--primary-orange);box-shadow:0 20px 40px rgba(0,0,0,.4);}
.card-thumbnail{position:relative;height:340px;background:var(--dark-bg-tertiary);overflow:hidden;}
.card-thumbnail img{width:100%;height:100%;object-fit:cover;transition:none;transform:none;}
.manga-card:hover .card-thumbnail img{transform:scale(1.1);}
.manga-badge{position:absolute;top:12px;left:12px;background:linear-gradient(135deg,var(--primary-orange),var(--primary-orange-light));color:#fff;font-size:.7rem;font-weight:700;padding:6px 14px;border-radius:999px;box-shadow:0 4px 12px rgba(255,107,71,.4);}
.card-content{padding:20px;flex:1;display:flex;flex-direction:column;}
.card-title{font-weight:700;font-size:1.1rem;margin-bottom:14px;line-height: 1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.card-info{margin-bottom:16px;}
.info-row{display:flex;align-items:center;line-height: 1.6; gap:8px;font-size:.9rem;color:var(--text-muted);margin-bottom: 6px; }
.genre-badges{display:flex;gap:6px;flex-wrap:wrap;margin-bottom: 12px;}
.genre-badge{padding:4px 10px;background:rgba(255,107,71,.15);border:1px solid rgba(255,107,71,.3);border-radius:8px;color:var(--primary-orange-light);font-size:.8rem;font-weight:600;}
.rating-display{display:flex;align-items:center;gap:6px;font-size:.9rem;margin-bottom:18px;line-height: 1.5;}
.stars{
    color:#ffd700;
}
.rating-number{
    font-weight:700;
    color:var(--text-primary);
}
.card-action{
    display:flex;
    gap:12px;
    margin-top:auto;
}
.btn-detail{flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;padding:10px 16px;
    background:linear-gradient(135deg,var(--primary-orange),var(--primary-orange-light));
    border-radius:12px;color:#fff;
    text-decoration:none;
    font-weight:600;
}
.btn-detail:hover{box-shadow:0 6px 18px rgba(255,107,71,.4);}


/* ===== Swiper ===== */
.favorites-swiper{padding:0 60px 40px;}
.favorites-swiper .swiper-button-next,
.favorites-swiper .swiper-button-prev{
  color:var(--primary-orange);
  background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.15);
  width:50px;height:50px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  backdrop-filter:blur(6px);box-shadow:0 6px 18px rgba(0,0,0,.4);
  transition:.3s;top:50%;transform:translateY(-50%);
}
.favorites-swiper .swiper-button-prev{left:10px;}
.favorites-swiper .swiper-button-next{right:10px;}
.favorites-swiper .swiper-button-next:hover,
.favorites-swiper .swiper-button-prev:hover{
  background:linear-gradient(135deg,var(--primary-orange),var(--primary-orange-light));
  color:#000;transform:translateY(-50%) scale(1.08);
  box-shadow:0 8px 24px rgba(255,107,71,.5);
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
          <div class="meta">Joined : {{ $user->created_at->format('M Y') }}</div>
          <div class="meta">Email : {{ $user->email }}</div>
          <div class="meta">Name : {{ $user->username }}</div>

          <div class="profile-actions">
              <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                  <i class="bi bi-pencil-square"></i> Edit Profile
              </a>
              <form action="{{ route('logout') }}" method="POST" style="margin:0;">
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
          <div class="icon"><img src="/images/icons/DashBoard/Star.png"></div>
          <div class="stat-value">{{ $user->favorites_count }}</div>
          <div class="stat-label">Favorites</div>
      </div>
      <div class="stat-card">
          <div class="icon"><img src="/images/icons/DashBoard/Comment.png"></div>
          <div class="stat-value">{{ $user->reviews_count}}</div>
          <div class="stat-label">Reviews</div>
      </div>
  </div>

  <!-- Favorites Section -->
  <div class="section-header">Favorites</div>
  <div class="manga-container">
    @if ($favorites->count() > 0)
      <div class="swiper favorites-swiper">
          <div class="swiper-wrapper">
              @foreach ($favorites as $fav)
                  @if ($fav->manga)
                  <div class="swiper-slide">
                      <div class="manga-card">
                          <div class="card-thumbnail">
                              @if ($fav->manga->cover_img)
                                  <img src="{{ asset('storage/' . $fav->manga->cover_img) }}" alt="{{ $fav->manga->title }}">
                              @else
                                  <div class="no-image">
                                      <i class="bi bi-image"></i><span>No Image</span>
                                  </div>
                              @endif
                              <span class="manga-badge">{{ $fav->manga->type ?? 'Manga' }}</span>
                          </div>
                          <div class="card-content">
                              <h3 class="card-title">{{ $fav->manga->title ?? 'Unknown' }}</h3>
                              <div class="card-info">
                                  <div class="info-row"><i class="fas fa-pen"></i><span><strong>Author:</strong> {{ $fav->manga->author ?? 'Unknown Author' }}</span></div>
                                  <div class="info-row"><i class="fas fa-info-circle"></i><span><strong>Status:</strong> {{ $fav->manga->status ?? 'N/A' }}</span></div>
                              </div>
                              <div class="genre-badges">
                                  @if ($fav->manga->genres && $fav->manga->genres->count() > 0)
                                      @foreach ($fav->manga->genres as $g)<span class="genre-badge">{{ $g->name }}</span>@endforeach
                                  @else
                                      <span class="genre-badge">Unknown</span>
                                  @endif
                              </div>
                              @php
                                $avgRating = $fav->manga->reviews_avg_rating ?? 0;
                                $reviewsCount = $fav->manga->reviews_count ?? 0;
                                $fullStars = floor($avgRating);
                                $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                              @endphp
                              <div class="rating-display">
                                <span class="stars">
                                    @for ($i = 0; $i < $fullStars; $i++)<i class="fas fa-star"></i>@endfor
                                    @if ($hasHalfStar)<i class="fas fa-star-half-alt"></i>@endif
                                    @for ($i = 0; $i < $emptyStars; $i++)<i class="far fa-star"></i>@endfor
                                </span>
                                @if ($reviewsCount > 0)
                                  <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                  <span>({{ $reviewsCount }})</span>
                                @else
                                  <span class="rating-number">No rating</span>
                                @endif
                              </div>
                              <div class="card-action">
                                  <a href="{{ route('manga.detail', $fav->manga_id) }}" class="btn-detail">
                                      <i class="fas fa-eye"></i> View Details
                                  </a>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
                  @endif
              @endforeach
          </div>
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
  new Swiper(".favorites-swiper", {
    slidesPerView: 1,
    spaceBetween: 24,
    breakpoints: {
      768: { slidesPerView: 2 },
      992: { slidesPerView: 3 }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    }
  });
});
</script>
@endpush

