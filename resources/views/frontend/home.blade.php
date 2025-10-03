@extends('layouts.frontend')

@section('title', 'Home')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-orange: #ff6b47;
            --primary-orange-dark: #e55a2b;
            --primary-orange-light: #ff8e53;
            --dark-bg: #0f0f0f;
            --dark-bg-secondary: #1a1a1a;
            --dark-bg-tertiary: #242424;
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.85);
            --text-muted: rgba(255, 255, 255, 0.6);
            --border-color: rgba(255, 255, 255, 0.1);
            --hover-bg: rgba(255, 255, 255, 0.05);
        }

        html,
        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-bg-secondary) 100%);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-content {
            min-height: 100vh;
            padding-bottom: 80px;
        }

        /* Banner Carousel */
        .banner-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 24px;
            position: relative;
        }

        .banner-carousel {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
        }

        .banner-slide {
            position: relative;
            height: 500px;
            display: none;
            animation: fadeIn 0.8s ease;
        }

        .banner-slide.active {
            display: block;
        }

        .banner-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 50%, transparent 100%);
        }

        .banner-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 60px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        }

        .banner-title {
            font-size: 3rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 16px;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.8);
            letter-spacing: -0.02em;
        }

        .banner-subtitle {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 24px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
        }

        .banner-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: white;
            text-decoration: none;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .banner-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(255, 107, 71, 0.5);
            color: white;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .carousel-nav:hover {
            background: rgba(255, 107, 71, 0.3);
            border-color: var(--primary-orange);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav.prev {
            left: 20px;
        }

        .carousel-nav.next {
            right: 20px;
        }

        .carousel-nav i {
            color: white;
            font-size: 1.5rem;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .indicator {
            width: 40px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .indicator.active {
            background: var(--primary-orange);
            width: 60px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .hero-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 24px 60px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 24px;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .hero-gradient-text {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-section p {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header {
            max-width: 1400px;
            margin: 0 auto 40px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-title {
            font-weight: 800;
            font-size: 2rem;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .section-title i {
            color: var(--primary-orange);
            font-size: 1.5rem;
        }

        .view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            background: rgba(255, 107, 71, 0.15);
            border-color: var(--primary-orange);
            color: var(--primary-orange-light);
            transform: translateY(-2px);
        }

        .manga-container {
            padding: 0 24px;
            max-width: 1400px;
            margin: 0 auto 80px;
        }

        .manga-grid {
            display: grid;
            gap: 32px;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }

        .manga-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .manga-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 107, 71, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .manga-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary-orange);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.3);
        }

        .manga-card:hover::before {
            opacity: 1;
        }

        .card-thumbnail {
            position: relative;
            width: 100%;
            height: 380px;
            overflow: hidden;
            background: var(--dark-bg-tertiary);
        }

        .card-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .manga-card:hover .card-thumbnail img {
            transform: scale(1.1);
        }

        .placeholder-thumb {
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

        .placeholder-thumb i {
            font-size: 3rem;
            opacity: 0.5;
        }

        .manga-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 999px;
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.4);
            z-index: 3;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .card-content {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6em;
        }

        .card-info {
            margin-bottom: 16px;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .info-row i {
            color: var(--primary-orange);
            font-size: 0.85rem;
            width: 16px;
        }

        .info-row strong {
            color: var(--text-primary);
            font-weight: 600;
        }

        .card-meta {
            margin-bottom: 16px;
            min-height: 38px;
        }

        .genre-badges {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .genre-badge {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(255, 107, 71, 0.15);
            border: 1px solid rgba(255, 107, 71, 0.3);
            border-radius: 8px;
            color: var(--primary-orange-light);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .rating-display {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .stars {
            color: #ffd700;
            font-size: 1rem;
            letter-spacing: 2px;
        }

        .rating-number {
            color: var(--text-primary);
            font-weight: 700;
        }

        .card-action {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }

        .btn-detail {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 71, 0.4);
            color: white;
        }

        .btn-favorite {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .btn-favorite:hover {
            background: rgba(255, 107, 71, 0.15);
            border-color: var(--primary-orange);
            color: #ff6b6b;
            transform: scale(1.1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .manga-card {
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }

        .manga-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .manga-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .manga-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .manga-card:nth-child(4) {
            animation-delay: 0.2s;
        }

        .manga-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .manga-card:nth-child(6) {
            animation-delay: 0.3s;
        }

        @media (max-width: 768px) {
            .banner-section {
                padding: 20px 16px;
            }

            .banner-slide {
                height: 350px;
            }

            .banner-content {
                padding: 30px 20px;
            }

            .banner-title {
                font-size: 2rem;
            }

            .banner-subtitle {
                font-size: 1rem;
            }

            .carousel-nav {
                width: 40px;
                height: 40px;
            }

            .carousel-nav.prev {
                left: 10px;
            }

            .carousel-nav.next {
                right: 10px;
            }

            .hero-section {
                padding: 30px 16px 40px;
            }

            .section-header {
                padding: 0 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .manga-container {
                padding: 0 16px;
                margin-bottom: 60px;
            }

            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 20px;
            }

            .card-thumbnail {
                height: 280px;
            }
        }

        @media (max-width: 576px) {
            .banner-slide {
                height: 280px;
            }

            .manga-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .card-thumbnail {
                height: 240px;
            }

            .card-content {
                padding: 16px;
            }

            .card-title {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <!-- Banner Carousel -->
        <div class="banner-section">
            <div class="banner-carousel">
                <div class="banner-slide active">
                    <img src="{{ asset('images/banner1.jpeg') }}" alt="Banner 1">
                    <div class="banner-overlay"></div>
                    <div class="banner-content">
                        <h2 class="banner-title">Welcome to Manga Paradise</h2>
                        <p class="banner-subtitle">Discover thousands of manga titles and join our growing community</p>
                        <a href="{{ route('frontend.mangalist') }}" class="banner-btn">
                            <i class="fas fa-book-open"></i> Explore Now
                        </a>
                    </div>
                </div>

                <div class="banner-slide">
                    <img src="{{ asset('images/banner2.jpg') }}" alt="Banner 2">
                    <div class="banner-overlay"></div>
                    <div class="banner-content">
                        <h2 class="banner-title">Your Next Adventure Awaits</h2>
                        <p class="banner-subtitle">From action-packed stories to heartwarming tales</p>
                        <a href="{{ route('register') }}" class="banner-btn">
                            <i class="fas fa-compass"></i> Start Reading
                        </a>
                    </div>
                </div>

                <div class="carousel-nav prev" onclick="changeSlide(-1)">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="carousel-nav next" onclick="changeSlide(1)">
                    <i class="fas fa-chevron-right"></i>
                </div>

                <div class="carousel-indicators">
                    <div class="indicator active" onclick="goToSlide(0)"></div>
                    <div class="indicator" onclick="goToSlide(1)"></div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="hero-section">
            <h1>
                Discover Your Next
                <span class="hero-gradient-text">Favorite Manga</span>
            </h1>
            <p>Explore thousands of manga titles, track your reading, and join our community of manga enthusiasts</p>
        </div>

        <!-- Latest Manga Section -->
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-stars"></i>
                Latest Releases
            </h2>
            <a href="{{ route('frontend.mangalist') }}" class="view-all-btn">
                <span>View All</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="manga-container">
            @if (isset($latestManga) && $latestManga->count() > 0)
                <div class="manga-grid">
                    @foreach ($latestManga as $manga)
                        <div class="manga-card">
                            <div class="card-thumbnail">
                                @if ($manga->cover_img)
                                    <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}">
                                @else
                                    <div class="placeholder-thumb">
                                        <i class="bi bi-image"></i>
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <span class="manga-badge">{{ $manga->type ?? 'Manga' }}</span>
                            </div>

                            <div class="card-content">
                                <h3 class="card-title">{{ $manga->title }}</h3>

                                <div class="card-info">
                                    <div class="info-row">
                                        <i class="fas fa-pen"></i>
                                        <span><strong>Author:</strong> {{ $manga->author ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-info-circle"></i>
                                        <span><strong>Status:</strong> {{ $manga->status ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="card-meta">
                                    <div class="genre-badges">
                                        @forelse($manga->genres->take(2) as $g)
                                            <span class="genre-badge">{{ $g->name }}</span>
                                        @empty
                                            <span class="genre-badge">Unknown</span>
                                        @endforelse
                                        @if ($manga->genres->count() > 2)
                                            <span class="genre-badge">+{{ $manga->genres->count() - 2 }}</span>
                                        @endif
                                    </div>
                                </div>

                                @php
                                    $avgRating = $manga->reviews_avg_rating ?? 0;
                                    $reviewsCount = $manga->reviews_count ?? 0;
                                    $fullStars = floor($avgRating);
                                    $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                @endphp

                                <div class="rating-display">
                                    <span class="stars">
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </span>
                                    @if ($reviewsCount > 0)
                                        <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                        <span>({{ $reviewsCount }})</span>
                                    @else
                                        <span class="rating-number">No rating</span>
                                    @endif
                                </div>

                                <div class="card-action">
                                    <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn-detail">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    @auth
                                        <button class="btn-favorite" onclick="toggleFavorite({{ $manga->manga_id }}, this)"
                                            title="{{ in_array($manga->manga_id, $userFavorites ?? []) ? 'Remove from Favorites' : 'Add to Favorites' }}">
                                            <i
                                                class="fa{{ in_array($manga->manga_id, $userFavorites ?? []) ? 's' : 'r' }} fa-heart"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-favorite" title="Login to add favorites">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Popular Manga Section -->
        @if (isset($popularManga) && $popularManga->count() > 0)
            <div class="section-header">
                <h2 class="section-title">
                    <i class="bi bi-fire"></i>
                    Popular This Week
                </h2>
                <a href="{{ route('frontend.mangalist') }}" class="view-all-btn">
                    <span>View All</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="manga-container">
                <div class="manga-grid">
                    @foreach ($popularManga as $manga)
                        <div class="manga-card">
                            <div class="card-thumbnail">
                                @if ($manga->cover_img)
                                    <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}">
                                @else
                                    <div class="placeholder-thumb">
                                        <i class="bi bi-image"></i>
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <span class="manga-badge">{{ $manga->type ?? 'Manga' }}</span>
                            </div>

                            <div class="card-content">
                                <h3 class="card-title">{{ $manga->title }}</h3>

                                <div class="card-info">
                                    <div class="info-row">
                                        <i class="fas fa-pen"></i>
                                        <span><strong>Author:</strong> {{ $manga->author ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-info-circle"></i>
                                        <span><strong>Status:</strong> {{ $manga->status ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="card-meta">
                                    <div class="genre-badges">
                                        @forelse($manga->genres->take(2) as $g)
                                            <span class="genre-badge">{{ $g->name }}</span>
                                        @empty
                                            <span class="genre-badge">Unknown</span>
                                        @endforelse
                                        @if ($manga->genres->count() > 2)
                                            <span class="genre-badge">+{{ $manga->genres->count() - 2 }}</span>
                                        @endif
                                    </div>
                                </div>

                                @php
                                    $avgRating = $manga->reviews_avg_rating ?? 0;
                                    $reviewsCount = $manga->reviews_count ?? 0;
                                    $fullStars = floor($avgRating);
                                    $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                @endphp

                                <div class="rating-display">
                                    <span class="stars">
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </span>
                                    @if ($reviewsCount > 0)
                                        <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                        <span>({{ $reviewsCount }})</span>
                                    @else
                                        <span class="rating-number">No rating</span>
                                    @endif
                                </div>

                                <div class="card-action">
                                    <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn-detail">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    @auth
                                        <button class="btn-favorite" onclick="toggleFavorite({{ $manga->manga_id }}, this)"
                                            title="{{ in_array($manga->manga_id, $userFavorites ?? []) ? 'Remove from Favorites' : 'Add to Favorites' }}">
                                            <i
                                                class="fa{{ in_array($manga->manga_id, $userFavorites ?? []) ? 's' : 'r' }} fa-heart"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-favorite" title="Login to add favorites">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-slide');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = slides.length;

        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));

            currentSlide = (n + totalSlides) % totalSlides;

            slides[currentSlide].classList.add('active');
            indicators[currentSlide].classList.add('active');
        }

        function changeSlide(direction) {
            showSlide(currentSlide + direction);
        }

        function goToSlide(n) {
            showSlide(n);
        }

        let autoSlideInterval = setInterval(() => {
            changeSlide(1);
        }, 5000);

        const carousel = document.querySelector('.banner-carousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            carousel.addEventListener('mouseleave', () => {
                autoSlideInterval = setInterval(() => {
                    changeSlide(1);
                }, 5000);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const bannerSection = document.querySelector('.banner-section');
            if (bannerSection) {
                bannerSection.style.opacity = '0';
                bannerSection.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    bannerSection.style.transition = 'all 0.8s ease';
                    bannerSection.style.opacity = '1';
                    bannerSection.style.transform = 'translateY(0)';
                }, 100);
            }

            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                heroSection.style.opacity = '0';
                heroSection.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    heroSection.style.transition = 'all 0.8s ease';
                    heroSection.style.opacity = '1';
                    heroSection.style.transform = 'translateY(0)';
                }, 300);
            }

            const sectionHeaders = document.querySelectorAll('.section-header');
            sectionHeaders.forEach((header, index) => {
                header.style.opacity = '0';
                header.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    header.style.transition = 'all 0.6s ease';
                    header.style.opacity = '1';
                    header.style.transform = 'translateY(0)';
                }, 500 + (index * 100));
            });
        });

        function toggleFavorite(mangaId, button) {
            fetch(`/manga/${mangaId}/favorite`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const icon = button.querySelector('i');
                        if (data.status === 'added') {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                            button.title = 'Remove from Favorites';
                            Toast.fire({
                                icon: 'success',
                                title: 'Added to favorites'
                            });
                        } else {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                            button.title = 'Add to Favorites';
                            Toast.fire({
                                icon: 'success',
                                title: 'Removed from favorites'
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Toast.fire({
                        icon: 'error',
                        title: 'Failed to update favorites'
                    });
                });
        }

        // Initialize SweetAlert2 Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endpush
