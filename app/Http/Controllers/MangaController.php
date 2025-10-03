<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\MangaModel;
use App\Models\GenreModel;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteModel;
use App\Models\MangaVisit;
use App\Models\SiteVisit;
use App\Models\ReviewModel;

class MangaController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $mangaList = MangaModel::with('genres')->orderBy('manga_id', 'desc')->paginate(5);
        return view('admin.manga.list', compact('mangaList'));
    }

    public function detail($id)
    {
        $manga = MangaModel::with(['reviews.user','genres'])->findOrFail($id);

        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = FavoriteModel::where('user_id', Auth::id())
                ->where('manga_id', $manga->manga_id)
                ->exists();
        }
        $userReview = auth()->check() 
        ? ReviewModel::where('user_id', auth()->id())
            ->where('manga_id', $id)
            ->first() 
        : null;

        return view('frontend.manga_detail', compact('manga', 'isFavorite', 'userReview'));
    }

    public function frontendList(Request $request)
    {
        $userFavorites = [];
        if (Auth::check()) {
            $userFavorites = FavoriteModel::where('user_id', Auth::id())
                ->pluck('manga_id')
                ->toArray();
        }

        $query = MangaModel::with(['genres', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        // Handle Search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhereHas('genres', function($g) use ($search) {
                        $g->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // ✅ FIX: Filter by Multiple Genres (AND condition)
        if ($request->has('genres') && is_array($request->genres)) {
            $genreIds = array_filter($request->genres, function($id) {
                return is_numeric($id) && $id > 0;
            });
            
            if (!empty($genreIds)) {
                foreach ($genreIds as $genreId) {
                    $query->whereHas('genres', function($q) use ($genreId) {
                        $q->where('manga_genre.genre_id', $genreId);
                    });
                }
            }
        }

        // ✅ FIX: Filter by Author - Handle exact and partial matches
        if ($request->filled('author')) {
            $author = trim($request->author);
            $query->where('author', 'like', "%{$author}%");
        }

        // ✅ FIX: Filter by Status - Direct where clause
        if ($request->filled('status') && in_array($request->status, ['Publishing', 'Completed'])) {
            $query->where('status', $request->status);
        }

        // Sort Options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'rating':
                $query->orderByDesc('reviews_avg_rating')
                      ->orderByDesc('reviews_count');
                break;
            case 'popularity':
                $query->orderByDesc('reviews_count')
                      ->orderByDesc('reviews_avg_rating');
                break;
            default: // latest
                $query->orderByDesc('manga_id');
        }

        // Pagination with remembered page
        $perPage = $request->get('per_page', 12);
        $mangaList = $query->paginate($perPage)->withQueryString();

        // ✅ FIX: Get all genres for sidebar
        $genres = GenreModel::orderBy('name')->get();

        // Count total results
        $totalResults = $mangaList->total();

        return view('frontend.mangalist', compact(
            'mangaList',
            'genres',
            'userFavorites',
            'totalResults',
            'sortBy',
            'perPage'
        ));
    }

    public function adding()
    {
        $genres = GenreModel::all();
        return view('admin.manga.create', compact('genres'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|min:3',
            'author'       => 'required|min:3',
            'publisher'    => 'nullable|string',
            'genres'       => 'required|array',
            'status'       => ['required', Rule::in(['Publishing', 'Completed'])],
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'type'         => ['required', Rule::in(['Manga','Manhwa','Manhua'])],
            'synopsis'     => 'nullable|string|max:2000',
            'cover_img'    => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
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

            $manga = MangaModel::create([
                'title'        => strip_tags($request->title),
                'author'       => strip_tags($request->author),
                'publisher'    => strip_tags($request->publisher),
                'status'       => $request->status,
                'release_year' => $request->release_year,
                'cover_img'    => $imagePath,
                'type'         => $request->type,
                'synopsis'     => $request->synopsis,
            ]);

            $manga->genres()->sync($request->genres);

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
        $manga = MangaModel::with('genres')->findOrFail($id);
        $genres = GenreModel::all();
        return view('admin.manga.edit', compact('manga','genres'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|min:3',
            'author'       => 'required|min:3',
            'publisher'    => 'nullable|string',
            'genres'       => 'required|array',
            'status'       => ['required', Rule::in(['Publishing', 'Completed'])],
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'type'         => ['required', Rule::in(['Manga','Manhwa','Manhua'])],
            'synopsis'     => 'nullable|string|max:2000',
            'cover_img'    => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.manga.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $manga = MangaModel::findOrFail($id);

            $data = [
                'title'        => strip_tags($request->title),
                'author'       => strip_tags($request->author),
                'publisher'    => strip_tags($request->publisher),
                'status'       => $request->status,
                'release_year' => $request->release_year,
                'type'         => $request->type,
                'synopsis'     => $request->synopsis,
            ];

            if ($request->hasFile('cover_img')) {
                if ($manga->cover_img) {
                    Storage::disk('public')->delete($manga->cover_img);
                }
                $data['cover_img'] = $request->file('cover_img')->store('uploads/manga', 'public');
            }

            $manga->update($data);
            $manga->genres()->sync($request->genres);

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

            $manga->genres()->detach();
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

        $query = MangaModel::with('genres');

        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('author', 'like', "%{$keyword}%")
                ->orWhere('publisher', 'like', "%{$keyword}%")
                ->orWhereHas('genres', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
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