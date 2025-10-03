@extends('layouts.frontend')

@section('title', isset($keyword) ? 'Search Results' : 'My Manga List')

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
            padding: 40px 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .search-header {
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            padding: 20px 30px;
            border-radius: 16px;
            margin-bottom: 40px;
            box-shadow: 0 12px 32px rgba(255, 107, 71, 0.3);
        }

        .search-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .search-header span {
            font-weight: 800;
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

        .manga-cover-wrap {
            position: relative;
            width: 100%;
            height: 380px;
            overflow: hidden;
            background: var(--dark-bg-tertiary);
        }

        .manga-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .manga-card:hover .manga-cover {
            transform: scale(1.1);
        }

        .manga-cover-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent 60%);
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

        .manga-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .text-author {
            color: var(--text-muted) !important;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .btn-gradient {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 71, 0.4);
            color: white;
        }

        .btn-gradient i {
            font-size: 1.1rem;
        }

        /* Pagination styling from home.blade.php */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 48px;
        }

        .pagination {
            display: flex;
            gap: 8px;
        }

        .page-link {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
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
            color: white;
            box-shadow: 0 6px 16px rgba(255, 107, 71, 0.4);
        }

        .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            color: var(--text-muted);
            border-color: var(--border-color);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px 16px;
            }

            .search-header {
                padding: 16px 20px;
                margin-bottom: 24px;
            }

            .search-header h3 {
                font-size: 1.25rem;
            }

            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 20px;
            }

            .manga-cover-wrap {
                height: 280px;
            }
        }

        @media (max-width: 576px) {
            .manga-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .manga-cover-wrap {
                height: 240px;
            }

            .card-content {
                padding: 16px;
            }

            .manga-title {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="search-header">
            <i class="fas fa-search fa-lg"></i>
            <h3>Search Results for: <span>"{{ $keyword }}"</span></h3>
        </div>

        @if ($mangaList->count() > 0)
            <div class="manga-grid">
                @foreach ($mangaList as $manga)
                    <div class="manga-card">
                        <div class="manga-cover-wrap">
                            @if ($manga->cover_img)
                                <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}"
                                    class="manga-cover">
                            @else
                                <div class="placeholder-thumb">
                                    <i class="bi bi-image"></i>
                                    <span>No Image</span>
                                </div>
                            @endif
                            <div class="manga-cover-overlay"></div>
                            <span class="manga-badge">{{ $manga->type ?? 'Manga' }}</span>
                        </div>

                        <div class="card-content">
                            <h6 class="manga-title">{{ $manga->title }}</h6>
                            <p class="text-author">{{ $manga->author ?? 'Unknown Author' }}</p>
                            <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn-gradient">
                                <i class="fas fa-eye"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $mangaList->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center text-muted mt-5">
                <i class="bi bi-search" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                <h4>No results found</h4>
                <p>Try different keywords or check your spelling</p>
            </div>
        @endif
    </div>
@endsection
