<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\FavoriteModel;
use App\Models\UserModel;
use App\Models\MangaModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $favoriteList = FavoriteModel::with(['user', 'manga'])
            ->orderBy('favorite_id', 'desc')
            ->paginate(5);

        return view('admin.favorites.list', compact('favoriteList'));
    }

    public function toggle($manga_id)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'guest']);
        }

        $user = Auth::user();

        $favorite = FavoriteModel::where('user_id', $user->user_id)
            ->where('manga_id', $manga_id)
            ->first();

        if ($favorite) {
            // ลบออก
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // เพิ่มใหม่
            FavoriteModel::create([
                'user_id' => $user->user_id,
                'manga_id' => $manga_id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
    public function myFavorites()
    {
        $user = Auth::user();

        $favorites = FavoriteModel::with('manga')
            ->where('user_id', $user->user_id)
            ->orderBy('favorite_id', 'desc')
            ->paginate(10);

        return view('frontend.myfavorites', compact('favorites'));
    }

    // กด Favorite จากหน้า Frontend
    public function addFromFrontend($manga_id)
    {
        if (!Auth::check()) {
            // ถ้า guest → redirect ไป login
            return redirect()->route('login')
                ->with('error', 'Please login before adding to favorites.');
        }

        $user = Auth::user();

        $exists = FavoriteModel::where('user_id', $user->user_id)
            ->where('manga_id', $manga_id)
            ->exists();

        if ($exists) {
            Alert::info('This manga is already in your favorites.');
            return back();
        }

        FavoriteModel::create([
            'user_id'  => $user->user_id,
            'manga_id' => $manga_id,
        ]);

        Alert::success('Added to favorites!');
        return back();
    }

    // CRUD ที่เหลือ
    public function adding()
    {
        $users = UserModel::all();
        $manga = MangaModel::all();
        return view('admin.favorites.create', compact('users', 'manga'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'  => 'required|exists:users,user_id',
            'manga_id' => 'required|exists:manga,manga_id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.favorites.create')
                ->withErrors($validator)
                ->withInput();
        }

        FavoriteModel::create([
            'user_id'  => $request->user_id,
            'manga_id' => $request->manga_id
        ]);

        Alert::success('เพิ่ม Favorite สำเร็จ');
        return redirect()->route('admin.favorites.list');
    }

    public function edit($id)
    {
        $favorite = FavoriteModel::findOrFail($id);
        $users = UserModel::all();
        $manga = MangaModel::all();
        return view('admin.favorites.edit', compact('favorite', 'users', 'manga'));
    }

    public function update(Request $request, $id)
    {
        $favorite = FavoriteModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id'  => 'required|exists:users,user_id',
            'manga_id' => 'required|exists:manga,manga_id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.favorites.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $favorite->update([
            'user_id'  => $request->user_id,
            'manga_id' => $request->manga_id
        ]);

        Alert::success('อัปเดต Favorite สำเร็จ');
        return redirect()->route('admin.favorites.list');
    }

    public function remove($id)
    {
        $favorite = FavoriteModel::findOrFail($id);
        $favorite->delete();

        Alert::success('Removed from favorites successfully');

        // ✅ ถ้ามาจากหน้า My Favorites → กลับไปที่ /my-favorites
        if (url()->previous() === route('favorites.my')) {
            return redirect()->route('favorites.my');
        }

        // ✅ ถ้ามาจากหน้า manga.detail → กลับไปหน้านั้น
        if (str_contains(url()->previous(), '/manga/detail')) {
            return redirect()->back();
        }

        // ถ้าไม่ใช่ → กลับไป backend list
        return redirect()->route('admin.favorites.list');
    }
}