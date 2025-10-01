<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\MangaModel;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteModel;
use App\Models\MangaVisit;
use App\Models\SiteVisit;

class MangaController extends Controller
{
    public function index()
    {

        Paginator::useBootstrap();
        $mangaList = MangaModel::orderBy('manga_id', 'desc')->paginate(5);

        return view('admin.manga.list', compact('mangaList'));
    }

    public function detail($id)
    {
        $manga = MangaModel::with('reviews.user')->findOrFail($id);

        // MangaVisit::create([
        //     'manga_id'   => $manga->manga_id,
        //     'ip_address' => request()->ip(),
        //     'url'        => request()->fullUrl(),
        //     'user_agent' => request()->userAgent(),
        // ]);

        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = FavoriteModel::where('user_id', Auth::id())
                ->where('manga_id', $manga->manga_id)
                ->exists();
        }

        return view('frontend.manga_detail', compact('manga', 'isFavorite'));
    }



    public function frontendList(Request $request)
    {
        $query = MangaModel::query();

        // ✅ Multi-search (Title, Author, Genre)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('genre', 'like', "%{$search}%");
            });
        }

        // ✅ Filter by Genres (checkbox)
        if ($request->has('genres') && is_array($request->genres)) {
            $query->whereIn('genre', $request->genres);
        }

        // ✅ Filter by Author (sidebar input)
        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        // ✅ Filter by Status (radio)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ✅ Pagination
        $mangaList = $query->orderBy('manga_id', 'desc')->paginate(9);

        // ✅ Data สำหรับ Sidebar
        $genres = MangaModel::select('genre')
            ->whereNotNull('genre')
            ->distinct()
            ->pluck('genre')
            ->toArray();

        $authors = MangaModel::select('author')
            ->whereNotNull('author')
            ->distinct()
            ->pluck('author')
            ->toArray();

        return view('frontend.mangalist', compact('mangaList', 'genres', 'authors'));
    }




    public function adding()
    {
        return view('admin.manga.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|min:3',
            'author'       => 'required|min:3',
            'publisher'    => 'nullable|string',
            'genre'        => 'required|string',
            'status'       => ['required', Rule::in(['Publishing', 'Completed'])],
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'cover_img'    => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'title.required'  => 'กรุณากรอกชื่อเรื่อง',
            'author.required' => 'กรุณากรอกชื่อผู้แต่ง',
            'genre.required'  => 'กรุณาเลือกหมวดหมู่',
            'cover_img.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น',
            'cover_img.max'   => 'ขนาดไฟล์ไม่เกิน 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.manga.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imagePath = $request->hasFile('cover_img')
                ? $request->file('cover_img')->store('uploads/manga', 'public')
                : null;

            MangaModel::create([
                'title'        => strip_tags($request->title),
                'author'       => strip_tags($request->author),
                'publisher'    => strip_tags($request->publisher),
                'genre'        => strip_tags($request->genre),
                'status'       => $request->status,
                'release_year' => $request->release_year,
                'cover_img'    => $imagePath,
            ]);

            Alert::success('Insert Successfully');
            return redirect()->route('admin.manga.list');
        } catch (\Exception $e) {
            report($e);
            Alert::error('เกิดข้อผิดพลาด', $e->getMessage());
            return redirect()->route('admin.manga.list');
        }
    }

    public function edit($id)
    {
        $manga = MangaModel::findOrFail($id);
        return view('admin.manga.edit', compact('manga'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|min:3',
            'author'       => 'required|min:3',
            'publisher'    => 'nullable|string',
            'genre'        => 'required|string',
            'status'       => ['required', Rule::in(['Publishing', 'Completed'])],
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'cover_img'    => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->route('manga.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $manga = MangaModel::findOrFail($id);

            $data = [
                'title'        => strip_tags($request->title),
                'author'       => strip_tags($request->author),
                'publisher'    => strip_tags($request->publisher),
                'genre'        => strip_tags($request->genre),
                'status'       => $request->status,
                'release_year' => $request->release_year,
            ];

            if ($request->hasFile('cover_img')) {
                if ($manga->cover_img) {
                    Storage::disk('public')->delete($manga->cover_img);
                }
                $data['cover_img'] = $request->file('cover_img')->store('uploads/manga', 'public');
            }

            $manga->update($data);

            Alert::success('Update Successfully');
            return redirect()->route('admin.manga.list');
        } catch (\Exception $e) {
            report($e);
            Alert::error('เกิดข้อผิดพลาด', $e->getMessage());
            return redirect()->route('admin.manga.list');
        }
    }

    public function remove($id)
    {
        try {
            $manga = MangaModel::findOrFail($id);

            if ($manga->cover_img && Storage::disk('public')->exists($manga->cover_img)) {
                Storage::disk('public')->delete($manga->cover_img);
            }

            $manga->delete();
            Alert::success('Delete Successfully');
            return redirect()->route('admin.manga.list');
        } catch (\Exception $e) {
            report($e);
            Alert::error('เกิดข้อผิดพลาด', $e->getMessage());
            return redirect()->route('admin.manga.list');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = MangaModel::query();

        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('author', 'like', "%{$keyword}%")
                ->orWhere('genre', 'like', "%{$keyword}%")
                ->orWhere('publisher', 'like', "%{$keyword}%");
        }

        $mangaList = $query->orderBy('manga_id', 'desc')->paginate(12);
        SiteVisit::create([
            'ip_address' => request()->ip(),
            'url'        => request()->fullUrl(),
            'user_agent' => request()->userAgent(),
        ]);

        return view('frontend.search', compact('mangaList', 'keyword'));
    }
}