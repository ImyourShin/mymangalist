<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class FrontendReviewController extends Controller
{
    public function store(Request $request, $manga_id)
    {
        // ตรวจสอบว่า user เคยรีวิว manga นี้แล้วหรือยัง
        $existingReview = ReviewModel::where('user_id', Auth::id())
            ->where('manga_id', $manga_id)
            ->first();

        if ($existingReview) {
            Alert::warning('You have already reviewed this manga', 'You can edit your existing review instead.');
            return redirect()->route('manga.detail', $manga_id);
        }

        $validator = Validator::make($request->all(), [
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('manga.detail', $manga_id)
                ->withErrors($validator)
                ->withInput();
        }

        ReviewModel::create([
            'user_id'  => Auth::id(),
            'manga_id' => $manga_id,
            'rating'   => $request->rating,
            'comment'  => $request->comment,
        ]);

        Alert::success('Review added successfully');
        return redirect()->route('manga.detail', $manga_id);
    }

    public function update(Request $request, $id)
    {
        $review = ReviewModel::findOrFail($id);

        $this->authorize('update', $review);

        $validator = Validator::make($request->all(), [
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $review->update([
            'rating'  => $request->rating,
            'comment' => strip_tags($request->comment),
        ]);

        // ถ้าเป็น AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'review' => [
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'updated_at' => $review->updated_at->diffForHumans()
                ]
            ]);
        }

        Alert::success('Review updated successfully');
        return redirect()->route('manga.detail', $review->manga_id);
    }

    public function remove($id)
    {
        $review = ReviewModel::findOrFail($id);

        $this->authorize('delete', $review);

        $mangaId = $review->manga_id;
        $review->delete();

        Alert::success('Review deleted successfully');
        return redirect()->route('manga.detail', $mangaId);
    }
}