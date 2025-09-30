@extends('layouts.frontend')

@section('title', 'Home')

@push('styles')
    
    <style>
        /* =============================================
           HOME PAGE STYLES - MATCHING NAVBAR THEME
           ============================================= */

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

        /* Main Content Container */
        .main-content {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-bg-secondary) 100%);
            padding-bottom: 80px;
        }

        /* =============================================
           HERO BANNER SECTION
           ============================================= */

        #heroBanner {
            height: 600px;
            overflow: hidden;
            border-radius: 0 0 24px 24px;
            margin-bottom: 80px;
            position: relative;
        }

        .banner {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out, visibility 1s ease-in-out;
        }

        .banner.active {
            opacity: 1;
            visibility: visible;
            z-index: 1;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 15, 15, 0.85) 0%, rgba(26, 26, 26, 0.7) 50%, rgba(15, 15, 15, 0.9) 100%);
        }

        .banner-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 24px;
            max-width: 900px;
            margin: 0 auto;
        }

        .banner-content h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 24px;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .banner-content p {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: var(--text-secondary);
            margin-bottom: 40px;
            max-width: 600px;
            line-height: 1.6;
        }

        /* Hero Button */
        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 40px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px rgba(255, 107, 71, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-orange-light), var(--primary-orange));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .btn-hero:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 32px rgba(255, 107, 71, 0.4);
            color: white;
        }

        .btn-hero:hover::before {
            opacity: 1;
        }

        .btn-hero i {
            position: relative;
            z-index: 1;
            font-size: 1.2rem;
        }

        /* Banner Navigation */
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: rgba(255, 107, 71, 0.2);
            border-color: var(--primary-orange);
            transform: translateY(-50%) scale(1.1);
        }

        .nav-left {
            left: 32px;
        }

        .nav-right {
            right: 32px;
        }

        /* Banner Indicators */
        .banner-indicators {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .indicator.active {
            background: var(--primary-orange);
            width: 32px;
            border-radius: 6px;
        }

        /* Animations */
        .animate-text {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .animate-text.delay-1 {
            animation-delay: 0.2s;
        }

        .animate-text.delay-2 {
            animation-delay: 0.4s;
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

        /* =============================================
           STATS SECTION
           ============================================= */

        .stats-section {
            max-width: 1400px;
            margin: 0 auto 100px;
            padding: 0 24px;
            text-align: center;
        }

        .stats-section h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .stats-section>p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 60px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 48px 32px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 107, 71, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .stat-item:hover {
            transform: translateY(-8px);
            border-color: var(--primary-orange);
            box-shadow: 0 20px 40px rgba(255, 107, 71, 0.15);
        }

        .stat-item:hover::before {
            opacity: 1;
        }

        .stat-item h3 {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            position: relative;
        }

        .stat-item p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            font-weight: 600;
            position: relative;
        }

        /* =============================================
           SECTION HEADERS
           ============================================= */

        .section-header {
            max-width: 1400px;
            margin: 0 auto 40px;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .title-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 8px 24px rgba(255, 107, 71, 0.3);
        }

        .section-title h2 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 900;
            color: var(--text-primary);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            margin: 4px 0 0 0;
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
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            background: rgba(255, 107, 71, 0.1);
            border-color: var(--primary-orange);
            color: var(--primary-orange);
            transform: translateX(4px);
        }

        /* =============================================
           MANGA GRID
           ============================================= */

        .manga-grid {
            max-width: 1400px;
            margin: 0 auto 80px;
            padding: 0 24px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 32px;
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
            color: var(--text-muted);
            background: linear-gradient(135deg, var(--dark-bg-secondary), var(--dark-bg-tertiary));
        }

        /* Card Content */
        .card-content {
            padding: 24px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6em;
        }

        /* Card Meta */
        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
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
        }

        .rating-display .stars {
            color: #ffd700;
            font-size: 0.95rem;
            letter-spacing: 1px;
        }

        .rating-display i {
            color: var(--primary-orange);
        }

        /* Card Actions */
        .card-action {
            display: flex;
            gap: 12px;
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
            border: none;
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

        /* =============================================
           FADE IN ANIMATIONS
           ============================================= */

        .fade-in {
            opacity: 0;
            animation: fadeIn 0.8s ease forwards;
        }

        .fade-in.stagger-1 {
            animation-delay: 0.1s;
        }

        .fade-in.stagger-2 {
            animation-delay: 0.2s;
        }

        .fade-in.stagger-3 {
            animation-delay: 0.3s;
        }

        .fade-in.stagger-4 {
            animation-delay: 0.4s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =============================================
           RESPONSIVE DESIGN
           ============================================= */

        @media (max-width: 1024px) {
            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 24px;
            }

            .card-thumbnail {
                height: 320px;
            }
        }

        @media (max-width: 768px) {
            #heroBanner {
                height: 500px;
                margin-bottom: 60px;
            }

            .nav-btn {
                width: 44px;
                height: 44px;
            }

            .nav-left {
                left: 16px;
            }

            .nav-right {
                right: 16px;
            }

            .banner-indicators {
                bottom: 24px;
            }

            .stats-section {
                margin-bottom: 60px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 16px;
            }

            .stat-item {
                padding: 32px 24px;
            }

            .stat-item h3 {
                font-size: 2.5rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 32px;
            }

            .title-icon {
                width: 56px;
                height: 56px;
                font-size: 1.5rem;
            }

            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 20px;
                margin-bottom: 60px;
            }

            .card-thumbnail {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            #heroBanner {
                height: 450px;
            }

            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
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

            .btn-detail {
                padding: 10px 16px;
                font-size: 0.85rem;
            }

            .btn-favorite {
                width: 44px;
                height: 44px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="main-content">
        <!-- Enhanced Hero Banner -->
        <div id="heroBanner" class="position-relative">
            <!-- Slide 1 -->
            <div class="banner w-100 active" style="background-image:url('{{ asset('images/banner1.jpeg') }}')">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h1 class="animate-text">Discover Your Next Favorite Manga</h1>
                    <p class="animate-text delay-1">Explore thousands of manga titles, read reviews, and build your personal
                        collection</p>
                    <a href="{{ route('frontend.mangalist') }}" class="btn-hero animate-text delay-2">
                        <i class="fas fa-rocket"></i>
                        Browse Manga
                    </a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="banner w-100" style="background-image:url('{{ asset('images/banner2.jpg') }}')">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h1 class="animate-text">Read Anytime, Anywhere</h1>
                    <p class="animate-text delay-1">Access your manga library on any device with seamless reading experience
                    </p>
                    <a href="{{ route('frontend.mangalist') }}" class="btn-hero animate-text delay-2">
                        <i class="fas fa-book-open"></i>
                        Start Reading
                    </a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="banner w-100" style="background-image:url('{{ asset('images/hero-3.jpg') }}')">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h1 class="animate-text">Join the Community</h1>
                    <p class="animate-text delay-1">Connect with fellow manga enthusiasts, share reviews, and discover
                        hidden gems</p>
                    <a href="{{ route('register') }}" class="btn-hero animate-text delay-2">
                        <i class="fas fa-users"></i>
                        Join Now
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <button class="nav-btn nav-left" onclick="previousSlide()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="nav-btn nav-right" onclick="nextSlide()">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Indicators -->
            <div class="banner-indicators">
                <div class="indicator active" onclick="goToSlide(0)"></div>
                <div class="indicator" onclick="goToSlide(1)"></div>
                <div class="indicator" onclick="goToSlide(2)"></div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section fade-in">
            <h2>Manga Paradise Awaits</h2>
            <p>Join thousands of manga enthusiasts in the ultimate reading community</p>
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>10,000+</h3>
                    <p>Manga Titles</p>
                </div>
                <div class="stat-item">
                    <h3>50,000+</h3>
                    <p>Active Readers</p>
                </div>
                <div class="stat-item">
                    <h3>100,000+</h3>
                    <p>Reviews Posted</p>
                </div>
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>Available Access</p>
                </div>
            </div>
        </div>

        <!-- Popular Section -->
        <div class="section-header fade-in">
            <div class="section-title">
                <div class="title-icon"><i class="fas fa-fire"></i></div>
                <div>
                    <h2>What's Popular</h2>
                    <p class="section-subtitle">Trending manga that everyone's talking about</p>
                </div>
            </div>
            <a href="{{ route('frontend.mangalist') }}" class="view-all-btn">View All <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="manga-grid">
            @foreach ($popularManga as $index => $manga)
                <div class="manga-card fade-in stagger-{{ ($index % 4) + 1 }}">
                    <div class="card-thumbnail">
                        @if ($manga->cover_img)
                            <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}">
                        @else
                            <div class="placeholder-thumb">
                                <i class="fas fa-image" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">{{ $manga->title }}</h3>

                        <div class="card-meta">
                            <span class="genre-badge">{{ $manga->genre ?? 'Unknown Genre' }}</span>

                            @if (!is_null($manga->reviews_avg_rating))
                                <div class="rating-display">
                                    <span class="stars">★★★★☆</span>
                                    <span>{{ number_format($manga->reviews_avg_rating, 1) }}</span>
                                </div>
                            @else
                                <div class="rating-display">
                                    <span class="stars">☆☆☆☆☆</span>
                                    <span>No rating</span>
                                </div>
                            @endif
                        </div>

                        <div class="card-action">
                            <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn-detail">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            <button class="btn-favorite" title="Add to Favorites"><i class="far fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Latest Releases Section -->
        @if (isset($latestManga) && $latestManga->count() > 0)
            <div class="section-header fade-in">
                <div class="section-title">
                    <div class="title-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h2>Latest Releases</h2>
                        <p class="section-subtitle">Fresh chapters and new series just added</p>
                    </div>
                </div>
                <a href="{{ route('frontend.mangalist') }}" class="view-all-btn">View All <i
                        class="fas fa-arrow-right"></i></a>
            </div>

            <div class="manga-grid">
                @foreach ($latestManga as $index => $manga)
                    <div class="manga-card fade-in stagger-{{ ($index % 4) + 1 }}">
                        <div class="card-thumbnail">
                            @if ($manga->cover_img)
                                <img src="{{ asset('storage/' . $manga->cover_img) }}" alt="{{ $manga->title }}">
                            @else
                                <div class="placeholder-thumb">
                                    <i class="fas fa-image" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                        </div>

                        <div class="card-content">
                            <h3 class="card-title">{{ $manga->title }}</h3>
                            <div class="card-meta">
                                <span class="genre-badge">{{ $manga->genre ?? 'Unknown Genre' }}</span>
                                <div class="rating-display">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $manga->release_year ?? 'Unknown' }}</span>
                                </div>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn-detail">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <button class="btn-favorite" title="Add to Favorites"><i
                                        class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        // Hero Banner Carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));

            currentSlide = (index + totalSlides) % totalSlides;
            slides[currentSlide].classList.add('active');
            indicators[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function previousSlide() {
            showSlide(currentSlide - 1);
        }

        function goToSlide(index) {
            showSlide(index);
        }

        // Auto-advance slides every 5 seconds
        let autoSlide = setInterval(nextSlide, 5000);

        // Pause auto-slide on hover
        const heroBanner = document.getElementById('heroBanner');
        if (heroBanner) {
            heroBanner.addEventListener('mouseenter', () => {
                clearInterval(autoSlide);
            });

            heroBanner.addEventListener('mouseleave', () => {
                autoSlide = setInterval(nextSlide, 5000);
            });
        }

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
@endsection
