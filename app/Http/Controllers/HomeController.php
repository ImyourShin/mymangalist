<?php

namespace App\Http\Controllers;

use App\Models\MangaModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\SiteVisit;

class HomeController extends Controller
{
    public function index()
    {
        // 📌 Popular Manga: ดึง manga ที่มีค่าเฉลี่ย rating สูงสุด
        $popularManga = MangaModel::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(8)
            ->get();

        // 📌 Latest Releases: ดึง manga ล่าสุดตาม release_year
        $latestManga = MangaModel::orderByDesc('release_year')
            ->take(8)
            ->get();

        return view('frontend.home', compact('popularManga', 'latestManga'));
    }
}