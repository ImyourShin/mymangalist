@extends('layouts.frontend')

@section('title', 'Home')

@push('styles')
<style>
  :root{
    --bg-900:#0d0d0d;
    --bg-800:#1a1a1a;
    --border-soft:rgba(255,255,255,.08);
    --text-100:#f5f5f7;
    --text-70:#b3b3b3;
    --accent:#FF4C00;              /* updated accent */
    --accent-hover:#FF4C00;        /* softer hover */
    --radius-16:16px;
    --shadow-soft:0 8px 24px rgba(0,0,0,.35);
  }
  body{background:var(--bg-900); color:var(--text-100); font-family:'Poppins','Inter',sans-serif;}

  /* ===== Hero Banner ===== */
  #heroBanner { position:relative; border-radius:var(--radius-16); overflow:hidden; }
  #heroBanner .banner {
    min-height:600px; background-position:center; background-size:cover; background-repeat:no-repeat;
    border-radius:var(--radius-16);
    border:1px solid var(--border-soft); box-shadow:var(--shadow-soft);
    opacity:0; position:absolute; inset:0; transition:opacity 1s ease;
  }
  #heroBanner .banner.active { opacity:1; position:relative; }

  /* Overlay */
  #heroBanner .banner-overlay{
    position:absolute; inset:0;
    background:linear-gradient(to top, rgba(0,0,0,.65) 0%, rgba(0,0,0,.25) 50%, rgba(0,0,0,0) 100%);
  }

  /* Banner Content */
  .banner-content{
    position:absolute; bottom:22%; left:50%; transform:translateX(-50%);
    text-align:center; z-index:2; max-width:80%;
    text-shadow:0 3px 12px rgba(0,0,0,.85);
  }
  .banner-content h1{font-size:2.6rem;font-weight:700;}
  .banner-content p{color:var(--text-70);}
  @media(max-width:768px){
    #heroBanner .banner{min-height:240px;}
    .banner-content h1{font-size:1.6rem;}
    .banner-content p{font-size:.9rem;}
  }

  /* Text Animation */
  .animate-text{opacity:0; transform:translateY(20px); transition:all .8s ease;}
  .banner.active .animate-text{opacity:1; transform:translateY(0);}
  .delay-1{transition-delay:.3s;} .delay-2{transition-delay:.6s;}

  /* Nav Buttons */
  .nav-btn{
    position:absolute; top:50%; transform:translateY(-50%);
    width:48px; height:48px; border-radius:50%;
    background:rgba(20,20,20,.55); border:1px solid rgba(255,255,255,.2);
    color:#fff; display:grid; place-items:center; cursor:pointer;
    z-index:5; transition:.25s;
    backdrop-filter:blur(6px);
  }
  .nav-btn:hover{background:rgba(20,20,20,.75);}
  .nav-left{left:1rem;} .nav-right{right:1rem;}

  /* Ripple */
  .ripple{position:relative;overflow:hidden;}
  .ripple::after{
    content:"";position:absolute;border-radius:50%;width:120px;height:120px;
    background:rgba(255,255,255,.35);top:50%;left:50%;
    transform:scale(0) translate(-50%,-50%);opacity:0;pointer-events:none;
  }
  .ripple:active::after{transform:scale(2) translate(-50%,-50%);opacity:1;transition:.6s;}

  /* ===== Section Title ===== */
  .section-title{
    background:rgba(255,255,255,.04); backdrop-filter:blur(8px);
    border:1px solid var(--border-soft);
    border-radius:var(--radius-16); box-shadow:var(--shadow-soft);
    padding:.75rem 1rem; display:flex; align-items:center; justify-content:space-between;
    margin:2rem 0 1.25rem;
  }
  .section-title .left{display:flex;align-items:center;gap:.75rem;}
  .section-title .bar{
    width:6px;height:22px;border-radius:4px;
    background:linear-gradient(180deg,var(--accent),var(--accent-hover));
  }
  .section-title h4{margin:0;font-weight:600;color:var(--text-100);}
  .section-title .bi{color:var(--text-70);}

  /* ===== Cards ===== */
  .card-dark{
    background:rgba(255,255,255,.03); backdrop-filter:blur(12px);
    border:1px solid var(--border-soft); border-radius:var(--radius-16);
    overflow:hidden; box-shadow:var(--shadow-soft);
    transition:transform .25s ease, box-shadow .25s ease;
    height:100%;
  }
  .card-dark:hover{transform:translateY(-4px);box-shadow:0 12px 28px rgba(0,0,0,.55);}
  .card-dark .ratio-thumb{height:180px;overflow:hidden;}
  .card-dark img{width:100%;height:100%;object-fit:cover;transition:transform .5s;}
  .card-dark:hover img{transform:scale(1.05);}
  .placeholder-thumb{display:flex;align-items:center;justify-content:center;background:#1c1c1c;color:var(--text-70);}
  .card-title-2line{
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
    overflow:hidden;min-height:2.6em;line-height:1.3;font-weight:600;color:var(--text-100);
  }
  .badge-genre{
    display:inline-block;font-size:.75rem;color:#e0e0e0;
    background:rgba(255,255,255,.06);border:1px solid var(--border-soft);
    border-radius:999px;padding:.2rem .65rem;
  }
  .btn-orange{
    background:linear-gradient(45deg,var(--accent),var(--accent-hover));
    border:none;color:#111;font-weight:600;
    border-radius:999px;box-shadow:0 6px 16px rgba(255,76,0,.35);
    transition:.25s;
  }
  .btn-orange:hover{opacity:.9;}
</style>
@endpush

@section('content')
<!-- Hero Banner -->
<div id="heroBanner" class="position-relative mb-5">
  <!-- Slide 1 -->
  <div class="banner w-100 active mt-2" style="background-image:url('{{ asset('images/banner1.jpeg') }}')">
    <div class="banner-overlay"></div>
    <div class="banner-content">
      <h1 class="animate-text">Discover Your Next Favorite Manga</h1>
      <p class="animate-text delay-1">New chapters, trending titles, curated for you.</p>
      <a href="{{ route('frontend.mangalist') }}" class="btn btn-orange btn-lg d-inline-flex align-items-center gap-2 ripple animate-text delay-2">
        Browse Manga <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
  <!-- Slide 2 -->
  <div class="banner w-100" style="background-image:url('{{ asset('images/banner2.jpg') }}')">
    <div class="banner-overlay"></div>
    <div class="banner-content">
      <h1 class="animate-text">Read Anytime, Anywhere</h1>
      <p class="animate-text delay-1">Thousands of titles ready for you to explore.</p>
      <a href="{{ route('frontend.mangalist') }}" class="btn btn-orange btn-lg d-inline-flex align-items-center gap-2 ripple animate-text delay-2">
        Start Reading <i class="bi bi-book"></i>
      </a>
    </div>
  </div>
  <!-- Slide 3 -->
  <div class="banner w-100" style="background-image:url('{{ asset('images/hero-3.jpg') }}')">
    <div class="banner-overlay"></div>
    <div class="banner-content">
      <h1 class="animate-text">Join the Community</h1>
      <p class="animate-text delay-1">Share reviews, build your list, connect with fans.</p>
      <a href="{{ route('frontend.mangalist') }}" class="btn btn-orange btn-lg d-inline-flex align-items-center gap-2 ripple animate-text delay-2">
        Join Now <i class="bi bi-people"></i>
      </a>
    </div>
  </div>
  <!-- Nav -->
  <button class="nav-btn nav-left"><i class="bi bi-chevron-left"></i></button>
  <button class="nav-btn nav-right"><i class="bi bi-chevron-right"></i></button>
</div>

<!-- Section: Popular -->
<div class="section-title">
  <div class="left"><span class="bar"></span><h4>What's Popular</h4></div>
  <i class="bi bi-chevron-right"></i>
</div>

<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3">
  @foreach ($popularManga as $manga)
  <div class="col">
    <div class="card-dark">
      @if ($manga->cover_img)
        <div class="ratio-thumb">
          <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}">
        </div>
      @else
        <div class="ratio-thumb">
          <div class="placeholder-thumb"><i class="bi bi-image fs-2"></i></div>
        </div>
      @endif
      <div class="p-3">
        <h6 class="card-title-2line mb-2">{{ $manga->title }}</h6>
        <div class="mb-3"><span class="badge-genre">{{ $manga->genre ?? 'Unknown Genre' }}</span></div>
        <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn btn-orange btn-sm d-inline-flex align-items-center gap-1 ripple">
          More Detail <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
  const banners = document.querySelectorAll("#heroBanner .banner");
  const prevBtn = document.querySelector("#heroBanner .nav-left");
  const nextBtn = document.querySelector("#heroBanner .nav-right");
  let index = 0, autoSlide;

  function showSlide(i){
    banners.forEach(b => b.classList.remove("active"));
    banners[i].classList.add("active");
  }
  function nextSlide(){ index = (index + 1) % banners.length; showSlide(index); }
  function prevSlide(){ index = (index - 1 + banners.length) % banners.length; showSlide(index); }

  prevBtn.addEventListener("click", () => { prevSlide(); resetAuto(); });
  nextBtn.addEventListener("click", () => { nextSlide(); resetAuto(); });

  function startAuto(){ autoSlide = setInterval(nextSlide, 6000); }
  function resetAuto(){ clearInterval(autoSlide); startAuto(); }

  // Swipe
  let startX=0; const hero=document.querySelector("#heroBanner");
  hero.addEventListener("touchstart", e => startX = e.touches[0].clientX);
  hero.addEventListener("touchend", e => {
    let dx = e.changedTouches[0].clientX - startX;
    if(Math.abs(dx) > 50){ dx < 0 ? nextSlide() : prevSlide(); resetAuto(); }
  });

  startAuto();
});
</script>
@endpush
