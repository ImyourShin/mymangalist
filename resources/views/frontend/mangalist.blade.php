@extends('layouts.frontend')

@section('title', 'My Manga List')

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

        .sidebar-toggle-btn {
            position: fixed;
            left: 24px;
            top: 120px;
            z-index: 1001;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(255, 107, 71, 0.4);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 32px rgba(255, 107, 71, 0.5);
        }

        .sidebar-toggle-btn i {
            font-size: 1.3rem;
            transition: transform 0.4s ease;
        }

        .sidebar-wrapper {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform, opacity;
        }

        @keyframes slideOut {
            0% {
                opacity: 1;
                transform: translateX(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-100%);
            }
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-100%);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .sidebar-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-weight: 800;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            scroll-behavior: smooth;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 107, 71, 0.3);
            border-radius: 3px;
        }

        .filter-section {
            margin-bottom: 32px;
        }

        .filter-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 8px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: visible;
            opacity: 1;
        }

        .sidebar-section {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 8px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 12px;
            user-select: none;
        }

        .sidebar-section i:first-child {
            color: var(--primary-orange);
            font-size: 1.2rem;
        }

        .filter-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-color), transparent);
            margin: 24px 0;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid var(--border-color);
            color: var(--text-primary) !important;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .filter-content .form-control {
            grid-column: 1 / -1;
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
            height: auto;
            min-height: 45px;
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 71, 0.15);
            outline: none;
        }

        .form-check {
            padding-left: 0;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid var(--border-color);
            cursor: pointer;
            margin-right: 12px;
            margin-top: 0;
            margin-left: 0;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 71, 0.15);
        }

        .form-check-input:hover {
            border-color: var(--primary-orange-light);
        }

        .form-check-label {
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            user-select: none;
        }

        .form-check-input:checked+.form-check-label {
            color: var(--text-primary);
            font-weight: 600;
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

        .btn-outline-light {
            background: transparent;
            border: 1.5px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: var(--hover-bg);
            border-color: var(--primary-orange-light);
            color: var(--text-primary);
            transform: translateY(-2px);
        }

        .filter-actions {
            padding: 20px 24px;
            background: linear-gradient(to top, rgba(15, 15, 15, 0.95), rgba(26, 26, 26, 0.8));
            backdrop-filter: blur(10px);
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 12px;
            border-radius: 0 0 20px 20px;
        }

        .filter-actions .btn {
            flex: 1;
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

        @media (min-width: 992px) {
            .sidebar-card {
                position: sticky;
                top: 90px;
                max-height: calc(100vh - 110px);
            }

            .sidebar-scroll {
                max-height: calc(100vh - 250px);
            }

            .sidebar-wrapper {
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                transform-origin: left center;
            }

            .sidebar-wrapper.hidden {
                transform: translateX(-100%);
                flex: 0 0 0%;
                max-width: 0;
                padding: 0;
                overflow: hidden;
                opacity: 0;
            }

            .sidebar-wrapper.hidden~.col-lg-9 {
                flex: 0 0 100%;
                max-width: 100%;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar-card {
                transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar-wrapper.hidden .sidebar-card {
                transform: translateX(-50px);
            }
        }

        @media (max-width: 991px) {
            .sidebar-toggle-btn {
                display: none;
            }

            .sidebar-card {
                max-height: none;
            }

            .sidebar-scroll {
                max-height: none;
                padding-bottom: 100px;
            }

            .filter-actions {
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 999;
                border-radius: 0;
                box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.3);
                background: var(--dark-bg);
                padding: 16px 24px;
            }

            body {
                padding-bottom: 80px;
            }
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
            <button class="sidebar-toggle-btn" id="sidebarToggle" title="Toggle Filter Sidebar">
                <i class="bi bi-funnel-fill"></i>
            </button>

            <div class="page-header">
                <h1>Explore Manga Collection</h1>
                <p>Discover your next favorite story from our extensive library</p>
                @if (isset($mangaList) && $mangaList->total() > 0)
                    <span class="results-count">
                        <i class="bi bi-collection"></i>
                        {{ $mangaList->total() }} {{ Str::plural('manga', $mangaList->total()) }} found
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-12 col-lg-3 mb-4 sidebar-wrapper" id="sidebarWrapper">
                    <div class="card glass-panel sidebar-card">
                        <div class="sidebar-header">
                            <h5 class="section-title">
                                <i class="bi bi-funnel-fill"></i>
                                Refine Search
                            </h5>
                        </div>

                        <form action="{{ route('frontend.mangalist') }}" method="GET" id="filterForm"
                            class="d-flex flex-column h-100">
                            <div class="sidebar-scroll">
                                <div class="filter-section">
                                    <h6 class="sidebar-section">
                                        <i class="bi bi-tags-fill"></i>
                                        <span>Genres</span>
                                    </h6>
                                    <div class="filter-content">
                                        @foreach ($genres as $genre)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]"
                                                    value="{{ $genre->genre_id }}" id="genre-{{ $genre->genre_id }}"
                                                    {{ in_array($genre->genre_id, request()->get('genres', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="genre-{{ $genre->genre_id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="filter-divider"></div>

                                <div class="filter-section">
                                    <h6 class="sidebar-section">
                                        <i class="bi bi-person-fill"></i>
                                        <span>Author</span>
                                    </h6>
                                    <div class="filter-content" style="display: block;">
                                        <input type="text" name="author" class="form-control"
                                            placeholder="Search by author..." value="{{ request('author') }}"
                                            style="grid-column: 1 / -1;">
                                    </div>
                                </div>

                                <div class="filter-divider"></div>

                                <div class="filter-section">
                                    <h6 class="sidebar-section">
                                        <i class="bi bi-clock-history"></i>
                                        <span>Status</span>
                                    </h6>
                                    <div class="filter-content">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="Publishing"
                                                id="status-publishing"
                                                {{ request('status') == 'Publishing' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status-publishing">Publishing</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="Completed"
                                                id="status-completed"
                                                {{ request('status') == 'Completed' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status-completed">Completed</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-actions">
                                <button type="submit" class="btn btn-gradient">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Apply</span>
                                </button>
                                <a href="{{ route('frontend.mangalist') }}" class="btn btn-outline-light">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="manga-container">
                        @if (isset($mangaList) && $mangaList->count() > 0)
                            <div class="manga-grid">
                                @foreach ($mangaList as $manga)
                                    <div class="manga-card">
                                        <div class="card-thumbnail">
                                            @if ($manga->cover_img)
                                                <img src="{{ asset('storage/' . $manga->cover_img) }}"
                                                    alt="{{ $manga->title }}">
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
                                                @if ($manga->genres && $manga->genres->count() > 0)
                                                    <div class="genre-badges">
                                                        @foreach ($manga->genres as $g)
                                                            <span class="genre-badge">{{ $g->name }}</span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="genre-badges">
                                                        <span class="genre-badge">Unknown</span>
                                                    </div>
                                                @endif
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
                                                <a href="{{ route('manga.detail', $manga->manga_id) }}"
                                                    class="btn-detail">
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

                            <div class="pagination-wrapper">
                                {{ $mangaList->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h3>No Manga Found</h3>
                                <p>Try adjusting your filters or search criteria to find what you're looking for.</p>
                                <a href="{{ route('frontend.mangalist') }}" class="btn btn-gradient">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span>Reset Filters</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarWrapper = document.getElementById('sidebarWrapper');
            const toggleIcon = sidebarToggle?.querySelector('i');

            // Load saved sidebar state
            if (sidebarToggle && sidebarWrapper && window.innerWidth >= 992) {
                const sidebarHidden = localStorage.getItem('sidebarHidden') === 'true';
                if (sidebarHidden) {
                    sidebarWrapper.classList.add('hidden');
                    toggleIcon.className = 'bi bi-funnel-fill';
                }
            }

            // Toggle sidebar with smooth animation
            sidebarToggle?.addEventListener('click', function() {
                const isCurrentlyHidden = sidebarWrapper.classList.contains('hidden');

                if (isCurrentlyHidden) {
                    // กำลังจะเปิด
                    sidebarWrapper.classList.remove('hidden');
                    sidebarWrapper.style.animation = 'slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                    setTimeout(() => {
                        toggleIcon.className = 'bi bi-x-lg';
                    }, 250);
                } else {
                    // กำลังจะปิด
                    sidebarWrapper.style.animation = 'slideOut 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                    setTimeout(() => {
                        sidebarWrapper.classList.add('hidden');
                        toggleIcon.className = 'bi bi-funnel-fill';
                    }, 500);
                }

                localStorage.setItem('sidebarHidden', !isCurrentlyHidden);
            });

            // Update active filters count
            function updateActiveFiltersCount() {
                const checkedGenres = document.querySelectorAll('input[name="genres[]"]:checked').length;
                const authorValue = document.querySelector('input[name="author"]')?.value.trim();
                const statusChecked = document.querySelector('input[name="status"]:checked');

                const total = checkedGenres + (authorValue ? 1 : 0) + (statusChecked ? 1 : 0);

                const sectionTitle = document.querySelector('.section-title');
                let badge = sectionTitle?.querySelector('.filter-count');

                if (total > 0) {
                    if (!badge) {
                        badge = document.createElement('span');
                        badge.className = 'filter-count';
                        badge.style.cssText = `
                            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
                            color: white;
                            font-size: 0.75rem;
                            padding: 4px 10px;
                            border-radius: 999px;
                            margin-left: 8px;
                            font-weight: 700;
                        `;
                        sectionTitle.appendChild(badge);
                    }
                    badge.textContent = total;
                } else {
                    badge?.remove();
                }
            }

            updateActiveFiltersCount();

            document.querySelectorAll('.form-check-input, input[name="author"]').forEach(input => {
                input.addEventListener('change', updateActiveFiltersCount);
                input.addEventListener('input', updateActiveFiltersCount);
            });
        });
    </script>
@endpush
