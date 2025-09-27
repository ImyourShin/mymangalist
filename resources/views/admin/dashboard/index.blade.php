@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">📊 Manga Dashboard</h1>

        {{-- Summary Cards --}}
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-primary">
                    <div class="card-body">
                        <h1 class="text-primary"><i class="bi bi-people-fill"></i></h1>
                        <h5 class="card-title">ผู้ใช้งาน</h5>
                        <h2 class="fw-bold">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm border-info">
                    <div class="card-body">
                        <h1 class="text-info"><i class="bi bi-journal-bookmark-fill"></i></h1>
                        <h5 class="card-title">มังงะทั้งหมด</h5>
                        <h2 class="fw-bold">{{ $countManga }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <h1 class="text-success"><i class="bi bi-chat-left-text-fill"></i></h1>
                        <h5 class="card-title">รีวิว</h5>
                        <h2 class="fw-bold">{{ $countReviews }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm border-warning">
                    <div class="card-body">
                        <h1 class="text-warning"><i class="bi bi-star-fill"></i></h1>
                        <h5 class="card-title">Favorites</h5>
                        <h2 class="fw-bold">{{ $countFavorites }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Views --}}
        <div class="row g-4 mt-3">
            <div class="col-md-6">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <h1 class="text-success"><i class="bi bi-eye-fill"></i></h1>
                        <h5 class="card-title">เข้าชมมังงะ</h5>
                        <h2 class="fw-bold">{{ $countMangaViews }}</h2>
                        <span class="badge bg-success">Unique: {{ $uniqueMangaVisitors }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-center shadow-sm border-danger">
                    <div class="card-body">
                        <h1 class="text-danger"><i class="bi bi-globe"></i></h1>
                        <h5 class="card-title">เข้าชมเว็บไซต์</h5>
                        <h2 class="fw-bold">{{ $countSiteViews }}</h2>
                        <span class="badge bg-danger">Unique: {{ $uniqueSiteVisitors }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Manga --}}
        <div class="row mt-5 g-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-trophy-fill"></i> Top 5 Manga by Views</h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อเรื่อง</th>
                                    <th class="text-center">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topManga as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->manga->title ?? 'Unknown' }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">{{ $item->total }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">ไม่มีข้อมูล</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="bi bi-star-fill"></i> Top 5 Manga by Favorites</h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อเรื่อง</th>
                                    <th class="text-center">Favorites</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topFavoriteManga as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->manga->title ?? 'Unknown' }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark">{{ $item->total }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">ไม่มีข้อมูล</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="row mt-5 g-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="bi bi-graph-up"></i> Views (7 วันล่าสุด)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="viewsChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="bi bi-bar-chart"></i> Favorites (7 วันล่าสุด)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="favoritesChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data จาก Laravel → JSON
        const dailyViews = @json($dailyViews);
        const dailyFavorites = @json($dailyFavorites);

        const viewLabels = dailyViews.map(item => item.date);
        const viewData = dailyViews.map(item => item.total);

        const favLabels = dailyFavorites.map(item => item.date);
        const favData = dailyFavorites.map(item => item.total);

        // Chart: Views
        new Chart(document.getElementById('viewsChart'), {
            type: 'line',
            data: {
                labels: viewLabels,
                datasets: [{
                    label: 'จำนวน Views',
                    data: viewData,
                    borderColor: 'rgba(25,135,84,1)',
                    backgroundColor: 'rgba(25,135,84,0.2)',
                    tension: 0.4,
                    fill: true
                }]
            }
        });

        // Chart: Favorites
        new Chart(document.getElementById('favoritesChart'), {
            type: 'bar',
            data: {
                labels: favLabels,
                datasets: [{
                    label: 'จำนวน Favorites',
                    data: favData,
                    backgroundColor: 'rgba(255,193,7,0.6)',
                    borderColor: 'rgba(255,193,7,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
