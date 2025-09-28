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

        // SiteVisit::create([
        //     'ip_address' => request()->ip(),
        //     'url'        => request()->fullUrl(),
        //     'user_agent' => request()->userAgent(),
        // ]);
        $popularManga = MangaModel::orderBy('release_year', 'desc')
            ->limit(8)
            ->get();



        return view('frontend.home', compact('popularManga'));
    }
}
