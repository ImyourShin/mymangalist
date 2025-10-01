@extends('layouts.frontend')

@section('title', 'My Manga List')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* =============================================
                                                                                                                   MANGA LIST - PROFESSIONAL DARK THEME
                                                                                                                   Matching Home Page Design System
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
            --radius: 20px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        /* ===== Global Styles ===== */
        html,
        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-bg-secondary) 100%);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
        }

        /* ===== Page Header ===== */
        .page-header {
            max-width: 1400px;
            margin: 0 auto 40px;
            padding: 32px 24px 24px;
        }

        .page-header h1 {
            font-size: clamp(2rem, 4vw, 2.5rem);
            font-weight: 900;
            color: var(--text-primary);
            margin: 0 0 8px 0;
            letter-spacing: -0.02em;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin: 0;
        }

        .results-count {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 107, 71, 0.1);
            border: 1px solid rgba(255, 107, 71, 0.3);
            border-radius: 12px;
            color: var(--primary-orange-light);
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 12px;
        }

        /* เพิ่มใน Global Styles */
        html {
            overflow-x: hidden;
            /* ป้องกัน horizontal scrollbar ระหว่าง animation */
        }

        body {
            overflow-x: hidden;
        }

        /* ป้องกัน white flash */
        .container-fluid {
            background: var(--dark-bg);
            min-height: 100vh;
        }

        .row {
            background: transparent;
        }

        /* Optimize rendering */
        * {
            -webkit-tap-highlight-color: transparent;
        }

        /* ===== Glass Panel ===== */
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        /* ===== Sidebar Toggle Button ===== */
        .sidebar-toggle-btn {
            position: fixed;
            left: 20px;
            top: 100px;
            z-index: 1001;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border: none;
            color: white;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(255, 107, 71, 0.4);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(255, 107, 71, 0.5);
        }

        .sidebar-toggle-btn i {
            font-size: 1.2rem;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== Sidebar Wrapper ===== */
        .sidebar-wrapper {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform, opacity;
        }

        /* ===== Sidebar ===== */
        .sidebar-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .sidebar-header {
            padding: 24px 24px 16px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-weight: 800;
            font-size: 1.4rem;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-toggle {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 8px 16px;
            color: var(--text-primary);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
        }

        .filter-toggle:hover {
            background: rgba(255, 107, 71, 0.15);
            border-color: var(--primary-orange);
            color: var(--primary-orange-light);
        }

        .sidebar-content {
            flex: 1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 24px 20px;
            /* ลด padding */
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
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

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 107, 71, 0.5);
        }

        /* ===== Filter Sections ===== */
        .filter-section {
            margin-bottom: 34px;
        }

        .filter-section:last-child {
            margin-bottom: 0;
        }

        .filter-content {
            max-height: 1000px;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
            opacity: 1;
        }

        .filter-content.collapsed {
            max-height: 0;
            opacity: 0;
        }

        .sidebar-section {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.95rem;
            position: relative;
            padding: 12px 8px;
            margin-bottom: 16px;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.2s ease;
            user-select: none;
        }

        .sidebar-section:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-section i:first-child {
            color: var(--primary-orange);
            font-size: 1.1rem;
        }

        .sidebar-section .toggle-icon {
            margin-left: auto;
            font-size: 0.9rem;
            color: var(--text-muted);
            transition: transform 0.3s ease;
        }

        .sidebar-section.collapsed .toggle-icon {
            transform: rotate(-90deg);
        }

        .sidebar-section::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 8px;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-orange), transparent);
            border-radius: 2px;
        }

        .filter-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-color), transparent);
            margin: 28px -26px;
        }

        /* ===== Form Controls ===== */
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid var(--border-color);
            color: var(--text-primary) !important;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 71, 0.15);
            outline: none;
            color: var(--text-primary) !important;
        }

        /* ===== Checkboxes & Radios ===== */
        .form-check {
            padding-left: 0;
            /* เปลี่ยนจาก 8px เป็น 0 */
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
            /* เพิ่มระยะห่างจาก checkbox ถึง label */
            margin-top: 0;
            margin-left: 0;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 71, 0.15);
        }

        .form-check-input:hover {
            border-color: var(--primary-orange-light);
            background: rgba(255, 107, 71, 0.1);
        }

        .form-check-label {
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 0.9rem;
            transition: color 0.2s ease;
            user-select: none;
        }

        .form-check-input:checked+.form-check-label {
            color: var(--text-primary);
            font-weight: 500;
        }

        /* ===== Buttons ===== */
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.25);
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
            box-shadow: 0 6px 16px rgba(255, 107, 71, 0.35);
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
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-orange-light);
            color: var(--text-primary);
            transform: translateY(-2px);
        }

        /* ===== Filter Actions ===== */
        .filter-actions {
            padding: 20px 24px;
            background: linear-gradient(to top, rgba(15, 15, 15, 0.95), rgba(26, 26, 26, 0.8));
            backdrop-filter: blur(10px);
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 12px;
            border-radius: 0 0 var(--radius) var(--radius);
        }

        .filter-actions .btn {
            flex: 1;
        }

        /* ===== Manga Grid ===== */
        .manga-container {
            padding: 0 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .manga-grid {
            display: grid;
            gap: 32px;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        }

        /* ===== Manga Cards ===== */
        .manga-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .manga-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 107, 71, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
            z-index: 1;
        }

        .manga-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary-orange);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.4);
        }

        .manga-card:hover::before {
            opacity: 1;
        }

        /* ===== Cover Image ===== */
        .manga-cover-wrap {
            position: relative;
            overflow: hidden;
            height: 360px;
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
            background: linear-gradient(to top, rgba(15, 15, 15, 0.9) 0%, transparent 50%);
            z-index: 2;
        }

        .manga-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 999px;
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.4);
            z-index: 3;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* No Image Placeholder */
        .no-image {
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

        .no-image i {
            font-size: 3rem;
            opacity: 0.5;
        }

        .no-image span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* ===== Card Content ===== */
        .manga-card .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            background: rgba(15, 15, 15, 0.6);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .manga-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-primary);
            line-height: 1.3;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6em;
        }

        .text-author {
            color: var(--text-muted) !important;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 16px !important;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .text-author i {
            font-size: 0.75rem;
        }

        .manga-card .btn-gradient {
            margin-top: auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            font-size: 0.9rem;
        }

        /* ===== Empty State ===== */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--text-muted);
            opacity: 0.3;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        /* ===== Pagination ===== */
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
            flex-wrap: wrap;
        }

        .page-item {
            list-style: none;
        }

        .page-link {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 50% !important;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .page-link:hover {
            background: rgba(255, 107, 71, 0.15);
            border-color: var(--primary-orange);
            color: var(--text-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.2);
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
            box-shadow: none;
        }

        .pagination .page-link span:not([aria-hidden="true"]) {
            display: none !important;
        }

        /* ===== Animations ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
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

        .manga-card:nth-child(7) {
            animation-delay: 0.35s;
        }

        .manga-card:nth-child(8) {
            animation-delay: 0.4s;
        }

        .manga-card:nth-child(9) {
            animation-delay: 0.45s;
        }

        /* ===== Responsive Design ===== */
        @media (max-width: 1200px) {
            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 24px;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .manga-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 992px) {
            .sidebar-card {
                position: sticky;
                top: 90px;
                max-height: calc(100vh - 110px);
            }

            .sidebar-scroll {
                max-height: calc(100vh - 250px);
                /* ปรับให้เห็นเนื้อหาครบ */
                padding: 24px 20px;
            }

            .sidebar-toggle-btn {
                display: flex;
            }

            /* Reset row behavior */
            .container-fluid>.row {
                margin-right: -15px;
                margin-left: -15px;
            }

            /* Sidebar wrapper */
            .sidebar-wrapper {
                position: relative;
                width: 100%;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
                flex: 0 0 25%;
                max-width: 25%;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar-wrapper.hidden {
                flex: 0 0 0%;
                max-width: 0;
                padding: 0;
                overflow: hidden;
                opacity: 0;
            }

            /* Content column */
            .col-lg-9 {
                position: relative;
                width: 100%;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
                flex: 0 0 75%;
                max-width: 75%;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar-wrapper.hidden~.col-lg-9 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* Manga container - จัดกลางเสมอ */
            .manga-container {
                max-width: 1400px;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 991px) {
            .sidebar-toggle-btn {
                display: none;
            }

            /* จำกัดความสูง sidebar บนมือถือ/แท็บเล็ต */
            .sidebar-card {
                max-height: 75vh;
            }

            .sidebar-scroll {
                max-height: calc(75vh - 180px);
                padding: 20px 16px;
            }

            .filter-actions {
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 0;
                margin: 0;
                z-index: 999;
                background: rgba(15, 15, 15, 0.98);
                backdrop-filter: blur(20px);
                border-top: 1px solid var(--border-color);
                padding: 16px 20px;
                box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.3);
            }

            body {
                padding-bottom: 80px;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 24px 16px 16px;
            }

            .manga-container {
                padding: 0 16px;
            }

            .manga-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 20px;
            }

            .manga-cover-wrap {
                height: 280px;
            }

            .manga-title {
                font-size: 1rem;
            }

            .sidebar-scroll {
                padding: 16px 12px;
                max-height: calc(70vh - 160px);
            }

            /* ลด spacing */
            .filter-section {
                margin-bottom: 24px;
            }

            .sidebar-section {
                padding: 10px 6px;
                margin-bottom: 12px;
                font-size: 0.9rem;
            }

            .form-check {
                margin-bottom: 12px;
            }

            .filter-divider {
                margin: 20px -12px;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 1.1rem;
            }

            .manga-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .manga-cover-wrap {
                height: 240px;
            }

            .manga-card .card-body {
                padding: 16px;
            }

            .manga-title {
                font-size: 0.95rem;
            }

            .manga-badge {
                font-size: 0.65rem;
                padding: 4px 10px;
            }

            .page-link {
                width: 40px;
                height: 40px;
                font-size: 0.85rem;
            }

            .sidebar-scroll {
                padding: 12px 10px;
                max-height: calc(65vh - 140px);
            }

            .form-check-label {
                font-size: 0.85rem;
            }

            .form-control {
                font-size: 0.85rem;
                padding: 10px 12px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle-btn" id="sidebarToggle" title="Toggle Filter Sidebar">
            <i class="bi bi-funnel-fill"></i>
        </button>

        <!-- Page Header -->
        <div class="page-header fade-in">
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
            <!-- Sidebar Filter -->
            <div class="col-12 col-lg-3 mb-4 sidebar-wrapper" id="sidebarWrapper">
                <div class="card glass-panel sidebar-card">
                    <div class="sidebar-header">
                        <h5 class="section-title">
                            <i class="bi bi-funnel-fill"></i>
                            Refine Search
                        </h5>
                        <button class="filter-toggle d-lg-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#refineCollapse" aria-expanded="false" aria-controls="refineCollapse">
                            <i class="bi bi-chevron-down"></i>
                            <span>Filters</span>
                        </button>
                    </div>

                    <div class="collapse d-lg-block sidebar-content" id="refineCollapse">
                        <form action="{{ route('frontend.mangalist') }}" method="GET" id="filterForm"
                            class="d-flex flex-column h-100">
                            <div class="sidebar-scroll">

                                <!-- Genres Section -->
                                <div class="filter-section">
                                    <h6 class="sidebar-section" data-toggle="filter">
                                        <i class="bi bi-tags-fill"></i>
                                        <span>Genres</span>
                                        <i class="bi bi-chevron-down toggle-icon"></i>
                                    </h6>
                                    <div class="filter-content genre-list">
                                        @foreach ($genres as $g)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]"
                                                    value="{{ $g }}" id="genre-{{ $loop->index }}"
                                                    {{ in_array($g, request()->get('genres', [])) ? 'checked' : '' }}>
                                                <label
                                                    class="form-check-label
                                                for="genre-{{ $loop->index }}">{{ $g }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="filter-divider"></div>

                                <!-- Author Section -->
                                <div class="filter-section">
                                    <h6 class="sidebar-section" data-toggle="filter">
                                        <i class="bi bi-person-fill"></i>
                                        <span>Author</span>
                                        <i class="bi bi-chevron-down toggle-icon"></i>
                                    </h6>
                                    <div class="filter-content">
                                        <input type="text" name="author" class="form-control"
                                            placeholder="Search by author..." value="{{ request('author') }}">
                                    </div>
                                </div>

                                <div class="filter-divider"></div>

                                <!-- Status Section -->
                                <div class="filter-section">
                                    <h6 class="sidebar-section" data-toggle="filter">
                                        <i class="bi bi-clock-history"></i>
                                        <span>Status</span>
                                        <i class="bi bi-chevron-down toggle-icon"></i>
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

                            <!-- Filter Actions -->
                            <div class="filter-actions">
                                <button type="submit" class="btn btn-gradient">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Apply Filters</span>
                                </button>
                                <a href="{{ route('frontend.mangalist') }}" class="btn btn-outline-light">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Manga Grid -->
            <div class="col-12 col-lg-9">
                <div class="manga-container">
                    @if (isset($mangaList) && $mangaList->count() > 0)
                        <div class="manga-grid">
                            @foreach ($mangaList as $manga)
                                <div class="manga-card">
                                    <!-- Cover -->
                                    <div class="manga-cover-wrap">
                                        @if ($manga->cover_img)
                                            <img src="{{ asset('storage/' . $manga->cover_img) }}"
                                                alt="{{ $manga->title }}" class="manga-cover">
                                        @else
                                            <div class="no-image">
                                                <i class="bi bi-image"></i>
                                                <span>No Image</span>
                                            </div>
                                        @endif
                                        <div class="manga-cover-overlay"></div>
                                        <span class="manga-badge">{{ $manga->type ?? 'Manga' }}</span>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <h6 class="manga-title">{{ $manga->title }}</h6>
                                        <p class="text-author">
                                            <i class="bi bi-pencil"></i>
                                            {{ $manga->author ?? 'Unknown Author' }}
                                        </p>
                                        <a href="{{ route('manga.detail', $manga->manga_id) }}" class="btn btn-gradient">
                                            <i class="bi bi-eye-fill"></i>
                                            <span>View Details</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            {{ $mangaList->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h3>No Manga Found</h3>
                            <p>Try adjusting your filters or search criteria to find what you're looking for.</p>
                            <a href="{{ route('frontend.mangalist') }}" class="btn btn-gradient mt-3">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span>Reset Filters</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle Functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarWrapper = document.getElementById('sidebarWrapper');
            const toggleIcon = sidebarToggle.querySelector('i');
            const contentColumn = document.querySelector('.col-lg-9');

            // Check saved state
            window.addEventListener('load', function() {
                const sidebarHidden = localStorage.getItem('sidebarHidden') === 'true';
                if (sidebarHidden && window.innerWidth >= 992) {
                    sidebarWrapper.style.transition = 'none';
                    sidebarWrapper.classList.add('hidden');
                    toggleIcon.className = 'bi bi-funnel-fill';

                    requestAnimationFrame(() => {
                        sidebarWrapper.style.transition = '';
                    });
                }
            });

            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();

                // ใช้ requestAnimationFrame เพื่อ smooth animation
                requestAnimationFrame(() => {
                    const isHidden = sidebarWrapper.classList.toggle('hidden');

                    // Toggle icon
                    if (isHidden) {
                        setTimeout(() => {
                            toggleIcon.className = 'bi bi-funnel-fill';
                        }, 250);
                        sidebarToggle.title = 'Show Filters';
                    } else {
                        setTimeout(() => {
                            toggleIcon.className = 'bi bi-x-lg';
                        }, 250);
                        sidebarToggle.title = 'Hide Filters';
                    }

                    // Save state
                    localStorage.setItem('sidebarHidden', isHidden);
                });
            });
            // Toggle filter sections
            const filterToggles = document.querySelectorAll('[data-toggle="filter"]');

            filterToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const filterSection = this.closest('.filter-section');
                    const content = filterSection.querySelector('.filter-content');

                    // Toggle collapsed state
                    this.classList.toggle('collapsed');
                    content.classList.toggle('collapsed');

                    // Save state to localStorage
                    const sectionName = this.querySelector('span').textContent.trim();
                    const isCollapsed = this.classList.contains('collapsed');
                    localStorage.setItem(`filter-${sectionName}`, isCollapsed);
                });
            });

            // Restore saved states
            filterToggles.forEach(toggle => {
                const sectionName = toggle.querySelector('span').textContent.trim();
                const savedState = localStorage.getItem(`filter-${sectionName}`);

                if (savedState === 'true') {
                    const filterSection = toggle.closest('.filter-section');
                    const content = filterSection.querySelector('.filter-content');
                    toggle.classList.add('collapsed');
                    content.classList.add('collapsed');
                }
            });

            // Auto-hide mobile filter on apply (mobile only)
            const filterForm = document.getElementById('filterForm');
            const collapseElement = document.getElementById('refineCollapse');

            if (filterForm && collapseElement && window.innerWidth < 992) {
                filterForm.addEventListener('submit', function() {
                    const bsCollapse = bootstrap.Collapse.getInstance(collapseElement);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                });
            }

            

            // Smooth scroll to top after filter apply
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.toString() && !urlParams.has('page')) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Add active state animation to checkboxes/radios
            const filterInputs = document.querySelectorAll('.form-check-input');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    this.parentElement.style.animation = 'none';
                    setTimeout(() => {
                        this.parentElement.style.animation = 'pulse 0.3s ease';
                    }, 10);
                });
            });

            // Toggle icon rotation for mobile filter
            const filterToggle = document.querySelector('.filter-toggle');
            if (filterToggle && collapseElement) {
                collapseElement.addEventListener('show.bs.collapse', function() {
                    const icon = filterToggle.querySelector('i');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                });

                collapseElement.addEventListener('hide.bs.collapse', function() {
                    const icon = filterToggle.querySelector('i');
                    if (icon) icon.style.transform = 'rotate(0deg)';
                });
            }

            // Lazy loading for images
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            observer.unobserve(img);
                        }
                    }
                });
            }, {
                rootMargin: '50px'
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });

            // Highlight active filters count
            function updateActiveFiltersCount() {
                const checkedInputs = document.querySelectorAll('.form-check-input:checked').length;
                const authorInput = document.querySelector('input[name="author"]');
                const hasAuthor = authorInput && authorInput.value.trim() !== '';

                const totalActive = checkedInputs + (hasAuthor ? 1 : 0);

                const sectionTitle = document.querySelector('.section-title');
                if (sectionTitle) {
                    let badge = sectionTitle.querySelector('.filter-count');
                    if (totalActive > 0) {
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'filter-count';
                            badge.style.cssText = `
                                background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
                                color: white;
                                font-size: 0.75rem;
                                padding: 4px 8px;
                                border-radius: 999px;
                                margin-left: auto;
                                font-weight: 700;
                            `;
                            sectionTitle.appendChild(badge);
                        }
                        badge.textContent = totalActive;
                    } else if (badge) {
                        badge.remove();
                    }
                }
            }

            // Update count on page load and input change
            updateActiveFiltersCount();
            document.querySelectorAll('.form-check-input, input[name="author"]').forEach(input => {
                input.addEventListener('change', updateActiveFiltersCount);
                input.addEventListener('input', updateActiveFiltersCount);
            });

            // Add keyboard navigation for cards
            const mangaCards = document.querySelectorAll('.manga-card');
            mangaCards.forEach((card, index) => {
                card.setAttribute('tabindex', '0');
                card.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const link = this.querySelector('.btn-gradient');
                        if (link) link.click();
                    }
                });
            });

            // Fade in animation for page header
            const pageHeader = document.querySelector('.page-header');
            if (pageHeader) {
                pageHeader.style.opacity = '0';
                pageHeader.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    pageHeader.style.transition = 'all 0.6s ease';
                    pageHeader.style.opacity = '1';
                    pageHeader.style.transform = 'translateY(0)';
                }, 100);
            }

            // Add ripple effect to buttons
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.3);
                        left: ${x}px;
                        top: ${y}px;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;

                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);

                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                @keyframes pulse {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.02); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
