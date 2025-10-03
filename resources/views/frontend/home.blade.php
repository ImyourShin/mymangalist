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

        /* Global Styles */
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

        /* Hero Section */
        .hero-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 24px 80px;
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

        /* Section Headers */
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

        /* Manga Container */
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

        /* Manga Card */
        .manga-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
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

        /* Card Thumbnail */
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

        /* Card Content */
        .card-content {
            padding: 24px;
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

        /* Card Info */
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

        /* Card Meta */
        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
            flex-wrap: wrap;
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

        /* Rating Display */
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

        /* Card Action */
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

        /* Animations */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 16px 60px;
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
                            <!-- Cover -->
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

                            <!-- Card Content -->
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
                                    <button class="btn-favorite" title="Add to Favorites">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Popular Manga Section (if you have it) -->
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
                    @foreach ($latestManga as $manga)
                        <div class="manga-card">
                            <!-- Cover -->
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

                            <!-- Card Content -->
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
                                    <button class="btn-favorite" title="Add to Favorites">
                                        <i class="far fa-heart"></i>
                                    </button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Hero section fade in
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                heroSection.style.opacity = '0';
                heroSection.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    heroSection.style.transition = 'all 0.8s ease';
                    heroSection.style.opacity = '1';
                    heroSection.style.transform = 'translateY(0)';
                }, 100);
            }

            // Section headers fade in
            const sectionHeaders = document.querySelectorAll('.section-header');
            sectionHeaders.forEach((header, index) => {
                header.style.opacity = '0';
                header.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    header.style.transition = 'all 0.6s ease';
                    header.style.opacity = '1';
                    header.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });
        });
    </script>
@endpush
