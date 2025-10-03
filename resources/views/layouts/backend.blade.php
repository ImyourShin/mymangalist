<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyMangaList | Back Office</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- ==== Dark Admin Theme Styles (no variables/yields renamed) ==== -->
    <style>
        :root {
            --bg-900: #0d0d0d;
            /* sidebar panel */
            --bg-800: #1c1c1c;
            /* page background */
            --bg-700: #1c1c1c;
            /* cards */
            --text-100: #f5f5f7;
            /* white */
            --text-70: #b3b3b3;
            /* muted */
            --accent: #FF4C00;
            /* orange */
            --accent-20: rgba(255, 76, 0, .18);
            --border-soft: rgba(255, 255, 255, .08);
            --shadow-soft: 0 10px 30px rgba(0, 0, 0, .45);
            --radius: 12px;
        }

        html,
        body {
            background: var(--bg-800) fixed;
            color: var(--text-100);
        }

        a {
            text-decoration: none;
        }

        /* Layout containers */
        .admin-wrap {
            max-width: 1320px;
            margin: 0 auto;
        }

        .admin-row {
            gap: 0;
        }

        .sidebar-col {
            background: var(--bg-900);
            border-radius: var(--radius);
            box-shadow: var(--shadow-soft);
            position: sticky;
            top: 16px;
            height: calc(100vh - 32px);
            overflow: hidden;
            padding: 0;
        }

        .content-col {
            padding-left: 30px;
        }

        /* Header Card (replaces old alert) */
        .dash-header {
            background: linear-gradient(180deg, #151515, #121212);
            border-left: 4px solid var(--accent);
            border-radius: var(--radius);
            padding: 16px 18px;
            box-shadow: var(--shadow-soft);
        }

        .dash-header h4 {
            margin: 0;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .dash-sub {
            color: var(--text-70);
            font-size: .95rem;
        }

        /* Sidebar */
        .side-inner {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .brand {
            padding: 18px 16px;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand .logo-dot {
            width: 10px;
            height: 10px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 18px var(--accent-20);
        }

        .brand .title {
            font-weight: 700;
            letter-spacing: .3px;
        }

        .brand .title .accent {
            color: var(--accent);
        }

        .menu {
            padding: 10px;
            overflow: auto;
        }

        .menu .list-group {
            gap: 10px;
        }

        .menu .list-group-item {
            background: transparent;
            color: var(--text-70);
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform .15s ease, box-shadow .2s ease, border-color .2s ease, background .2s ease, color .2s ease;
        }

        .menu .list-group-item:hover {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-20);
            color: #FF4C00;
            transform: translateY(-1px);
        }

        .menu .list-group-item .ico {
            width: 26px;
            height: 26px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, .04);
            /* พื้นหลังวง */
            border-radius: 8px;
            /* มุมโค้ง */
            margin-right: 8px;
            transition: 0.25s ease;
        }

        .menu .list-group-item .ico img {
            width: 16px;
            height: 16px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            /* ให้เป็นโทนขาว */
            transition: 0.25s ease;
        }

        /* เมื่อเมนู active */
        .menu .list-group-item.active .ico {
            background: var(--accent);
            /* พื้นหลังส้ม */
        }

        .menu .list-group-item.active .ico img {
            filter: none;
            /* ให้โชว์สีจริงของรูป */
        }

        /* hover menu */
        .menu .list-group-item:hover {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-20);
            color: var(--accent);
            transform: translateY(-1px);
        }

        .menu .list-group-item:hover .ico {
            background: rgba(255, 76, 0, .2);
        }

        .menu .list-group-item.active {
            background: linear-gradient(180deg, rgba(255, 76, 0, .18), rgba(255, 76, 0, .12));
            border-color: var(--accent);
            color: #FF4C00;
            font-weight: 700;
        }


        .side-footer {
            margin-top: 14px;
        }

        .admin-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: #121212;
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .admin-mini .avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), #ff8a4a);
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #000;
        }

        .admin-mini .meta small {
            color: var(--text-70);
            display: block;
            line-height: 1.1;
        }

        .btn-logout {
            width: 40%;
            border: none;
            background: linear-gradient(180deg, var(--accent), #ff6b2a);
            color: var(--text-100);
            font-weight: 700;
            border-radius: 999px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            /* ระยะห่าง icon กับข้อความ */
            transition: transform .12s ease, box-shadow .2s ease, opacity .2s ease;
        }

        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 6px rgba(255, 76, 0, .45);
            opacity: .95;
        }

        .btn-logout .ico {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout .ico img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Content Area & Cards */
        .card-dark {
            background: var(--bg-700);
            border: 1px solid var(--border-soft);
            border-radius: var(--radius);
            box-shadow: var(--shadow-soft);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-bottom: 1px solid var(--border-soft);
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .section-title .tag {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: rgba(255, 76, 0, .2);
            color: var(--accent);
        }

        .card-body-compact {
            padding: 16px;
        }

        .metric {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px 0;
            font-size: 2rem;
            font-weight: 800;
        }

        .muted {
            color: var(--text-70);
        }

        /* Chart placeholders */
        .chart-wrap {
            padding: 12px;
        }

        .chart-placeholder {
            width: 100%;
            min-height: 260px;
            border: 1px dashed rgba(255, 255, 255, .15);
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: var(--text-70);
            background: repeating-conic-gradient(from 0deg, #1b1b1b 0% 25%, #191919 0% 50%);
            background-size: 20px 20px;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, .25);
            border-top: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 10px 12px;
            color: var(--text-70);
        }

        /* Responsive: collapse sidebar on < md */
        @media (max-width: 767.98px) {
            .content-col {
                padding-left: 0;
                margin-top: 12px;
            }

            .sidebar-col {
                height: auto;
                position: static;
            }

            .menu {
                display: block !important;
                padding: 16px;
                height: calc(100vh - 120px);
                overflow-y: auto;
            }

            .list-group {
                margin-bottom: 16px;
            }

            .list-group-item {
                margin-bottom: 8px;
            }

            /* ปรับขนาดปุ่มและระยะห่างให้ง่ายต่อการกดบนมือถือ */
            .menu .list-group-item {
                padding: 14px 16px;
                margin-bottom: 8px;
            }

            /* เพิ่ม active state ที่ชัดเจนขึ้น */
            .menu .list-group-item.active {
                background: var(--accent);
                color: white;
            }

            .menu .list-group-item.active .ico {
                background: rgba(255, 255, 255, 0.2);
            }
        }

        .menu-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            background: rgba(255, 76, 0, .12);
            /* พื้นหลังวงกลม */
            border: 2px solid #FF4C00;
            /* ขอบรอบวงกลม */
            box-shadow: 0 0 6px rgba(255, 76, 0, .4);
            /* glow เล็กน้อย */
        }

        .menu-icon img {
            width: 26px;
            height: 26px;

        }

        /* Mobile Menu Styles */
        @media (max-width: 767.98px) {
            .sidebar-col {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                width: 280px;
                z-index: 1000;
                transition: 0.3s ease-in-out;
                background: var(--bg-900);
            }

            .sidebar-col.active {
                left: 0;
            }

            .mobile-menu-toggle {
                position: fixed;
                top: 16px;
                left: 16px;
                z-index: 1001;
                width: 45px;
                height: 45px;
                border: none;
                border-radius: 12px;
                background: var(--accent);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            }

            .mobile-menu-toggle span {
                display: block;
                width: 24px;
                height: 2px;
                background: #fff;
                position: relative;
                transition: 0.3s ease;
            }

            .mobile-menu-toggle span:before,
            .mobile-menu-toggle span:after {
                content: '';
                position: absolute;
                width: 24px;
                height: 2px;
                background: #fff;
                left: 0;
                transition: 0.3s ease;
            }

            .mobile-menu-toggle span:before {
                top: -8px;
            }

            .mobile-menu-toggle span:after {
                bottom: -8px;
            }

            .mobile-menu-toggle.active span {
                background: transparent;
            }

            .mobile-menu-toggle.active span:before {
                top: 0;
                transform: rotate(45deg);
            }

            .mobile-menu-toggle.active span:after {
                bottom: 0;
                transform: rotate(-45deg);
            }

            .mobile-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .mobile-overlay.active {
                display: block;
            }

            .menu .list-group-item {
                padding: 12px 16px;
                font-size: 1.1rem;
            }

            .menu .list-group-item .ico {
                width: 32px;
                height: 32px;
            }

            .menu .list-group-item .ico img {
                width: 18px;
                height: 18px;
            }
        }
    </style>



    @yield('css_before')
</head>

<body>

    <!-- Add this just after <body> tag -->
    <button class="mobile-menu-toggle d-md-none">
        <span></span>
    </button>
    <div class="mobile-overlay"></div>


    @yield('header')

    <div class="container admin-wrap mt-4">
        <div class="row admin-row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar-col">
                <div class="side-inner">
                    <div class="brand">
                        <span class="logo-dot"></span>
                        <div class="title">My <span class="accent">Manga</span> List</div>
                    </div>

                    <div class="menu" id="sidebarCollapse">
                        <div class="list-group d-flex flex-column">

                            <a href="/admin/dashboard"
                                class="list-group-item list-group-item-action {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                <span class="ico">
                                    <img src="/images/icons/DashBoard/DashBoard.png" alt="Dashboard">
                                </span>
                                Dashboard
                            </a>

                            <a href="/admin/manga"
                                class="list-group-item list-group-item-action {{ request()->is('admin/manga*') ? 'active' : '' }}">
                                <span class="ico">
                                    <img src="/images/icons/DashBoard/Book.png" alt="Manga">
                                </span>
                                Manga
                            </a>

                            <a href="/admin/users"
                                class="list-group-item list-group-item-action {{ request()->is('admin/users*') ? 'active' : '' }}">
                                <span class="ico">
                                    <img src="/images/icons/DashBoard/User.png" alt="Manga">
                                </span>
                                Users
                            </a>

                            <a href="/admin/reviews"
                                class="list-group-item list-group-item-action {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                                <span class="ico">
                                    <img src="/images/icons/DashBoard/Comment.png" alt="Manga">
                                </span>
                                Reviews
                            </a>


                        </div>

                        @yield('sidebarMenu')

                        <div class="side-footer">
                            <a href="/" class="btn-logout {{ request()->is('/') ? 'active' : '' }}">
                                <span class="ico">
                                    <img src="/images/Home.png" alt="Home">
                                </span>
                                Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 content-col">



                @yield('content')
            </div>
        </div>
    </div>

    <footer class="mt-4 mb-2">
        <p class="text-center mb-0">MyMangaList | Admin Panel | ©2025</p>
    </footer>

    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

    @yield('js_before')

    {{-- SweetAlert --}}
    @include('sweetalert::alert')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('.mobile-menu-toggle');
            const sidebar = document.querySelector('.sidebar-col');
            const overlay = document.querySelector('.mobile-overlay');

            toggle?.addEventListener('click', function() {
                this.classList.toggle('active');
                sidebar?.classList.toggle('active');
                overlay?.classList.toggle('active');
                document.body.style.overflow = sidebar?.classList.contains('active') ? 'hidden' : '';
            });

            overlay?.addEventListener('click', function() {
                toggle?.classList.remove('active');
                sidebar?.classList.remove('active');
                this.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Close sidebar when clicking menu items on mobile
            const menuItems = document.querySelectorAll('.list-group-item');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        toggle?.classList.remove('active');
                        sidebar?.classList.remove('active');
                        overlay?.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
            });
        });
    </script>
</body>

</html>
