<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MyMangaList | Laravel 12')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }

        .navbar {
            background-color: #2e51a2 !important;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            margin-right: 10px;
        }

        .navbar-nav .nav-link.active {
            border-bottom: 2px solid #fff;
        }

        footer {
            background-color: #2e51a2;
            color: #fff;
            padding: 15px 0;
        }
    </style>

    @yield('css_before')
</head>

<body>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white" href="/">MyMangaList</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- เมนูหลัก -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                            data-bs-toggle="dropdown">
                            🛠 Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.manga.list') }}">📖 Manage Manga</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.users.list') }}">👥 Manage Users</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reviews.list') }}">💬 Manage Reviews</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.favorites.list') }}">⭐ Manage
                                    Favorites</a></li>
                        </ul>
                    </li>
                @endif
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active text-white' : 'text-white' }}"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mangalist') ? 'active text-white' : 'text-white' }}"
                            href="/mangalist">Manga List</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('my-favorites') ? 'active text-white' : 'text-white' }}"
                                href="{{ route('favorites.my') }}">
                                ⭐ My Favorites
                            </a>
                        </li>
                    @endauth
                </ul>

                <!-- search bar -->
                <form action="/manga/search" method="get" class="d-flex" role="search">
                    <input class="form-control me-2" type="text" name="keyword"
                        placeholder="Search Manga or Author..." value="{{ request('keyword') }}">
                    <button class="btn btn-light" type="submit">Search</button>
                </form>

                <!-- auth links -->
                <ul class="navbar-nav ms-3">
                    @auth
                        <li class="nav-item dropdown d-flex align-items-center">
                            {{-- Avatar --}}
                            @if (auth()->user()->profile_img)
                                <img src="{{ asset('storage/' . auth()->user()->profile_img) }}" alt="Profile"
                                    class="rounded-circle me-2" width="35" height="35" style="object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                    style="width:35px; height:35px; font-size:14px; color:#fff;">
                                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                                </div>
                            @endif

                            {{-- Dropdown --}}
                            <a class="nav-link dropdown-toggle text-white p-0" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">👤 My Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('favorites.my') }}">⭐ My Favorites</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">⚙️ Edit Profile</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- banner -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary text-center fw-bold">
                    Welcome to <span class="text-uppercase">MyMangaList</span> 🎉
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container mt-2">
        @yield('content')
    </div>

    <!-- footer -->
    <footer class="mt-5">
        <div class="container">
            <p class="text-center mb-0">MyMangaList | Powered by Laravel 12 | ©2025</p>
        </div>
    </footer>

    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js_before')
</body>

</html>
