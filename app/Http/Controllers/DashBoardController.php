<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\MangaModel;
use App\Models\ReviewModel;
use App\Models\FavoriteModel;
use App\Models\MangaVisit;
use App\Models\SiteVisit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ✅ นับข้อมูลพื้นฐาน
        $totalUsers     = UserModel::count();
        $countManga     = MangaModel::count();
        $countReviews   = ReviewModel::count();
        $countFavorites = FavoriteModel::count();

        // ✅ log มังงะ
        $countMangaViews     = MangaVisit::count();
        $uniqueMangaVisitors = MangaVisit::distinct('ip_address')->count('ip_address');

        // ✅ log เว็บ
        $countSiteViews     = SiteVisit::count();
        $uniqueSiteVisitors = SiteVisit::distinct('ip_address')->count('ip_address');

        // ✅ top 5 มังงะที่ถูกดูเยอะสุด
        $topManga = MangaVisit::select('manga_id', DB::raw('COUNT(*) as total'))
            ->groupBy('manga_id')
            ->orderByDesc('total')
            ->with('manga')
            ->take(5)
            ->get();

        // ✅ top 5 มังงะที่ถูก favorite เยอะสุด
        $topFavoriteManga = FavoriteModel::select('manga_id', DB::raw('COUNT(*) as total'))
            ->groupBy('manga_id')
            ->orderByDesc('total')
            ->with('manga')
            ->take(5)
            ->get();

        // ✅ Views รายวัน 7 วันล่าสุด
        $dailyViews = MangaVisit::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // ✅ Favorites รายวัน 7 วันล่าสุด
        $dailyFavorites = FavoriteModel::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'countManga',
            'countReviews',
            'countFavorites',
            'countMangaViews',
            'uniqueMangaVisitors',
            'countSiteViews',
            'uniqueSiteVisitors',
            'topManga',
            'topFavoriteManga',
            'dailyViews',
            'dailyFavorites'
        ));
    }

    

}
