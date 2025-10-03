<?php

namespace App\Http\Controllers;

use App\Models\MangaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteModel; // เพิ่มการนำเข้า FavoriteModel

class HomeController extends Controller
{
    public function index()
    {
        $userFavorites = [];
        if (Auth::check()) {
            $userFavorites = FavoriteModel::where('user_id', Auth::id())
                ->pluck('manga_id')
                ->toArray();
        }

        // ✅ Popular Manga: ดึง manga ที่มีค่าเฉลี่ย rating สูงสุด
        $popularManga = MangaModel::withAvg('reviews', 'rating')
            ->withCount('reviews') // ✅ เพิ่มบรรทัดนี้
            ->with('genres')
            ->orderByDesc('reviews_avg_rating')
            ->take(8)
            ->get();

        // ✅ Latest Releases: ดึง manga ล่าสุดตาม release_year
        $latestManga = MangaModel::withAvg('reviews', 'rating') // ✅ เพิ่มบรรทัดนี้
            ->withCount('reviews') // ✅ เพิ่มบรรทัดนี้
            ->with('genres')
            ->orderByDesc('release_year')
            ->take(8)
            ->get();

        // ✅ Popular Manhwa (ถ้าอยากแยกเฉพาะ manhwa)
        $popularManhwa = MangaModel::withAvg('reviews', 'rating')
            ->withCount('reviews') // ✅ เพิ่มบรรทัดนี้
            ->with('genres')
            ->where('type', 'Manhwa') // ✅ ต้องเป็น 'Manhwa' ตัวพิมพ์ใหญ่ตามที่เก็บใน database
            ->orderByDesc('reviews_avg_rating')
            ->take(8)
            ->get();

        return view('frontend.home', compact('latestManga', 'popularManga', 'userFavorites'));
    }
}