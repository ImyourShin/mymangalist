@extends('layouts.frontend')

@section('title', 'My Favorites')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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

        .page-header {
            max-width: 1400px;
            margin: 0 auto 48px;
            padding: 40px 24px 0;
            text-align: center;
        }

        .page-header h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .page-header p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .results-count {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255, 107, 71, 0.15);
            border: 1px solid rgba(255, 107, 71, 0.3);
            border-radius: 12px;
            color: var(--primary-orange-light);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .manga-container {
            padding: 0 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .manga-grid {
            display: grid;
            gap: 32px;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            margin-bottom: 60px;
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
            flex: 1;
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
            max-height: 68px;
            overflow: hidden;
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
            white-space: nowrap;
        }

        .genre-more {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
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
            padding-top: 8px;
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

        .btn-remove {
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

        .btn-remove:hover {
            background: rgba(255, 59, 59, 0.15);
            border-color: #ff5b5b;
            color: #ff5b5b;
            transform: scale(1.1);
        }

        .empty-state {
            text-align: center;
            padding: 100px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 5rem;
            color: var(--text-muted);
            opacity: 0.3;
            margin-bottom: 24px;
        }

        .empty-state h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .empty-state p {
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto 32px;
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 20px rgba(255, 107, 71, 0.3);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
            box-shadow: 0 8px 24px rgba(255, 107, 71, 0.4);
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

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 48px;
            padding: 24px 0 40px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-item {
            list-style: none;
        }

        .page-link {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .page-link:hover {
            background: rgba(255, 107, 71, 0.15);
            border-color: var(--primary-orange);
            color: var(--text-primary);
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border-color: transparent;
            color: #fff;
            box-shadow: 0 6px 16px rgba(255, 107, 71, 0.4);
        }

        .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.05);
            pointer-events: none;
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
            .page-header {
                padding: 24px 16px 0;
            }

            .manga-container {
                padding: 0 16px;
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
        <div class="container-fluid">
            <div class="page-header">
                <h1>My Favorite Manga</h1>
                <p>Your personal collection of saved manga – quick access to what you love.</p>
                @if (isset($favorites) && $favorites->total() > 0)
                    <span class="results-count">
                        <i class="bi bi-collection"></i>
                        {{ $favorites->total() }} {{ Str::plural('manga', $favorites->total()) }} found
                    </span>
                @endif
            </div>

            <div class="manga-container">
                @if ($favorites->count() > 0)
                    <div class="manga-grid">
                        @foreach ($favorites as $fav)
                            @if ($fav->manga)
                                <div class="manga-card">
                                    <div class="card-thumbnail">
                                        @if ($fav->manga->cover_img)
                                            <img src="{{ asset('storage/' . $fav->manga->cover_img) }}"
                                                alt="{{ $fav->manga->title }}">
                                        @else
                                            <div class="placeholder-thumb">
                                                <i class="bi bi-image"></i>
                                                <span>No Image</span>
                                            </div>
                                        @endif
                                        <span class="manga-badge">{{ $fav->manga->type ?? 'Manga' }}</span>
                                    </div>

                                    <div class="card-content">
                                        <h3 class="card-title">{{ $fav->manga->title }}</h3>

                                        <div class="card-info">
                                            <div class="info-row">
                                                <i class="fas fa-pen"></i>
                                                <span><strong>Author:</strong> {{ $fav->manga->author ?? 'Unknown' }}</span>
                                            </div>
                                            <div class="info-row">
                                                <i class="fas fa-info-circle"></i>
                                                <span><strong>Status:</strong> {{ $fav->manga->status ?? 'N/A' }}</span>
                                            </div>
                                        </div>

                                        <div class="card-meta">
                                            @if ($fav->manga->genres && $fav->manga->genres->count() > 0)
                                                <div class="genre-badges">
                                                    @foreach ($fav->manga->genres as $genre)
                                                        <span class="genre-badge">{{ $genre->name }}</span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="genre-badges">
                                                    <span class="genre-badge">Unknown</span>
                                                </div>
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
                                            <a href="{{ route('manga.detail', $fav->manga_id) }}" class="btn-detail">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <form action="{{ route('admin.favorites.remove', $fav->favorite_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Remove this manga from favorites?');"
                                                style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove" title="Remove from Favorites">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="pagination-wrapper">
                        {{ $favorites->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @else
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
@endsection
