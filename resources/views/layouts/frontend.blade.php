<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MyMangaList | Laravel 12')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

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

        * {
            scrollbar-width: thin;
            scrollbar-color: var(--primary-orange) var(--dark-bg-secondary);
        }

        *::-webkit-scrollbar {
            width: 8px;
        }

        *::-webkit-scrollbar-track {
            background: var(--dark-bg-secondary);
        }

        *::-webkit-scrollbar-thumb {
            background: var(--primary-orange);
            border-radius: 4px;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-bg-secondary) 100%);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
        }

        /* Main Navbar Styles */
        .main-navbar {
            background: rgba(15, 15, 15, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-navbar.scrolled {
            background: rgba(15, 15, 15, 0.98);
            backdrop-filter: blur(25px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 40px;
            height: 70px;
        }

        /* Logo Section */
        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text-primary) !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .brand-logo img {
            height: 72px;
            /* ปรับตามใจ เช่น 24px, 40px */
            width: auto;
            /* ให้สัดส่วนรูปไม่เพี้ยน */
            margin-right: 9px;
        }


        .navbar-brand:hover {
            transform: scale(1.01);
            color: var(--text-primary) !important;
        }


        .brand-text .highlight {
            color: var(--primary-orange);
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Navigation Menu */
        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 4px;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            white-space: nowrap;
        }

        .nav-link:hover {
            color: var(--text-primary);
            background: var(--hover-bg);
            transform: translateY(-0.5px) scale(1.01);
        }

        .nav-link.active {
            color: var(--primary-orange);
            background: rgba(255, 107, 71, 0.1);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-orange), var(--primary-orange-light));
            border-radius: 2px;
        }

        .nav-link i {
            font-size: 16px;
            width: 16px;
            text-align: center;
        }

        /* Search Section */
        .search-section {
            flex: 1;
            max-width: 400px;
            margin: 0 32px;
            position: relative;
        }

        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            height: 44px;
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid var(--border-color);
            border-radius: 22px;
            padding: 0 48px 0 20px;
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-orange);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(255, 107, 71, 0.1);
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-btn {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border: none;
            border-radius: 16px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.02);
            box-shadow: 0 2px 8px rgba(255, 107, 71, 0.3);
        }

        /* User Actions */
        .user-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-login {
            color: var(--text-secondary);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
        }

        .btn-login:hover {
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-0.5px) scale(1.02);
        }

        .btn-signup {
            color: white;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            box-shadow: 0 2px 8px rgba(255, 107, 71, 0.2);
        }

        .btn-signup:hover {
            color: white;
            background: linear-gradient(135deg, var(--primary-orange-light), var(--primary-orange));
            transform: translateY(-0.5px) scale(1.02);
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.3);
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-trigger:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid var(--primary-orange);
        }

        .user-avatar.placeholder {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            color: white;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-weight: 600;
            font-size: 13px;
            line-height: 1;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 8px;
            min-width: 200px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 14px;
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
        }

        .dropdown-item:hover {
            color: var(--text-primary);
            background: var(--hover-bg);
        }

        .dropdown-item.danger {
            color: #ff6b6b;
        }

        .dropdown-item.danger:hover {
            color: white;
            background: #ff6b6b;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 8px 0;
            border: none;
        }

        /* Admin Badge */
        .admin-badge {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #000;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Mobile Styles */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 20px;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: var(--hover-bg);
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: rgba(15, 15, 15, 0.98);
            backdrop-filter: blur(20px);
            border-top: 1px solid var(--border-color);
            padding: 20px;
            z-index: 1040;
        }

        .mobile-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .mobile-search {
            margin-bottom: 20px;
        }

        .mobile-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Notification Indicator */
        .notification-dot {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ff4757;
            border-radius: 50%;
            border: 2px solid var(--dark-bg);
        }

        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            inset: 0;
            background: transparent;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .search-section {
                max-width: 300px;
                margin: 0 16px;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                padding: 0 16px;
                height: 60px;
                gap: 20px;
            }

            .nav-menu,
            .search-section,
            .user-actions .action-btn {
                display: none;
            }

            .mobile-toggle {
                display: block;
            }

            .mobile-menu.show {
                display: block;
            }

            .brand-text {
                font-size: 1.2rem;
            }

            .mobile-menu {
                top: 60px;
            }
        }

        /* Content Offset */
        main.main-content {
            margin-top: 70px;
            padding: 32px 24px;
        }

        @media (max-width: 768px) {
            main.main-content {
                margin-top: 60px;
                padding: 24px 16px;
            }
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .dropdown-menu.show {
            animation: fadeInScale 0.2s ease;
        }

        .mobile-menu.show {
            animation: slideDown 0.3s ease;
        }
    </style>

    @yield('css_before')
    @stack('styles')
</head>

<body>
    <!-- Main Navigation -->
    <nav class="main-navbar" id="mainNavbar">
        <div class="navbar-container">
            <!-- Logo/Brand -->
            <a href="/" class="navbar-brand">
                <div class="brand-logo">
                    <img src="{{ asset('images/my-logo (3).png') }}" alt="MyMangaList">
                </div>
                <span class="brand-text">My<span class="highlight">Manga</span>List</span>
            </a>

            <!-- Main Navigation Menu -->
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mangalist" class="nav-link {{ request()->is('mangalist*') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>Browse</span>
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="{{ route('favorites.my') }}"
                            class="nav-link {{ request()->is('my-favorites*') ? 'active' : '' }}">
                            <i class="fas fa-heart"></i>
                            <span>My Favorites</span>
                        </a>
                    </li>
                @endauth
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">
                            <i class="fas fa-crown"></i>
                            <span>Admin</span>
                            <span class="admin-badge">Admin</span>
                        </a>
                    </li>
                @endif
            </ul>

            <!-- Search Section -->
            <div class="search-section">
                <form action="/manga/search" method="get" class="search-container">
                    <input type="text" name="keyword" class="search-input"
                        placeholder="Search manga, author, genre..." value="{{ request('keyword') }}"
                        autocomplete="off">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- User Actions -->
            <div class="user-actions">
                @guest
                    <a href="{{ route('login') }}" class="action-btn btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="action-btn btn-signup">
                        <i class="fas fa-user-plus"></i>
                        <span>Sign Up</span>
                    </a>
                @else
                    <div class="user-dropdown">
                        <div class="user-trigger" onclick="toggleDropdown()">
                            @if (auth()->user()->profile_img)
                                <img src="{{ asset('storage/' . auth()->user()->profile_img) }}" alt="Profile"
                                    class="user-avatar">
                            @else
                                <div class="user-avatar placeholder">
                                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                                </div>
                            @endif
                            <div class="user-info">
                                <span class="user-name">{{ auth()->user()->username }}</span>
                                <span class="user-role">{{ ucfirst(auth()->user()->role) }}</span>
                            </div>
                            <i class="fas fa-chevron-down" style="font-size: 12px; color: var(--text-muted);"></i>
                        </div>

                        <div class="dropdown-menu" id="userDropdown">
                            <a href="{{ route('profile.show') }}" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="{{ route('favorites.my') }}" class="dropdown-item">
                                <i class="fas fa-heart"></i>
                                <span>My Favorites</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>

                            @if (Auth::user()->role === 'admin')
                                <hr class="dropdown-divider">
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <i class="fas fa-crown"></i>
                                    <span>Admin Panel</span>
                                </a>
                            @endif

                            <hr class="dropdown-divider">
                            <form action="/logout" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item danger">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile Toggle -->
            <button class="mobile-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars" id="mobileToggleIcon"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <!-- Mobile Search -->
        <div class="mobile-search">
            <form action="/manga/search" method="get" class="search-container">
                <input type="text" name="keyword" class="search-input"
                    placeholder="Search manga, author, genre..." value="{{ request('keyword') }}"
                    autocomplete="off">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-nav">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="/mangalist" class="nav-link {{ request()->is('mangalist*') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Browse</span>
            </a>
            @auth
                <a href="{{ route('favorites.my') }}"
                    class="nav-link {{ request()->is('my-favorites*') ? 'active' : '' }}">
                    <i class="fas fa-heart"></i>
                    <span>My Favorites</span>
                </a>
                <a href="{{ route('profile.show') }}" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a>
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">
                        <i class="fas fa-crown"></i>
                        <span>Admin Panel</span>
                        <span class="admin-badge">Admin</span>
                    </a>
                @endif
            @endauth
        </div>

        <!-- Mobile Actions -->
        <div class="mobile-actions">
            @guest
                <a href="{{ route('login') }}" class="action-btn btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}" class="action-btn btn-signup">
                    <i class="fas fa-user-plus"></i>
                    <span>Sign Up</span>
                </a>
            @else
                <form action="/logout" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="action-btn btn-login danger"
                        style="background: #ff6b6b; color: white;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: var(--dark-bg-secondary); border-top: 1px solid var(--border-color); padding: 40px 0;">
        <div class="container text-center">
            <p style="margin: 0; color: var(--text-muted);">
                MyMangaList | Powered by Laravel 12 | ©2025
            </p>
        </div>
    </footer>

    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // User dropdown toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const toggleIcon = document.getElementById('mobileToggleIcon');

            mobileMenu.classList.toggle('show');

            if (mobileMenu.classList.contains('show')) {
                toggleIcon.className = 'fas fa-times';
            } else {
                toggleIcon.className = 'fas fa-bars';
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('userDropdown');
            const userTrigger = document.querySelector('.user-trigger');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileToggle = document.querySelector('.mobile-toggle');

            // Close user dropdown
            if (userDropdown && !userTrigger.contains(event.target)) {
                userDropdown.classList.remove('show');
            }

            // Close mobile menu
            if (mobileMenu && !mobileToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.remove('show');
                document.getElementById('mobileToggleIcon').className = 'fas fa-bars';
            }
        });

        // Search input focus effects
        document.querySelectorAll('.search-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Add loading states for navigation
        document.querySelectorAll('.nav-link, .action-btn').forEach(link => {
            link.addEventListener('click', function() {
                if (this.href && !this.href.includes('#')) {
                    this.classList.add('loading');
                }
            });
        });
    </script>

    @yield('js_before')
    @stack('scripts')
</body>

</html>
