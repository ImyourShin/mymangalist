<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FrontendFavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggle($mangaId)
    {
        $manga = \App\Models\MangaModel::findOrFail($mangaId);
        
        $existing = FavoriteModel::where('user_id', Auth::id())
            ->where('manga_id', $mangaId)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json([
                'success' => true,
                'status' => 'removed',
                'message' => 'Removed from favorites'
            ]);
        }

        FavoriteModel::create([
            'user_id' => Auth::id(),
            'manga_id' => $mangaId
        ]);

        return response()->json([
            'success' => true,
            'status' => 'added',
            'message' => 'Added to favorites'
        ]);
    }

    public function remove($id)
    {
        try {
            $favorite = FavoriteModel::where('user_id', Auth::id())
                ->where('favorite_id', $id)
                ->firstOrFail();
                
            $favorite->delete();
            
            return redirect()->back()
                ->with('success', 'Manga removed from favorites successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to remove manga from favorites');
        }
    }
}